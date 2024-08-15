<?php

namespace App\Http\Controllers;

use App\News;
use Carbon\Carbon;
use App\NewsCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\CURDservice;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
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
        $data['news'] = News::query()
            ->search($request)
            ->with('newsCategory')
            ->latest()
            ->get();

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

            $requestedData                  = $news->fill($requestedData)->save();

            return $this->curdService->SuccessFull('Marketing Category', 'shop-news.index');
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
    public function edit($id)
    {
        $data['news']           = News::find($id);
        $data['newCategory']    = NewsCategory::query()->active()->get();
        return view('news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the News by ID
            $news = News::find($id);

            // Check if the News is found
            if (!$news) {
                return $this->curdService->NotFound('News');
            }

            // Initialize an empty array to store requested data
            $requestedData = $request->all();

            // Handle Thumbnail Upload
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = public_path('uploads/news/thumbnail');
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = rand(123456, 999999) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move($thumbnailPath, $thumbnailName);
                $requestedData['thumbnail'] = 'uploads/news/thumbnail/' . $thumbnailName;

                // Delete the existing thumbnail if it exists
                $existingThumbnailPath = public_path($news->thumbnail);
                if (file_exists($existingThumbnailPath)) {
                    unlink($existingThumbnailPath);
                }
            }

            // Handle Images Upload
            if ($request->hasFile('images')) {
                $imagePath = public_path('uploads/news/images');
                $images = [];

                foreach ($request->file('images') as $image) {
                    $imageName = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                    $image->move($imagePath, $imageName);
                    $images[] = 'uploads/news/images/' . $imageName;
                }

                // Decode existing images, if any
                $existingImages = json_decode($news->images, true) ?? [];

                // Merge existing and new images
                $allImages = array_merge($existingImages, $images);

                // Update requested data with the merged images
                $requestedData['images'] = json_encode($images);

                // Delete existing images if they exist
                foreach ($existingImages as $existingImage) {
                    $existingImagePath = public_path($existingImage);
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }
            }

            // Update the News with the requested data
            $news->update($requestedData);

            return $this->curdService->SuccessFull('News', 'shop-news.index');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->back()->withErrors(['error' => 'News not found.']);
        }

        // Retrieve the image path
        $thumbnailPath = public_path($news->thumbnail);

        $imagePaths = json_decode($news->images, true);


        // Delete the news item
        $news->delete();

        // If the image path exists, delete the image from storage
        if (file_exists($thumbnailPath) && is_file($thumbnailPath)) {
            unlink($thumbnailPath);
        }

        // Loop through each image path and delete the image
        // Check if $imagePaths is not null before looping through it
        if ($imagePaths !== null) {
            // Loop through each image path and delete the image
            foreach ($imagePaths as $imagePath) {
                $fullImagePath = public_path($imagePath);

                // If the image path exists and is a file, delete the image
                if (file_exists($fullImagePath) && is_file($fullImagePath)) {
                    unlink($fullImagePath);
                }
            }
        }


        $output = [
            'success' => true,
            'msg' => 'Deleted Successfully!!!',
        ];

        return redirect()->back()->with('status', $output);
    }

    public function statusChange($id)
    {
        $data = News::find($id);

        return $this->curdService->statusChange($data, 'shop-news.index', 'Status Change');
    }
}
