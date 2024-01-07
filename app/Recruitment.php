<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recruitment extends Model
{
    use HasFactory, CreatedUpdatedBy, HasUuid;

    protected $table = 'recruitment';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'job_id',
        'name',
        'phone',
        'email',
        'current_address',
        'country_residence',
        'birth_country',
        'experiences',
        'salary_type',
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
