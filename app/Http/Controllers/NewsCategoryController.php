<?php

namespace App\Http\Controllers;

use App\NewsCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\CURDservice;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;

class NewsCategoryController extends Controller
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
        $data['news'] = NewsCategory::query()
            ->search($request)
            ->latest()
            ->get();

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

            return $this->curdService->SuccessFull('Marketing Category', 'shop-news-category.index');
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
                return $this->curdService->NotFound('News Category');
            }

            // Update the NewsCategory with the requested data
            $newsCategory->update($request->all());

            return $this->curdService->SuccessFull('News Category', 'shop-news-category.index');
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
        // $data = NewsCategory::find($id);

        // return $this->curdService->delete($data, 'shop-news-category.index', 'News Category Deleted');
    }

    public function statusChange($id)
    {
        $data = NewsCategory::find($id);

        return $this->curdService->statusChange($data, 'shop-news-category.index', 'Status Change');
    }
}
