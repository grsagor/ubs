<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellingProduct extends Model
{
    use HasFactory;

    protected $table = 'reselling_products';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
