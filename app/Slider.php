<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['subtitle_text','subtitle_size','subtitle_color','subtitle_anime','title_text','title_size','title_color','title_anime','details_text','details_size','details_color','details_anime','photo','position','link','language_id'];
    public $timestamps = false;

    public function language()
    {
    	return $this->belongsTo('App\Language','language_id')->withDefault();
    }  
}
