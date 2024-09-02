<?php

namespace App;

use App\Category;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'shop_news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'business_id',
        'business_location_id',
        'category_id',
        'subcategory_id',
        'region_id',
        'language_id',
        'special_id',
        'title',
        'slug',
        'description',
        'define_this_item',
        'source_name',
        'source_url',
        'video_url',
        'thumbnail',
        'images',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('title', 'LIKE', '%' . $request->search . '%');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function region()
    {
        return $this->belongsTo(Category::class, 'region_id');
    }
    public function language()
    {
        return $this->belongsTo(Category::class, 'language_id');
    }
}
