<?php

namespace App;

use App\Traits\HasUuid;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppliedJob extends Model
{
    use HasFactory, CreatedUpdatedBy, HasUuid;

    protected $table = 'applied_jobs';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'job_id',
        'recruitment_id',
        'status',
    ];


    public function scopeSearchApplicants($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->whereHas('JobId', function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%');
            })
                ->orWhereHas('recuimentId', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('current_address', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('countryResidence', function ($q) use ($search) {
                            $q->where('country_name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('birthCountry', function ($q) use ($search) {
                            $q->where('country_name', 'LIKE', '%' . $search . '%');
                        });
                })
                ->orWhereHas('createdBy', function ($q) use ($search) {
                    $q->where('surname', 'LIKE', '%' . $search . '%')
                        ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $search . '%');
                });
        });
    }

    public function JobId()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function recuimentId()
    {
        return $this->belongsTo(Recruitment::class, 'recruitment_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
