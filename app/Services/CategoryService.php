<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use PDO;

class CategoryService
{
    protected $slug_service;

    public function __construct(SlugService $slug_service)
    {
        $this->slug_service               = $slug_service;
    }

    public function index($object, $category_type)
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }
        $business_id = request()->session()->get('user.business_id');

        $data['categories'] = $object->query()
            ->where('business_id', $business_id)
            ->whereIn('category_type', $category_type)
            ->where('parent_id', 0)
            ->with(['sub_categories', 'sub_categories.child_categories']) // Eager load sub_categories and their child_categories
            ->orderBy('name', 'asc') // Order by name alphabetically
            // ->latest()
            ->get();

        return $data;
    }

    public function store($request, $object)
    {
        try {
            $object->name = $request->name;
            $object->short_code = $request->short_code;
            $object->description = $request->description;
            $object->slug = $this->slug_service->slug_create($request->name, $object);

            // if (!empty($request->input('category_id'))) {
            //     $object->parent_id = $request->category_id;
            // } else {
            //     $object->parent_id = 0;
            // }

            // if (empty($request->category_type)) {
            //     $object->category_type =   $object->where('id', $object->parent_id)->value('category_type');
            // } else {
            //     $object->category_type = $request->category_type;
            // }

            // if (isset($request->status)) {
            //     $object->status = $request->status;
            // }

            // Set the parent_id to the provided category_id or default to 0
            $object->parent_id = $request->input('category_id', 0);

            // Set category_type based on input or retrieve from the parent if not provided
            $object->category_type = $request->input('category_type') ??
                $object->where('id', $object->parent_id)->value('category_type');

            // Set status if provided, otherwise it will remain unchanged
            $object->status = $request->status ?? 0;


            $object->business_id = Auth::user()->business_id;
            $object->created_by = Auth::user()->id;
            $object->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return  $output;
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                // 'msg' => __('messages.something_went_wrong'),
                'msg' => $e->getMessage(),
            ];
            return $output;
        }
    }

    public function update($request, $object)
    {
        try {
            $object->name = $request->name;
            $object->short_code = $request->short_code;
            $object->category_type = $request->category_type;
            $object->description = $request->description;

            if (!empty($request->input('category_id'))) {
                $object->parent_id = $request->category_id;
            } else {
                $object->parent_id = 0;
            }

            if (isset($request->status)) {
                $object->status = $request->status;
            }

            $object->save();

            $output = [
                'success' => true,
                'msg' => __('Category updated successfully.'),
            ];

            return  $output;
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
            return redirect()->back()->with('status', $output);
        }
    }
}
