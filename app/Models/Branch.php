<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'type',
        'status',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'phone',
        'email',
        'website',
        'gst_number',
        'pan_number',
        'tin_number',
        'cst_number',
        'contact_person',
        'contact_phone',
        'contact_email',
        'operating_hours',
        'facilities',
        'settings',
        'metadata',
        'max_capacity',
        'current_employees',
        'manager_id',
        'parent_branch_id'
    ];

    protected $casts = [
        'operating_hours' => 'array',
        'facilities' => 'array',
        'settings' => 'array',
        'metadata' => 'array',
        'max_capacity' => 'integer',
        'current_employees' => 'integer'
    ];

    // Relationships
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function parentBranch()
    {
        return $this->belongsTo(Branch::class, 'parent_branch_id');
    }

    public function childBranches()
    {
        return $this->hasMany(Branch::class, 'parent_branch_id');
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }

    public function employees()
    {
        return $this->hasMany(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Methods
    public function isAtCapacity()
    {
        return $this->max_capacity && $this->current_employees >= $this->max_capacity;
    }

    public function getFullAddress()
    {
        return implode(', ', array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->pincode,
            $this->country
        ]));
    }
}
