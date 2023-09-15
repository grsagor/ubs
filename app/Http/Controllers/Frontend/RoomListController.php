<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
use App\ChildCategory;
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

        $data['categories']             = ChildCategory::get();

        return view('frontend.service.room.room_list', $data);
    }


    public function roomShow($id)
    {
        $data['info']                   = ServiceAdvertiseRoom::with(['child_category', 'user'])->findOrFail($id);
        $data['service_charge']         = ServiceCharge::where([['category_id', $data['info']->service_category_id], ['sub_category_id', $data['info']->sub_category_id], ['child_category', $data['info']->child_category_id]])->first()->service_charge;
        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)
            ->where('model_type', 'App\\User')->first();
        $room = json_decode($data['info']->room);

        $result = [];
        for ($i = 1; $i <= 5; $i++) {
            $serviceCharge = $room->{'service_charge_room' . $i};
            if ($serviceCharge !== null) {
                $result[] = [
                    'room_cost_of_amount' => $room->{'room_cost_of_amount' . $i},
                    'room_cost_time' => $room->{'room_cost_time' . $i},
                    'room_size' => $room->{'room_size' . $i},
                    'room_amenities' => $room->{'room_amenities' . $i},
                    'room_furnishings' => $room->{'room_furnishings' . $i},
                    'room_security_deposit' => $room->{'room_security_deposit' . $i},
                    'room_available_from' => $room->{'room_available_from' . $i},
                    'service_charge_room' => $room->{'service_charge_room' . $i},
                ];
            }
        }

        $data['roomArray'] = $result;
        // dd(count($data['roomArray']));

        $data['first_image'] = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';

        $data['images'] = json_decode($data['info']->advert_photos, true);
        $data['img_count'] = null;
        $data['imagePath'] = null;
        $data['div_value'] = 0;

        if ($data['images']) {
            $data['first_image'] = reset($data['images']);
            $data['imagePath'] = public_path($data['first_image']);
            $data['img_count'] = count($data['images']);

            if ($data['img_count'] >= 7) {
                $data['div_value'] = 1;
            }

            if ($data['img_count'] == 5 ||  $data['img_count'] == 6) {
                $data['div_value'] = 2;
            }

            if ($data['img_count'] == 4) {
                $data['div_value'] = 3;
            }

            if ($data['img_count'] <= 3) {
                $data['div_value'] = 3;
            }
        }

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

            $info['output'] = [
                'success'               => true,
                'msg'                   => ('Reference number matched!!!'),
            ];

            return redirect('stripe')
                ->with([
                    'product_id'        => $info['product_id'],
                    'product_name'      => $info['product_name'],
                    'bill'              => $info['bill'],
                    'table_name'        => $info['table_name'],
                    'output'            => $info['output'],
                ]);
        } else {
            $output     = [
                'success'               => false,
                'msg'                   => ('Wrong Reference number!!!'),
            ];

            return redirect()->back()->with('status', $output);
        }
    }


    public function roomListCategory(Request $request)
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
            ->latest()
            ->paginate($data['per_page']);

        $data['categories']             = ChildCategory::get();

        // return     $data['rooms'];
        return view('frontend.service.room.room_list', $data);
    }
}
