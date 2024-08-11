<?php

namespace App\Http\Controllers;

use App\Job;
use App\AppliedJob;
use App\JobCategory;
use App\BusinessLocation;
use Illuminate\Http\Request;
use App\Services\SlugService;
use App\Services\UniqueIDService;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    protected $unique_id_service;
    protected $slug_service;

    public function __construct(UniqueIDService $unique_id_service, SlugService $slug_service)
    {
        $this->unique_id_service          = $unique_id_service;
        $this->slug_service               = $slug_service;
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

            $this->validateJobRequest($request);

            // Assign the unique slug to the requested data
            $requestedData['slug'] = $this->slug_service->slug_create($requestedData['title'], $job);

            // Generate a unique id
            $requestedData['short_id'] = $this->unique_id_service->generateUniqueId($job, 'short_id');

            $requestedData['reference'] = $this->generateNewReference($job);

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

    public function show($id)
    {
        $job = Job::find($id);
        if ($job) {
            return response()->json([
                'title' => $job->title,
                'note' => $job->note
            ]);
        } else {
            return response()->json(['error' => 'Job not found'], 404);
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
            $this->validateJobRequest($request);

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

    public function status_change($id)
    {
        // Retrieve the job by its ID
        $job = Job::find($id);

        // Check if the job exists
        if ($job) {
            // Toggle the status: if 0, set to 1; if 1, set to 0
            $job->status = $job->status == 0 ? 1 : 0;

            // Save the updated job
            $job->save();

            // Prepare the output message
            $output = [
                'success' => true,
                'msg' => 'Status changed successfully!!!',
            ];
        } else {
            // Prepare the output message if the job does not exist
            $output = [
                'success' => false,
                'msg' => 'Job not found.',
            ];
        }

        // Redirect to the jobs index route with the status message
        return redirect()->route('jobs.index')->with('status', $output);
    }

    protected function validateJobRequest(Request $request)
    {
        $request->validate([
            'company_information' => 'required',
            'description' => 'required',
            'closing_date' => 'required|date|after_or_equal:today',
        ], [
            'company_information.required' => 'The company information field is required.',
            'description.required' => 'The description field is required.',
            'closing_date.after_or_equal' => 'The closing date must be today or a later date.',
        ]);
    }

    protected function generateNewReference($job)
    {
        do {
            // Generate a random 8-digit number
            $newNumber = mt_rand(1, 99999999);

            // Format the number to be 8 digits long (e.g., '00000001')
            $formattedNumber = sprintf('%08d', $newNumber);

            // Create the new reference
            $newReference = 'Uni' . $formattedNumber;

            // Check if the new reference already exists in the jobs table
            $exists = $job->where('reference', $newReference)->exists();
        } while ($exists); // Repeat the process if the reference exists

        // Return the new unique reference
        return $newReference;
    }
}
