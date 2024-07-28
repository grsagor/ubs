<?php

namespace App\Http\Controllers;

use App\Job;
use App\AppliedJob;
use App\JobCategory;
use App\BusinessLocation;
use Illuminate\Http\Request;
use App\Services\UniqueIDService;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    protected $unique_id_service;

    public function __construct(UniqueIDService $unique_id_service)
    {
        $this->unique_id_service          = $unique_id_service;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $data['jobs'] = Job::query()
            ->search($request)
            ->with('appliedJobs')
            ->whereHas('business_location', function ($query) use ($user) {
                $query->where('business_id', $user->business_id);
            })
            ->latest()
            ->get();

        return view('backend.jobs.index', $data);
    }

    public function applicantList(Request $request, $jobID)
    {
        $data['job'] = Job::where('uuid', $jobID)->first();
        $data['applicants'] = AppliedJob::query()
            ->with('JobId', 'recuimentId', 'createdBy')
            ->where('job_id', $jobID)
            ->latest()
            ->get();

        return view('backend.jobs.applicants_job', $data);
    }

    public function create()
    {
        $business_id = request()->session()->get('user.business_id');

        //Get all business locations
        $data['business_locations'] = BusinessLocation::where('business_id', $business_id)
            ->get();

        $data['job_categories'] = JobCategory::query()
            ->active()
            ->get();

        return view('backend.jobs.create', $data);
    }

    public function store(Request $request, Job $job)
    {
        try {
            $requestedData = $request->all();

            // dd($requestedData);

            $request->validate([
                'company_information' => 'required',
                'description' => 'required',
                'closing_date' => 'required|date|after_or_equal:today',
            ], [
                'company_information.required' => 'The company information field is required.',
                'description.required' => 'The description field is required.',
                'closing_date.after_or_equal' => 'The closing date must be today or a later date.',
            ]);

            $latestReference = $job->orderBy('created_at', 'desc')->value('reference');

            // Parse the number part of the reference
            $latestNumber = (int)substr($latestReference, -6); // Assuming reference format like 'Unijob000001'

            $newNumber = $latestNumber + 1;

            $newReference = 'Unijob' . sprintf('%06d', $newNumber);

            $requestedData['reference'] = $newReference;

            // Generate a unique id
            $requestedData['short_id'] = $this->unique_id_service->generateUniqueId($job, 'short_id');

            // Handle multiple select fields
            $requestedData['hour_type'] = $request->input('hour_type', []);
            $requestedData['job_type'] = $request->input('job_type', []);

            $job->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->route('jobs.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $data['job'] = Job::find($id);

        $business_id = request()->session()->get('user.business_id');

        $data['business_locations'] = BusinessLocation::where('business_id', $business_id)
            ->get();

        $data['job_categories'] = JobCategory::query()
            ->active()
            ->get();

        return view('backend.jobs.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'description' => 'required',
                'closing_date' => 'required|date|after_or_equal:today',
            ], [
                'description.required' => 'The description field is required.',
                'closing_date.after_or_equal' => 'The closing date must be today or a later date.',
            ]);

            $job = Job::findOrFail($id);

            $requestedData = $request->all();

            // Handle multiple select fields
            $requestedData['hour_type'] = $request->input('hour_type', []);
            $requestedData['job_type'] = $request->input('job_type', []);


            $job->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => 'Updated Successfully!!!',
            ];
            return redirect()->route('jobs.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
