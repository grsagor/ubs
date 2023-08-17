<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Crm\Entities\ServicePropertyWanted;

class PropertyController extends Controller
{
    public function propertyList(Request $request)
    {
        $data['per_page'] = 10;

        $data['rooms']          = ServicePropertyWanted::active()->select(
            'id',
            'room_size',
            'available_form',
            'ad_title',
            'ad_text',
            'images',
            'advert_type',
            'created_at'
        )
            ->search($request)
            ->latest()->paginate($data['per_page']);

        return view('frontend.service.property.property_list', $data);
    }


    public function propertyShow($id)
    {
        $data['info']                   = ServicePropertyWanted::findOrFail($id);
        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)->first();

        return view('frontend.service.property.details', $data);
    }

    public function referenceNumberCheck(Request $request, $id)
    {
        $data                           = ServicePropertyWanted::findOrFail($id);

        $info['product_id']             = $id;
        $info['product_name']           = $data->ad_title;
        $info['bill']                   = $request->bill;
        $info['table_name']             = 'service_property_wanted';

        if ($data->reference_id == $request->reference_number) {
            return redirect('stripe')
                ->with([
                    'product_id' => $info['product_id'],
                    'product_name' => $info['product_name'],
                    'bill' => $info['bill'],
                    'table_name' => $info['table_name'],
                ]);
        } else {
            return redirect()->back();
        }
    }
}
