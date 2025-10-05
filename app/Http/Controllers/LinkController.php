<?php

namespace App\Http\Controllers;

use App\Models\AppSession;
use App\Models\ClickLog;
use App\Models\Link;
use App\Models\LinkVisitsDaily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $allLinks = Link::all();
        return view('panel.link.index', compact('allLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'linkTitle' => 'required|string|max:100|min:2',
            'mainLink' => 'required|url',
            'shortLink' => 'required|string|alpha_dash|max:50|unique:links,short_link',
            'isActive' => 'required'
        ]);

        $linkData = [
            'title' => $validated['linkTitle'],
            'main_link' => $validated['mainLink'],
            'short_link' => $validated['shortLink'],
            'is_active' => $validated['isActive'] ?? false,
            'view' => '0'
        ];

        $link = Link::create($linkData);

        return redirect()->route('link.index')
            ->with('success', 'لینک با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }

    // 



    /**
     * ریدایرکت به لینک اصلی
     */
    public function redirect($shortLink)
    {
        // بررسی اگر در انتهای آدرس + باشد
        if (str_ends_with($shortLink, '+')) {
            $cleanShortLink = rtrim($shortLink, '+');
            return $this->showReport($cleanShortLink);
        }

        // پیدا کردن لینک
        $link = Link::where('short_link', $shortLink)
            ->accessible()
            ->first();

        if (!$link) {
            abort(404, 'لینک پیدا نشد یا منقضی شده است.');
        }

        // بررسی لینک خصوصی
        if ($link->is_private && $link->password) {
            return $this->showPasswordForm($link);
        }

        // ثبت کلیک و ریدایرکت
        return $this->processRedirect($link, $shortLink);
    }

    /**
     * نمایش گزارش لینک
     */
    public function showReport($shortLink)
    {
        $link = Link::where('short_link', $shortLink)->firstOrFail();

        // آمار کلی
        $totalStats = LinkVisitsDaily::getStatsForLink($link->id);

        // آمار روزانه ۳۰ روز گذشته
        $dailyStats = LinkVisitsDaily::where('link_id', $link->id)
            ->last30Days()
            ->orderBy('date', 'asc')
            ->get();

        // ds(compact('link', 'totalStats', 'dailyStats'));
        return view('links.report', compact('link', 'totalStats', 'dailyStats'));
    }

    /**
     * پردازش ریدایرکت و ثبت کلیک
     */
    private function processRedirect(Link $link, $shortLink)
    {
        // بررسی دسترسی به لینک خصوصی
        if ($link->is_private && $link->password && !session("link_access_{$link->id}")) {
            return $this->showPasswordForm($link);
        }

        // ثبت اطلاعات کلیک
        $this->logClick($link, $shortLink);

        // افزایش شمارنده
        $link->incrementClickCount();

        // به‌روزرسانی آمار روزانه
        $this->updateDailyStats($link);

        // ریدایرکت به لینک اصلی
        return redirect()->away($this->prepareRedirectUrl($link));
    }

    /**
     * ثبت اطلاعات کلیک - متد جدید
     */

    private function logClick(Link $link, $shortLink)
    {
        $userAgent = request()->userAgent();
        $ipAddress = request()->ip();

        // تشخیص موقعیت جغرافیایی
        $location = ClickLog::getLocationData($ipAddress);

        // تشخیص اطلاعات دستگاه
        $deviceType = ClickLog::detectDeviceType($userAgent);
        $browser = ClickLog::detectBrowser($userAgent);
        $platform = ClickLog::detectPlatform($userAgent);

        // بررسی سشن منحصربفرد
        $isUnique = AppSession::isUniqueSession(session()->getId(), $ipAddress, $userAgent);

        if ($isUnique) {
            $link->incrementUniqueClickCount();
        }

        // ثبت سشن با اطلاعات موقعیت
        AppSession::createOrUpdateSession(
            session()->getId(),
            $ipAddress,
            $userAgent,
            $location['country'],
            $location['city']
        );

        // ثبت لاگ کلیک
        ClickLog::create([
            'link_id' => $link->id,
            'short_link' => $shortLink,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'referrer' => request()->header('referer'),
            'country' => $location['country'],
            'city' => $location['city'],
            'device_type' => $deviceType,
            'browser' => $browser,
            'platform' => $platform,
        ]);
    }

    /**
     * به‌روزرسانی آمار روزانه - متد جدید
     */
    private function updateDailyStats(Link $link)
    {
        $today = now()->format('Y-m-d');

        $todayClicks = ClickLog::where('link_id', $link->id)
            ->whereDate('created_at', $today)
            ->get();

        $uniqueClicks = $todayClicks->unique('ip_address')->count();

        $deviceStats = $todayClicks->groupBy('device_type')->map->count();

        LinkVisitsDaily::updateDailyStats($link, [
            'total_clicks' => $todayClicks->count(),
            'unique_clicks' => $uniqueClicks,
            'desktop_clicks' => $deviceStats->get('desktop', 0),
            'mobile_clicks' => $deviceStats->get('mobile', 0),
            'tablet_clicks' => $deviceStats->get('tablet', 0),
        ]);
    }

    /**
     * نمایش فرم رمز لینک خصوصی
     */
    private function showPasswordForm(Link $link)
    {
        return view('links.password', compact('link'));
    }

    /**
     * بررسی رمز لینک خصوصی
     */
    public function checkPassword(Request $request, Link $link)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        if (password_verify($request->password, $link->password)) {
            session(["link_access_{$link->id}" => true]);
            return $this->processRedirect($link, $link->shortLink);
        }

        return back()->withErrors(['password' => 'رمز عبور نامعتبر است.']);
    }

    /**
     * آماده‌سازی URL برای ریدایرکت
     */
    private function prepareRedirectUrl(Link $link)
    {
        $mainLink = $link->main_link;

        // اضافه کردن پارامترهای UTM اگر وجود دارند
        $utmParams = [];
        if ($link->utm_source) {
            $utmParams['utm_source'] = $link->utm_source;
        }
        if ($link->utm_medium) {
            $utmParams['utm_medium'] = $link->utm_medium;
        }
        if ($link->utm_campaign) {
            $utmParams['utm_campaign'] = $link->utm_campaign;
        }
        if ($link->utm_term) {
            $utmParams['utm_term'] = $link->utm_term;
        }
        if ($link->utm_content) {
            $utmParams['utm_content'] = $link->utm_content;
        }

        if (!empty($utmParams)) {
            $separator = (parse_url($mainLink, PHP_URL_QUERY) ? '&' : '?');
            $mainLink .= $separator . http_build_query($utmParams);
        }

        return $mainLink;
    }

    /**
     * تولید لینک کوتاه یکتا
     */
    private function generateUniqueShortLink($length = 6)
    {
        do {
            $shortLink = Str::random($length);
        } while (Link::where('short_link', $shortLink)->exists());

        return $shortLink;
    }
}
