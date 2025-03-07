<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualityCheck extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'check_code',
        'checkable_type',
        'checkable_id',
        'parameters',
        'score',
        'notes',
        'checked_by',
        'checked_at',
        'metadata'
    ];

    protected $casts = [
        'parameters' => 'array',
        'metadata' => 'array',
        'score' => 'decimal:2',
        'checked_at' => 'datetime'
    ];

    // Relationships
    public function checkable(): MorphTo
    {
        return $this->morphTo();
    }

    public function checkedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->whereNull('checked_at');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('checked_at');
    }

    public function scopePassed($query)
    {
        return $query->where('score', '>=', 70);
    }

    public function scopeFailed($query)
    {
        return $query->where('score', '<', 70);
    }

    // Accessors
    public function getStatusAttribute(): string
    {
        if (!$this->checked_at) {
            return 'pending';
        }
        return $this->score >= 70 ? 'passed' : 'failed';
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'passed' => 'green',
            'failed' => 'red',
            default => 'gray'
        };
    }

    // Helper Methods
    public function isPending(): bool
    {
        return !$this->checked_at;
    }

    public function isPassed(): bool
    {
        return $this->score >= 70;
    }

    public function isFailed(): bool
    {
        return $this->score < 70;
    }

    public function complete(float $score, array $parameters, ?string $notes = null): void
    {
        $this->score = $score;
        $this->parameters = $parameters;
        if ($notes) {
            $this->notes = $notes;
        }
        $this->checked_at = now();
        $this->save();
    }

    public function addMetadata(array $data): void
    {
        $this->metadata = array_merge($this->metadata ?? [], $data);
        $this->save();
    }
}
