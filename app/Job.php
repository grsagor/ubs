<?php

namespace App;

use App\Traits\HasUuid;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory, CreatedUpdatedBy, HasUuid;

    protected $table = 'jobs';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'business_location_id',
        'reference',
        'title',
        'hour_type',
        'job_type',
        'closing_date',
        'company_name',
        'company_information',
        'salary',
        'salary_type',
        'location',
        'description',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('company_name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('location', 'LIKE', '%' . $request->search . '%');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function appliedJobs()
    {
        return $this->hasMany(AppliedJob::class, 'job_id', 'uuid');
    }

    public function business_location()
    {
        return $this->belongsTo(BusinessLocation::class, 'business_location_id');
    }
}
