<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'part_id',
        'document_name',
        'file_path',
        'file_type',
        'file_size',
        'uploaded_by'
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
