<?php

namespace App\Http\Controllers;

use App\ChildCategory;
use App\ServiceAdvertiseRoom;
use Illuminate\Http\Request;
use Modules\Crm\Entities\ServicePropertyWanted;

class FrontendController extends Controller
{
    public function roomList(Request $request, $sub_category_id = 'property-to-rent', $child_category_id = null)
    {
        if ($sub_category_id == 'property-to-rent') {
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
                // ->search($request)
                ->whereNotIn('id', function ($query) {
                    $query->select('foregn_key')
                        ->from('payment_histories')
                        ->where('table_name', 'service_advertise_rooms');
                })
                ->with('child_category')
                ->latest();

            if ($child_category_id !== null) {
                if ($child_category_id == 'room') {
                    $child_category_id = 1;
                } elseif ($child_category_id == 'house') {
                    $child_category_id = 2;
                } elseif ($child_category_id == 'flat') {
                    $child_category_id = 6;
                } elseif ($child_category_id == 'studio-flat') {
                    $child_category_id = 9;
                }
                $data['rooms'] = $data['rooms']->where('child_category_id', $child_category_id);
            }

            $data['rooms'] = $data['rooms']->paginate($data['per_page']);

            $data['child_categories']               = ChildCategory::where('sub_category_id', 2)->get();
            $data['sub_category_id']                = $sub_category_id;

            return view('frontend.service.room.room_list', $data);
        }
        if ($sub_category_id == 'property-wanted') {
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
                'child_category_id',
                'created_at'
            )
                ->with('child_category')
                ->where('information_complete', '<>', 0)
                ->whereNotNull('ad_title')
                ->whereBetween('created_at', [now()->subDays(45), now()])
                // ->search($request)
                // ->whereNotIn('id', function ($query) {
                //     $query->select('foregn_key')
                //         ->from('payment_histories')
                //         ->where('table_name', 'service_property_wanted');
                // })
                ->latest();

            // $counts = $data['rooms']->count();
            // dd($counts);


            if ($child_category_id !== null) {
                if ($child_category_id == 'room') {
                    $child_category_id = 11;
                } elseif ($child_category_id == 'house') {
                    $child_category_id = 12;
                } elseif ($child_category_id == 'flat') {
                    $child_category_id = 13;
                } elseif ($child_category_id == 'studio-flat') {
                    $child_category_id = 14;
                }
                $data['rooms'] = $data['rooms']->where('child_category_id', $child_category_id);
            }

            $data['rooms'] = $data['rooms']->paginate($data['per_page']);

            $data['child_categories']             = ChildCategory::where('sub_category_id', 1)->get();
            $data['sub_category_id']             = $sub_category_id;

            // return $data;
            return view('frontend.service.property.property_list', $data);
        }
    }
}
