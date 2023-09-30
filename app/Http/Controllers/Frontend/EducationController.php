<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
use App\ServiceCategory;
use App\ServiceChildCategories;
use App\ServiceEducation;
use App\ServiceSubCategories;
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
            'tuition_fee',
            'requirements',
            'scholarship',
            'images',
            'description',
            'created_at'
        )
            ->search($request)
            ->latest()->paginate($data['per_page']);

        $data['service_categories'] = ServiceCategory::query()->pluck('name','id');
        $data['service_sub_categories'] = ServiceSubCategories::query()->pluck('name','id');
        $data['service_child_categories'] = ServiceChildCategories::query()->pluck('name','id');

        return view('frontend.service.education.education_list', $data);
    }


    public function educationShow($id)
    {
        $data['info'] = ServiceEducation::query()->with('user')->find($id);
        $data['user_info'] = Media::query()->where('uploaded_by', $data['info']->user_id)->where('model_type', 'App\\User')->first();

        $data['first_image'] = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';

        $data['images'] = json_decode($data['info']->images, true);
        $data['img_count'] = null;
        $data['imagePath'] = null;
        $data['div_value'] = 0;

        if ($data['images']) {
            $data['first_image'] = reset($data['images']);
            $data['imagePath'] = public_path($data['first_image']);
            $data['img_count'] = count($data['images']);
            if ($data['img_count'] >= 7) {
                $data['div_value'] = 1;
            }

            if ($data['img_count'] == 5 || $data['img_count'] == 6) {
                $data['div_value'] = 2;
            }

            if ($data['img_count'] == 4) {
                $data['div_value'] = 3;
            }

            if ($data['img_count'] <= 3) {
                $data['div_value'] = 4;
            }
        }
        return view('frontend.service.education.details',$data);
    }
}
