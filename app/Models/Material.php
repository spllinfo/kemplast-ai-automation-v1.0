<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // Basic Information
        'material_code',
        'material_name',
        'material_type',
        'material_grade',
        'material_category',
        'material_color',

        // Stock Information
        'opening_balance',
        'quantity',
        'uom',
        'minimum_stock_level',
        'maximum_stock_level',
        'reorder_point',
        'safety_stock',

        // Pricing
        'unit_price',
        'last_purchase_price',
        'currency',
        'tax_rate',
        'hsn_code',

        // Physical Properties
        'density',
        'melt_flow_index',
        'technical_properties',
        'standard_weight',
        'standard_length',
        'standard_width',

        // Storage
        'warehouse_location',
        'bin_location',
        'storage_conditions',
        'shelf_life_days',

        // Quality
        'quality_grade',
        'quality_parameters',
        'manufacture_date',
        'expiry_date',
        'requires_inspection',
        'inspection_interval_days',

        // Supplier Info
        'primary_supplier_id',
        'alternative_suppliers',
        'manufacturer_name',
        'brand_name',
        'lead_time_days',
        'minimum_order_quantity',

        // Documentation
        'material_image',
        'msds_document',
        'technical_datasheet',
        'quality_certificate',
        'notes',
        'certificates',

        // Status and Control
        'status',
        'is_active',
        'is_returnable',
        'is_batch_tracked',
        'requires_coa',

        // Tracking
        'created_by',
        'updated_by',
        'branch_id',
        'last_stock_update',
        'last_price_update'
    ];

    protected $casts = [
        'technical_properties' => 'array',
        'storage_conditions' => 'array',
        'quality_parameters' => 'array',
        'alternative_suppliers' => 'array',
        'certificates' => 'array',
        'manufacture_date' => 'date',
        'expiry_date' => 'date',
        'last_stock_update' => 'datetime',
        'last_price_update' => 'datetime',
        'requires_inspection' => 'boolean',
        'is_active' => 'boolean',
        'is_returnable' => 'boolean',
        'is_batch_tracked' => 'boolean',
        'requires_coa' => 'boolean'
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
