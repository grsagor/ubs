<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;
    protected $table = 'booking_service';

    protected $fillable = [
        'type',
        'service_id',
        'description',
        'status',
    ];
}
