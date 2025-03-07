<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrintingProcess extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'production_stage_id',
        'material_assignment_id',
        'job_number',
        'part_name',
        'part_id',
        'part_description',
        'customer_code',
        'print_type',
        'number_of_colors',
        'color_details',
        'artwork_reference',
        'artwork_files',
        'machine_id',
        'machine_name',
        'machine_settings',
        'printing_speed',
        'tension_settings',
        'registration_marks',
        'print_parameters',
        'input_rolls',
        'total_input_weight',
        'planned_rolls',
        'completed_rolls',
        'ink_consumption',
        'ink_batch_numbers',
        'total_ink_cost',
        'ink_inventory',
        'color_density_readings',
        'registration_accuracy',
        'adhesion_test_passed',
        'quality_checkpoints',
        'quality_status',
        'quality_approved',
        'quality_notes',
        'total_runtime_minutes',
        'setup_time_minutes',
        'downtime_minutes',
        'downtime_reasons',
        'power_consumption',
        'good_output_quantity',
        'waste_quantity',
        'defect_categories',
        'production_metrics',
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
        'color_details' => 'array',
        'artwork_files' => 'array',
        'machine_settings' => 'array',
        'tension_settings' => 'array',
        'registration_marks' => 'array',
        'print_parameters' => 'array',
        'input_rolls' => 'array',
        'ink_consumption' => 'array',
        'ink_batch_numbers' => 'array',
        'ink_inventory' => 'array',
        'color_density_readings' => 'array',
        'registration_accuracy' => 'array',
        'quality_checkpoints' => 'array',
        'downtime_reasons' => 'array',
        'defect_categories' => 'array',
        'production_metrics' => 'array',
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
        'adhesion_test_passed' => 'boolean',
        'quality_approved' => 'boolean',
        'total_input_weight' => 'decimal:2',
        'total_ink_cost' => 'decimal:2',
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
        return $this->hasMany(PrintingRoll::class);
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
            $this->color_density_readings = $measurements;
        }
        $this->quality_status = $approved ? 'approved' : 'rejected';
        $this->save();
    }

    public function updateInkConsumption(array $consumption): void
    {
        $this->ink_consumption = $consumption;
        $this->total_ink_cost = collect($consumption)->sum('cost');
        $this->save();
    }

    public function updateRegistrationAccuracy(array $readings): void
    {
        $this->registration_accuracy = $readings;
        $this->save();
    }
}
