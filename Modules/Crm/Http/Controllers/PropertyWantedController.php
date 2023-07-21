<?php
namespace Modules\Crm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Crm\Entities\ServicePropertyWanted;

class PropertyWantedController extends Controller
{
    public function showPropertyForm(){
        // return view('user.property.addProperty');
        return view('crm::property_wanted.list');
    }


    public function saveProperty(Request $request){
        $property = new ServicePropertyWanted();
        $property->user_id = auth()->user()->id;
        $property->who_is_searching = $request->who_is_searching;
        $property->gender = $request->gender;
        $property->room_size = $request->room_size;
        $property->buddy_ups = $request->buddy_ups;
        $property->reason_to_leave = $request->reason_to_leave;
        $property->combined_budget = $request->combined_budget;
        $property->per = $request->per;
        $property->day_avail = $request->day_avail;
        $property->mon_avail = $request->mon_avail;
        $property->year_avail = $request->year_avail;
        $property->min_term = $request->min_term;
        $property->max_term = $request->max_term;
        $property->days_of_wk_available = $request->days_of_wk_available;
        $property->roomfurnishings = json_encode($request->roomfurnishings);
        $property->min_age = $request->min_age;
        $property->share_type = $request->share_type;
        $property->pets = $request->pets;
        $property->smoking_current = $request->smoking_current;
        $property->gay_lesbian = $request->gay_lesbian;
        $property->gay_consent = $request->gay_consent;
        $property->lang_id = $request->lang_id;
        $property->nationality = $request->nationality;
        $property->first_name = $request->first_name;
        $property->last_name = $request->last_name;
        $property->gender_req = $request->gender_req;
        $property->min_age_req = $request->min_age_req;
        $property->max_age_req = $request->max_age_req;
        $property->smoking = $request->smoking;
        $property->pets_req = $request->pets_req;
        $property->share_type_req = $request->share_type_req;
        $property->gay_lesbian_req = $request->gay_lesbian_req;
        $property->ad_title = $request->ad_title;
        $property->ad_text = $request->ad_text;
        $property->tel = $request->tel;
        $property->selectedSports = $request->selectedSports;
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];
            foreach ($images as $image) {
                $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                $image_path = public_path('service_images');
                $image->move($image_path, $image_name);
                $imagePaths[] = 'service_images/' . $image_name;
            }
            $property->images = json_encode($imagePaths);
        }

        $property->save();
        return back();
    }
}
