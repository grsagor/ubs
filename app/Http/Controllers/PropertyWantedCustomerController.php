<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\User;
use App\BusinessLocation;
use App\ChildCategory;
use App\ServiceCategory;
use App\ServiceCharge;
use App\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Modules\Crm\Entities\ServicePropertyWanted;

class PropertyWantedCustomerController extends Controller
{
    use ImageFileUpload;

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        // $services = ServicePropertyWanted::where('user_id', $user->id)->with('category')->with('sub_category')->with('child_category')->get();

        // return $services;

        if (request()->ajax()) {
            $services = ServicePropertyWanted::where('user_id', $user->id)->with('category')->with('sub_category')->with('child_category')->get();

            return Datatables::of($services)
                ->addColumn('child_category_name', function ($service) {
                    return $service->child_category->name;
                })
                ->addColumn('status', function ($service) {
                    return $service->status;
                })
                ->addColumn('action', function ($service) {

                    $room_details_int = null;

                    if ($service->room_details !== null) {
                        preg_match('/\d+/', $service->room_details, $matches);
                        $room_details_int = isset($matches[0]) ? intval($matches[0]) : null;
                    }

                    $html =
                        '<div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">' . __('messages.actions') . '<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu dropdown-menu-left" style="position: relative" role="menu">';

                    $html .= '<li><a href="/property-show/' . $service->id . '" target="_blank" style="padding: 0;"><button class="btn btn-link" style="color: #525557;"><i class="fas fa-solid fa-eye"></i>View</button></a></li>';
                    $html .= '<li><button type="button" data-id="' . $service->id . '" class="btn btn-link" id="property_wanted_edit_btn" data-toggle="tooltip" style="color: #525557;"><i class="glyphicon glyphicon-edit"></i> ' . __('Edit') . '</button></li>';
                    // $html .= '<li><button type="button" data-id="' . $service->id . '" class="btn btn-link" id="property_wanted_delete_btn" data-toggle="tooltip" style="color: #525557;"><i class="fas fa-history"></i> ' . __('Change Status') . '</button></li>';


                    if ($service->upgraded && $service->plan == 'Regular') {
                        $html .= '<li><button type="button" class="btn btn-link" id="" data-toggle="tooltip" style="color: #525557;"><i class="fa fa-moon"></i> ' . __('Regular') . '</button></li>';
                    } elseif ($service->plan == 'Premium') {
                        $html .= '<li><button type="button" class="btn btn-link" id="" data-toggle="tooltip" style="color: #525557;"><i class="fa fa-star"></i> ' . __('Premium') . '</button></li>';
                    } else {
                        $html .= '<form action="/property-finding-service/" method="GET" enctype="multipart/form-data">
                                    <li>
                                        <button type="submit" class="btn btn-link" id="" data-toggle="tooltip" style="color: #525557;">
                                            <i class="fa fa-arrow-circle-up"></i>
                                            <input type="hidden" name="property_id" value="' . $service->id . '">
                                            <input type="hidden" name="child_category_id" value="' . $service->child_category_id . '">
                                            <input type="hidden" name="property_size" value="' . $service->property_size . '">
                                            <input type="hidden" name="room_details" value="' . $room_details_int . '">
                                            ' . __('Upgrade') . '
                                        </button>
                                    </li>
                                </form>';
                    }

                    $html .= '</ul></div>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('crm::property_wanted.list');
    }

    public function createPropertyPage()
    {
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        // return $business_locations;
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'buy']])->first();
        //$sub_category = SubCategory::where(['category_id',$category->id])->get();

        $child_categories = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->get();

        $languages = $this->languages();
        $countries = $this->countries();

        $data = [];
        $data['countries'] = $countries;
        $data['languages'] = $languages;
        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['child_categories'] = $child_categories;
        $data['house'] = ServiceCharge::where('child_category', 2)->first()->service_charge;
        $data['Flat'] = ServiceCharge::where('child_category', 6)->first()->service_charge;
        $data['studio_flat'] = ServiceCharge::where('child_category', 9)->first()->service_charge;
        $data['single'] = ServiceCharge::where([['child_category', 1], ['size', ['single']]])->first()->service_charge;
        $data['double'] = ServiceCharge::where([['child_category', 1], ['size', ['double']]])->first()->service_charge;
        $data['semi_double'] = ServiceCharge::where([['child_category', 1], ['size', ['semi-double']]])->first()->service_charge;
        $data['en_suite'] = ServiceCharge::where([['child_category', 1], ['size', ['en-suite']]])->first()->service_charge;

        return view('crm::property_wanted.property_add_page', compact('business_locations'), $data);
    }
    public function create()
    {
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        // return $business_locations;
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'buy']])->first();
        //$sub_category = SubCategory::where(['category_id',$category->id])->get();

        $child_categories = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->get();

        $languages = $this->languages();
        $countries = $this->countries();

        $data = [];
        $data['countries'] = $countries;
        $data['languages'] = $languages;
        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['child_categories'] = $child_categories;
        $data['house'] = ServiceCharge::where('child_category', 2)->first()->service_charge;
        $data['Flat'] = ServiceCharge::where('child_category', 6)->first()->service_charge;
        $data['studio_flat'] = ServiceCharge::where('child_category', 9)->first()->service_charge;
        $data['single'] = ServiceCharge::where([['child_category', 1], ['size', ['single']]])->first()->service_charge;
        $data['double'] = ServiceCharge::where([['child_category', 1], ['size', ['double']]])->first()->service_charge;
        $data['semi_double'] = ServiceCharge::where([['child_category', 1], ['size', ['semi-double']]])->first()->service_charge;
        $data['en_suite'] = ServiceCharge::where([['child_category', 1], ['size', ['en-suite']]])->first()->service_charge;
        return view('crm::property_wanted.create', compact('business_locations'), $data);
    }

    public function showOccupantsDetailsInputs(Request $request)
    {
        $num = $request->num;
        $html = view('crm::property_wanted.show_occupants_details_inputs', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }
    public function showOccupantsDetailsInputsCreate(Request $request)
    {
        $num = $request->num;
        $html = view('crm::property_wanted.create_show_occupants_details_inputs', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }
    public function showRoomDetailsInputs(Request $request)
    {
        $num = $request->num;
        $num = 1;
        $html = view('crm::property_wanted.show_room_details_inputs', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }

    public function storeProperty(Request $request)
    {
        // dd($request->toArray());
        try {
            $occupant_details = [];

            if (!is_array($request->occupant_name)) {
                $request->occupant_name = json_decode($request->occupant_name);
            }

            $count = count($request->occupant_name);
            for ($i = 0; $i < $count; $i++) {
                $occupant_details[] = [
                    "occupant_name" => $request->occupant_name[$i],
                    "occupant_gender_req" => $request->occupant_gender_req[$i],
                    "occupant_age" => $request->occupant_age[$i],
                    "occupant_relationship" => $request->occupant_relationship[$i],
                    "occupant_occupation" => $request->occupant_occupation[$i],
                    "occupant_university_name" => $request->occupant_university_name[$i],
                    "occupant_degree_name" => $request->occupant_degree_name[$i],
                    "occupant_job" => $request->occupant_job[$i],
                    "occupant_job_type" => $request->occupant_job_type[$i],
                    "occupant_designation" => $request->occupant_designation[$i],
                    "occupant_miat" => $request->occupant_miat[$i],
                    "occupant_pay_rent" => $request->occupant_pay_rent[$i],
                    "occupant_nationality" => $request->occupant_nationality[$i],
                    "occupant_visa_status" => $request->occupant_visa_status[$i],
                ];
            }

            $property = new ServicePropertyWanted();

            $requestedData = $request->all();

            $requestedData['reference_id'] = Auth::id() . Str::random(15);

            $requestedData['user_id'] = auth()->id();

            $requestedData['roomfurnishings']       = json_encode($request->roomfurnishings);
            $requestedData['occupant_details']      = json_encode($occupant_details);
            $requestedData['age']                   = json_encode($request->age);

            if ($request->hasFile('images')) {
                $requestedData['images'] = FileHelper::saveImages($request->file('images'));
            }
            $property->fill($requestedData);
            $property->room_details = json_encode($request->room_details);
            $property->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return response()->json($output);
        } catch (\Throwable $e) {
            dd($e->getmessage());
            $output = [
                'success' => false,
                'msg' => ('Created failed!!!'),
            ];

            return redirect()->back()->with('status', $output);
        }
    }

    public function showPropertyDeleteModal(Request $request)
    {
        $id = $request->id;
        return view('crm::property_wanted.property_delete_modal', compact('id'));
    }
    public function confirmPropertyDelete(Request $request)
    {
        $id = $request->id;
        $property = ServicePropertyWanted::find($id);
        if ($property->status == 1) {
            $property->status = 0;
        } else {
            $property->status = 1;
        }
        $property->save();
        $response = [
            'success' => true,
            'message' => 'Property status changed.'
        ];
        return response()->json($response);
    }

    public function showPropertyEditModal(Request $request)
    {
        $id = $request->id;
        $property = ServicePropertyWanted::find($id);
        $property->room_details = $property->room_details ? json_decode($property->room_details) : null;
        $property->images = $property->images ? json_decode($property->images) : null;
        $property->roomfurnishings = $property->roomfurnishings ? json_decode($property->roomfurnishings) : null;
        $property->age = $property->age ? json_decode($property->age) : null;
        if ($property->occupant_details && !is_array($property->occupant_details)) {
            $property->occupant_details = json_decode($property->occupant_details);
            if (!is_array($property->occupant_details)) {
                $property->occupant_details = json_decode($property->occupant_details);
            }
        }

        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'buy']])->first();
        //$sub_category = SubCategory::where(['category_id',$category->id])->get();

        $child_categories = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->get();

        $languages = $this->languages();
        $countries = $this->countries();

        $data = [];
        $data['countries'] = $countries;
        $data['languages'] = $languages;
        $data['property'] = $property;
        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['child_categories'] = $child_categories;
        $data['house'] = ServiceCharge::where('child_category', 2)->first()->service_charge;
        $data['Flat'] = ServiceCharge::where('child_category', 6)->first()->service_charge;
        $data['studio_flat'] = ServiceCharge::where('child_category', 9)->first()->service_charge;
        $data['single'] = ServiceCharge::where([['child_category', 1], ['size', ['single']]])->first()->service_charge;
        $data['double'] = ServiceCharge::where([['child_category', 1], ['size', ['double']]])->first()->service_charge;
        $data['semi_double'] = ServiceCharge::where([['child_category', 1], ['size', ['semi-double']]])->first()->service_charge;
        $data['en_suite'] = ServiceCharge::where([['child_category', 1], ['size', ['en-suite']]])->first()->service_charge;
        return view('crm::property_wanted.property_edit_modal', compact('business_locations'), $data);
    }

    public function updatePropertyWanted(Request $request)
    {
        $property = ServicePropertyWanted::find($request->property_id);

        if ($request->occupant_name) {
            $count = count($request->occupant_name);
            $occupant_details = [];
            for ($i = 0; $i < $count; $i++) {
                $occupant_details[] = [
                    "occupant_name" => $request->occupant_name[$i],
                    "occupant_gender_req" => $request->occupant_gender_req[$i],
                    "occupant_age" => $request->occupant_age[$i],
                    "occupant_relationship" => $request->occupant_relationship[$i],
                    "occupant_occupation" => $request->occupant_occupation[$i],
                    "occupant_university_name" => $request->occupant_university_name[$i],
                    "occupant_degree_name" => $request->occupant_degree_name[$i],
                    "occupant_job" => $request->occupant_job[$i],
                    "occupant_job_type" => $request->occupant_job_type[$i],
                    "occupant_designation" => $request->occupant_designation[$i],
                    "occupant_miat" => $request->occupant_miat[$i],
                    "occupant_pay_rent" => $request->occupant_pay_rent[$i],
                    "occupant_nationality" => $request->occupant_nationality[$i],
                    "occupant_visa_status" => $request->occupant_visa_status[$i],
                ];
            }
        }

        $requestedData = $request->all();

        if (isset($request->roomfurnishings)) {
            $requestedData['roomfurnishings'] = json_encode($request->roomfurnishings);
        }

        if (isset($occupant_details)) {
            $requestedData['occupant_details'] = json_encode($occupant_details);
        }

        if (isset($request->room_details)) {
            $requestedData['room_details'] = json_encode($request->room_details);
        }

        if (isset($request->age)) {
            $requestedData['age'] = json_encode($request->age);
        }
        if ($request->hasFile('images')) {
            $requestedData['images'] = FileHelper::saveImages($request->file('images'));
        }

        $property->fill($requestedData)->save();

        $response = [
            'success' => true,
            'msg' => 'Property updated successfully.'
        ];
        return response()->json($response);
    }
    public function propertyWantedUpgradePage(Request $request)
    {
        $property = ServicePropertyWanted::find($request->product_id);
        $bill = ServiceCharge::where([['category_id', $property->category_id], ['sub_category_id', $property->sub_category_id], ['child_category', $property->child_category_id]])->first()->service_charge;

        return redirect('stripe')
            ->with([
                'product_id' => $request->product_id,
                // 'product_name' => $info['product_name'],
                'bill' => $bill,
                'table_name' => 'service_property_wanted',
                'upgrade' => 'yes',
                'url' => '/contact/property-wanted',
            ]);
    }

    public function showStudentInfoContainerEdit()
    {
        $html = view('crm::property_wanted.edit_student_info_container')->render();

        $response = [
            'html' => $html
        ];

        return response()->json($response);
    }
    public function showStudentInfoContainerCreate()
    {
        $html = view('crm::property_wanted.create_student_info_container')->render();

        $response = [
            'html' => $html
        ];

        return response()->json($response);
    }

    public function showSecondStep(Request $request)
    {
        $child_category = $request->child_category_id;
        $languages = $this->languages();
        $countries = $this->countries();

        $data = [];
        $data['child_category'] = $child_category;
        $data['countries'] = $countries;
        $data['languages'] = $languages;
        $html = view('crm::property_wanted.show_second_step', $data)->render();

        $response = [
            'html' => $html,
            'child' => $child_category
        ];

        return response()->json($response);
    }
    public function showEditSecondStep(Request $request)
    {
        $child_category = $request->child_category_id;
        $property = ServicePropertyWanted::find($request->id);
        $property->images = $property->images ? json_decode($property->images) : null;

        $languages = $this->languages();
        $countries = $this->countries();

        $data = [];
        $data['child_category'] = $child_category;
        $data['property'] = $property;
        $data['countries'] = $countries;
        $data['languages'] = $languages;
        $html = view('crm::property_wanted.show_edit_second_step', $data)->render();

        $response = [
            'html' => $html,
            'child' => $child_category,
            'images' => $property->images
        ];

        return response()->json($response);
    }

    public function checkAdvertTitle($data)
    {
        $auth_id = Auth::id();

        $checking_advert_title = ServicePropertyWanted::where('user_id', $auth_id)
            ->where('ad_title', $data)
            ->first();

        // Check if $checking_advert_title is not null
        if ($checking_advert_title) {
            return true;
        } else {
            return false;
        }
    }

    private function languages()
    {
        $languages = [
            'English',
            'Mixed',
            'Arabic',
            'Bengali',
            'Cantonese',
            'French',
            'German',
            'Hindi',
            'Indonesian',
            'Japanese',
            'Malay',
            'Mandarin',
            'Portuguese',
            'Punjabi',
            'Russian',
            'Spanish',
            'Afrikaans',
            'Albanian',
            'Amharic',
            'Armenian',
            'Aymara',
            'Baluchi',
            'Bambara',
            'Basque',
            'Belarussian',
            'Berber',
            'Bislama',
            'Bosnian',
            'Bulgarian',
            'Burmese',
            'Catalan',
            'Ciluba',
            'Creole',
            'Croatian',
            'Czech',
            'Danish',
            'Dari',
            'Dutch',
            'Eskimo',
            'Estonian',
            'Ewe',
            'Fang',
            'Faroese',
            'Farsi (Persian)',
            'Filipino',
            'Finnish',
            'Flemish',
            'Galician',
            'Greek',
            'Gujarati',
            'Hausa',
            'Hebrew',
            'Hungarian',
            'Ibo',
            'Icelandic',
            'Italian',
            'Kabi',
            'Kashmiri',
            'Kirundi',
            'Kishwahili',
            'Korean',
            'Latvian',
            'Lingala',
            'Lithuanian',
            'Luxembourgish',
            'Macedonian',
            'Malagasy',
            'Mayan',
            'Motu',
            'Nepali',
            'Norwegian',
            'Noub',
            'Pashto',
            'Peul',
            'Pidgin',
            'Polish',
            'Pushtu',
            'Quechua',
            'Romanian',
            'Romansch',
            'Sango',
            'Serbian',
            'Setswana',
            'Sindhi',
            'Sinhala',
            'Slovak',
            'Slovene',
            'Somali',
            'Swahili',
            'Swedish',
            'Tamil',
            'Thai',
            'Turkish',
            'Urdu',
            'Vietnamese',
            'Welsh',
            'Xhosa',
            'Yoruba',
            'Zulu',
        ];

        return $languages;
    }
    private function countries()
    {
        $countries = [
            'Afghan',
            'Albanian',
            'Algerian',
            'American',
            'Andorran',
            'Angolan',
            'Anguillan',
            'Antigua and Barbuda',
            'Argentine',
            'Armenian',
            'Australian',
            'Austrian',
            'Azerbaijani',
            'Bahamian',
            'Bahraini',
            'Bangladeshi',
            'Barbadian',
            'Belarusian',
            'Belgian',
            'Belizean',
            'Beninese',
            'Bermudian',
            'Bhutanese',
            'Bolivian',
            'Bosnia and Herzegovina',
            'Botswanan',
            'Brazilian',
            'British',
            'British Virgin Islander',
            'Bruneian',
            'Bulgarian',
            'Burkinan',
            'Burmese',
            'Burundian',
            'Cambodian',
            'Cameroonian',
            'Canadian',
            'Cape Verdean',
            'Cayman Islander',
            'Central African',
            'Chadian',
            'Chilean',
            'Chinese',
            'Colombian',
            'Comoran',
            'Congolese (Congo)',
            'Congolese (DRC)',
            'Cook Islander',
            'Costa Rican',
            'Croatian',
            'Cuban',
            'Cymraes',
            'Cymro',
            'Cypriot',
            'Czech',
            'Danish',
            'Djiboutian',
            'Dominican (Commonwealth)',
            'Dominican (Republic)',
            'Dutch',
            'East Timorese',
            'Ecuadorean',
            'Egyptian',
            'Emirati',
            'English',
            'Equatorial Guinean',
            'Eritrean',
            'Estonian',
            'Ethiopian',
            'Faroese',
            'Fijian',
            'Filipino',
            'Finnish',
            'French',
            'Gabonese',
            'Gambian',
            'Georgian',
            'German',
            'Ghanaian',
            'Gibraltarian',
            'Greek',
            'Greenlandic',
            'Grenadian',
            'Guamanian',
            'Guatemalan',
            'Guinea-Bissau',
            'Guinean',
            'Guyanese',
            'Haitian',
            'Honduran',
            'Hong Konger',
            'Hungarian',
            'Icelandic',
            'Indian',
            'Indonesian',
            'Iranian',
            'Iraqi',
            'Irish',
            'Israeli',
            'Italian',
            'Ivorian',
            'Jamaican',
            'Japanese',
            'Jordanian',
            'Kazakh',
            'Kenyan',
            'Kittitian',
            'Kiribati',
            'Kosovan',
            'Kuwaiti',
            'Kyrgyz',
            'Lao',
            'Latvian',
            'Lebanese',
            'Liberian',
            'Libyan',
            'Liechtenstein citizen',
            'Lithuanian',
            'Luxembourger',
            'Macanese',
            'Macedonian',
            'Malagasy',
            'Malawian',
            'Malaysian',
            'Maldivian',
            'Malian',
            'Maltese',
            'Marshallese',
            'Martiniquais',
            'Mauritanian',
            'Mauritian',
            'Mexican',
            'Micronesian',
            'Moldovan',
            'Monegasque',
            'Mongolian',
            'Montenegrin',
            'Montserratian',
            'Moroccan',
            'Mosotho',
            'Mozambican',
            'Namibian',
            'Nauruan',
            'Nepalese',
            'New Zealander',
            'Nicaraguan',
            'Nigerian',
            'Nigerien',
            'Niuean',
            'North Korean',
            'Northern Irish',
            'Norwegian',
            'Omani',
            'Pakistani',
            'Palauan',
            'Palestinian',
            'Panamanian',
            'Papua New Guinean',
            'Paraguayan',
            'Peruvian',
            'Pitcairn Islander',
            'Polish',
            'Portuguese',
            'Prydeinig',
            'Puerto Rican',
            'Qatari',
            'Romanian',
            'Russian',
            'Rwandan',
            'Salvadorean',
            'Sammarinese',
            'Samoan',
            'Sao Tomean',
            'Saudi Arabian',
            'Scottish',
            'Senegalese',
            'Serbian',
            'Seychelles',
            'Sierra Leonean',
            'Singaporean',
            'Slovak',
            'Slovenian',
            'Solomon Islander',
            'Somali',
            'South African',
            'South Korean',
            'South Sudanese',
            'Spanish',
            'Sri Lankan',
            'St Helenian',
            'St Lucian',
            'Stateless',
            'Sudanese',
            'Surinamese',
            'Swazi',
            'Swedish',
            'Swiss',
            'Syrian',
            'Taiwanese',
            'Tajik',
            'Tanzanian',
            'Thai',
            'Togolese',
            'Tongan',
            'Trinidadian',
            'Tristanian',
            'Tunisian',
            'Turkish',
            'Turkmen',
            'Turks and Caicos Islander',
            'Tuvaluan',
            'Ugandan',
            'Ukrainian',
            'Uruguayan',
            'Uzbek',
            'Vatican citizen',
            'Vanuatu',
            'Venezuelan',
            'Vietnamese',
            'Vincentian',
            'Wallisian',
            'Welsh',
            'Yemeni',
            'Zambian',
            'Zimbabwean',
        ];


        return $countries;
    }
}
