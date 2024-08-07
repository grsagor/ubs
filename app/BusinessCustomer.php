<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCustomer extends Model
{
    use HasFactory;

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
