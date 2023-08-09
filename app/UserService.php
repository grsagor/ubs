<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use App\Helpers\PriceHelper;

class UserService extends Model
{
    protected $fillable = ['user_id', 'service_type', 'national_int','country_id','city_id', 'name','slug', 'photo', 'price','previous_price','availability','payment_installment','is_emergency','emergency_charge','note','experience','facilities','specialization','policy', 'description', 'short_description', 'shop_id', 'category_id', 'subcategory_id', 'childcategory_id', 'meta_tag','meta_description','youtube','file','status'];

    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany('App\Comment', 'service_id', 'id');
    }
    // public function categories()
    // {
    //     return $this->belongsTo('App\ServiceCategory', 'category_id', 'id');
    // }
    public function ratings()
    {
        return $this->hasMany('App\Rating', 'service_id', 'id');
    }

    public function offPercentage(){
        $gs = cache()->remember('generalsettings', now()->addDay(), function () {
            return DB::table('generalsettings')->first();
        });
        $price = $this->price;

        $preprice = $this->previous_price;
        if(!$preprice){
            return '';
        }

        if($this->user_id != 0){
        $price = $this->price + $gs->fixed_commission + ($this->price/100) * $gs->percentage_commission;

        $preprice = $this->previous_price + $gs->fixed_commission + ($this->previous_price/100) * $gs->percentage_commission ;
        }

        if(!empty($this->size)){
            $price += $this->size_price[0];
            $preprice += $this->size_price[0];
        }


        if (Session::has('currency'))
        {
            $curr = cache()->remember('session_currency', now()->addDay(), function () {
                return Currency::find(Session::get('currency'));
            });
        }
        else
        {
            $curr = cache()->remember('default_currency', now()->addDay(), function () {
                return Currency::where('is_default','=',1)->first();
            });
        }

        $price = $price * $curr->value;
        $preprice = $preprice * $curr->value;
        $Percentage=(($preprice-$price)*100)/$preprice;
        return $Percentage;

    }

    public  function setCurrency() {
        // $gs = cache()->remember('generalsettings', now()->addDay(), function () {
        //     return DB::table('generalsettings')->first();
        // });
        // $price = $this->price;
        // if (Session::has('currency'))
        // {
        //     $curr = cache()->remember('session_currency', now()->addDay(), function () {
        //         return Currency::find(Session::get('currency'));
        //     });
        // }
        // else
        // {
        //     $curr = cache()->remember('default_currency', now()->addDay(), function () {
        //         return Currency::where('is_default','=',1)->first();
        //     });
        // }
        // $price = $price * $curr->value;
        // $price = PriceHelper::showPrice($price);
        // if($gs->currency_format == 0){
        //     return $curr->sign.$price;
        // }
        // else{
        //     return $price.$curr->sign;
        // }
    }

    public function vendorSizePrice() {
        $gs = cache()->remember('generalsettings', now()->addDay(), function () {
            return DB::table('generalsettings')->first();
        });
        $price = $this->price;
        if($this->user_id != 0){
        $price = $this->price + $gs->fixed_commission + ($this->price/100) * $gs->percentage_commission;
        }
        if(!empty($this->size)){
            $price += $this->size_price[0];
        }
        return $price;
    }

    public function language()
    {
    	return $this->belongsTo('App\Language','language_id')->withDefault();
    }  

    public function showName() {
        $name = mb_strlen($this->name,'UTF-8') > 50 ? mb_substr($this->name,0,50,'UTF-8').'...' : $this->name;
        return $name;
    }

    public function showShortDescription() {
        $this->short_description = strip_tags(html_entity_decode($this->short_description));
        $short_description = mb_strlen($this->short_description,'UTF-8') > 50 ? mb_substr($this->short_description,0,50,'UTF-8').'...' : $this->short_description;
        return $short_description;
    }

    public function showPrice() {
        $gs = cache()->remember('generalsettings', now()->addDay(), function () {
            return DB::table('generalsettings')->first();
        });
        $price = $this->price;

        if($this->user_id != 0){
            $price = $this->price + $gs->fixed_commission + ($this->price/100) * $gs->percentage_commission;
        }

        if (Session::has('currency'))
        {
            $curr = cache()->remember('session_currency', now()->addDay(), function () {
                return Currency::find(Session::get('currency'));
            });
        }
        else
        {
            $curr = cache()->remember('default_currency', now()->addDay(), function () {
                return Currency::where('is_default','=',1)->first();
            });
        }

        $price = $price * $curr->value;
        $price = PriceHelper::showPrice($price);

        if($gs->currency_format == 0){
            return $curr->sign.$price;
        }
        else{
            return $price.$curr->sign;
        }
    }

    // public function showPreviousPrice() {
    //     $gs = cache()->remember('generalsettings', now()->addDay(), function () {
    //         return DB::table('generalsettings')->first();
    //     });
    //     $price = $this->previous_price;
    //     if(!$price){
    //         return '';
    //     }
    //     if($this->user_id != 0){
    //     $price = $this->previous_price + $gs->fixed_commission + ($this->previous_price/100) * $gs->percentage_commission ;
    //     }

    
    //     if (Session::has('currency'))
    //     {
    //         $curr = cache()->remember('session_currency', now()->addDay(), function () {
    //             return Currency::find(Session::get('currency'));
    //         });
    //     }
    //     else
    //     {
    //         $curr = cache()->remember('default_currency', now()->addDay(), function () {
    //             return Currency::where('is_default','=',1)->first();
    //         });

    //     }

    //     $price = $price * $curr->value;
    //     $price = PriceHelper::showPrice($price);

    //     if($gs->currency_format == 0){
    //         return $curr->sign.$price;
    //     }
    //     else{
    //         return $price.$curr->sign;
    //     }
    // }

    public function galleries()
    {
        return $this->hasMany('App\ServiceGallery','service_id','id');
    }

    // public function ratings()
    // {
    //     return $this->hasMany('App\Rating','service_id','service_id');
    // }

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo('App\ServiceCategory')->withDefault();
    }
    public function vendorPrice() {
        $gs = cache()->remember('generalsettings', now()->addDay(), function () {
            return DB::table('generalsettings')->first();
        });
        $price = $this->price;
        if($this->user_id != 0){
        $price = $this->price + $gs->fixed_commission + ($this->price/100) * $gs->percentage_commission ;
        }

        return $price;
    }
}

