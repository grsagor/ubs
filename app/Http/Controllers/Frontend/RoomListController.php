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
        $data['per_page'] = 10;

        $data['rooms']          = ServiceAdvertiseRoom::active()->select(
            'id',
            'property_type',
            'property_address',
            'room',
            'room_available_from',
            'advert_title',
            'advert_description',
            'advert_photos',
            'advert_type',
            'created_at'
        )->latest()->paginate($data['per_page']);


        // dd($data['rooms']);
        return view('rough.room_list', $data);
    }


    public function roomShow($id)
    {
        $data                   = ServiceAdvertiseRoom::findOrFail($id);
        $user_info              = Media::where('uploaded_by', $data->user_id)
            ->where('model_type', 'App\\User')->first();

        return view('rough.more_info', compact('data', 'user_info'));
    }
}
