<?php

namespace App\Http\Controllers;

use App\Recruitment;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{

    public function create()
    {
        return view('frontend.recruitment.create');
    }


    public function store(Request $request, Recruitment $recruitment)
    {
        try {
            $requestedData = $request->all();

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
