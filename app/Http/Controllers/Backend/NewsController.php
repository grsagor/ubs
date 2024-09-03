<?php

namespace App\Http\Controllers\Backend;

use App\News;
use App\Region;
use App\Category;
use App\BusinessLocation;
use Illuminate\Http\Request;
use App\Services\SlugService;
use App\Http\Controllers\Controller;
use App\LanguageSpeech;
use App\Special;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller

{
    protected $slug_service;

    public function __construct(SlugService $slug_service)
    {
        $this->slug_service               = $slug_service;
    }

    public function index(Request $request)
    {
        $data['news'] = News::query()
            ->search($request)
            ->with('category', 'region', 'language')
            ->latest()
            ->get();

        return view('news_marketing.news.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::query()
            ->active()
            ->whereIn('category_type', ['news'])
            ->onlyParent()
            ->orderByNameAsc()
            ->get();

        $data['regions'] = Region::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $data['languages'] = LanguageSpeech::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $data['specials'] = Special::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $business_id = request()->session()->get('user.business_id');

        $data['business_locations'] = BusinessLocation::where('business_id', $business_id)
            ->orderByNameAsc()
            ->get();

        return view('news_marketing.news.create', $data);
    }

    public function store(Request $request, News $news)
    {
        try {
            $requestedData = $request->all();

            $requestedData['business_id']   = Auth::user()->business_id;

            $news->slug = $this->slug_service->slug_create($request->title, $news);

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
        $data['news']           = News::find($id);

        $data['categories'] = Category::query()
            ->active()
            ->whereIn('category_type', ['news'])
            ->onlyParent()
            ->orderByNameAsc()
            ->get();

        $data['sub_categories'] = Category::query()
            ->active()
            ->where('category_type', 'news')
            ->orderByNameAsc()
            ->get();

        $data['regions'] = Region::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $data['languages'] = LanguageSpeech::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $data['specials'] = Special::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $business_id = request()->session()->get('user.business_id');

        $data['business_locations'] = BusinessLocation::where('business_id', $business_id)
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
            // Get existing images from the database
            $existingImages = json_decode($news->images, true) ?? [];

            // Handle image deletions
            if ($request->has('removed_images')) {
                $removedImages = $request->input('removed_images');

                // Debugging: Log removed images

                foreach ($removedImages as $removedImage) {
                    // Remove the image file from the local filesystem
                    $removedImagePath = public_path($removedImage);
                    if (file_exists($removedImagePath)) {
                        unlink($removedImagePath);
                    }
                }

                // Remove deleted images from the existing images array
                $existingImages = array_filter($existingImages, function ($image) use ($removedImages) {
                    return !in_array($image, $removedImages);
                });
            }

            // Handle new image uploads
            if ($request->hasFile('images')) {
                $imagePath = public_path('uploads/news/images');
                $newImages = [];

                foreach ($request->file('images') as $image) {
                    $imageName = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                    $image->move($imagePath, $imageName);
                    $newImages[] = 'uploads/news/images/' . $imageName;
                }

                // Merge new images with existing images
                $allImages = array_merge($existingImages, $newImages);
            } else {
                // No new images, just use existing images
                $allImages = $existingImages;
            }

            // Update the news item with the merged images
            $requestedData['images'] = json_encode($allImages);

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

    public function get_sub_category($id)
    {
        $category = Category::find($id);
        $subcategories = Category::where('parent_id', $id)
            ->where('category_type', $category->category_type)
            ->get();
        return response()->json(['subcategories' => $subcategories]);
    }
}
