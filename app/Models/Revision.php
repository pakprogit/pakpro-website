<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'revisions';

    protected $fillable = [
        'model',
        'model_id',
        'user_id',
        'old',
        'new',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'old' => 'array',
            'new' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

