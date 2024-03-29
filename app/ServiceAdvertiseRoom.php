<?php

namespace App;

use App\User;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceAdvertiseRoom extends Model
{

    use HasFactory, SoftDeletes, CreatedUpdatedBy;

    protected $table = 'service_advertise_rooms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'reference_id',
        'business_location_id',
        'service_category_id',
        'service_charge_room',
        'service_category_id',
        'sub_category_id',
        'child_category_id',
        'room_size',
        'property_room_quantity',
        'property_size',
        'property_type',
        'bathroom',
        'property_occupants',
        'property_allow_people',
        'property_postcode',
        'property_user_title',
        'property_email_address',

        'property_address',
        'property_area',
        'transport_minutes',
        'transport_form',
        'transport_to',
        'living_room',
        'property_amenities',

        'room',
        'room_available_from',
        'room_min_stay',
        'room_max_stay',
        'room_short_term_let_consider',
        'room_days_available',
        'room_reference',
        'room_bills',
        'room_broadband',

        'exiting_flatmate_smoking',
        'exiting_flatmate_gender',
        'exiting_flatmate_occupation',
        'exiting_flatmate_pets',
        'exiting_flatmate_age',
        'exiting_flatmate_language',
        'exiting_flatmate_nationality',
        'exiting_flatmate_sexual_orientation',
        'exiting_flatmate_sexual_orientation_check_box',

        'new_flatmate_smoking',
        'new_flatmate_gender',
        'new_flatmate_occupation',
        'new_flatmate_pets',
        'new_flatmate_min_age',
        'new_flatmate_max_age',
        'new_flatmate_language',
        'new_flatmate_couples',
        'new_flatmate_vegetarians',


        'advert_title',
        'advert_description',
        'advert_photos',
        'advert_first_name',
        'advert_last_name',
        'advert_on_last_name',
        'advert_telephone',
        'advert_on_telephone',
        'secondary_telephone',
        'advert_type',

        'daily_email_alerts',
        'instant_email_alerts',
        'instant_email_max_days',

        'status',
        'user_id',
        'rent',
        'security_deposit',
        'holding_deposit',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('advert_title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('property_type', 'LIKE', '%' . $request->search . '%')
            ->orWhere('property_address', 'LIKE', '%' . $request->search . '%')
            ->orWhere('child_category_id', 'LIKE', '%' . $request->search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function child_category()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    public function latest_booking_service()
    {
        return $this->hasOne(PropertyRentBookingDetails::class, 'service_advertise_id', 'id')
            ->latest()->where('status', 'confirmed');
    }

    public function business_location()
    {
        return $this->belongsTo(BusinessLocation::class, 'business_location_id');
    }
}
