<?php

namespace App\Http\Controllers;

use App\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\CURDservice;
use Illuminate\Support\Facades\Auth;

class JobCategoryController extends Controller
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
        $user = Auth::user();

        $data['jobs'] = JobCategory::query()
            ->search($request)
            ->where('business_id', $user->business_id)
            ->latest()
            ->paginate(10);

        return view('backend.job_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.job_categories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobCategory $jobsCategory)
    {
        try {
            $requestedData = $request->all();

            $requestedData['business_id']   = Auth::user()->business_id;
            $requestedData['slug']          = Str::slug($request->name);

            $requestedData                  = $jobsCategory->fill($requestedData)->save();

            return $this->curdService->SuccessFull('Job Category', 'job-category.index');
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }


    public function show(JobCategory $jobsCategory)
    {
        //
    }


    public function edit($id)
    {
        $data = JobCategory::find($id);
        return view('backend.job_categories.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        try {
            // Find the NewsCategory by ID
            $newsCategory = JobCategory::find($id);

            // Check if the NewsCategory is found
            if (!$newsCategory) {
                return $this->curdService->NotFound('News Category');
            }

            // Update the NewsCategory with the requested data
            $newsCategory->update($request->all());

            return $this->curdService->SuccessFull('News Category', 'job-category.index');
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }


    // public function destroy($id)
    // {
    //     $data = JobCategory::find($id);

    //     return $this->curdService->delete($data, 'job-category.index', 'News Category Deleted');
    // }

    public function statusChange($id)
    {
        $data = JobCategory::find($id);

        return $this->curdService->statusChange($data, 'job-category.index', 'Status Change');
    }
}
