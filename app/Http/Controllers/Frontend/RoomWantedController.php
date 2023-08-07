<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
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
            'room_size',
            'available_form',
            'ad_title',
            'ad_text',
            'images',
            'advert_type',
            'created_at'
        )->latest()->paginate($data['per_page']);


        // return ($data['rooms']);
        return view('rough.property_list', $data);
    }


    public function roomShow($id)
    {
        $data['info']                   = ServicePropertyWanted::findOrFail($id);
        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)
            ->where('model_type', 'App\\User')->first();

        // return $data;

        return view('rough.property_more_info', $data);
    }
}
