<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'plan_code',
        'title',
        'description',
        'type',
        'priority',
        'status',
        'planned_start_date',
        'planned_end_date',
        'actual_start_date',
        'actual_end_date',
        'estimated_cost',
        'actual_cost',
        'budget',
        'material_cost',
        'labor_cost',
        'overhead_cost',
        'total_quantity',
        'completed_quantity',
        'rejected_quantity',
        'estimated_hours',
        'actual_hours',
        'completion_percentage',
        'efficiency_rate',
        'production_line',
        'location',
        'branch_id',
        'department_id',
        'created_by',
        'approved_by',
        'customer_id',
        'project_manager_id',
        'quality_parameters',
        'machine_requirements',
        'material_requirements',
        'metadata'
    ];

    protected $casts = [
        'planned_start_date' => 'datetime',
        'planned_end_date' => 'datetime',
        'actual_start_date' => 'datetime',
        'actual_end_date' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'budget' => 'decimal:2',
        'material_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'overhead_cost' => 'decimal:2',
        'completion_percentage' => 'decimal:2',
        'efficiency_rate' => 'decimal:2',
        'quality_parameters' => 'array',
        'machine_requirements' => 'array',
        'material_requirements' => 'array',
        'metadata' => 'array'
    ];

    // Relationships
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function projectManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public function productionBatches(): HasMany
    {
        return $this->hasMany(ProductionBatch::class);
    }

    public function productionStages(): HasMany
    {
        return $this->hasMany(ProductionStage::class);
    }

    // Scopes
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeOnHold($query)
    {
        return $query->where('status', 'on_hold');
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    public function scopeUrgent($query)
    {
        return $query->where('priority', 'urgent');
    }

    // Accessors
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'draft' => 'gray',
            'pending' => 'yellow',
            'approved' => 'blue',
            'in_progress' => 'green',
            'completed' => 'green',
            'cancelled' => 'red',
            'on_hold' => 'orange',
            default => 'gray'
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'low' => 'green',
            'medium' => 'yellow',
            'high' => 'orange',
            'urgent' => 'red',
            default => 'gray'
        };
    }

    public function getRemainingQuantityAttribute(): int
    {
        return $this->total_quantity - $this->completed_quantity;
    }

    public function getRejectionRateAttribute(): float
    {
        if ($this->completed_quantity === 0) {
            return 0;
        }
        return ($this->rejected_quantity / $this->completed_quantity) * 100;
    }

    // Helper Methods
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isOnHold(): bool
    {
        return $this->status === 'on_hold';
    }

    public function isHighPriority(): bool
    {
        return in_array($this->priority, ['high', 'urgent']);
    }

    public function canBeStarted(): bool
    {
        return $this->status === 'approved' && !$this->actual_start_date;
    }

    public function canBeCompleted(): bool
    {
        return $this->status === 'in_progress' && $this->completed_quantity >= $this->total_quantity;
    }

    public function calculateActualCost(): float
    {
        return $this->material_cost + $this->labor_cost + $this->overhead_cost;
    }

    public function calculateEfficiency(): float
    {
        if ($this->actual_hours === 0) {
            return 0;
        }
        return ($this->completed_quantity / $this->actual_hours) * 100;
    }

    public function updateProgress(int $completed, int $rejected = 0): void
    {
        $this->completed_quantity += $completed;
        $this->rejected_quantity += $rejected;
        $this->completion_percentage = ($this->completed_quantity / $this->total_quantity) * 100;

        if ($this->completion_percentage >= 100) {
            $this->status = 'completed';
            $this->actual_end_date = now();
        }

        $this->save();
    }
}
