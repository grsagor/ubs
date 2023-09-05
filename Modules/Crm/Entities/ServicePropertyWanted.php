<?php

namespace Modules\Crm\Entities;

use App\User;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicePropertyWanted extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy;

    protected $table = 'service_property_wanted';
    protected $primaryKey = 'id';

    protected $fillable = [
        'reference_id',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'occupant_details',
        'room_details',
        'business_location_id',
        'service_category_id',
        'who_is_searching',
        'why_is_searching',
        'gender',
        'room_size',
        'buddy_ups',
        'wanted_living_area',

        // 'address',

        'combined_budget',
        'per',
        'available_form',
        'min_term',
        'max_term',
        'days_of_wk_available',
        'roomfurnishings',
        'age',
        'occupation',
        'pets',
        'smoking_current',
        'gay_lesbian',
        'gay_consent',

        'lang_id',
        'nationality',
        'first_name',
        'last_name',
        'gender_req',
        'min_age_req',
        'max_age_req',
        'smoking',
        'pets_req',
        'share_type_req',
        'gay_lesbian_req',
        'ad_title',
        'ad_text',
        'tel',
        'selectedSports',
        'images',

        'advert_type',

        'status',
        'user_id',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('ad_title', 'LIKE', '%' . $request->search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
