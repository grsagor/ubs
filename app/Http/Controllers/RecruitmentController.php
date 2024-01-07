<?php

namespace App\Http\Controllers;

use App\Recruitment;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;

class RecruitmentController extends Controller
{
    use ImageFileUpload;

    public function create()
    {
        return view('frontend.recruitment.create');
    }


    public function store(Request $request, Recruitment $recruitment)
    {
        try {
            $requestedData = $request->all();

            foreach ($request->input('name_of_company') as $key => $company) {
                $experienceData[] = [
                    'name_of_company' => $company,
                    'start_date' => $request->input('start_date')[$key],
                    'end_date' => $request->input('end_date')[$key],
                    // Add other fields as needed
                ];

                // Check if the additional_file is present for the current experience
                if ($request->hasFile('additional_file') && $request->file('additional_file')[$key]) {
                    $experienceData[$key]['additional_file'] = $this->fileUpload($request->file('additional_file')[$key], 'uploads/recruitments');
                }
            }
            $requestedData['experiences'] = json_encode($experienceData, JSON_PRETTY_PRINT);

            if ($request->file('cv')) {
                $requestedData['cv']     = $this->fileUpload($request->file('cv'), 'uploads/recruitments');
            }
            if ($request->file('dbs_check')) {
                $requestedData['dbs_check']     = $this->fileUpload($request->file('dbs_check'), 'uploads/recruitments');
            }
            if ($request->file('care_certificates')) {
                $requestedData['care_certificates']     = $this->fileUpload($request->file('care_certificates'), 'uploads/recruitments');
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
}
