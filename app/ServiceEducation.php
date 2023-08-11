<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceEducation extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy;

    protected $table = 'service_education';
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_name',
        'price',
        'course_duration',
        'institution_name',
        'requirements',
        'start_date',
        'intake',
        'department',
        'tuition_fee',
        'scholarship',
        'modules',
        'description',
        'service_facilities',
        'agent_commission',
        'thumbnail',
        'images',

        'status',
        'user_id',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('course_name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('institution_name', 'LIKE', '%' . $request->search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
