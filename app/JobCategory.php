<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'job_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'business_id',
        'name',
        'slug',
        'description',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    public function business_location()
    {
        return $this->belongsTo(BusinessLocation::class, 'business_id');
    }
}
