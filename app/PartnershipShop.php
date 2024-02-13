<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipShop extends Model
{
    use HasFactory;

    protected $table = 'partnership_shop';

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(BusinessLocation::class, 'partnership_shop_id');
    }
}
