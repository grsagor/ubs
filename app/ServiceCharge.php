<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCharge extends Model
{
    use HasFactory;
    protected $table = 'service_charges';


    public function getSizeAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category');
    }
}
