<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsCategory extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'shop_news_category';
    protected $primaryKey = 'id';

    protected $fillable = [
        'business_id',
        'name',
        'slug',
        'description',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('name', 'LIKE', '%' . $request->search . '%');
    }
}
