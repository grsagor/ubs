<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
use App\ServiceCharge;
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
            ->whereNotIn('id', function ($query) {
                $query->select('foregn_key')
                    ->from('payment_histories')
                    ->where('table_name', 'service_advertise_rooms');
            })
            ->latest()->paginate($data['per_page']);

        return view('frontend.service.room.room_list', $data);
    }


    public function roomShow($id)
    {
        $data['info']                   = ServiceAdvertiseRoom::with('user')->findOrFail($id);
        $data['service_charge'] = ServiceCharge::where([['category_id',$data['info']->service_category_id],['sub_category_id',$data['info']->sub_category_id],['child_category',$data['info']->child_category_id]])->first()->service_charge;
        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)
            ->where('model_type', 'App\\User')->first();
        return view('frontend.service.room.details', $data);
    }


    public function referenceNumberCheck(Request $request, $id)
    {
        $data                           = ServiceAdvertiseRoom::findOrFail($id);

        $info['product_id']             = $id;
        $info['product_name']           = $data->advert_title;
        $info['bill']                   = $request->bill;
        $info['table_name']             = 'service_advertise_rooms';

        if ($data->reference_id == $request->reference_number) {
            return redirect('stripe')
                ->with([
                    'product_id' => $info['product_id'],
                    'product_name' => $info['product_name'],
                    'bill' => $info['bill'],
                    'table_name' => $info['table_name']
                ]);
        } else {
            return redirect()->back();
        }
    }
}
