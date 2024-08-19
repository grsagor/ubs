<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class CategoryService
{
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
            $object->category_type = $request->category_type;
            $object->description = $request->description;

            if (!empty($request->input('category_id'))) {
                $object->parent_id = $request->category_id;
            } else {
                $object->parent_id = 0;
            }

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
            $object->parent_id = $request->input('category_id', 0); // Default to 0 if not set

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
