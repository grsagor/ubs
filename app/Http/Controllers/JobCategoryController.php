<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    public function index(Request $request)
    {
        $this->NotSuperAdmin();

        $business_id = request()->session()->get('user.business_id');

        $data['categories'] = Category::query()
            ->where('business_id', $business_id)
            ->whereIn('category_type', ['jobs'])
            ->orderByNameAsc()
            ->onlyParent()
            ->get();

        return view('backend.job_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->NotSuperAdmin();

        return view('backend.job_categories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->NotSuperAdmin();

        $object = new Category();

        $output =  $this->category_service->store($request, $object);

        return redirect()->route('job-category.index')->with('status', $output);
    }


    public function edit($id)
    {
        $this->NotSuperAdmin();

        $data = Category::find($id);

        return view('backend.job_categories.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $this->NotSuperAdmin();
        $object = Category::findOrFail($id);

        $output =  $this->category_service->update($request, $object);

        return redirect()->route('job-category.index')->with('status', $output);
    }

    public function statusChange($id)
    {
        $this->NotSuperAdmin();

        $data = Category::find($id);

        // Toggle the status of the News item
        $data->status = $data->status == 1 ? 0 : 1;
        $data->save();

        $output = [
            'success' => true,
            'msg' => 'Status changed successfully!',
        ];

        return redirect()->back()->with('status', $output);
    }

    protected function NotSuperAdmin()
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }
    }
}
