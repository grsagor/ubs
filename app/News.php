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
        'title',
        'slug',
        'business_id',
        'business_location_id',
        'category_id',
        'subcategory_id',
        'region_id',
        'language_id',
        'special_id',
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
        $query->where('status', 2);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('title', 'LIKE', '%' . $request->search . '%');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function language()
    {
        return $this->belongsTo(LanguageSpeech::class, 'language_id');
    }

    public function special()
    {
        return $this->belongsTo(Special::class, 'special_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by')
            ->select('id', 'surname', 'first_name', 'last_name');
    }

    public function userProfilePicture()
    {
        return $this->hasOne(Media::class, 'uploaded_by', 'created_by')
            ->where('model_type', 'App\\User')
            ->select('id', 'business_id', 'file_name', 'uploaded_by', 'model_type');
    }

    public function businessLocation()
    {
        return $this->belongsTo(BusinessLocation::class, 'business_location_id')
            ->select('id', 'name', 'logo');
    }
}
