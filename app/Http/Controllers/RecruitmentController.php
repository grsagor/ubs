<?php

namespace App\Http\Controllers;

use App\Country;
use App\AppliedJob;
use App\Recruitment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;

class RecruitmentController extends Controller
{
    use ImageFileUpload;

    public function list()
    {
        return view('frontend.recruitment.list');
    }

    public function index(Request $request)
    {
        $data['recruitments'] = Recruitment::query()
            ->search($request) // Assuming a custom search scope or method is applied
            ->with('countryResidence', 'birthCountry', 'createdBy') // Eager loading related country information
            ->latest() // Ordering by the latest
            ->paginate(10); // Paginating the results
        // return $data;
        return view('frontend.recruitment.index', $data);
    }

    public function create()
    {
        if (Auth::check()) {
            $data['country'] = Country::get();
            return view('frontend.recruitment.create2', $data);
        } else {
            $output = [
                'success' => false,
                'msg' => 'You are not authenticated!!!',
            ];

            return redirect()->route('recruitment.list')->with('status', $output);
        }
    }

    public function store(Request $request, Recruitment $recruitment)
    {
        // dd($request->toarray());
        if (Auth::check()) {
            try {

                DB::beginTransaction();

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

                // Create a new Recruitment record
                $info = $recruitment::create($requestedData);

                $appliedJob['job_id'] = 1;
                $appliedJob['recruitment_id'] = $info->uuid;

                AppliedJob::create($appliedJob);

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

    public function edit($id)
    {
        $data['country'] = Country::get();
        $data['item'] = Recruitment::with('countryResidence', 'birthCountry')->find($id);
        return view('frontend.recruitment.edit', $data);
    }

    public function update(Request $request, $id)
    {
        dd($request->toArray());

        // Define the allowed keys that you want to include in the final $data array
        $allowedKeys = [
            'cover_letter',
            'name', 'phone',
            'email',
            'current_address',
            'country_residence',
            'birth_country',
            'salary_type',
            'expected_salary',
            'cv',
            '_token'
        ];
        // dd($allowedKeys);
        // Use array_intersect_key to filter the original array based on allowed keys
        $data = array_intersect_key($request->all(), array_flip($allowedKeys));

        // Update the user information
        $recruitment = Recruitment::findOrFail($id);

        // Check if a new CV file is provided in the request
        if ($request->file('cv')) {
            // Unlink the previous CV file if it exists
            if ($recruitment->cv) {
                $previousFilePath = public_path('uploads/recruitments/' . $recruitment->cv);

                // Check if the file exists before attempting to delete
                if (file_exists($previousFilePath)) {
                    unlink($previousFilePath);
                }
            }

            // Upload the new CV file and update the 'cv' field in the database
            $requestedData['cv'] = $this->fileUpload($request->file('cv'), 'uploads/recruitments/');
        }

        $recruitment->update($data);

        // Reload the updated data with relationships
        $updatedData = Recruitment::with('countryResidence', 'birthCountry')->find($id);

        // Return a response with the updated data
        return response()->json($updatedData);
    }

    public function success()
    {
        return view('frontend.recruitment.after_submit');
    }

    public function userCheck($jobID)
    {
        $data['userId'] = Recruitment::where('created_by', auth()->id())
            // ->where('job_id', $jobID)
            ->get();
        $count          = $data['userId']->count();

        if ($count == 0) {
            return 1;
        } else {
            return 2;
        }
    }
}