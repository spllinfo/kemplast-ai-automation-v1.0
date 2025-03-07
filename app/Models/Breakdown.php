<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Breakdown extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'breakdown_code',
        'description',
        'severity',
        'status',
        'resolution',
        'reported_at',
        'resolved_at',
        'reported_by',
        'resolved_by',
        'metadata'
    ];

    protected $casts = [
        'reported_at' => 'datetime',
        'resolved_at' => 'datetime',
        'metadata' => 'array'
    ];

    // Relationships
    public function breakdownable(): MorphTo
    {
        return $this->morphTo();
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function resolver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    // Scopes
    public function scopeReported($query)
    {
        return $query->where('status', 'reported');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function scopeCritical($query)
    {
        return $query->where('severity', 'critical');
    }

    public function scopeHigh($query)
    {
        return $query->where('severity', 'high');
    }

    public function scopeMedium($query)
    {
        return $query->where('severity', 'medium');
    }

    public function scopeLow($query)
    {
        return $query->where('severity', 'low');
    }

    // Accessors
    public function getDurationAttribute(): ?int
    {
        if (!$this->resolved_at) {
            return null;
        }
        return $this->resolved_at->diffInMinutes($this->reported_at);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'reported' => 'red',
            'in_progress' => 'yellow',
            'resolved' => 'green',
            'closed' => 'gray',
            default => 'gray'
        };
    }

    public function getSeverityColorAttribute(): string
    {
        return match($this->severity) {
            'critical' => 'red',
            'high' => 'orange',
            'medium' => 'yellow',
            'low' => 'green',
            default => 'gray'
        };
    }

    // Helper Methods
    public function isReported(): bool
    {
        return $this->status === 'reported';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }

    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    public function isCritical(): bool
    {
        return $this->severity === 'critical';
    }

    public function startResolution(): void
    {
        if ($this->isReported()) {
            $this->status = 'in_progress';
            $this->save();
        }
    }

    public function resolve(string $resolution, int $resolvedBy): void
    {
        if ($this->isInProgress()) {
            $this->status = 'resolved';
            $this->resolution = $resolution;
            $this->resolved_by = $resolvedBy;
            $this->resolved_at = now();
            $this->save();
        }
    }

    public function close(): void
    {
        if ($this->isResolved()) {
            $this->status = 'closed';
            $this->save();
        }
    }

    public function reopen(): void
    {
        if ($this->isClosed()) {
            $this->status = 'reported';
            $this->resolution = null;
            $this->resolved_by = null;
            $this->resolved_at = null;
            $this->save();
        }
    }
}
