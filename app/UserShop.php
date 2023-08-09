<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserShop extends Model
{
    protected $fillable = ['category_id', 'subcategory_id', 'country', 'user_id', 'shop_name','shop_image','shop_banner','shop_about','shop_number','shop_address', 'owner_name', 'email', 'phone', 'reg_number','language_id', 'website', 'facebook', 'instagram', 'linkedin', 'twitter', 'youtube', 'pinterest', 'status'];

    public $timestamps = false;


    public function language()
    {
    	return $this->belongsTo('App\Language','language_id')->withDefault();
    }
    
    public function category(){
        return $this->belongsTo('App\Category','category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Subcategory', 'subcategory_id','id');
    }
    
    public function services(){
        return $this->hasMany('App\UserService','shop_id','id');
    }

    public function products(){
        return $this->hasMany('App\Product','shop_id','id');
    }

    // get 2 products for marketing
    public function marketingProducts(){
        return $this->hasMany('App\Product','shop_id','id');
    }

}