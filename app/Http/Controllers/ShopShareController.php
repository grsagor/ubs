<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\PartnershipShop;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShopShareController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $locations = BusinessLocation::select('name','id')
            ->whereNotIn('id', function ($query) use($user_id) {
                $query->select('partnership_shop_id')
                    ->from('partnership_shop')
                    ->where('user_id', $user_id);
            })
            ->get();

            return Datatables::of($locations)
            ->addColumn('action', function ($location) {
                return '<form action="' . route("shop.share.store") . '" method="post" enctype="multipart/form-data">
                ' . csrf_field() . '
                            <input type="hidden" value="' . $location->id . '" name="shop_id">
                            <input type="submit" class="btn btn-xs btn-primary" value="Share This Shop">
                        </form>';
        
            })
            ->removeColumn('id')
            ->rawColumns(['action'])
            ->toJson();
        }
        return view('business_location.share_shop');
    }

    public function store(Request $request){
        $partnership = new PartnershipShop();
        $partnership->user_id = request()->session()->get('user.id');
        $partnership->partnership_shop_id = $request->shop_id;
        $partnership->save();
        return back()->with('success','Shop shared successfully.');
    }
}