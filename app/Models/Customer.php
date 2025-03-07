<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_unique_code',
        'company_profile_picture',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'alt_phone',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'gst_number',
        'pan_number',
        'tin_number',
        'cst_number',
        'website',
        'credit_limit',
        'payment_terms',
        'tax_registration_number',
        'tax_exemption_number',
        'business_type',
        'industry_type',
        'customer_group',
        'company_size',
        'status',
        'notes',
        'documents',
        'bank_details',
        'preferences',
        'metadata',
        'sales_person_id',
        'branch_id'
    ];

    protected $casts = [
        'documents' => 'array',
        'bank_details' => 'array',
        'preferences' => 'array',
        'metadata' => 'array',
        'credit_limit' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    // Relationships
    public function productionPlans(): HasMany
    {
        return $this->hasMany(ProductionPlan::class);
    }

    public function dispatchInvoices(): HasMany
    {
        return $this->hasMany(DispatchInvoice::class);
    }

    public function salesPerson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    public function scopeBlocked($query)
    {
        return $query->where('status', 'blocked');
    }

    public function scopePremium($query)
    {
        return $query->where('customer_group', 'premium');
    }

    public function scopeRegular($query)
    {
        return $query->where('customer_group', 'regular');
    }

    public function scopeWholesale($query)
    {
        return $query->where('customer_group', 'wholesale');
    }

    // Accessors
    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->pincode}, {$this->country}";
    }

    public function getTotalOrdersAttribute(): int
    {
        return $this->metadata['total_orders'] ?? 0;
    }

    public function getTotalSpentAttribute(): float
    {
        return $this->metadata['total_spent'] ?? 0;
    }

    // Mutators
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $value);
    }

    // Helper Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isPremium(): bool
    {
        return $this->customer_group === 'premium';
    }

    public function hasValidGST(): bool
    {
        return !empty($this->gst_number);
    }

    public function getBankDetails(): array
    {
        return $this->bank_details ?? [];
    }

    public function getCommunicationPreferences(): array
    {
        return $this->preferences['communication_preference'] ?? [];
    }
}
