<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtrusionRoll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'extrusion_process_id',
        'roll_number',
        'barcode',
        'qr_code',
        'weight',
        'length',
        'width',
        'thickness',
        'quality_measurements',
        'quality_status',
        'quality_approved',
        'quality_notes',
        'status',
        'current_location',
        'movement_history',
        'next_process',
        'next_process_scheduled_time'
    ];

    protected $casts = [
        'quality_measurements' => 'array',
        'movement_history' => 'array',
        'quality_approved' => 'boolean',
        'next_process_scheduled_time' => 'datetime',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'thickness' => 'decimal:3'
    ];

    // Relationships
    public function extrusionProcess(): BelongsTo
    {
        return $this->belongsTo(ExtrusionProcess::class);
    }

    // Scopes
    public function scopeInProduction($query)
    {
        return $query->where('status', 'in_production');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeInQualityCheck($query)
    {
        return $query->where('status', 'in_quality_check');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeInTransit($query)
    {
        return $query->where('status', 'in_transit');
    }

    public function scopeAtNextStage($query)
    {
        return $query->where('status', 'at_next_stage');
    }

    // Accessors
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'in_production' => 'blue',
            'completed' => 'green',
            'in_quality_check' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red',
            'in_transit' => 'orange',
            'at_next_stage' => 'purple',
            default => 'gray'
        };
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

    public function getDimensionsAttribute(): string
    {
        return "{$this->length}m x {$this->width}mm x {$this->thickness}μm";
    }

    // Helper Methods
    public function isInProduction(): bool
    {
        return $this->status === 'in_production';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isInQualityCheck(): bool
    {
        return $this->status === 'in_quality_check';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isInTransit(): bool
    {
        return $this->status === 'in_transit';
    }

    public function isAtNextStage(): bool
    {
        return $this->status === 'at_next_stage';
    }

    public function complete(): void
    {
        if ($this->isInProduction()) {
            $this->status = 'completed';
            $this->save();
        }
    }

    public function sendToQualityCheck(): void
    {
        if ($this->isCompleted()) {
            $this->status = 'in_quality_check';
            $this->updateLocation('Quality Check Area');
            $this->save();
        }
    }

    public function approve(): void
    {
        if ($this->isInQualityCheck()) {
            $this->status = 'approved';
            $this->quality_status = 'passed';
            $this->quality_approved = true;
            $this->save();
        }
    }

    public function reject(string $reason): void
    {
        if ($this->isInQualityCheck()) {
            $this->status = 'rejected';
            $this->quality_status = 'failed';
            $this->quality_approved = false;
            $this->quality_notes = $reason;
            $this->save();
        }
    }

    public function sendToNextProcess(string $process, ?string $scheduledTime = null): void
    {
        if ($this->isApproved()) {
            $this->next_process = $process;
            if ($scheduledTime) {
                $this->next_process_scheduled_time = $scheduledTime;
            }
            $this->status = 'in_transit';
            $this->save();
        }
    }

    public function arriveAtNextStage(): void
    {
        if ($this->isInTransit()) {
            $this->status = 'at_next_stage';
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

    public function updateQualityMeasurements(array $measurements): void
    {
        $this->quality_measurements = $measurements;
        $this->save();
    }
}
