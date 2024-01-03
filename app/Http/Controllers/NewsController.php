<?php

namespace App\Http\Controllers;

use App\News;
use Carbon\Carbon;
use App\NewsCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StatusChangeService;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $statusChangeService;

    public function __construct(StatusChangeService $statusChangeService)
    {
        $this->statusChangeService          = $statusChangeService;
    }

    public function index(Request $request)
    {
        $data['news'] = News::query()->search($request)->with('newsCategory')->latest()->paginate(10);

        return view('news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['newCategory'] = NewsCategory::query()->active()->get();

        return view('news.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, News $news)
    {
        try {
            $requestedData = $request->all();

            $requestedData['business_id']   = Auth::user()->business_id;
            $requestedData['slug'] = Str::slug($request->title) . '-' . Carbon::now()->timestamp;

            // dd($requestedData);


            if ($request->hasFile('thumbnail')) {
                $image_path = public_path('uploads/news/thumbnail');

                $image = $request->file('thumbnail');
                $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                $image->move($image_path, $image_name);

                $requestedData['thumbnail'] = 'uploads/news/thumbnail/' . $image_name;
            }


            if ($request->hasFile('images')) {
                $image_path = public_path('uploads/news/images');

                $images = [];

                foreach ($request->file('images') as $image) {
                    $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                    $image->move($image_path, $image_name);
                    $images[] = 'uploads/news/images/' . $image_name;
                }

                $requestedData['images'] = json_encode($images);
            }


            // dd($requestedData);

            $requestedData                  = $news->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->route('shop-news.index')->with('status', $output);
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }

    public function statusChange($id)
    {
        $newsItem = News::find($id);

        $this->statusChangeService->statusChange($newsItem);

        return redirect()->back();
    }
}
