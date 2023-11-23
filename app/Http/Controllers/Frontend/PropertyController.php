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
        $property = ServicePropertyWanted::find($id);
        $occupantDetails = json_decode($property->occupant_details, true);
        if (!is_array($occupantDetails)) {
            $occupantDetails = json_decode($occupantDetails, true);
        }
        // return $property;
        $data['info'] = $property;
        $data['occupantDetails'] = $occupantDetails;
        $total_monthly_income_before_tax = 0;
        foreach ($occupantDetails as $item) {
            if ($item['occupant_pay_rent'] == 1) {
                $total_monthly_income_before_tax += (int)$item['occupant_miat'];
            }
        }
        $data['total_monthly_income_before_tax'] = $total_monthly_income_before_tax;

        $data['user_info']              = Media::where('uploaded_by', $data['info']->user_id)
            ->where('model_type', 'App\\User')->first();


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
