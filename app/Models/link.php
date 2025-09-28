<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'main_link',
        'short_link',
        'view',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
