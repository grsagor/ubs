<?php

namespace App\Http\Controllers;

use App\Country;
use App\Recruitment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;
use Illuminate\Support\Facades\Auth;

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
            ->with('countryResidence', 'birthCountry') // Eager loading related country information
            ->latest() // Ordering by the latest
            ->paginate(10); // Paginating the results
        return view('frontend.recruitment.index', $data);
    }

    public function create()
    {
        $data['country'] = Country::get();
        return view('frontend.recruitment.create', $data);

        // if (Auth::check()) {
        //     $user = Auth::user();

        //     if ($user->user_type == 'user_customer') {
        //         return view('frontend.recruitment.create');
        //     } else {
        //         return view('frontend.recruitment.error');
        //     }
        // } else {
        //     return view('frontend.recruitment.error');
        // }
    }


    public function store(Request $request, Recruitment $recruitment)
    {
        try {
            $requestedData = $request->all();

            // Initialize an empty array to store the experiences
            $experienceData = [];

            // Iterate over each 'name_of_company' from the request data
            foreach ($request->input('name_of_company') as $key => $company) {
                // Create an array for each experience
                $experience = [
                    'name_of_company' => $company,
                    'start_date' => $request->input('start_date')[$key],
                    'end_date' => $request->input('end_date')[$key],
                    // Add other fields as needed
                ];

                // Check if the additional_file is present for the current experience
                if ($request->hasFile('additional_file') && $request->file('additional_file')[$key]) {
                    // Upload the file and add its path to the experience array
                    $experience['additional_file'] = $this->fileUpload($request->file('additional_file')[$key], 'uploads/recruitments/');
                }

                // Add the current experience array to the overall experiences array
                $experienceData[] = $experience;
            }

            // Encode the experiences array into JSON and store it in $requestedData['experiences']
            $requestedData['experiences'] = json_encode($experienceData, JSON_PRETTY_PRINT);

            if ($request->file('cv')) {
                $requestedData['cv']     = $this->fileUpload($request->file('cv'), 'uploads/recruitments/');
            }
            if ($request->file('dbs_check')) {
                $requestedData['dbs_check']     = $this->fileUpload($request->file('dbs_check'), 'uploads/recruitments/');
            }
            if ($request->file('care_certificates')) {
                $requestedData['care_certificates']     = $this->fileUpload($request->file('care_certificates'), 'uploads/recruitments/');
            }

            $requestedData                  = $recruitment->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->back()->with('status', $output);
        } catch (\Throwable $e) {
            dd($e->getmessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $data['item'] = Recruitment::find($id);
        return view('frontend.recruitment.show', $data);
    }
}
