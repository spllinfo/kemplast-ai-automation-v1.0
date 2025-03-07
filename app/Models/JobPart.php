<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_unique_code',
        'job_part_unique_code',
        'job_part_profile_picture',
        'job_part_name',
        'job_part_model',
        'job_part_customer_name',
        'hsn_no',
        'job_part_length',
        'job_part_width',
        'job_part_height',
        'job_part_thickness',
        'job_part_ld_ratio',
        'job_part_lld_ratio',
        'job_part_hd_ratio',
        'job_part_rd_ratio',
        'job_part_no_ups',
        'job_part_weight',
        'job_part_no_sealing_type',
        'job_printing_status',
        'job_printing_colour',
        'job_bundle_qty',
        'job_part_category',
        'job_part_description',
        'job_part_price',
        'job_part_quantity',
        'job_bst',
        'job_lain',
        'job_flat',
        'job_gazzate',
        'job_bio',
        'job_normal',
        'job_milky',
        'job_roto_printing',
        'job_flexo_printing',
        'job_sideseal',
        'job_recycle_logo',
        'job_part_status',
        'job_part_documents',
        'job_part_tags',
        'branch_name',
        'machine_type',
        'job_status',
        'user_id',
        'customer_id',
        'machine_id',
        'branch_id',
        'plan_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function plan()
    {
        return $this->belongsTo(ProductionPlan::class);
    }
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
