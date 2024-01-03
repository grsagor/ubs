<?php

namespace App\Http\Controllers;

use App\MarketingCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->route('shop-marketing-category.index')->with('status', $output);
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
                $output = [
                    'success' => false,
                    'msg' => 'NewsCategory not found!',
                ];
                return redirect()->back()->with('status', $output);
            }

            // Update the NewsCategory with the requested data
            $newsCategory->update($request->all());

            $output = [
                'success' => true,
                'msg' => 'Updated Successfully!',
            ];

            return redirect()->route('shop-marketing-category.index')->with('status', $output);
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
        $newsCategory = MarketingCategory::find($id);

        if (!$newsCategory) {
            return redirect()->back()->withErrors(['error' => 'NewsCategory not found.']);
        }

        $newsCategory->delete();

        $output = [
            'success' => true,
            'msg' => 'Deleted Successfully!!!',
        ];

        return redirect()->back()->with('status', $output);
    }

    public function statusChange($id)
    {
        $newsCategory = MarketingCategory::find($id);

        if ($newsCategory) {
            // Toggle the status (assuming 1 is active and 0 is inactive)
            $newsCategory->status = $newsCategory->status == 1 ? 0 : 1;

            $newsCategory->save();

            $output = [
                'success' => true,
                'msg' => 'Status Changed Successfully!',
            ];

            return redirect()->back()->with('status', $output);
        } else {
            $output = [
                'success' => false,
                'msg' => 'NewsCategory not found!',
            ];

            return redirect()->back()->with('status', $output);
        }
    }
}
