<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionBatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'batch_number',
        'production_plan_id',
        'part_id',
        'version',
        'status',
        'priority',
        'planned_quantity',
        'produced_quantity',
        'rejected_quantity',
        'material_cost',
        'labor_cost',
        'overhead_cost',
        'scheduled_start_time',
        'actual_start_time',
        'completed_time',
        'efficiency_rate',
        'total_runtime_minutes',
        'total_downtime_minutes',
        'quality_parameters',
        'machine_settings',
        'process_parameters',
        'machine_id',
        'operator_id'
    ];

    protected $casts = [
        'uuid' => 'string',
        'version' => 'integer',
        'planned_quantity' => 'integer',
        'produced_quantity' => 'integer',
        'rejected_quantity' => 'integer',
        'material_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'overhead_cost' => 'decimal:2',
        'scheduled_start_time' => 'datetime',
        'actual_start_time' => 'datetime',
        'completed_time' => 'datetime',
        'efficiency_rate' => 'decimal:2',
        'total_runtime_minutes' => 'integer',
        'total_downtime_minutes' => 'integer',
        'quality_parameters' => 'array',
        'machine_settings' => 'array',
        'process_parameters' => 'array'
    ];

    // Relationships
    public function productionPlan(): BelongsTo
    {
        return $this->belongsTo(ProductionPlan::class);
    }

    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function qualityChecks(): HasMany
    {
        return $this->hasMany(QualityCheck::class, 'checkable_id')
            ->where('checkable_type', self::class);
    }

    public function breakdowns(): HasMany
    {
        return $this->hasMany(Breakdown::class, 'breakdownable_id')
            ->where('breakdownable_type', self::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeMaterialAssigned($query)
    {
        return $query->where('status', 'material_assigned');
    }

    public function scopeInProduction($query)
    {
        return $query->where('status', 'in_production');
    }

    public function scopeInQualityCheck($query)
    {
        return $query->where('status', 'quality_check');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    // Accessors
    public function getDurationAttribute(): ?int
    {
        if (!$this->actual_start_time || !$this->completed_time) {
            return null;
        }
        return $this->completed_time->diffInMinutes($this->actual_start_time);
    }

    public function getEfficiencyAttribute(): float
    {
        if (!$this->duration || $this->duration === 0) {
            return 0;
        }
        return ($this->produced_quantity / $this->duration) * 60; // units per hour
    }

    public function getRejectionRateAttribute(): float
    {
        if ($this->produced_quantity === 0) {
            return 0;
        }
        return ($this->rejected_quantity / $this->produced_quantity) * 100;
    }

    public function getQualityScoreAttribute(): float
    {
        if (!$this->qualityChecks->count()) {
            return 0;
        }
        return $this->qualityChecks->avg('score');
    }

    public function getTotalCostAttribute(): float
    {
        return $this->material_cost + $this->labor_cost + $this->overhead_cost;
    }

    // Helper Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isMaterialAssigned(): bool
    {
        return $this->status === 'material_assigned';
    }

    public function isInProduction(): bool
    {
        return $this->status === 'in_production';
    }

    public function isInQualityCheck(): bool
    {
        return $this->status === 'quality_check';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function canBeStarted(): bool
    {
        return $this->status === 'material_assigned' && !$this->actual_start_time;
    }

    public function canBeCompleted(): bool
    {
        return $this->status === 'in_production' && $this->produced_quantity >= $this->planned_quantity;
    }

    public function start(): void
    {
        if ($this->canBeStarted()) {
            $this->status = 'in_production';
            $this->actual_start_time = now();
            $this->save();
        }
    }

    public function complete(): void
    {
        if ($this->canBeCompleted()) {
            $this->status = 'completed';
            $this->completed_time = now();
            $this->save();
        }
    }

    public function reject(string $reason = null): void
    {
        $this->status = 'rejected';
        $this->completed_time = now();
        if ($reason) {
            $this->quality_parameters = array_merge(
                $this->quality_parameters ?? [],
                ['rejection_reason' => $reason]
            );
        }
        $this->save();
    }

    public function updateProgress(int $produced, int $rejected = 0): void
    {
        $this->produced_quantity = $produced;
        $this->rejected_quantity = $rejected;

        if ($this->produced_quantity >= $this->planned_quantity) {
            $this->complete();
        }

        $this->save();
    }

    public function recordQualityCheck(array $parameters, float $score, string $notes = null): QualityCheck
    {
        return $this->qualityChecks()->create([
            'check_code' => 'QC' . str_pad($this->id . rand(1, 999), 8, '0', STR_PAD_LEFT),
            'parameters' => $parameters,
            'score' => $score,
            'notes' => $notes,
            'checked_by' => auth()->id(),
            'checked_at' => now()
        ]);
    }

    public function recordBreakdown(string $description, string $severity = 'medium'): Breakdown
    {
        return $this->breakdowns()->create([
            'breakdown_code' => 'BD' . str_pad($this->id . rand(1, 999), 8, '0', STR_PAD_LEFT),
            'description' => $description,
            'severity' => $severity,
            'status' => 'reported',
            'reported_by' => auth()->id(),
            'reported_at' => now()
        ]);
    }

    public function updateCosts(float $material = 0, float $labor = 0, float $overhead = 0): void
    {
        $this->material_cost = $material;
        $this->labor_cost = $labor;
        $this->overhead_cost = $overhead;
        $this->save();
    }

    public function recordDowntime(int $minutes, string $reason): void
    {
        $this->total_downtime_minutes += $minutes;
        $this->save();
    }

    public function updateEfficiencyRate(): void
    {
        if ($this->duration > 0) {
            $this->efficiency_rate = ($this->produced_quantity / $this->duration) * 60;
            $this->save();
        }
    }
}
