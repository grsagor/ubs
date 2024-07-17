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

        if ($category_type == 'business_location') {
            return 'OK';
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

            if (!empty($request->input('add_as_sub_cat')) && $request->input('add_as_sub_cat') == 1 && !empty($request->input('parent_id'))) {
                $category->parent_id = $request->parent_id;
            } else {
                $category->parent_id = 0;
            }
            $category->business_id = Auth::user()->business_id;
            $category->created_by = Auth::user()->id;
            $category->save();

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

    public function business_location_category_index(Request $request)
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
        $data['categories'] = Category::query()
            ->where('business_id', $business_id)
            ->where('category_type', 'business_location')
            ->where('parent_id', 0)
            ->with('sub_categories')
            ->orderBy('name', 'asc') // Order by name alphabetically
            ->get();

        return view('business_location.category_business_location.index', $data);
    }

    public function business_location_category_create()
    {
        return view('business_location.category_business_location.create');
    }

    public function business_location_category_store(Request $request)
    {
        try {
            $category = new Category();

            $category->name = $request->name;
            $category->short_code = $request->short_code;
            $category->category_type = $request->category_type;
            $category->description = $request->description;

            if (!empty($request->input('category_id'))) {
                $category->parent_id = $request->category_id;
            } else {
                $category->parent_id = 0;
            }

            $category->business_id = Auth::user()->business_id;
            $category->created_by = Auth::user()->id;
            $category->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->route('business_location_category_index')->with('status', $output);
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


    public function business_location_category_edit($id)
    {
        $data = Category::find($id);
        return view('business_location.category_business_location.edit', compact('data'));
    }

    public function business_location_category_update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->short_code = $request->input('short_code');
            $category->parent_id = $request->input('category_id', 0); // Default to 0 if not set

            $category->save();

            $output = [
                'success' => true,
                'msg' => __('Category updated successfully.'),
            ];

            $mode = $request->input('mode');

            return redirect()->route('business_location_category_index')->with('status', $output);
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
            return redirect()->back()->with('status', $output);
        }
    }


    public function business_location_category_destroy($id)
    {
        try {
            $business_id = request()->session()->get('user.business_id');

            $category = Category::where('business_id', $business_id)->findOrFail($id);


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

        return redirect()->back()->with('status', $output);
    }

    public function business_location_sub_category_create()
    {
        $data['categorires'] = Category::query()
            ->where('category_type', 'business_location')
            ->where('parent_id', 0)
            ->get();

        return view('business_location.sub_category_business_location.create', $data);
    }

    public function business_location_sub_category_edit($id)
    {
        $data['sub_category'] = Category::findOrFail($id);

        $data['categories'] = Category::query()
            ->where('category_type', 'business_location')
            ->where('parent_id', 0)
            ->get();

        return view('business_location.sub_category_business_location.edit', $data);
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
