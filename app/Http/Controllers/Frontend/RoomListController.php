<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
use Illuminate\Http\Request;
use App\ServiceAdvertiseRoom;
use App\Http\Controllers\Controller;

class RoomListController extends Controller
{
    public function roomList(Request $request)
    {
        $data['per_page'] = 10;

        $data['rooms']         = ServiceAdvertiseRoom::active()->select(
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
        )
            ->search($request)
            ->latest()->paginate($data['per_page']);

        return view('Frontend.service.room.room_list', $data);
    }


    public function roomShow($id)
    {
        $data['info']                   = ServiceAdvertiseRoom::findOrFail($id);
        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)
            ->where('model_type', 'App\\User')->first();

        return view('Frontend.service.room.details', $data);
    }


    public function referenceNumberCheck(Request $request, $id)
    {
        $data                           = ServiceAdvertiseRoom::findOrFail($id);
        // dd($request->toArray());
        if ($data->reference_id == $request->reference_number) {
            return redirect('stripe')
                ->with('bill', $request->bill);
        } else {
            return redirect()->back();
        }
    }
}
