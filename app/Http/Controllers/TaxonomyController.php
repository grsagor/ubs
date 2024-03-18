<?php

namespace App\Http\Controllers;

use App\Category;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TaxonomyController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->id !== 5) {
            return response()->json(['error' => 'You are not authorized to access this page.'], 403);
        }

        $category_type = request()->get('type');
        if ($category_type == 'product' && !auth()->user()->can('category.view') && !auth()->user()->can('category.create')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $can_edit = true;
            if ($category_type == 'product' && !auth()->user()->can('category.update')) {
                $can_edit = false;
            }

            $can_delete = true;
            if ($category_type == 'product' && !auth()->user()->can('category.delete')) {
                $can_delete = false;
            }

            $business_id = request()->session()->get('user.business_id');

            $category = Category::where('business_id', $business_id)
                ->where('category_type', 'service')
                ->select(['name', 'short_code', 'description', 'id', 'parent_id']);

            return Datatables::of($category)
                ->addColumn(
                    'action',
                    function ($row) use ($can_edit, $can_delete, $category_type) {
                        $html = '';
                        if ($can_edit) {
                            $html .= '<button data-href="' . action([\App\Http\Controllers\TaxonomyController::class, 'edit'], [$row->id]) . '?type=' . $category_type . '" class="btn btn-xs btn-primary edit_category_button"><i class="glyphicon glyphicon-edit"></i>' . __('messages.edit') . '</button>';
                        }

                        if ($can_delete) {
                            $html .= '&nbsp;<button data-href="' . action([\App\Http\Controllers\TaxonomyController::class, 'destroy'], [$row->id]) . '" class="btn btn-xs btn-danger delete_category_button"><i class="glyphicon glyphicon-trash"></i> ' . __('messages.delete') . '</button>';
                        }

                        return $html;
                    }
                )
                ->editColumn('name', function ($row) {
                    if ($row->parent_id != 0) {
                        return '--' . $row->name;
                    } else {
                        return $row->name;
                    }
                })
                ->removeColumn('id')
                ->removeColumn('parent_id')
                ->rawColumns(['action'])
                ->make(true);
        }

        $module_category_data = $this->moduleUtil->getTaxonomyData($category_type);

        return view('taxonomy.index')->with(compact('module_category_data', 'module_category_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mode = request()->mode;
        // $category_type = request()->get('type');
        $category_type = 'service';
        if ($category_type == 'product' && !auth()->user()->can('category.create')) {
            abort(403, 'Unauthorized action.');
        }
        $business_id = request()->session()->get('user.business_id');

        $module_category_data = $this->moduleUtil->getTaxonomyData($category_type);

        $categories = Category::where('business_id', $business_id)
            ->where('parent_id', 0)
            ->where('category_type', $category_type)
            ->select(['name', 'short_code', 'id', 'category_type'])
            ->get();

        $parent_categories = [];

        if ($mode == 'sub_category') {
            $temps = Category::where('business_id', $business_id)
                ->where('parent_id', 0)
                ->where('category_type', $category_type)
                ->select(['name', 'short_code', 'id', 'category_type'])
                ->get();

            foreach ($temps as $temp) {
                $parent_categories[$temp->id] = $temp->name;
            }
        }
        if ($mode == 'child_category') {
            $sub_categories = Category::where('business_id', $business_id)
                ->where('parent_id', '!=', 0)
                ->where('category_type', $category_type)
                ->select(['name', 'short_code', 'id', 'parent_id', 'category_type'])
                ->get();

            $sub_categories = $sub_categories->filter(function ($sub_category) {
                $parent = Category::find($sub_category->parent_id);
                if ($parent) {
                    $grand_parent = Category::find($parent->parent_id);
                    if ($grand_parent) {
                        return false;
                    } else {
                        return true;
                    }
                }
                return false;
            })->values();


            foreach ($sub_categories as $temp) {
                $parent_categories[$temp->id] = $temp->name;
            }
        }
        // if (! empty($categories)) {
        //     foreach ($categories as $category) {
        //         $parent_categories[$category->id] = $category->name;
        //     }
        // }

        // $categories = Category::where('parent_id', 0)
        // ->select(['name', 'short_code', 'id'])
        // ->get();

        // $sub_categories = Category::where('parent_id', '!=', 0)
        // ->select(['name', 'short_code', 'id', 'parent_id'])
        // ->get();


        // $sub_categories = $sub_categories->filter(function ($sub_category) {
        //     $parent = Category::find($sub_category->parent_id);
        //     if ($parent) {
        //         $grand_parent = Category::find($parent->parent_id);
        //         if ($grand_parent) {
        //             return false;
        //         } else {
        //             return true;
        //         }
        //     }
        //     return false;
        // })->values();

        // $child_categories = Category::where('parent_id', '!=', 0)
        // ->select(['name', 'short_code', 'id', 'parent_id'])
        // ->get();


        // $child_categories = $child_categories->filter(function ($child_category) {
        //     $parent = Category::find($child_category->parent_id);
        //     if ($parent) {
        //         $grand_parent = Category::find($parent->parent_id);
        //         if ($grand_parent) {
        //             return true;
        //         } else {
        //             return false;
        //         }
        //     }
        //     return false;
        // })->values();

        return view('taxonomy.create')
            ->with(compact('parent_categories', 'module_category_data', 'category_type', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return Auth::user()->id;
        $category_type = request()->input('category_type');
        if ($category_type == 'product' && !auth()->user()->can('category.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $category = new Category();

            $category->name = $request->name;
            $category->short_code = $request->short_code;
            $category->category_type = $request->category_type;
            $category->description = $request->description;

            // $input = $request->only(['name', 'short_code', 'category_type', 'description']);
            if (!empty($request->input('add_as_sub_cat')) && $request->input('add_as_sub_cat') == 1 && !empty($request->input('parent_id'))) {
                $category->parent_id = $request->parent_id;
            } else {
                $category->parent_id = 0;
            }
            $category->business_id = Auth::user()->business_id;
            $category->created_by = Auth::user()->id;
            $category->save();

            // $category = Category::create($input);
            $output = [
                'success' => true,
                'data' => $category,
                'msg' => $request->input('add_as_sub_cat') == 1 ? __('category.added_sub_success') : __('category.added_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => false,
                // 'msg' => __('messages.something_went_wrong'),
                'msg' => $e->getMessage(),
            ];
        }

        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_type = request()->get('type');
        if ($category_type == 'product' && !auth()->user()->can('category.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $category = Category::where('business_id', $business_id)->find($id);

            $module_category_data = $this->moduleUtil->getTaxonomyData($category_type);

            $parent_categories = Category::where('business_id', $business_id)
                ->where('parent_id', 0)
                ->where('category_type', $category_type)
                ->where('id', '!=', $id)
                ->pluck('name', 'id');
            $is_parent = false;

            if ($category->parent_id == 0) {
                $is_parent = true;
                $selected_parent = null;
            } else {
                $selected_parent = $category->parent_id;
            }

            return view('taxonomy.edit')
                ->with(compact('category', 'parent_categories', 'is_parent', 'selected_parent', 'module_category_data'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $input = $request->only(['name', 'description']);
                $business_id = $request->session()->get('user.business_id');

                $category = Category::where('business_id', $business_id)->findOrFail($id);

                if ($category->category_type == 'product' && !auth()->user()->can('category.update')) {
                    abort(403, 'Unauthorized action.');
                }

                $category->name = $input['name'];
                $category->description = $input['description'];
                $category->short_code = $request->input('short_code');

                if (!empty($request->input('add_as_sub_cat')) && $request->input('add_as_sub_cat') == 1 && !empty($request->input('parent_id'))) {
                    $category->parent_id = $request->input('parent_id');
                } else {
                    $category->parent_id = 0;
                }
                $category->save();

                $output = [
                    'success' => true,
                    'msg' => __('category.updated_success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');

                $category = Category::where('business_id', $business_id)->findOrFail($id);

                if ($category->category_type == 'product' && !auth()->user()->can('category.delete')) {
                    abort(403, 'Unauthorized action.');
                }

                $category->delete();

                $output = [
                    'success' => true,
                    'msg' => __('category.deleted_success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    public function getCategoriesApi()
    {
        try {
            $api_token = request()->header('API-TOKEN');

            $api_settings = $this->moduleUtil->getApiSettings($api_token);

            $categories = Category::catAndSubCategories($api_settings->business_id);
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            return $this->respondWentWrong($e);
        }

        return $this->respond($categories);
    }

    /**
     * get taxonomy index page
     * through ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function getTaxonomyIndexPage(Request $request)
    {
        if (request()->ajax()) {
            $category_type = $request->get('category_type');
            $module_category_data = $this->moduleUtil->getTaxonomyData($category_type);

            return view('taxonomy.ajax_index')
                ->with(compact('module_category_data', 'category_type'));
        }
    }
}
