<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SlittingRoll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slitting_process_id',
        'roll_batch_number',
        'barcode',
        'qr_code',
        'parent_roll_id',
        'slit_number',
        'weight',
        'length',
        'width',
        'diameter',
        'core_details',
        'edge_quality',
        'edge_trim_width',
        'tension_values',
        'quality_measurements',
        'quality_status',
        'quality_approved',
        'quality_notes',
        'defects_found',
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
        'core_details' => 'array',
        'edge_quality' => 'array',
        'tension_values' => 'array',
        'quality_measurements' => 'array',
        'defects_found' => 'array',
        'machine_settings' => 'array',
        'process_parameters' => 'array',
        'movement_history' => 'array',
        'quality_approved' => 'boolean',
        'next_process_scheduled_time' => 'datetime',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'diameter' => 'decimal:2',
        'edge_trim_width' => 'decimal:2'
    ];

    // Relationships
    public function slittingProcess(): BelongsTo
    {
        return $this->belongsTo(SlittingProcess::class);
    }

    public function parentRoll(): BelongsTo
    {
        return $this->belongsTo(LaminationRoll::class, 'parent_roll_id');
    }

    // Scopes
    public function scopeInProduction($query)
    {
        return $query->where('status', 'in_production');
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

    // Helper Methods
    public function isInProduction(): bool
    {
        return $this->status === 'in_production';
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

    public function updateEdgeQuality(array $quality): void
    {
        $this->edge_quality = $quality;
        $this->save();
    }

    public function updateTensionValues(array $values): void
    {
        $this->tension_values = $values;
        $this->save();
    }

    public function recordDefect(array $defect): void
    {
        $defects = $this->defects_found ?? [];
        $defects[] = array_merge($defect, [
            'timestamp' => now()->toDateTimeString()
        ]);
        $this->defects_found = $defects;
        $this->save();
    }
}
