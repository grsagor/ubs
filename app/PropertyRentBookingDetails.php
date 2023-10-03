<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRentBookingDetails extends Model
{
    use HasFactory;
    protected $table = 'property_rent_booking_details';

    protected $fillable = [
        'service_advertise_id',
        'number_of_shared_people',
        'preriod_accommodation_needed',
        'want_stay_accommodation',
        'email',
        'mobile',
        'occupant_details',
        'status'
    ];
}
