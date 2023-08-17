<?php

namespace App\Http\Controllers\Frontend;

use App\ServiceEducation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    public function educationList(Request $request)
    {
        $data['per_page'] = 10;

        $data['education']          = ServiceEducation::active()->select(
            'id',
            'course_name',
            'price',
            'institution_name',
            'start_date',
            'images',
            'description',
            'created_at'
        )
            ->search($request)
            ->latest()->paginate($data['per_page']);

        return view('frontend.service.education.education_list', $data);
    }
}
