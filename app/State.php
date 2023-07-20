<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['state','country_id','status','tax'];
    public function country()
    {
    	return $this->belongsTo('App\Country')->withDefault();
    }
}
