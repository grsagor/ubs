<?php

namespace App;

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
        'shop_news_category_id',
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

    public function scopeSearch($query, $request)
    {
        return $query->where('title', 'LIKE', '%' . $request->search . '%');
    }

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class, 'shop_news_category_id');
    }
}
