<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Crm\Entities\ServicePropertyWanted;

class PropertyWantedController extends Controller
{
    use ImageFileUpload;

    public function index()
    {
        // return view('user.property.addProperty');
        return view('crm::property_wanted.list');
    }




    public function store(Request $request)
    {
        try {
            $property                                 = new ServicePropertyWanted();

            $requestedData                            = $request->all();

            $requestedData['reference_id']            = Auth::id() . Str::random(15);

            $requestedData['user_id']                 = auth()->id();

            $requestedData['roomfurnishings']         = json_encode($request->roomfurnishings);

            $requestedData['images']                  = $this->image($request->file('images'), 'uploads/service_property/', 800, 500);

            $property->fill($requestedData)->save();

            return redirect()->back();
        } catch (\Throwable $e) {

            dd($e->getmessage());

            return redirect()->back();
        }
    }
}
