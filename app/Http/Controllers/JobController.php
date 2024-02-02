<?php

namespace App\Http\Controllers;

use App\Job;
use App\AppliedJob;
use App\BusinessLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        // if (auth()->user()->id != 5) {
        //     // abort(403, 'Unauthorized action.');
        //     $output = [
        //         'success' => False,
        //         'msg' => 'You are not allowed',
        //     ];
        //     return redirect()->back()->with('status', $output);
        // }

        $user = Auth::user();

        // if ($user->id == 5) {
        //     $data['jobs'] = Job::query()
        //         ->search($request)
        //         ->with('appliedJobs')
        //         ->latest()
        //         ->paginate(10);
        // } else {
        $data['jobs'] = Job::query()
            ->search($request)
            ->with('appliedJobs')
            ->whereHas('business_location', function ($query) use ($user) {
                $query->where('business_id', $user->business_id);
            })
            ->latest()
            ->paginate(10);
        // }
        // return $data;

        return view('backend.jobs.index', $data);
    }

    public function applicantList($jobID)
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }

        // $data['applicants'] = AppliedJob::where('job_id', $jobID)->with('JobId', 'recuimentId')->latest()
        //     ->paginate(10);

        $data['job'] = Job::where('uuid', $jobID)->first();
        $data['applicants'] = AppliedJob::query()
            ->search(request()->get('search')) // Assuming a custom search scope or method is applied
            ->with('JobId', 'recuimentId', 'createdBy') // Eager loading related country information
            ->latest() // Ordering by the latest
            ->where('job_id', $jobID)
            ->paginate(10); // Paginating the results
        // return $data;
        return view('backend.jobs.applicants_job', $data);

        // return ($data);
    }

    public function create()
    {
        // if (auth()->user()->id != 5) {
        //     // abort(403, 'Unauthorized action.');
        //     $output = [
        //         'success' => False,
        //         'msg' => 'You are not allowed',
        //     ];
        //     return redirect()->back()->with('status', $output);
        // }

        $business_id = request()->session()->get('user.business_id');

        //Get all business locations
        $data['business_locations'] = BusinessLocation::where('business_id', $business_id)
            ->get();

        return view('backend.jobs.create', $data);
    }

    public function store(Request $request, Job $job)
    {
        // if (auth()->user()->id != 5) {
        //     abort(403, 'Unauthorized action.');
        // }
        try {
            $requestedData = $request->all();

            // dd($request->toArray());
            $request->validate([
                'company_information' => 'required',
                'description' => 'required',
                'closing_date' => 'required|date|after_or_equal:today',
            ], [
                'company_information.required' => 'The company information field is required.',
                'description.required' => 'The description field is required.',
                'closing_date.after_or_equal' => 'The closing date must be today or a later date.',
            ]);

            $latestReference = Job::orderBy('created_at', 'desc')->value('reference');

            // Parse the number part of the reference
            $latestNumber = (int)substr($latestReference, -6); // Assuming reference format like 'Unijob000001'

            $newNumber = $latestNumber + 1;

            $newReference = 'Unijob' . sprintf('%06d', $newNumber);

            $requestedData['reference'] = $newReference;

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
        // if (auth()->user()->id != 5) {
        //     abort(403, 'Unauthorized action.');
        // }
        $data['job'] = Job::find($id);
        return view('backend.jobs.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // if (auth()->user()->id != 5) {
        //     abort(403, 'Unauthorized action.');
        // }

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
