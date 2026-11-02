<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';

    protected $fillable = [
        'material',
        'slug',
        'recycler_min',
        'recycler_max',
        'aggregator_min',
        'aggregator_max',
        'note',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'recycler_min' => 'decimal:2',
            'recycler_max' => 'decimal:2',
            'aggregator_min' => 'decimal:2',
            'aggregator_max' => 'decimal:2',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Price $price) {
            if (empty($price->slug)) {
                $price->slug = Str::slug($price->material);
            }
        });
    }

    /**
     * Check status for admin badge: OK, Missing, Confirm.
     */
    public function getCheckStatusAttribute(): string
    {
        // Validation check: min cannot exceed max
        if (($this->recycler_min !== null && $this->recycler_max !== null && $this->recycler_min > $this->recycler_max) ||
            ($this->aggregator_min !== null && $this->aggregator_max !== null && $this->aggregator_min > $this->aggregator_max)) {
            return 'Error';
        }

        // Missing price: both recycler and aggregator are empty
        if ($this->recycler_min === null && $this->recycler_max === null &&
            $this->aggregator_min === null && $this->aggregator_max === null) {
            return 'Missing';
        }

        // Specific confirmation check
        if (!empty($this->note) && stripos($this->note, 'confirm') !== false) {
            return 'Confirm';
        }
        if (strcasecmp(trim($this->material), 'Milk pouches') === 0) {
            return 'Confirm';
        }

        return 'OK';
    }

    public static function formatRange(?float $min, ?float $max): string
    {
        if ($min === null && $max === null) {
            return 'To be confirmed';
        }
        if ($min !== null && $max !== null && (float)$min === (float)$max) {
            return 'KES ' . (floor($min) == $min ? number_format($min, 0) : number_format($min, 2));
        }
        if ($min !== null && $max !== null) {
            $minStr = floor($min) == $min ? number_format($min, 0) : number_format($min, 2);
            $maxStr = floor($max) == $max ? number_format($max, 0) : number_format($max, 2);
            return 'KES ' . $minStr . '–' . $maxStr;
        }
        if ($min !== null) {
            return 'From KES ' . (floor($min) == $min ? number_format($min, 0) : number_format($min, 2));
        }
        return 'Up to KES ' . (floor($max) == $max ? number_format($max, 0) : number_format($max, 2));
    }

    public function getRecyclerFormattedAttribute(): string
    {
        return static::formatRange($this->recycler_min !== null ? (float)$this->recycler_min : null, $this->recycler_max !== null ? (float)$this->recycler_max : null);
    }

    public function getAggregatorFormattedAttribute(): string
    {
        return static::formatRange($this->aggregator_min !== null ? (float)$this->aggregator_min : null, $this->aggregator_max !== null ? (float)$this->aggregator_max : null);
    }
}

