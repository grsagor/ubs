<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use Modules\Crm\Entities\Campaign;
use App\Http\Controllers\Controller;

class PromoterController extends Controller

{
    public function index(Request $request)
    {
        // Eager load leadGenerationFirstContact relation
        // Assuming $data['promoters'] is already populated with the Campaign data
        $data['promoters'] = Campaign::where('campaign_type', 'lead_generation')
            ->select('contact_ids')
            ->get();

        // Flatten the contact_ids into a single array
        $contactIds = $data['promoters']->flatMap(function ($campaign) {
            return $campaign->contact_ids; // This will return all contact_ids as a flat array
        })->unique()->filter(); // unique() to remove duplicates, filter() to remove null values

        // Convert the collection to an array if needed
        $contactIdsArray = $contactIds->values()->toArray();

        // Return the array or include it in the response data
        $data['contact_ids'] = $contactIdsArray;

        return $data;

        return view('backend.promoters.index', $data);
    }
}
