<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkVisitsDaily extends Model
{
    use HasFactory;

    protected $table = 'link_visits_daily';

    protected $fillable = [
        'link_id',
        'date',
        'total_clicks',
        'unique_clicks',
        'desktop_clicks',
        'mobile_clicks',
        'tablet_clicks',
    ];

    protected $casts = [
        'date' => 'date',
        'total_clicks' => 'integer',
        'unique_clicks' => 'integer',
        'desktop_clicks' => 'integer',
        'mobile_clicks' => 'integer',
        'tablet_clicks' => 'integer',
    ];

    // غیرفعال کردن timestamps چون جدول آمار است
    public $timestamps = false;

    // روابط
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }

    // اسکوپ برای بازه زمانی خاص
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    // اسکوپ برای ۷ روز گذشته
    public function scopeLast7Days($query)
    {
        return $query->whereBetween('date', [
            now()->subDays(6)->format('Y-m-d'),
            now()->format('Y-m-d')
        ]);
    }

    // اسکوپ برای ۳۰ روز گذشته
    public function scopeLast30Days($query)
    {
        return $query->whereBetween('date', [
            now()->subDays(29)->format('Y-m-d'),
            now()->format('Y-m-d')
        ]);
    }

    // محاسبه مجموع آمار برای یک لینک
    public static function getStatsForLink($linkId, $days = 30)
    {
        return self::where('link_id', $linkId)
            ->last30Days()
            ->selectRaw('
                SUM(total_clicks) as total_clicks,
                SUM(unique_clicks) as unique_clicks,
                SUM(desktop_clicks) as desktop_clicks,
                SUM(mobile_clicks) as mobile_clicks,
                SUM(tablet_clicks) as tablet_clicks
            ')
            ->first();
    }

    // به‌روزرسانی آمار روزانه
    public static function updateDailyStats(Link $link, array $clickData): void
    {
        $today = now()->format('Y-m-d');

        self::updateOrCreate(
            [
                'link_id' => $link->id,
                'date' => $today
            ],
            [
                'total_clicks' => $clickData['total_clicks'] ?? 0,
                'unique_clicks' => $clickData['unique_clicks'] ?? 0,
                'desktop_clicks' => $clickData['desktop_clicks'] ?? 0,
                'mobile_clicks' => $clickData['mobile_clicks'] ?? 0,
                'tablet_clicks' => $clickData['tablet_clicks'] ?? 0,
            ]
        );
    }
}
