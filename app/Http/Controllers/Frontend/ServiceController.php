<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceChildCategories;
use App\ServiceEducation;
use App\ServiceSubCategories;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function serviceList(Request $request)
    {
        $data['per_page'] = 10;

        $data['education']          = ServiceEducation::active()->select(
            'id',
            'course_name',
            'price',
            'institution_name',
            'start_date',
            'tuition_fee',
            'images',
            'description',
            'created_at'
        )
            ->search($request)
            ->latest()->paginate($data['per_page']);

        $data['service_categories'] = ServiceCategory::query()->pluck('name','id');
        $data['service_sub_categories'] = ServiceSubCategories::query()->pluck('name','id');
        $data['service_child_categories'] = ServiceChildCategories::query()->pluck('name','id');

        return view('frontend.service.service_list', $data);
    }

}
