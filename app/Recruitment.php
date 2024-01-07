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
        return $query->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->orWhere('current_address', 'LIKE', '%' . $request->search . '%')
            ->orWhere('country_residence', 'LIKE', '%' . $request->search . '%')
            ->orWhere('birth_country', 'LIKE', '%' . $request->search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
