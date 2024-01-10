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
        $shops = BusinessLocation::all();
        $shared_shops = PartnershipShop::with('shop')->get();
        $new_shared_shops = $shared_shops->map(function ($item) {
            $shop = $item->shop;
            $shop->is_shared = true;
            $shop->resell_id = $item->id;
            return $shop;
        });
        $total_shops = $shops->concat($new_shared_shops);
        $total_shops = $total_shops->sortByDesc('updated_at')->values();
        return $total_shops;



        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $locations = BusinessLocation::whereNotIn('id', function ($query) use ($user_id) {
                    $query->select('partnership_shop_id')
                        ->from('partnership_shop')
                        ->where('user_id', $user_id);
                })
                ->get();


            return Datatables::of($locations)
                ->addColumn('action', function ($location) {
                    return '<button type="button" data-id="'. $location->id .'" class="btn btn-xs btn-primary shop_share_modal_open_btn">Share</button>';
                })
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('business_location.share_shop');
    }

    public function store(Request $request)
    {
        $partnership = new PartnershipShop();
        $partnership->user_id = request()->session()->get('user.id');
        $partnership->partnership_shop_id = $request->shop_id;
        $partnership->save();
        return back()->with('success', 'Shop shared successfully.');
    }

    public function openModal(Request $request) {
        $id = $request->id;
        $location = BusinessLocation::find($id);
        return view('business_location.share_shop_modal', compact('location'));
    }
}
