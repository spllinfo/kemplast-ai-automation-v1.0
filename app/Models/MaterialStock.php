<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_unique_code',
        'material_profile_picture',
        'material_name',
        'material_grade',
        'material_category',
        'material_quantity',
        'material_UOM',
        'material_price',
        'material_description',
        'material_warehouse_location',
        'supplier_name',
        'supplier_id',
        'user_id',
        'branch_id',
    ];
    

    /**
     * Get the user associated with the customer.
     */
    // Define relationships (if any)
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class); // Assuming you have a Branch model
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class); // Assuming you have a Branch model
    }

    // public function dispatch(){
    //     return $this->hasMany(Dispatch::class, 'customer_id', 'id');
    // }
}
