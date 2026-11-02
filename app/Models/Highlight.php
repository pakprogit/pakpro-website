<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $table = 'highlights';

    protected $fillable = [
        'type',
        'month',
        'title',
        'summary',
        'media_type',
        'video_url',
        'poster',
        'alt_text',
        'link_url',
        'status',
        'published_at',
        'created_by',
        'is_placeholder',
    ];

    protected function casts(): array
    {
        return [
            'month' => 'date:Y-m-d',
            'is_placeholder' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getFormattedMonthAttribute(): string
    {
        return Carbon::parse($this->month)->format('F Y');
    }

    public function getMonthKeyAttribute(): string
    {
        return Carbon::parse($this->month)->format('Y-m');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeForPublic($query)
    {
        $allowPlaceholders = config('app.allow_placeholder_highlights_on_public', false);
        return $query->where('status', 'published')
            ->when(!$allowPlaceholders, function ($q) {
                $q->where('is_placeholder', false);
            });
    }

    public function scopeForMonth($query, string $yearMonth)
    {
        $startOfMonth = Carbon::createFromFormat('Y-m', $yearMonth)->startOfMonth()->toDateString();
        return $query->where('month', $startOfMonth);
    }
}

