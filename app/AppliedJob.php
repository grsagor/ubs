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

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->whereHas('JobId', function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            })
                // ->orWhereHas('recuimentId', function ($q) use ($search) {
                //     $q->where('name', 'LIKE', '%' . $search . '%')
                //         ->orWhere('phone', 'LIKE', '%' . $search . '%');
                // })
            ;
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
