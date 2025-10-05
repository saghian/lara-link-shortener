<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClickLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'short_link',
        'ip_address',
        'user_agent',
        'referrer',
        'country',
        'city',
        'device_type',
        'browser',
        'platform',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // روابط
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }

    // اسکوپ برای بازدیدهای امروز
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    // اسکوپ برای بازدیدهای این هفته
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    // اسکوپ برای بازدیدهای این ماه
    public function scopeThisMonth($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ]);
    }

    // تشخیص نوع دستگاه
    public static function detectDeviceType($userAgent): string
    {
        if (preg_match('/(mobile|android|iphone)/i', $userAgent)) {
            return 'mobile';
        } elseif (preg_match('/(tablet|ipad)/i', $userAgent)) {
            return 'tablet';
        } elseif (preg_match('/(bot|crawl|spider)/i', $userAgent)) {
            return 'bot';
        } else {
            return 'desktop';
        }
    }

    // تشخیص مرورگر
    public static function detectBrowser($userAgent): string
    {
        if (preg_match('/chrome/i', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/firefox/i', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/safari/i', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/edge/i', $userAgent)) {
            return 'Edge';
        } else {
            return 'Other';
        }
    }

    // تشخیص سیستم عامل
    public static function detectPlatform($userAgent): string
    {
        if (preg_match('/windows/i', $userAgent)) {
            return 'Windows';
        } elseif (preg_match('/macintosh|mac os/i', $userAgent)) {
            return 'macOS';
        } elseif (preg_match('/linux/i', $userAgent)) {
            return 'Linux';
        } elseif (preg_match('/android/i', $userAgent)) {
            return 'Android';
        } elseif (preg_match('/iphone|ipad/i', $userAgent)) {
            return 'iOS';
        } else {
            return 'Other';
        }
    }

    public static function getLocationData($ipAddress)
    {
        // اگر IP لوکال هست، مقدار null برگردان
        if ($ipAddress === '127.0.0.1' || $ipAddress === '::1') {
            return ['country' => 'Local', 'city' => 'Local'];
        }

        // استفاده از دیتابیس آفلاین
        return self::getLocationFromIP($ipAddress);
    }
}
