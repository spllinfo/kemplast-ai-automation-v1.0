<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Part extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'part_unique_code',
        'part_name',
        'part_category',
        'part_model',
        'hsn_no',
        'reel_size',
        'part_length',
        'part_width',
        'part_height',
        'part_thickness',
        'part_ld_ratio',
        'part_lld_ratio',
        'part_hd_ratio',
        'part_rd_ratio',
        'part_weight',
        'part_price',
        'no_ups',
        'sealing_type',
        'printing_status',
        'printing_colour',
        'bundle_qty',
        'part_quantity',
        'bst',
        'plain',
        'flat',
        'gazzate',
        'bio',
        'normal',
        'milky',
        'roto_printing',
        'flexo_printing',
        'recycle_logo',
        'part_description',
        'part_profile_picture',
        'part_tags',
        'status',
        'branch_id',
        'customer_id',
        'user_id'
    ];

    protected $casts = [
        'part_tags' => 'array',
        'printing_status' => 'boolean',
        'bst' => 'boolean',
        'plain' => 'boolean',
        'flat' => 'boolean',
        'gazzate' => 'boolean',
        'bio' => 'boolean',
        'normal' => 'boolean',
        'milky' => 'boolean',
        'roto_printing' => 'boolean',
        'flexo_printing' => 'boolean',
        'recycle_logo' => 'boolean',
    ];

    // Relationships
    public function documents()
    {
        return $this->hasMany(PartDocument::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes for advanced filtering
    public function scopeFilterByDate($query, $dateFilter)
    {
        return match ($dateFilter) {
            'today' => $query->whereDate('created_at', now()),
            'yesterday' => $query->whereDate('created_at', now()->subDay()),
            'this_week' => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
            'last_week' => $query->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]),
            'this_month' => $query->whereMonth('created_at', now()->month),
            'last_month' => $query->whereMonth('created_at', now()->subMonth()->month),
            'this_year' => $query->whereYear('created_at', now()->year),
            'last_year' => $query->whereYear('created_at', now()->subYear()->year),
            'last_7_days' => $query->whereBetween('created_at', [now()->subDays(7), now()]),
            'last_30_days' => $query->whereBetween('created_at', [now()->subDays(30), now()]),
            'last_90_days' => $query->whereBetween('created_at', [now()->subDays(90), now()]),
            default => $query,
        };
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('part_unique_code', 'LIKE', "%{$searchTerm}%")
                ->orWhere('part_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('part_category', 'LIKE', "%{$searchTerm}%")
                ->orWhere('part_model', 'LIKE', "%{$searchTerm}%")
                ->orWhere('hsn_no', 'LIKE', "%{$searchTerm}%")
                ->orWhereHas('customer', function ($q) use ($searchTerm) {
                    $q->where('customer_name', 'LIKE', "%{$searchTerm}%");
                });
        });
    }
}
