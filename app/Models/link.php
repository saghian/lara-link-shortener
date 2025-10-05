<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'main_link',
        'short_link',
        'view',
        'is_active',

        'user_id',
        // 'custom_alias',
        'description',
        'click_count',
        'unique_click_count',
        'is_private',
        'password',
        'expires_at',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_private' => 'boolean',
        'expires_at' => 'datetime',
        'click_count' => 'integer',
        'unique_click_count' => 'integer',
    ];


    // اسکوپ برای لینک‌های فعال
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // اسکوپ برای لینک‌های منقضی نشده
    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        });
    }

    // اسکوپ برای لینک‌های قابل دسترسی
    public function scopeAccessible($query)
    {
        return $query->active()->notExpired();
    }

    // روابط
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clickLogs(): HasMany
    {
        return $this->hasMany(ClickLog::class);
    }

    public function dailyStats(): HasMany
    {
        return $this->hasMany(LinkVisitsDaily::class);
    }

    // بررسی انقضا
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    // بررسی فعال بودن
    public function isAccessible(): bool
    {
        return $this->is_active && !$this->isExpired();
    }

    // افزایش شمارنده کلیک
    public function incrementClickCount(): void
    {
        // $this->increment('click_count');
        $this->click_count++;
        $this->save();
    }

    // افزایش شمارنده کلیک منحصربفرد
    public function incrementUniqueClickCount(): void
    {
        // $this->increment('unique_click_count');
        $this->unique_click_count++;
        $this->save();
    }
}
