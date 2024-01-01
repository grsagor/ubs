<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'shop-news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'business_id',
        'shop_category_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'images',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    // public function scopeSearch($query, $request)
    // {
    //     return $query->where('advert_title', 'LIKE', '%' . $request->search . '%')
    //         ->orWhere('property_type', 'LIKE', '%' . $request->search . '%')
    //         ->orWhere('property_address', 'LIKE', '%' . $request->search . '%')
    //         ->orWhere('child_category_id', 'LIKE', '%' . $request->search . '%');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'shop_category_id');
    }
}
