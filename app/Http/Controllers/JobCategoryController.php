<?php

namespace App\Http\Controllers;

use App\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ActiveInactiveStatus;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ActiveInactiveStatus;


    public function index(Request $request)
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }

        $data['jobs'] = JobCategory::query()
            ->search($request)
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
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }
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
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }

        try {
            $requestedData = $request->all();

            $requestedData['slug']          = Str::slug($request->name);

            $requestedData                  = $jobsCategory->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->route('job-category.index')->with('status', $output);
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
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }

        $data = JobCategory::find($id);
        return view('backend.job_categories.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }

        try {
            // Find the NewsCategory by ID
            $newsCategory = JobCategory::find($id);


            // Update the NewsCategory with the requested data
            $newsCategory->update($request->all());

            $output = [
                'success' => true,
                'msg' => __('Category updated successfully.'),
            ];

            return redirect()->route('job-category.index')->with('status', $output);
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    public function statusChange($id)
    {
        $data = JobCategory::find($id);

        return $this->changeStatus($data, 'job-category.index', 'Status Change');
    }
}
