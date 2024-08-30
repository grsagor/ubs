<?php

namespace App\Http\Controllers\Backend;

use App\News;
use App\Category;
use Carbon\Carbon;
use App\BusinessLocation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class NewsMarketingController extends Controller

{
    public function index(Request $request)
    {
        $data['news'] = News::query()
            ->search($request)
            ->with('category')
            ->latest()
            ->get();

        return view('news_marketing.news.index', $data);
    }

    public function create()
    {
        $business_id = request()->session()->get('user.business_id');

        $data['categories'] = Category::query()
            ->active()
            ->where('business_id', $business_id)
            ->whereIn('category_type', ['news', 'marketing'])
            ->onlyParent()
            ->orderByNameAsc()
            ->get();

        $data['business_locations'] = BusinessLocation::where('business_id', $business_id)
            ->get();

        return view('news_marketing.news.create', $data);
    }

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

            $output = [
                'success' => true,
                'msg' => __('News inserted successfully.'),
            ];
            return redirect()->route('shop-news.index')->with('status', $output);
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    public function show(News $news)
    {
        //
    }

    public function edit($id)
    {
        $business_id = request()->session()->get('user.business_id');

        $data['news']           = News::find($id);

        $data['categories'] = Category::query()
            ->active()
            ->where('business_id', $business_id)
            ->whereIn('category_type', ['news', 'marketing'])
            ->onlyParent()
            ->orderByNameAsc()
            ->get();

        return view('news_marketing.news.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the News by ID
            $news = News::find($id);

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
            $output = [
                'success' => true,
                'msg' => __('News updated successfully.'),
            ];
            return redirect()->route('shop-news.index')->with('status', $output);
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->back();
        }
    }

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

        // Toggle the status of the News item
        $data->status = $data->status == 1 ? 0 : 1;
        $data->save();

        $output = [
            'success' => true,
            'msg' => 'Status changed successfully!',
        ];

        return redirect()->back()->with('status', $output);
    }
}
