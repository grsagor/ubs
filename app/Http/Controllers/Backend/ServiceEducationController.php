<?php

namespace App\Http\Controllers\Backend;

use App\Brands;
use App\BusinessLocation;
use App\Category;
use App\Product;
use App\SellingPriceGroup;
use App\ServiceEducation;
use App\ServiceSubCategories;
use App\TaxRate;
use App\Traits\ImageFileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceEducationRequest;
use App\Http\Requests\UpdateServiceEducationRequest;
use App\Unit;
use App\Warranty;

class ServiceEducationController extends Controller
{
    use ImageFileUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        // return $business_locations;

        return view('backend.services.education.create', compact('business_locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('product.create')) {
            abort(403, 'Unauthorized action.');
        }



        $business_id = request()->session()->get('user.business_id');

        $categories = Category::forDropdown($business_id, 'product');

        $brands = Brands::forDropdown($business_id);

        //Duplicate product
        $duplicate_product = null;
        $rack_details = null;

        $sub_categories = ServiceSubCategories::query()->where('service_category_id',2)->pluck('name','id');

        return view('backend.services.education.create')
            ->with(compact('categories', 'brands', 'sub_categories'));
    }

/*    public function create()
    {
        return view('backend.services.education.create');
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceEducationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceEducationRequest $request, ServiceEducation $serviceEducation)
    {
        dd('hello im here');
        try {
            $requestedData                               = $request->all();

            // Check Service Category Table Education category id is 2
            $requestedData['service_category_id']        = 2;

            $requestedData['thumbnail']                  = $this->image($request->file('thumbnail'), 'uploads/service_education/', 800, 500);

            $requestedData['images']                     = $this->image($request->file('images'), 'uploads/service_education/', 800, 500);

            $serviceEducation->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->back()->with('status', $output);
        } catch (\Throwable $e) {

            dd($e->getmessage());

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEducation $serviceEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceEducation $serviceEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceEducationRequest  $request
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceEducationRequest $request, ServiceEducation $serviceEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEducation $serviceEducation)
    {
        //
    }
}
