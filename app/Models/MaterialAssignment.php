<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialAssignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'production_stage_id',
        'assignment_number',
        'ld_details',
        'lld_details',
        'hd_details',
        'rd_details',
        'thickness',
        'width',
        'height',
        'target_weight',
        'batch_number',
        'mixing_date',
        'mixing_operator',
        'status',
        'mixing_parameters',
        'quality_checked',
        'quality_results',
        'total_assigned_weight',
        'total_consumed_weight',
        'total_waste',
        'total_returned',
        'number_of_batches',
        'batch_details',
        'batch_status',
        'mixing_instructions',
        'special_notes',
        'operator_notes',
        'process_alerts',
        'quality_alerts',
        'inventory_alerts',
        'assigned_by',
        'verified_by',
        'verified_at'
    ];

    protected $casts = [
        'ld_details' => 'array',
        'lld_details' => 'array',
        'hd_details' => 'array',
        'rd_details' => 'array',
        'mixing_parameters' => 'array',
        'quality_results' => 'array',
        'batch_details' => 'array',
        'batch_status' => 'array',
        'mixing_instructions' => 'array',
        'operator_notes' => 'array',
        'process_alerts' => 'array',
        'quality_alerts' => 'array',
        'inventory_alerts' => 'array',
        'quality_checked' => 'boolean',
        'mixing_date' => 'datetime',
        'verified_at' => 'datetime',
        'thickness' => 'decimal:3',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'target_weight' => 'decimal:2',
        'total_assigned_weight' => 'decimal:3',
        'total_consumed_weight' => 'decimal:3',
        'total_waste' => 'decimal:3',
        'total_returned' => 'decimal:3'
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

    public function mixingBatches(): HasMany
    {
        return $this->hasMany(MaterialMixingBatch::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInMixing($query)
    {
        return $query->where('status', 'in_mixing');
    }

    public function scopeMixed($query)
    {
        return $query->where('status', 'mixed');
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

    // Accessors
    public function getTotalWeightAttribute(): float
    {
        return $this->total_assigned_weight;
    }

    public function getConsumedPercentageAttribute(): float
    {
        if ($this->total_assigned_weight === 0) {
            return 0;
        }
        return ($this->total_consumed_weight / $this->total_assigned_weight) * 100;
    }

    public function getWastePercentageAttribute(): float
    {
        if ($this->total_consumed_weight === 0) {
            return 0;
        }
        return ($this->total_waste / $this->total_consumed_weight) * 100;
    }

    public function getCompletionPercentageAttribute(): float
    {
        if ($this->target_weight === 0) {
            return 0;
        }
        return ($this->total_consumed_weight / $this->target_weight) * 100;
    }

    // Helper Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isInMixing(): bool
    {
        return $this->status === 'in_mixing';
    }

    public function isMixed(): bool
    {
        return $this->status === 'mixed';
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

    public function isVerified(): bool
    {
        return !is_null($this->verified_at);
    }

    public function startMixing(): void
    {
        if ($this->isPending()) {
            $this->status = 'in_mixing';
            $this->save();
        }
    }

    public function completeMixing(): void
    {
        if ($this->isInMixing()) {
            $this->status = 'mixed';
            $this->save();
        }
    }

    public function startProcess(): void
    {
        if ($this->isMixed()) {
            $this->status = 'in_process';
            $this->save();
        }
    }

    public function completeProcess(): void
    {
        if ($this->isInProcess()) {
            $this->status = 'completed';
            $this->save();
        }
    }

    public function reject(string $reason): void
    {
        $this->status = 'rejected';
        $this->special_notes = $reason;
        $this->save();
    }

    public function verify(int $userId): void
    {
        $this->verified_by = $userId;
        $this->verified_at = now();
        $this->save();
    }

    public function updateConsumption(float $consumed, float $waste = 0, float $returned = 0): void
    {
        $this->total_consumed_weight = $consumed;
        $this->total_waste = $waste;
        $this->total_returned = $returned;
        $this->save();
    }

    public function addBatchDetails(array $details): void
    {
        $batchDetails = $this->batch_details ?? [];
        $batchDetails[] = $details;
        $this->batch_details = $batchDetails;
        $this->number_of_batches = count($batchDetails);
        $this->save();
    }

    public function updateQualityResults(array $results, bool $passed): void
    {
        $this->quality_results = $results;
        $this->quality_checked = true;
        if (!$passed) {
            $this->reject('Failed quality check');
        }
        $this->save();
    }
}
