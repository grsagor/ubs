<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
use App\ChildCategory;
use App\ServiceCharge;
use App\BookingService;
use Illuminate\Http\Request;
use App\ServiceAdvertiseRoom;
use App\Traits\ImageFileUpload;
use App\Services\PropertyService;
use App\PropertyRentBookingDetails;
use App\Http\Controllers\Controller;

class RoomListController extends Controller
{
    use ImageFileUpload;
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService      = $propertyService;
    }

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
        $data['info']                   = ServiceAdvertiseRoom::with(['child_category', 'user', 'latest_booking_service', 'business_location'])->findOrFail($id);
        $data['service_charge']         = ServiceCharge::where([['category_id', $data['info']->service_category_id], ['sub_category_id', $data['info']->sub_category_id], ['child_category', $data['info']->child_category_id]])->first()->service_charge;
        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)
            ->where('model_type', 'App\\User')->first();
        $room = json_decode($data['info']->room);

        $service_charge_room             = $data['info']->service_charge_room;

        $result = [];
        for ($i = 1; $i <= 5; $i++) {
            $serviceCharge = $service_charge_room ?? $room->{'service_charge_room' . $i};

            if ($serviceCharge !== null) {
                $result[] = [
                    'room_number' => $i,
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
                $data['div_value'] = 4;
            }
        }

        return view('frontend.service.room.details', $data);
    }

    public function showModal(Request $request)
    {
        $data = ServiceAdvertiseRoom::findOrFail($request->id);
        $matched = false;
        if ($data->reference_id == $request->reference_number) {
            $matched = true;
        }
        return view('frontend.service.room.details_form', compact('matched', 'data'));
    }

    public function showOccupantsDetailsInputs(Request $request)
    {
        $num = $request->num;
        $html = view('frontend.service.room.occupant_details', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }

    public function propertyRentBooking(Request $request)
    {
        $count = count($request->occupant_name);
        $occupant_details = [];
        for ($i = 0; $i < $count; $i++) {
            $occupant_details[] = [
                "occupant_name" => $request->occupant_name[$i],
                "occupant_gender_req" => $request->occupant_gender[$i],
                "occupant_age" => $request->occupant_age[$i],
                "occupant_relationship" => $request->occupant_relationship[$i],
                "occupant_occupation" => $request->occupant_occupation[$i],
                "occupant_job" => $request->occupant_job[$i],
                "occupant_job_type" => $request->occupant_job_type[$i],
                "occupant_designation" => $request->occupant_designation[$i],
                "occupant_miat" => $request->occupant_miat[$i],
                "occupant_university_name" => $request->occupant_university_name[$i],
                "occupant_degree_name" => $request->occupant_degree_name[$i],
                "occupant_pay_rent" => $request->occupant_pay_rent[$i],
                "occupant_nationality" => $request->occupant_nationality[$i],
                "occupant_visa_status" => $request->occupant_visa_status[$i],
                "occupant_photo" => $this->image($request->file('occupant_photo' . $i), '', 800, 500),
                "occupant_passport_id" => $this->fileUpload($request->file('occupant_passport_id' . $i), ''),
                "occupant_pay_slip" => $this->fileUpload($request->file('occupant_pay_slip' . $i), ''),
                "occupant_bank_statement" => $this->fileUpload($request->file('occupant_bank_statement' . $i), ''),
                "occupant_other_documents" => $this->fileUpload($request->file('occupant_other_documents' . $i), ''),
            ];
        }

        // dd($request->occupant_photo);

        // dd($request->toArray());
        $requestedData['service_advertise_id']          = $request->service_advertise_id;
        $requestedData['number_of_shared_people']       = $request->number_of_shared_people;
        $requestedData['preriod_accommodation_needed']  = $request->preriod_accommodation_needed;
        $requestedData['want_stay_accommodation']       = $request->want_stay_accommodation;
        $requestedData['email']                         = $request->email;
        $requestedData['mobile']                        = $request->mobile;
        $requestedData['occupant_details']              = json_encode($occupant_details);
        $requestedData['status']                        = 'confirmed';

        $propertyBookingDetails                         = PropertyRentBookingDetails::create($requestedData);

        $requestedData['type']                          = 'property_to_rent';
        $requestedData['service_id']                    = $propertyBookingDetails->id;
        $requestedData['description']                   = 'Table: service_advertise_rooms';

        BookingService::create($requestedData);

        $output = [
            'success' => true,
            'msg' => ('Booked Successfully!!!'),
        ];

        return redirect()->back()->with('status', $output);
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

        return view('frontend.service.room.room_list', $data);
    }
}
