<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Media;
use App\ServiceAdvertiseRoom;

class RoomListController extends Controller
{
    public function roomList()
    {

        $rooms           = ServiceAdvertiseRoom::active()->select(
            'id',
            'property_type',
            'property_address',
            'room',
            'room_available_from_date',
            'room_available_from_month',
            'advert_title',
            'advert_description',
            'advert_photos',
            'created_at'
        )->latest()->paginate(10);


        // return $rooms;
        return view('rough.card', compact('rooms'));
    }


    public function roomShow($id)
    {
        $data           = ServiceAdvertiseRoom::findOrFail($id);
        $user_info      = Media::where('uploaded_by', $data->user_id)
            ->where('model_type', 'App\\User')->first();

        return view('rough.more_info', compact('data', 'user_info'));
    }
}
