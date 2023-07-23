<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name','status'];
    public $timestamps = false;

    public function states()
    {
        return $this->hasMany('App\State');
    }
}
