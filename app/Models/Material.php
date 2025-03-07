<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'material_code',
        'material_name',
        'material_type',
        'material_grade',
        'material_category',
        'quantity',
        'uom',
        'minimum_stock_level',
        'maximum_stock_level',
        'reorder_point',
        'unit_price',
        'last_purchase_price',
        'currency',
        'density',
        'melt_flow_index',
        'technical_properties',
        'warehouse_location',
        'bin_location',
        'storage_conditions',
        'quality_grade',
        'quality_parameters',
        'manufacture_date',
        'expiry_date',
        'primary_supplier_id',
        'alternative_suppliers',
        'manufacturer_name',
        'brand_name',
        'material_image',
        'msds_document',
        'technical_datasheet',
        'notes',
        'certificates',
        'branch_id',
        'is_active'
    ];

    protected $casts = [
        'technical_properties' => 'array',
        'storage_conditions' => 'array',
        'quality_parameters' => 'array',
        'alternative_suppliers' => 'array',
        'certificates' => 'array',
        'manufacture_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
        'quantity' => 'decimal:3',
        'unit_price' => 'decimal:2',
        'minimum_stock_level' => 'decimal:3',
        'maximum_stock_level' => 'decimal:3',
        'reorder_point' => 'decimal:3',
        'density' => 'decimal:3',
        'melt_flow_index' => 'decimal:3'
    ];

    // Relationships
    public function primarySupplier()
    {
        return $this->belongsTo(Supplier::class, 'primary_supplier_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function stockMovements()
    {
        return $this->hasMany(MaterialStockMovement::class);
    }

    public function assignments()
    {
        return $this->hasMany(MaterialAssignment::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query)
    {
        return $query->whereRaw('quantity <= reorder_point');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('material_category', $category);
    }

    // Methods
    public function updateStock($quantity, $type = 'add')
    {
        $this->quantity = $type === 'add' 
            ? $this->quantity + $quantity
            : $this->quantity - $quantity;
        $this->save();
    }

    public function isLowStock(): bool
    {
        return $this->quantity <= $this->reorder_point;
    }

    public function getFormattedQuantityAttribute(): string
    {
        return number_format($this->quantity, 3) . ' ' . $this->uom;
    }
}