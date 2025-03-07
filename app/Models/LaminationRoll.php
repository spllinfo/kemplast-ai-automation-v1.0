<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaminationRoll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lamination_process_id',
        'roll_batch_number',
        'barcode',
        'qr_code',
        'weight',
        'length',
        'width',
        'number_of_layers',
        'layer_details',
        'bond_strength',
        'delamination_test_passed',
        'coating_uniformity',
        'quality_measurements',
        'quality_status',
        'quality_approved',
        'quality_notes',
        'lamination_type',
        'adhesive_details',
        'adhesive_consumption',
        'curing_start_time',
        'curing_end_time',
        'machine_id',
        'machine_settings',
        'process_parameters',
        'status',
        'current_location',
        'movement_history',
        'next_process',
        'next_process_scheduled_time'
    ];

    protected $casts = [
        'layer_details' => 'array',
        'coating_uniformity' => 'array',
        'quality_measurements' => 'array',
        'adhesive_details' => 'array',
        'machine_settings' => 'array',
        'process_parameters' => 'array',
        'movement_history' => 'array',
        'delamination_test_passed' => 'boolean',
        'quality_approved' => 'boolean',
        'curing_start_time' => 'datetime',
        'curing_end_time' => 'datetime',
        'next_process_scheduled_time' => 'datetime',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'bond_strength' => 'decimal:2',
        'adhesive_consumption' => 'decimal:2'
    ];

    // Relationships
    public function laminationProcess(): BelongsTo
    {
        return $this->belongsTo(LaminationProcess::class);
    }

    // Scopes
    public function scopeInProduction($query)
    {
        return $query->where('status', 'in_production');
    }

    public function scopeInCuring($query)
    {
        return $query->where('status', 'in_curing');
    }

    public function scopeCuringCompleted($query)
    {
        return $query->where('status', 'curing_completed');
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
            'in_curing' => 'yellow',
            'curing_completed' => 'green',
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
        return "{$this->length}m x {$this->width}mm";
    }

    public function getCuringDurationAttribute(): ?int
    {
        if (!$this->curing_start_time || !$this->curing_end_time) {
            return null;
        }
        return $this->curing_end_time->diffInMinutes($this->curing_start_time);
    }

    // Helper Methods
    public function isInProduction(): bool
    {
        return $this->status === 'in_production';
    }

    public function isInCuring(): bool
    {
        return $this->status === 'in_curing';
    }

    public function isCuringCompleted(): bool
    {
        return $this->status === 'curing_completed';
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
            $this->status = 'in_curing';
            $this->curing_start_time = now();
            $this->save();
        }
    }

    public function completeCuring(): void
    {
        if ($this->isInCuring()) {
            $this->status = 'curing_completed';
            $this->curing_end_time = now();
            $this->save();
        }
    }

    public function sendToQualityCheck(): void
    {
        if ($this->isCuringCompleted()) {
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

    public function updateBondStrength(float $strength): void
    {
        $this->bond_strength = $strength;
        $this->save();
    }

    public function updateCoatingUniformity(array $readings): void
    {
        $this->coating_uniformity = $readings;
        $this->save();
    }

    public function updateAdhesiveConsumption(float $consumption): void
    {
        $this->adhesive_consumption = $consumption;
        $this->save();
    }
}
