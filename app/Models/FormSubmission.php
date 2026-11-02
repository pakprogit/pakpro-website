<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class FormSubmission extends Model
{
    use HasFactory;

    protected $table = 'form_submissions';

    protected $fillable = [
        'type',
        'data',
        'is_anonymous',
        'ip_address',
        'user_agent',
        'status',
        'reviewed_at',
        'reviewed_by',
    ];

    protected function casts(): array
    {
        return [
            'is_anonymous' => 'boolean',
            'reviewed_at' => 'datetime',
        ];
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Mutator for data attribute to support field-level encryption for grievances.
     */
    public function setDataAttribute($value): void
    {
        if ($this->type === 'grievance') {
            $json = is_string($value) ? $value : json_encode($value);
            $this->attributes['data'] = Crypt::encryptString($json);
        } else {
            $this->attributes['data'] = is_string($value) ? $value : json_encode($value);
        }
    }

    /**
     * Accessor for data attribute.
     */
    public function getDataAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        if ($this->type === 'grievance') {
            try {
                $decrypted = Crypt::decryptString($value);
                return json_decode($decrypted, true) ?? [];
            } catch (\Exception $e) {
                return json_decode($value, true) ?? [];
            }
        }

        return json_decode($value, true) ?? [];
    }
}

