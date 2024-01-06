<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recruitment extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'recruitment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'reference_id',
        'job_id',
        'name',
        'phone',
        'email',
        'current_address',
        'country_residence',
        'birth_country',
        'experiences',
        'expected_salary',
        'cv',
        'dbs_check',
        'care_certificates',
        'cover_letter',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('advert_title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('property_type', 'LIKE', '%' . $request->search . '%')
            ->orWhere('property_address', 'LIKE', '%' . $request->search . '%')
            ->orWhere('child_category_id', 'LIKE', '%' . $request->search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
