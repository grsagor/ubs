<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use App\Country;
use App\Category;
use App\AppliedJob;
use App\Recruitment;
use App\BusinessCustomer;
use App\BusinessLocation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    use ImageFileUpload;

    public function list(Request $request)
    {
        $data['jobs'] = Job::searchAndFilter($request)
            ->active()
            ->where('closing_date', '>=', now())
            ->searchAndFilter($request)
            ->with('job_category')
            ->latest()
            ->paginate(10);

        $data['jobsCategory'] = Category::query()
            ->active()
            ->where('category_type', 'jobs')
            ->onlyParent()
            ->orderByNameAsc()
            ->get();

        return view('frontend.recruitment.list', $data);
    }

    public function details($id, $slug)
    {
        $data['job'] =  Job::with('business_location')->where('short_id', $id)->first();

        if (!$data['job'] || $id != $data['job']->short_id || $slug != $data['job']->slug) {
            return view('error.404');
        }

        if ($data['job']) {
            $closing_date = \Carbon\Carbon::parse($data['job']->closing_date);
            $data['closing_date'] = $closing_date->greaterThanOrEqualTo(now()->startOfDay());
        } else {
            $data['closing_date'] = false;
        }

        // dd($data);
        $data['recuitment_info'] = 0;
        $data['applied_jobs'] = 0;
        $authUserId = Auth::id();

        $recruitment = Recruitment::where('created_by', $authUserId)->get();

        if ($recruitment->isNotEmpty()) { // Check if the collection is not empty
            $recruitmentIds = $recruitment->pluck('uuid')->toArray();

            $appliedJob = AppliedJob::whereIn('recruitment_id', $recruitmentIds)
                ->where('job_id', $data['job']->uuid)
                ->first();

            $data['recuitment_info'] = 1;
            $data['applied_jobs'] = ($appliedJob !== null) ? 1 : 0;
        }
        // return $data['recuitment_info'];

        return view('frontend.recruitment.details', $data);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $data['recruitments'] = AppliedJob::query()
            ->searchApplicants($request->get('search'))
            ->with('JobId', 'recuimentId', 'JobId.business_location', 'recuimentId.countryResidence', 'recuimentId.birthCountry', 'createdBy')
            ->whereHas('JobId.business_location', function ($query) use ($user) {
                $query->where('business_id', $user->business_id);
            })
            ->latest()
            ->get();

        return view('frontend.recruitment.index', $data);
    }

    public function myApplications(Request $request)
    {
        $authUserId = Auth::id();
        $data['appliedJobs'] = AppliedJob::query()
            ->search($request->get('search')) // Assuming a custom search scope or method is applied
            ->with('JobId', 'recuimentId', 'createdBy') // Eager loading related country information
            ->where('created_by', $authUserId)
            ->latest() // Ordering by the latest
            ->get(); // Paginating the results

        // return $data;
        return view('frontend.recruitment.my_applications', $data);
    }

    public function create($jobID)
    {
        if (Auth::check()) {
            $data['country'] = Country::get();
            $data['jobID'] = $jobID;
            $data['create_page'] = 1;
            return view('frontend.recruitment.create', $data);
        } else {
            return redirect()->route('login')->with('previous_page', 'recruitment-create');
        }
    }

    public function store(Request $request, Recruitment $recruitment)
    {
        $user = Auth::user();
        $job_id = $request->job_id;

        $existingRecord = $recruitment->where('created_by', $user->id)
            ->where('job_id', $job_id)
            ->first();

        if ($existingRecord) {
            // Define a default route
            $route = 'recruitment.list'; // Default route in case the user type doesn't match

            // Set route based on user type
            if ($user->user_type == 'user_customer') {
                $route = 'recruitment.appliedJobsCustomer';
            } elseif ($user->user_type == 'user') {
                $route = 'recruitment.index';
            }

            $msg = 'already submitted';

            return view('frontend.recruitment.after_submit', compact('msg', 'route'));
        }

        if (Auth::check()) {
            DB::beginTransaction();
            try {
                $requestedData = $request->all();

                // Experience store
                if ($request->has('experience_name_of_company')) {
                    $experienceData = [];
                    foreach ($request->input('experience_name_of_company') as $key => $company) {
                        $experience = [
                            'experience_name_of_company' => $company,
                            'experience_start_date' => $request->input('experience_start_date')[$key],
                            'experience_end_date' => $request->input('experience_end_date')[$key],
                        ];
                        if ($request->hasFile('experience_file') && $request->file('experience_file')[$key]) {
                            $experience['experience_file'] = $this->fileUpload($request->file('experience_file')[$key], 'uploads/recruitments/');
                        }
                        $experienceData[] = $experience;
                    }
                    $requestedData['experiences'] = json_encode($experienceData, JSON_PRETTY_PRINT);
                }

                // Education store
                if ($request->has('education_name_of_title')) {
                    $educationData = [];
                    foreach ($request->input('education_name_of_title') as $key => $education) {
                        $edu = [
                            'education_name_of_title' => $education,
                            'education_start_date' => $request->input('education_start_date')[$key],
                            'education_end_date' => $request->input('education_end_date')[$key],
                        ];
                        if ($request->hasFile('education_file') && $request->file('education_file')[$key]) {
                            $edu['education_file'] = $this->fileUpload($request->file('education_file')[$key], 'uploads/recruitments/');
                        }
                        $educationData[] = $edu;
                    }
                    $requestedData['educations'] = json_encode($educationData, JSON_PRETTY_PRINT);
                }

                // // Additional file store
                if ($request->has('additional_name_of_title')) {
                    $additionalFilesData = [];
                    foreach ($request->input('additional_name_of_title') as $key => $ad_file) {
                        $addData = [
                            'additional_name_of_title' => $ad_file,
                        ];
                        if ($request->hasFile('additional_file') && $request->file('additional_file')[$key]) {
                            $addData['additional_file'] = $this->fileUpload($request->file('additional_file')[$key], 'uploads/recruitments/');
                        }
                        $additionalFilesData[] = $addData;
                    }
                    $requestedData['additional_files'] = json_encode($additionalFilesData, JSON_PRETTY_PRINT);
                }


                if ($request->file('cv')) {
                    $requestedData['cv']     = $this->fileUpload($request->file('cv'), 'uploads/recruitments/');
                }
                // if ($request->file('dbs_check')) {
                //     $requestedData['dbs_check']     = $this->fileUpload($request->file('dbs_check'), 'uploads/recruitments/');
                // }
                // if ($request->file('care_certificates')) {
                //     $requestedData['care_certificates']     = $this->fileUpload($request->file('care_certificates'), 'uploads/recruitments/');
                // }

                // from create page
                if ($request->create_page == 1) {
                    $requestedData['job_id'] = NULL;
                }

                $info = $recruitment::create($requestedData);

                $appliedJob['job_id'] = $request->job_id;
                $appliedJob['recruitment_id'] = $info->uuid;

                AppliedJob::create($appliedJob);

                $job = Job::find($request->job_id);
                $business_location = BusinessLocation::find($job->business_location_id);

                $business_customer = BusinessCustomer::where([['business_id', $business_location->business_id], ['customer_id', Auth::user()->id]])->first();
                if (!$business_customer) {
                    $business_customer = new BusinessCustomer();
                }

                $business_customer->business_id = $business_location->business_id;
                $business_customer->business_location_id = $business_location->id;
                $business_customer->customer_id = Auth::user()->id;
                $business_customer->save();

                $output = [
                    'success' => true,
                    'msg' => ('Created Successfully!!!'),
                ];

                DB::commit();

                return redirect()->route('recruitment.success')->with('status', $output);
            } catch (\Throwable $e) {
                DB::rollBack();

                dd($e->getmessage());
                return redirect()->back();
            }
        }
    }

    public function show($id)
    {
        $data['item'] = Recruitment::with('countryResidence', 'birthCountry')->find($id);
        return view('frontend.recruitment.show', $data);
    }

    // this is customer show
    public function showCustomer($id)
    {
        $data['item'] = Recruitment::with('countryResidence', 'birthCountry')->find($id);
        return view('frontend.recruitment.showCustomer', $data);
    }

    public function success()
    {
        $user = Auth::user();

        // Define a default route
        $route = 'recruitment.list'; // Default route in case the user type doesn't match

        // Set route based on user type
        if ($user->user_type == 'user_customer') {
            $route = 'recruitment.appliedJobsCustomer';
        } elseif ($user->user_type == 'user') {
            $route = 'recruitment.index';
        }

        $msg = 'submitted';

        return view('frontend.recruitment.after_submit', compact('msg', 'route'));
    }


    public function applyJob(Request $request, $jobID)
    {
        $authUserId = Auth::id();

        // Fist recruitment id save in applied table
        $recruitmentFirst = Recruitment::where('created_by', $authUserId)->first();

        // Retrieve the user's recruitment info
        $recruitment = Recruitment::where('created_by', $authUserId)->get();
        $recruitmentIds = $recruitment->pluck('uuid')->toArray();

        // Prepare applied job data
        $appliedJobData = [
            'job_id' => $jobID,
            'recruitment_id' => $recruitmentFirst->uuid,
            'recruitment_ids' => $recruitmentIds,
        ];

        // Check if the job has already been applied for by this user
        $existingApplication = AppliedJob::where('job_id', $appliedJobData['job_id'])
            ->whereIn('recruitment_id', $appliedJobData['recruitment_ids'])
            ->first();

        // dd($existingApplication, $appliedJobData);

        // Determine the message and next step
        $msg = !$existingApplication ? 'submitted' : 'already submitted';

        // Redirect based on user type
        $user = Auth::user();
        $route = 'recruitment.list'; // Default route in case the user type doesn't match

        if ($user->user_type == 'user_customer') {
            $route = 'recruitment.appliedJobsCustomer';
        } elseif ($user->user_type == 'user') {
            $route = 'recruitment.index';
        }

        // If the user confirms the application
        if ($request->confirmation == 'Yes') {
            // If no existing application, create one
            if (!$existingApplication) {
                AppliedJob::create($appliedJobData);
            }

            // Show success message with redirect to appropriate route
            return view('frontend.recruitment.after_submit', compact('msg', 'route'));
        }
        // If the user does not confirm, show recruitment creation form
        else {
            // If no existing application, redirect to the recruitment creation form
            if (!$existingApplication) {
                $data['country'] = Country::get();
                $data['jobID'] = $jobID;

                return view('frontend.recruitment.create', $data);
            }

            // Otherwise, return the after submit view with message
            return view('frontend.recruitment.after_submit', compact('msg', 'route'));
        }
    }


    public function userCheck($jobID)
    {
        $data['userId'] = Recruitment::where('created_by', auth()->id())
            ->get();
        $count          = $data['userId']->count();

        if ($count == 0) {
            return 1;
        } else {
            return 2;
        }
    }

    public function appliedJobsCustomer()
    {
        $authUserId = Auth::id();

        $data['appliedJobs'] = AppliedJob::query()
            ->search(request()->get('search'))
            ->with('JobId', 'recuimentId', 'createdBy')
            ->where('created_by', $authUserId)
            ->latest()
            ->paginate(10);

        return view('frontend.recruitment.applied_jobs_customer', $data);
    }
}
