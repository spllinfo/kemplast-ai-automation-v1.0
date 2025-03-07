<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_code',
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
        'supplier_group',
        'status',
        'notes',
        'documents',
        'bank_details',
        'preferences',
        'metadata'
    ];

    protected $casts = [
        'documents' => 'array',
        'bank_details' => 'array',
        'preferences' => 'array',
        'metadata' => 'array',
        'credit_limit' => 'decimal:2',
    ];

    /**
     * Get the user associated with the customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function dispatch(){
    //     return $this->hasMany(Dispatch::class, 'customer_id', 'id');
    // }

    // Relationships
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function materialStocks(): HasMany
    {
        return $this->hasMany(MaterialStock::class);
    }

    public function materialTransactions(): HasMany
    {
        return $this->hasMany(MaterialStockTransaction::class);
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
        return $query->where('supplier_group', 'premium');
    }

    public function scopeRegular($query)
    {
        return $query->where('supplier_group', 'regular');
    }

    public function scopeWholesale($query)
    {
        return $query->where('supplier_group', 'wholesale');
    }

    // Accessors
    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->pincode}, {$this->country}";
    }

    public function getTotalSuppliesAttribute(): int
    {
        return $this->metadata['total_supplies'] ?? 0;
    }

    public function getTotalPurchasesAttribute(): float
    {
        return $this->metadata['total_purchases'] ?? 0;
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
        return $this->supplier_group === 'premium';
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

    public function getPaymentTermsInDays(): int
    {
        return match($this->payment_terms) {
            'immediate' => 0,
            '15_days' => 15,
            '30_days' => 30,
            '45_days' => 45,
            '60_days' => 60,
            default => 30
        };
    }
}
