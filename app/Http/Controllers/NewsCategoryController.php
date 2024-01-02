<?php

namespace App\Http\Controllers;

use App\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['news'] = NewsCategory::query()->search($request)->latest()->paginate(10);

        return view('news_category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news_category.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, NewsCategory $newsCategory)
    {
        try {
            $requestedData = $request->all();

            $requestedData['business_id']   = Auth::user()->business_id;
            $requestedData['slug']          = Str::slug($request->name);

            $requestedData                  = $newsCategory->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->route('shop-news-category.index')->with('status', $output);
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function show(NewsCategory $newsCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsCategory = NewsCategory::find($id);
        return view('news_category.edit', compact('newsCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the NewsCategory by ID
            $newsCategory = NewsCategory::find($id);

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

            return redirect()->route('shop-news-category.index')->with('status', $output);
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsCategory = NewsCategory::find($id);

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
        $newsCategory = NewsCategory::find($id);

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
