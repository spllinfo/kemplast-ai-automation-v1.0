<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialMixingBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_assignment_id',
        'batch_number',
        'batch_sequence',
        'batch_weight',
        'mixing_start_time',
        'mixing_end_time',
        'material_quantities',
        'mixing_parameters',
        'quality_parameters',
        'quality_status',
        'quality_notes',
        'operator_id',
        'operator_notes',
        'status',
        'current_location',
        'movement_history'
    ];

    protected $casts = [
        'material_quantities' => 'array',
        'mixing_parameters' => 'array',
        'quality_parameters' => 'array',
        'movement_history' => 'array',
        'mixing_start_time' => 'datetime',
        'mixing_end_time' => 'datetime',
        'batch_weight' => 'decimal:2'
    ];

    // Relationships
    public function materialAssignment(): BelongsTo
    {
        return $this->belongsTo(MaterialAssignment::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProcess($query)
    {
        return $query->where('status', 'in_process');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeOnHold($query)
    {
        return $query->where('status', 'on_hold');
    }

    // Accessors
    public function getMixingDurationAttribute(): ?int
    {
        if (!$this->mixing_start_time || !$this->mixing_end_time) {
            return null;
        }
        return $this->mixing_end_time->diffInMinutes($this->mixing_start_time);
    }

    public function getQualityStatusColorAttribute(): string
    {
        return match($this->quality_status) {
            'pending' => 'yellow',
            'passed' => 'green',
            'failed' => 'red',
            default => 'gray'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'in_process' => 'blue',
            'completed' => 'green',
            'rejected' => 'red',
            'on_hold' => 'orange',
            default => 'gray'
        };
    }

    // Helper Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isInProcess(): bool
    {
        return $this->status === 'in_process';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isOnHold(): bool
    {
        return $this->status === 'on_hold';
    }

    public function start(): void
    {
        if ($this->isPending()) {
            $this->status = 'in_process';
            $this->mixing_start_time = now();
            $this->save();
        }
    }

    public function complete(): void
    {
        if ($this->isInProcess()) {
            $this->status = 'completed';
            $this->mixing_end_time = now();
            $this->save();
        }
    }

    public function reject(string $reason): void
    {
        $this->status = 'rejected';
        $this->quality_notes = $reason;
        $this->save();
    }

    public function putOnHold(string $reason): void
    {
        $this->status = 'on_hold';
        $this->operator_notes = $reason;
        $this->save();
    }

    public function resume(): void
    {
        if ($this->isOnHold()) {
            $this->status = 'in_process';
            $this->save();
        }
    }

    public function updateLocation(string $location): void
    {
        $history = $this->movement_history ?? [];
        $history[] = [
            'from' => $this->current_location,
            'to' => $location,
            'timestamp' => now()->toDateTimeString()
        ];

        $this->current_location = $location;
        $this->movement_history = $history;
        $this->save();
    }

    public function updateQualityStatus(string $status, ?string $notes = null): void
    {
        $this->quality_status = $status;
        if ($notes) {
            $this->quality_notes = $notes;
        }
        if ($status === 'failed') {
            $this->reject('Failed quality check');
        }
        $this->save();
    }
}
