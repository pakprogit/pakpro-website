<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePublication extends Model
{
    use HasFactory;

    protected $table = 'price_publications';

    protected $fillable = [
        'user_id',
        'published_at',
        'snapshot',
        'change_summary',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'snapshot' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function latestPublication(): ?self
    {
        return static::orderBy('published_at', 'desc')->first();
    }
}

