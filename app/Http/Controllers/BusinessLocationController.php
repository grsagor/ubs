<?php

namespace App\Http\Controllers;

use App\Account;
use App\Category;
use App\Utils\Util;
use App\InvoiceLayout;
use App\InvoiceScheme;
use App\BusinessLocation;
use App\Utils\ModuleUtil;
use App\SellingPriceGroup;
use App\Utils\BusinessUtil;
use Illuminate\Http\Request;
use App\Services\SlugService;
use GrahamCampbell\ResultType\Success;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class BusinessLocationController extends Controller
{
    protected $moduleUtil;

    protected $commonUtil;

    protected $businessUtil;
    protected $slug_service;


    /**
     * Constructor
     *
     * @param  ModuleUtil  $moduleUtil
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, ModuleUtil $moduleUtil, Util $commonUtil, SlugService $slug_service)
    {
        $this->moduleUtil = $moduleUtil;
        $this->commonUtil = $commonUtil;
        $this->businessUtil = $businessUtil;
        $this->slug_service = $slug_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $data['locations'] = BusinessLocation::query()
            ->with('invoice_schemes', 'invoice_layouts', 'invoice_layouts_sale', 'selling_price_group')
            ->where('business_locations.business_id', $business_id)
            ->latest()
            ->get();

        return view('business_location.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not, then check for location quota
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        } elseif (!$this->moduleUtil->isQuotaAvailable('locations', $business_id)) {
            return $this->moduleUtil->quotaExpiredResponse('locations', $business_id);
        }

        $data['invoice_schemes'] = InvoiceScheme::where('business_id', $business_id)
            ->get()
            ->pluck('name', 'id');

        $data['invoice_layouts'] = InvoiceLayout::where('business_id', $business_id)
            ->get()
            ->pluck('name', 'id');

        $data['price_groups'] = SellingPriceGroup::forDropdown($business_id);

        $data['payment_types'] = $this->commonUtil->payment_types(null, false, $business_id);

        //Accounts
        $data['accounts'] = [];
        if ($this->commonUtil->isModuleEnabled('account')) {
            $data['accounts'] = Account::forDropdown($business_id, true, false);
        }

        $data['categories'] = Category::query()
            ->where('category_type', 'business_location')
            ->where('parent_id', 0)
            ->get();

        return view('business_location.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = $request->session()->get('user.business_id');

            //Check if subscribed or not, then check for location quota
            if (!$this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse();
            } elseif (!$this->moduleUtil->isQuotaAvailable('locations', $business_id)) {
                return $this->moduleUtil->quotaExpiredResponse('locations', $business_id);
            }

            $input = $request->only([
                'name',
                'category',
                'subcategory',
                'location_id',
                'landmark',
                'city',
                'zip_code',
                'state',
                'country',
                'mobile',
                'alternate_number',
                'email',
                'website',
                'facebook',
                'instagram',
                'linkedin',
                'youtube',
                'twitter',
                'logo',
                'about_info',
                'invoice_scheme_id',
                'invoice_layout_id',
                'sale_invoice_layout_id',
                'selling_price_group_id',
                'custom_field1',
                'custom_field2',
                'custom_field3',
                'custom_field4',
                'default_payment_accounts',
                'featured_products',
            ]);

            $logo_name = null;
            if ($request->logo) {
                $image = $request->file('logo');
                $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                $image_path = public_path('uploads/business_location/');
                $image->move($image_path, $image_name);
                $logo_name =  'uploads/business_location/' . $image_name;
            }

            $input['logo'] = $logo_name;

            $input['business_id'] = $business_id;

            $input['default_payment_accounts'] = !empty($input['default_payment_accounts']) ? json_encode($input['default_payment_accounts']) : null;

            //Update reference count
            $ref_count = $this->moduleUtil->setAndGetReferenceCount('business_location');

            if (empty($input['location_id'])) {
                $input['location_id'] = $this->moduleUtil->generateReferenceNumber('business_location', $ref_count);
            }


            $location = new BusinessLocation();

            // Create unique slug
            $input['slug'] = $this->slug_service->slug_create($request->name, $location);

            $location = $location->create($input);

            // $location = BusinessLocation::create($input);

            //Create a new permission related to the created location
            Permission::create(['name' => 'location.' . $location->id]);

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect()->route('business-location.index')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoreFront  $storeFront
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreFront  $storeFront
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $location = BusinessLocation::where('business_id', $business_id)
            ->find($id);
        $invoice_layouts = InvoiceLayout::where('business_id', $business_id)
            ->get()
            ->pluck('name', 'id');
        $invoice_schemes = InvoiceScheme::where('business_id', $business_id)
            ->get()
            ->pluck('name', 'id');

        $price_groups = SellingPriceGroup::forDropdown($business_id);

        $payment_types = $this->commonUtil->payment_types(null, false, $business_id);

        //Accounts
        $accounts = [];
        if ($this->commonUtil->isModuleEnabled('account')) {
            $accounts = Account::forDropdown($business_id, true, false);
        }
        $featured_products = $location->getFeaturedProducts(true, false);

        $categories = Category::query()
            ->where('category_type', 'business_location')
            ->where('parent_id', 0)
            ->get();

        $selectedSubcategory = $location->subcategory;

        return view('business_location.edit')
            ->with(compact(
                'location',
                'invoice_layouts',
                'invoice_schemes',
                'price_groups',
                'payment_types',
                'accounts',
                'categories',
                'selectedSubcategory',
                'featured_products'
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreFront  $storeFront
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only([
                'name',
                'category',
                'subcategory',
                'location_id',
                'landmark',
                'city',
                'zip_code',
                'state',
                'country',
                'mobile',
                'alternate_number',
                'email',
                'website',
                'facebook',
                'instagram',
                'linkedin',
                'youtube',
                'twitter',
                'logo',
                'about_info',
                'invoice_scheme_id',
                'invoice_layout_id',
                'sale_invoice_layout_id',
                'selling_price_group_id',
                'custom_field1',
                'custom_field2',
                'custom_field3',
                'custom_field4',
                'default_payment_accounts',
                'featured_products',
            ]);

            $business_id = $request->session()->get('user.business_id');

            // Fetch the existing location
            $location = BusinessLocation::where('business_id', $business_id)
                ->where('id', $id)
                ->first();

            // Handle image upload
            if ($request->hasFile('logo')) {
                // Delete the old image if exists
                if ($location->logo && file_exists(public_path($location->logo))) {
                    unlink(public_path($location->logo));
                }

                // Upload the new image
                $image = $request->file('logo');
                $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                $image_path = public_path('uploads/business_location/');
                $image->move($image_path, $image_name);
                $input['logo'] = 'uploads/business_location/' . $image_name;
            } else {
                // Keep the old logo if a new one is not uploaded
                $input['logo'] = $location->logo;
            }

            $input['default_payment_accounts'] = !empty($input['default_payment_accounts']) ? json_encode($input['default_payment_accounts']) : null;
            $input['featured_products'] = !empty($input['featured_products']) ? json_encode($input['featured_products']) : null;

            // Update the location
            $location->update($input);

            $output = [
                'success' => true,
                'msg' => __('business.business_location_updated_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect()->route('business-location.index')->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreFront  $storeFront
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Checks if the given location id already exist for the current business.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkLocationId(Request $request)
    {
        $location_id = $request->input('location_id');

        $valid = 'true';
        if (!empty($location_id)) {
            $business_id = $request->session()->get('user.business_id');
            $hidden_id = $request->input('hidden_id');

            $query = BusinessLocation::where('business_id', $business_id)
                ->where('location_id', $location_id);
            if (!empty($hidden_id)) {
                $query->where('id', '!=', $hidden_id);
            }
            $count = $query->count();
            if ($count > 0) {
                $valid = 'false';
            }
        }
        echo $valid;
        exit;
    }

    /**
     * Function to activate or deactivate a location.
     *
     * @param  int  $location_id
     * @return json
     */

    public function activateDeactivateLocation($location_id)
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = request()->session()->get('user.business_id');

            $business_location = BusinessLocation::where('business_id', $business_id)
                ->findOrFail($location_id);

            $business_location->is_active = !$business_location->is_active;
            $business_location->save();

            $msg = $business_location->is_active ? __('lang_v1.business_location_activated_successfully') : __('lang_v1.business_location_deactivated_successfully');

            $output = [
                'success' => true,
                'msg' => $msg,
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return redirect()->route('business-location.index')->with('status', $output);

        return $output;
    }
}
