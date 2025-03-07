<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionStage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stage_code',
        'production_plan_id',
        'name',
        'description',
        'sequence',
        'status',
        'start_time',
        'end_time',
        'planned_duration',
        'actual_duration',
        'planned_quantity',
        'actual_quantity',
        'rejected_quantity',
        'quality_parameters',
        'machine_requirements',
        'operator_requirements',
        'material_requirements',
        'notes',
        'metadata'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'planned_duration' => 'integer',
        'actual_duration' => 'integer',
        'quality_parameters' => 'array',
        'machine_requirements' => 'array',
        'operator_requirements' => 'array',
        'material_requirements' => 'array',
        'metadata' => 'array',
        'sequence' => 'integer',
        'planned_quantity' => 'integer',
        'actual_quantity' => 'integer',
        'rejected_quantity' => 'integer'
    ];

    // Relationships
    public function productionPlan(): BelongsTo
    {
        return $this->belongsTo(ProductionPlan::class);
    }

    public function batches(): HasMany
    {
        return $this->hasMany(ProductionBatch::class);
    }

    public function qualityChecks(): HasMany
    {
        return $this->hasMany(QualityCheck::class);
    }

    public function breakdowns(): HasMany
    {
        return $this->hasMany(Breakdown::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeBySequence($query)
    {
        return $query->orderBy('sequence');
    }

    // Accessors
    public function getDurationAttribute(): ?int
    {
        if (!$this->start_time || !$this->end_time) {
            return null;
        }
        return $this->end_time->diffInMinutes($this->start_time);
    }

    public function getEfficiencyAttribute(): float
    {
        if (!$this->actual_duration || $this->actual_duration === 0) {
            return 0;
        }
        return ($this->actual_quantity / $this->actual_duration) * 60; // units per hour
    }

    public function getRejectionRateAttribute(): float
    {
        if ($this->actual_quantity === 0) {
            return 0;
        }
        return ($this->rejected_quantity / $this->actual_quantity) * 100;
    }

    public function getQualityScoreAttribute(): float
    {
        if (!$this->qualityChecks->count()) {
            return 0;
        }
        return $this->qualityChecks->avg('score');
    }

    public function getProgressAttribute(): float
    {
        if ($this->planned_quantity === 0) {
            return 0;
        }
        return ($this->actual_quantity / $this->planned_quantity) * 100;
    }

    // Helper Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function canBeStarted(): bool
    {
        return $this->status === 'pending' && !$this->start_time;
    }

    public function canBeCompleted(): bool
    {
        return $this->status === 'in_progress' && $this->actual_quantity >= $this->planned_quantity;
    }

    public function start(): void
    {
        if ($this->canBeStarted()) {
            $this->status = 'in_progress';
            $this->start_time = now();
            $this->save();
        }
    }

    public function complete(): void
    {
        if ($this->canBeCompleted()) {
            $this->status = 'completed';
            $this->end_time = now();
            $this->actual_duration = $this->duration;
            $this->save();
        }
    }

    public function fail(string $reason = null): void
    {
        $this->status = 'failed';
        $this->end_time = now();
        if ($reason) {
            $this->notes = $reason;
        }
        $this->save();
    }

    public function updateProgress(int $actual, int $rejected = 0): void
    {
        $this->actual_quantity = $actual;
        $this->rejected_quantity = $rejected;

        if ($this->actual_quantity >= $this->planned_quantity) {
            $this->complete();
        }

        $this->save();
    }

    public function recordQualityCheck(array $parameters, float $score, string $notes = null): QualityCheck
    {
        return $this->qualityChecks()->create([
            'parameters' => $parameters,
            'score' => $score,
            'notes' => $notes,
            'checked_by' => auth()->id()
        ]);
    }

    public function recordBreakdown(string $description, string $resolution = null): Breakdown
    {
        return $this->breakdowns()->create([
            'description' => $description,
            'resolution' => $resolution,
            'reported_by' => auth()->id()
        ]);
    }

    public function isDependentOn(ProductionStage $stage): bool
    {
        return $this->sequence > $stage->sequence;
    }

    public function hasDependencies(): bool
    {
        return $this->sequence > 1;
    }

    public function getDependencies(): array
    {
        return $this->productionPlan->productionStages()
            ->where('sequence', '<', $this->sequence)
            ->get()
            ->toArray();
    }

    public function getNextStage(): ?ProductionStage
    {
        return $this->productionPlan->productionStages()
            ->where('sequence', '>', $this->sequence)
            ->orderBy('sequence')
            ->first();
    }

    public function getPreviousStage(): ?ProductionStage
    {
        return $this->productionPlan->productionStages()
            ->where('sequence', '<', $this->sequence)
            ->orderBy('sequence', 'desc')
            ->first();
    }
}
