<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExtrusionProcess extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'production_stage_id',
        'material_assignment_id',
        'job_number',
        'part_name',
        'part_description',
        'customer_code',
        'ld_ratio',
        'lld_ratio',
        'hd_ratio',
        'rd_ratio',
        'total_material_weight',
        'film_thickness',
        'film_width',
        'film_weight',
        'line_speed',
        'temperature_zones',
        'melt_temperature',
        'die_temperature',
        'temperature_history',
        'machine_id',
        'machine_name',
        'screw_speed',
        'pressure',
        'blow_up_ratio',
        'frost_line_height',
        'machine_parameters',
        'planned_rolls',
        'completed_rolls',
        'target_roll_weight',
        'roll_details',
        'thickness_variance',
        'quality_measurements',
        'quality_checkpoints',
        'quality_approved',
        'quality_status',
        'total_runtime_minutes',
        'downtime_minutes',
        'downtime_reasons',
        'power_consumption',
        'production_metrics',
        'good_output_quantity',
        'waste_quantity',
        'defect_details',
        'roll_inventory',
        'roll_movement',
        'operator_id',
        'supervisor_id',
        'operator_notes',
        'shift_details',
        'status',
        'process_alerts',
        'maintenance_alerts',
        'quality_alerts',
        'planned_start_time',
        'actual_start_time',
        'completion_time'
    ];

    protected $casts = [
        'temperature_zones' => 'array',
        'temperature_history' => 'array',
        'machine_parameters' => 'array',
        'roll_details' => 'array',
        'quality_measurements' => 'array',
        'quality_checkpoints' => 'array',
        'production_metrics' => 'array',
        'defect_details' => 'array',
        'roll_inventory' => 'array',
        'roll_movement' => 'array',
        'operator_notes' => 'array',
        'shift_details' => 'array',
        'process_alerts' => 'array',
        'maintenance_alerts' => 'array',
        'quality_alerts' => 'array',
        'planned_start_time' => 'datetime',
        'actual_start_time' => 'datetime',
        'completion_time' => 'datetime',
        'quality_approved' => 'boolean',
        'ld_ratio' => 'decimal:2',
        'lld_ratio' => 'decimal:2',
        'hd_ratio' => 'decimal:2',
        'rd_ratio' => 'decimal:2',
        'total_material_weight' => 'decimal:2',
        'film_thickness' => 'decimal:3',
        'film_width' => 'decimal:2',
        'film_weight' => 'decimal:2',
        'melt_temperature' => 'decimal:2',
        'die_temperature' => 'decimal:2',
        'screw_speed' => 'decimal:2',
        'pressure' => 'decimal:2',
        'blow_up_ratio' => 'decimal:2',
        'frost_line_height' => 'decimal:2',
        'target_roll_weight' => 'decimal:2',
        'thickness_variance' => 'decimal:2',
        'power_consumption' => 'decimal:2',
        'good_output_quantity' => 'decimal:3',
        'waste_quantity' => 'decimal:3'
    ];

    // Relationships
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function productionStage(): BelongsTo
    {
        return $this->belongsTo(ProductionStage::class);
    }

    public function materialAssignment(): BelongsTo
    {
        return $this->belongsTo(MaterialAssignment::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function rolls(): HasMany
    {
        return $this->hasMany(ExtrusionRoll::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInSetup($query)
    {
        return $query->where('status', 'in_setup');
    }

    public function scopeRunning($query)
    {
        return $query->where('status', 'running');
    }

    public function scopePaused($query)
    {
        return $query->where('status', 'paused');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeOnHold($query)
    {
        return $query->where('status', 'on_hold');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // Accessors
    public function getDurationAttribute(): ?int
    {
        if (!$this->actual_start_time || !$this->completion_time) {
            return null;
        }
        return $this->completion_time->diffInMinutes($this->actual_start_time);
    }

    public function getEfficiencyAttribute(): float
    {
        if (!$this->total_runtime_minutes || $this->total_runtime_minutes === 0) {
            return 0;
        }
        return ($this->good_output_quantity / $this->total_runtime_minutes) * 60; // units per hour
    }

    public function getWastePercentageAttribute(): float
    {
        if ($this->good_output_quantity + $this->waste_quantity === 0) {
            return 0;
        }
        return ($this->waste_quantity / ($this->good_output_quantity + $this->waste_quantity)) * 100;
    }

    public function getCompletionPercentageAttribute(): float
    {
        if ($this->planned_rolls === 0) {
            return 0;
        }
        return ($this->completed_rolls / $this->planned_rolls) * 100;
    }

    // Helper Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isInSetup(): bool
    {
        return $this->status === 'in_setup';
    }

    public function isRunning(): bool
    {
        return $this->status === 'running';
    }

    public function isPaused(): bool
    {
        return $this->status === 'paused';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isOnHold(): bool
    {
        return $this->status === 'on_hold';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function start(): void
    {
        if ($this->isPending()) {
            $this->status = 'in_setup';
            $this->actual_start_time = now();
            $this->save();
        }
    }

    public function startProduction(): void
    {
        if ($this->isInSetup()) {
            $this->status = 'running';
            $this->save();
        }
    }

    public function pause(string $reason): void
    {
        if ($this->isRunning()) {
            $this->status = 'paused';
            $this->operator_notes[] = [
                'type' => 'pause',
                'reason' => $reason,
                'timestamp' => now()->toDateTimeString()
            ];
            $this->save();
        }
    }

    public function resume(): void
    {
        if ($this->isPaused()) {
            $this->status = 'running';
            $this->save();
        }
    }

    public function complete(): void
    {
        if ($this->isRunning() || $this->isPaused()) {
            $this->status = 'completed';
            $this->completion_time = now();
            $this->save();
        }
    }

    public function putOnHold(string $reason): void
    {
        $this->status = 'on_hold';
        $this->operator_notes[] = [
            'type' => 'hold',
            'reason' => $reason,
            'timestamp' => now()->toDateTimeString()
        ];
        $this->save();
    }

    public function cancel(string $reason): void
    {
        $this->status = 'cancelled';
        $this->operator_notes[] = [
            'type' => 'cancellation',
            'reason' => $reason,
            'timestamp' => now()->toDateTimeString()
        ];
        $this->completion_time = now();
        $this->save();
    }

    public function updateProgress(int $completedRolls, float $goodOutput, float $waste = 0): void
    {
        $this->completed_rolls = $completedRolls;
        $this->good_output_quantity = $goodOutput;
        $this->waste_quantity = $waste;

        if ($this->completed_rolls >= $this->planned_rolls) {
            $this->complete();
        }

        $this->save();
    }

    public function recordDowntime(int $minutes, string $reason): void
    {
        $this->downtime_minutes += $minutes;
        $this->downtime_reasons[] = [
            'minutes' => $minutes,
            'reason' => $reason,
            'timestamp' => now()->toDateTimeString()
        ];
        $this->save();
    }

    public function updateQualityStatus(bool $approved, array $measurements = []): void
    {
        $this->quality_approved = $approved;
        if (!empty($measurements)) {
            $this->quality_measurements = $measurements;
        }
        $this->quality_status = $approved ? 'approved' : 'rejected';
        $this->save();
    }
}
