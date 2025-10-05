<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'ip_address',
        'user_agent',
        'country',
        'city',
        'first_visit_at',
        'last_activity_at',
        'page_views',
    ];

    protected $casts = [
        'first_visit_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'page_views' => 'integer',
    ];

    // بررسی منحصربفرد بودن سشن
    public static function isUniqueSession($sessionId, $ipAddress, $userAgent): bool
    {
        return !self::where('session_id', $sessionId)
            ->orWhere(function ($query) use ($ipAddress, $userAgent) {
                $query->where('ip_address', $ipAddress)
                    ->where('user_agent', $userAgent)
                    ->where('last_activity_at', '>', now()->subHours(24));
            })
            ->exists();
    }

    // ایجاد یا به‌روزرسانی سشن
    public static function createOrUpdateSession($sessionId, $ipAddress, $userAgent, $country = null, $city = null): void
    {
        $session = self::where('session_id', $sessionId)->first();

        if ($session) {
            $session->update([
                'last_activity_at' => now(),
                'page_views' => $session->page_views + 1,
                'country' => $country ?? $session->country,
                'city' => $city ?? $session->city,
            ]);
        } else {
            self::create([
                'session_id' => $sessionId,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'country' => $country,
                'city' => $city,
                'first_visit_at' => now(),
                'last_activity_at' => now(),
                'page_views' => 1,
            ]);
        }
    }

    // پاک کردن سشن‌های قدیمی
    public static function cleanupOldSessions($days = 30): void
    {
        self::where('last_activity_at', '<', now()->subDays($days))->delete();
    }

    // گرفتن آمار سشن‌های فعال
    public static function getActiveSessionsStats($hours = 24): array
    {
        $since = now()->subHours($hours);

        return [
            'total_sessions' => self::where('last_activity_at', '>=', $since)->count(),
            'unique_visitors' => self::where('last_activity_at', '>=', $since)
                ->distinct('ip_address')
                ->count('ip_address'),
            'new_visitors' => self::where('first_visit_at', '>=', $since)->count(),
        ];
    }
}
