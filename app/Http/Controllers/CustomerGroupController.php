<?php

namespace App\Http\Controllers;

use App\CustomerGroup;
use App\SellingPriceGroup;
use App\User;
use App\Utils\Util;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\System;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Utils\ModuleUtil;
use DB;
use App\Utils\ContactUtil;

class CustomerGroupController extends Controller
{
    protected $commonUtil;
    protected $moduleUtil;
    protected $contactUtil;

    /**
     * Constructor
     *
     * @param  Util  $commonUtil
     * @return void
     */

    public function __construct(Util $commonUtil,  ModuleUtil $moduleUtil,  ContactUtil $contactUtil)
    {
        $this->commonUtil = $commonUtil;
        $this->moduleUtil = $moduleUtil;
        $this->contactUtil = $contactUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('customer.view')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $customer_group = CustomerGroup::where('customer_groups.business_id', $business_id)
                ->leftjoin('selling_price_groups as spg', 'spg.id', '=', 'customer_groups.selling_price_group_id')
                ->select(['customer_groups.name', 'customer_groups.amount', 'spg.name as selling_price_group', 'customer_groups.id', 'price_calculation_type']);

            return Datatables::of($customer_group)
                ->addColumn(
                    'action',
                    '@can("customer.update")
                            <button data-href="{{action(\'App\Http\Controllers\CustomerGroupController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_customer_group_button"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>
                        &nbsp;
                        @endcan

                        @can("customer.delete")
                            <button data-href="{{action(\'App\Http\Controllers\CustomerGroupController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_customer_group_button"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</button>
                        @endcan'
                )
                ->editColumn('selling_price_group', '@if($price_calculation_type=="selling_price_group") {{$selling_price_group}} @else -- @endif ')
                ->editColumn('amount', '@if($price_calculation_type=="percentage") {{$amount}} @else -- @endif ')
                ->removeColumn('id')
                ->removeColumn('price_calculation_type')
                ->rawColumns([3])
                ->make(false);
        }

        return view('customer_group.index');
    }

    public function getRegister($business_id = null)
    {
        $sessionLink = session('link');

        return view('customer_group.register', compact('business_id', 'sessionLink'));
    }

    public function postRegister(Request $request)
    {
        try {
            if ($request->business_id !== null) {
                $business_id = $request->business_id;

                //Check if subscribed or not
                if (!$this->moduleUtil->isSubscribed($business_id)) {
                    return $this->moduleUtil->expiredResponse();
                }

                $input = $request->only([
                    'type', 'supplier_business_name',
                    'surname', 'first_name', 'middle_name', 'last_name', 'tax_number', 'pay_term_number', 'pay_term_type', 'mobile', 'landline', 'alternate_number', 'city', 'state', 'country', 'address_line_1', 'address_line_2', 'customer_group_id', 'zip_code', 'contact_id', 'custom_field1', 'custom_field2', 'custom_field3', 'custom_field4', 'custom_field5', 'custom_field6', 'custom_field7', 'custom_field8', 'custom_field9', 'custom_field10', 'email', 'shipping_address', 'position', 'dob', 'shipping_custom_field_details', 'assigned_to_users', 'contact_number', 'alt_number'
                ]);

                $name_array = [];

                if (!empty($input['surname'])) {
                    $name_array[] = $input['surname'];
                }
                if (!empty($input['first_name'])) {
                    $name_array[] = $input['first_name'];
                }
                if (!empty($input['middle_name'])) {
                    $name_array[] = $input['middle_name'];
                }
                if (!empty($input['last_name'])) {
                    $name_array[] = $input['last_name'];
                }
                // For contact table surname as prefix
                if (!empty($input['surname'])) {
                    $input['prefix'] = $input['surname'];
                }
                if (!empty($input['contact_number'])) {
                    $input['mobile'] = $input['contact_number'];
                }
                if (!empty($input['alt_number'])) {
                    $input['alternate_number'] = $input['alt_number'];
                }


                $input['type'] = 'customer';


                $input['name'] = trim(implode(' ', $name_array));


                if (!empty($request->input('is_export'))) {
                    $input['is_export'] = true;
                    $input['export_custom_field_1'] = $request->input('export_custom_field_1');
                    $input['export_custom_field_2'] = $request->input('export_custom_field_2');
                    $input['export_custom_field_3'] = $request->input('export_custom_field_3');
                    $input['export_custom_field_4'] = $request->input('export_custom_field_4');
                    $input['export_custom_field_5'] = $request->input('export_custom_field_5');
                    $input['export_custom_field_6'] = $request->input('export_custom_field_6');
                }

                if (!empty($input['dob'])) {
                    $input['dob'] = $this->commonUtil->uf_date($input['dob']);
                }

                $input['business_id'] = $business_id;

                // dd($request->input('credit_limit'), $request->input('opening_balance'), $input);

                DB::beginTransaction();

                $requestData = $request->all();
                $requestData['business_id'] = $business_id;

                // Register the user and get the user object
                $user = $this->userCreate($requestData);

                // Fire the Registered event with the user object
                event(new Registered($user));

                // created_by session null
                $input['created_by'] = $user->id;;

                $input['credit_limit'] = $request->input('credit_limit') != '' ? $this->commonUtil->num_uf($request->input('credit_limit')) : null;
                $input['opening_balance'] = $this->commonUtil->num_uf($request->input('opening_balance'));


                $output = $this->contactUtil->createNewContact($input);

                if ($request->contact_persons && is_array($request->contact_persons)) {
                    foreach ($request->contact_persons as $cp) {
                        $cp['crm_contact_id '] = $output['data']['id'];
                        if ($cp['first_name'] && $cp['email'] || $cp['last_name'] && $cp['email']) {
                            $this->crmUtil->creatContactPerson($cp);
                        }
                    }
                }

                $this->moduleUtil->getModuleData('after_contact_saved', ['contact' => $output['data'], 'input' => $request->input()]);

                $this->contactUtil->activityLog($output['data'], 'added');

                DB::commit();

                return redirect(url('login'))->with('status', $output);
                // dd($request->input('credit_limit'), $request->input('opening_balance'), $input);
            } else {
                $validator = $this->validator($request->all())->validate();

                event(new Registered($user = $this->userCreate($request->all())));

                $output = [
                    'success' => true,
                    'msg' => ('Register successfull!!!'),
                ];

                $sessionLink = session('link');

                return redirect(url('login'))->with('status', $output)->with('sessionLink', $sessionLink);
            }
        } catch (\Throwable $e) {
            DB::rollBack();

            // dd($e->getmessage());

            $output = [
                'success' => false,
                'msg' => 'Something went wrong!!!',
            ];

            return redirect()->back()->with('status', $output);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'contact_number' => ['required', 'string', 'min:1', 'max:20', 'unique:users']
        ]);
    }

    protected function userCreate(array $data)
    {
        return User::create([
            'user_type' => 'user_customer',
            'surname' => $data['surname'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'alt_number' => $data['alt_number'],
            'family_number' => $data['family_number'],
            'permanent_address' => $data['permanent_address'],
            'current_address' => $data['current_address'],
            'business_id' => $data['business_id'] ?? NULL,
            'username' => $data['username'],
            'contact_no' => $data['contact_number'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('customer.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $price_groups = SellingPriceGroup::forDropdown($business_id, false);

        return view('customer_group.create')->with(compact('price_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('customer.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['name', 'amount', 'price_calculation_type', 'selling_price_group_id']);
            $input['business_id'] = $request->session()->get('user.business_id');
            $input['created_by'] = $request->session()->get('user.id');
            $input['amount'] = !empty($input['amount']) ? $this->commonUtil->num_uf($input['amount']) : 0;

            $customer_group = CustomerGroup::create($input);
            $output = [
                'success' => true,
                'data' => $customer_group,
                'msg' => __('lang_v1.success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $customer_group = CustomerGroup::where('business_id', $business_id)->find($id);

            $business_id = request()->session()->get('user.business_id');
            $price_groups = SellingPriceGroup::forDropdown($business_id, false);

            return view('customer_group.edit')
                ->with(compact('customer_group', 'price_groups'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $input = $request->only(['name', 'amount', 'price_calculation_type', 'selling_price_group_id']);
                $business_id = $request->session()->get('user.business_id');

                $input['amount'] = !empty($input['amount']) ? $this->commonUtil->num_uf($input['amount']) : 0;

                $customer_group = CustomerGroup::where('business_id', $business_id)->findOrFail($id);

                $customer_group->update($input);

                $output = [
                    'success' => true,
                    'msg' => __('lang_v1.success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('customer.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $business_id = request()->user()->business_id;

                $cg = CustomerGroup::where('business_id', $business_id)->findOrFail($id);
                $cg->delete();

                $output = [
                    'success' => true,
                    'msg' => __('lang_v1.success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }
}
