<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'footer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'description',
        'status',
    ];


    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
