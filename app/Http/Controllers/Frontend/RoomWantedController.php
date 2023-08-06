<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Crm\Entities\ServicePropertyWanted;

class RoomWantedController extends Controller
{
    public function roomList()
    {
        $data['per_page'] = 10;

        $data['rooms']          = ServicePropertyWanted::active()->select(
            'id',
            // 'property_type',
            'address',
            'room_size',
            'available_form',
            'ad_title',
            'ad_text',
            'images',
            'advert_type',
            'created_at'
        )->latest()->paginate($data['per_page']);


        return ($data['rooms']);
        return view('rough.room_list', $data);
    }
}
