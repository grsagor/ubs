<?php

namespace App\Http\Controllers;

use App\MarketingCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\CURDservice;
use Illuminate\Support\Facades\Auth;

class MarketingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $curdService;

    public function __construct(CURDservice $curdService)
    {
        $this->curdService          = $curdService;
    }

    public function index(Request $request)
    {
        $data['marketing'] = MarketingCategory::query()->search($request)->latest()->paginate(10);

        return view('marketing_category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marketing_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MarketingCategory $marketingCategory)
    {
        try {
            $requestedData = $request->all();

            $requestedData['business_id']   = Auth::user()->business_id;
            $requestedData['slug']          = Str::slug($request->name);

            $requestedData                  = $marketingCategory->fill($requestedData)->save();

            return $this->curdService->SuccessFull('Marketing Category', 'shop-marketing-category.index');
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MarketingCategory  $marketingCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MarketingCategory $marketingCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MarketingCategory  $marketingCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marketingCategory = MarketingCategory::find($id);
        return view('marketing_category.edit', compact('marketingCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MarketingCategory  $marketingCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the NewsCategory by ID
            $newsCategory = MarketingCategory::find($id);

            // Check if the NewsCategory is found
            if (!$newsCategory) {
                return $this->curdService->NotFound('Marketing Category');
            }

            // Update the NewsCategory with the requested data
            $newsCategory->update($request->all());

            return $this->curdService->SuccessFull('Marketing Category', 'shop-marketing-category.index');
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MarketingCategory  $marketingCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MarketingCategory::find($id);

        return $this->curdService->delete($data, 'shop-marketing-category.index', 'Marketing Category Deleted');
    }

    public function statusChange($id)
    {
        $data = MarketingCategory::find($id);

        return $this->curdService->statusChange($data, 'shop-marketing-category.index', 'Status Change');
    }
}
