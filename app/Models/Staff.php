<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staff';

    protected $fillable = [
        'user_id',
        'staff_code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'alt_phone',
        'designation',
        'department',
        'profile_picture',
        'date_of_birth',
        'joining_date',
        'experience_years',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'emergency_contact_address',
        'blood_group',
        'skills',
        'certifications',
        'basic_salary',
        'bank_name',
        'bank_account_no',
        'ifsc_code',
        'pan_number',
        'aadhar_number',
        'documents',
        'status',
        'reporting_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = [
        'date_of_birth',
        'joining_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'experience_years' => 'integer'
    ];

    public function reportingManager()
    {
        return $this->belongsTo(Staff::class, 'reporting_to');
    }

    public function subordinates()
    {
        return $this->hasMany(Staff::class, 'reporting_to');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture
            ? asset('storage/staff/profile_pictures/' . $this->profile_picture)
            : asset('assets/images/default-avatar.png');
    }

    public function getDocumentsUrlAttribute()
    {
        return $this->documents
            ? asset('storage/staff/documents/' . $this->documents)
            : null;
    }


}
