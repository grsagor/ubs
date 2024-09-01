<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Special extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'special';
    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'name',
        'slug',
        'business_id',
        'code',
        'description',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeOrderByNameAsc($query)
    {
        return $query->orderBy('name', 'asc');
    }
}
