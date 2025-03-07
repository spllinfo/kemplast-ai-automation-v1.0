<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Machine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'machine_code',
        'name',
        'model_number',
        'serial_number',
        'manufacturer',
        'manufacturing_date',
        'purchase_date',
        'warranty_start_date',
        'warranty_end_date',
        'purchase_price',
        'current_value',
        'branch_id',
        'location',
        'status',
        'capacity',
        'capacity_unit',
        'power_consumption',
        'power_unit',
        'operating_pressure',
        'pressure_unit',
        'operating_temperature',
        'temperature_unit',
        'specifications',
        'maintenance_schedule',
        'spare_parts',
        'documents',
        'notes',
        'metadata'
    ];

    protected $casts = [
        'manufacturing_date' => 'datetime',
        'purchase_date' => 'datetime',
        'warranty_start_date' => 'datetime',
        'warranty_end_date' => 'datetime',
        'purchase_price' => 'decimal:2',
        'current_value' => 'decimal:2',
        'specifications' => 'array',
        'maintenance_schedule' => 'array',
        'spare_parts' => 'array',
        'documents' => 'array',
        'metadata' => 'array',
        'capacity' => 'decimal:2',
        'power_consumption' => 'decimal:2',
        'operating_pressure' => 'decimal:2',
        'operating_temperature' => 'decimal:2',
    ];

    // Relationships
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function maintenanceRecords(): HasMany
    {
        return $this->hasMany(MaintenanceRecord::class);
    }

    public function breakdowns(): HasMany
    {
        return $this->hasMany(Breakdown::class);
    }

    public function productionProcesses(): HasMany
    {
        return $this->hasMany(ProductionProcess::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeRepair($query)
    {
        return $query->where('status', 'repair');
    }

    public function scopeScrapped($query)
    {
        return $query->where('status', 'scrapped');
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return "{$this->name} ({$this->model_number})";
    }

    public function getWarrantyStatusAttribute(): string
    {
        if (!$this->warranty_end_date) {
            return 'No Warranty';
        }

        return $this->warranty_end_date->isPast() ? 'Expired' : 'Active';
    }

    public function getNextMaintenanceDateAttribute(): ?string
    {
        return $this->metadata['next_maintenance'] ?? null;
    }

    public function getLastMaintenanceDateAttribute(): ?string
    {
        return $this->metadata['last_maintenance'] ?? null;
    }

    public function getTotalOperatingHoursAttribute(): int
    {
        return $this->metadata['total_operating_hours'] ?? 0;
    }

    public function getEfficiencyRatingAttribute(): int
    {
        return $this->metadata['efficiency_rating'] ?? 0;
    }

    // Helper Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isUnderMaintenance(): bool
    {
        return $this->status === 'maintenance';
    }

    public function isUnderRepair(): bool
    {
        return $this->status === 'repair';
    }

    public function isScrapped(): bool
    {
        return $this->status === 'scrapped';
    }

    public function hasWarranty(): bool
    {
        return $this->warranty_end_date && $this->warranty_end_date->isFuture();
    }

    public function getSpecifications(): array
    {
        return $this->specifications ?? [];
    }

    public function getMaintenanceSchedule(): array
    {
        return $this->maintenance_schedule ?? [];
    }

    public function getSpareParts(): array
    {
        return $this->spare_parts ?? [];
    }

    public function getDocuments(): array
    {
        return $this->documents ?? [];
    }

    public function getCriticalParts(): array
    {
        return $this->spare_parts['critical_parts'] ?? [];
    }

    public function needsMaintenance(): bool
    {
        if (!$this->next_maintenance_date) {
            return false;
        }

        return now()->diffInDays($this->next_maintenance_date) <= 7;
    }

    public function calculateDepreciation(): float
    {
        if (!$this->purchase_date || !$this->purchase_price) {
            return 0;
        }

        $years = now()->diffInYears($this->purchase_date);
        $depreciationRate = 0.1; // 10% per year
        $depreciation = $this->purchase_price * $depreciationRate * $years;

        return max(0, $this->purchase_price - $depreciation);
    }
}
