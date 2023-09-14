<?php

namespace App\Http\Controllers\Frontend;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Crm\Entities\ServicePropertyWanted;

class PropertyController extends Controller
{
    public function propertyListShowing($child_category_id = null)
    {
        if (!$child_category_id) {
            $properties = ServicePropertyWanted::all();
        } else {
            $properties = ServicePropertyWanted::where('child_category_id', $child_category_id)->get();
        }
        return $properties;
    }
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
            ->whereNotIn('id', function ($query) {
                $query->select('foregn_key')
                    ->from('payment_histories')
                    ->where('table_name', 'service_property_wanted');
            })
            ->latest()->paginate($data['per_page']);

        return view('frontend.service.property.property_list', $data);
    }


    public function propertyShow($id)
    {
        $data['info']                   = ServicePropertyWanted::with(['user', 'child_category'])->findOrFail($id);
        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)
            ->where('model_type', 'App\\User')->first();
        // return $data;
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

            $info['output'] = [
                'success' => true,
                'msg' => ('Reference number matched!!!'),
            ];

            return redirect('stripe')
                ->with([
                    'product_id'    => $info['product_id'],
                    'product_name'  => $info['product_name'],
                    'bill'          => $info['bill'],
                    'table_name'    => $info['table_name'],
                    'output'        => $info['output'],
                ]);
        } else {
            $output = [
                'success' => false,
                'msg' => ('Wrong Reference number!!!'),
            ];

            return redirect()->back()->with('status', $output);
        }
    }
}
