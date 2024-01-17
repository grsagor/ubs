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

    // public function scopeSearch($query, $request)
    // {
    //     return $query->where('name', 'LIKE', '%' . $request->search . '%')
    //         ->orWhere('birth_country', 'LIKE', '%' . $request->search . '%');
    // }

    public function JobId()
    {
        return $this->belongsTo(Country::class, 'job_id');
    }

    public function recuimentId()
    {
        return $this->belongsTo(Country::class, 'recruitment_id');
    }
}
