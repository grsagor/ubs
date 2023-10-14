<?php

namespace App\Http\Controllers;

use App\ChildCategory;
use App\ServiceAdvertiseRoom;
use Illuminate\Http\Request;
use Modules\Crm\Entities\ServicePropertyWanted;

class FrontendController extends Controller
{
    public function roomList(Request $request, $sub_category_id = 2, $child_category_id = null)
    {
        if ($sub_category_id == 2) {
            $data['per_page'] = 10;
            $data['rooms']         = ServiceAdvertiseRoom::active()->select(
                'id',
                'property_type',
                'property_address',
                'room',
                'room_available_from',
                'child_category_id',
                'advert_title',
                'advert_description',
                'advert_photos',
                'advert_type',
                'property_room_quantity',
                'property_size',
                'property_allow_people',
                'bathroom',
                'rent',
                'created_at'
            )
                ->search($request)
                ->whereNotIn('id', function ($query) {
                    $query->select('foregn_key')
                        ->from('payment_histories')
                        ->where('table_name', 'service_advertise_rooms');
                })
                ->with('child_category')
                ->latest();

            if ($child_category_id !== null) {
                $data['rooms'] = $data['rooms']->where('child_category_id', $child_category_id);
            }

            $data['rooms'] = $data['rooms']->paginate($data['per_page']);

            $data['child_categories']               = ChildCategory::where('sub_category_id', $sub_category_id)->get();
            $data['sub_category_id']                = $sub_category_id;

            return view('frontend.service.room.room_list', $data);
        }
        if ($sub_category_id == 1) {
            $data['per_page'] = 10;

            $data['rooms']          = ServicePropertyWanted::active()->select(
                'id',
                'room_size',
                'room_details',
                'available_form',
                'ad_title',
                'ad_text',
                'images',
                'plan',
                'advert_type',
                'created_at'
            )
                ->search($request)
                ->whereNotIn('id', function ($query) {
                    $query->select('foregn_key')
                        ->from('payment_histories')
                        ->where('table_name', 'service_property_wanted');
                })
                ->latest();

            if ($child_category_id !== null) {
                $data['rooms'] = $data['rooms']->where('child_category_id', $child_category_id);
            }

            $data['rooms'] = $data['rooms']->paginate($data['per_page']);

            $data['child_categories']             = ChildCategory::where('sub_category_id', $sub_category_id)->get();
            $data['sub_category_id']             = $sub_category_id;

            return view('frontend.service.property.property_list', $data);
        }
    }
}
