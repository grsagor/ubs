<?php

namespace App;

use App\Category;
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

    protected $casts = [
        'hour_type' => 'array',
        'job_type' => 'array',
    ];
    protected $fillable = [
        'uuid',
        'short_id',
        'slug',
        'business_location_id',
        'reference',
        'title',
        'job_category_id',
        'hour_type',
        'job_type',
        'closing_date',
        'company_name',
        'company_information',
        'salary_variation',
        'salary_type',
        'fixed_salary',
        'from_salary',
        'to_salary',
        'vacancies',
        'location',
        'description',
        'note',
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


    public function scopeSearchAndFilter($query, $request)
    {
        if ($request->filled('category_id')) {
            $query->where('job_category_id', $request->input('category_id'));
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                ->orWhere('company_information', 'LIKE', '%' . $request->search . '%');
        }

        return $query;
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

    public function job_category()
    {
        return $this->belongsTo(Category::class, 'job_category_id');
    }
}
