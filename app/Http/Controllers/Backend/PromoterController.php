<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use Modules\Crm\Entities\Campaign;
use App\Http\Controllers\Controller;
use Modules\Crm\Entities\LeadCampaignDetails;

class PromoterController extends Controller

{
    public function index(Request $request)
    {
        // Eager load leadGenerationFirstContact relation
        $promoters = Campaign::where('campaign_type', 'lead_generation')
            ->select('id', 'contact_ids')
            ->withCount('leadCampaignDetails') // Adds the count of related LeadCampaignDetails
            ->get();

        // Flatten the contact_ids into a single array
        $contactIds = $promoters->flatMap(function ($campaign) {
            return $campaign->contact_ids; // This will return all contact_ids as a flat array
        })->unique()->filter(); // unique() to remove duplicates, filter() to remove null values

        // Sort the contact IDs in ascending order
        $sortedContactIdsArray = $contactIds->sort()->values()->toArray(); // Sort and re-index

        // Fetch users corresponding to the sorted contact IDs
        $users = User::whereIn('id', $sortedContactIdsArray)->select(
            'id',
            'surname',
            'first_name',
            'last_name',
            'email',
            'contact_number',
            'address',
            'current_address',
            'permanent_address'
        )->get();

        // Count occurrences of each contact_id in the campaigns
        $contactCounts = [];
        $leadCampaignDetailsCounts = [];

        foreach ($sortedContactIdsArray as $contactId) {
            // Count how many times this contact_id appears in the campaigns
            $count = $promoters->filter(function ($campaign) use ($contactId) {
                return in_array($contactId, $campaign->contact_ids);
            })->count();

            $contactCounts[$contactId] = $count;

            // Count the total number of leadCampaignDetails associated with this contact_id
            $leadCampaignDetailsCount = $promoters->filter(function ($campaign) use ($contactId) {
                return in_array($contactId, $campaign->contact_ids);
            })->sum('lead_campaign_details_count'); // Sum all the leadCampaignDetails for this contact_id

            $leadCampaignDetailsCounts[$contactId] = $leadCampaignDetailsCount;
        }

        // Add the campaign_count and lead_campaign_details_count to each user
        $users->transform(function ($user) use ($contactCounts, $leadCampaignDetailsCounts) {
            $user->campaign_count = $contactCounts[$user->id] ?? 0; // Set campaign count, default to 0 if not found
            $user->lead_campaign_details_count = $leadCampaignDetailsCounts[$user->id] ?? 0; // Set leadCampaignDetails count
            return $user;
        });

        // Prepare the data to return, mapping contact IDs to user information and counts
        $data['contact_ids'] = $sortedContactIdsArray;
        $data['users'] = $users; // This now includes campaign_count and lead_campaign_details_count
        $data['contact_counts'] = $contactCounts; // Add the campaign counts to the response data
        $data['lead_campaign_details_counts'] = $leadCampaignDetailsCounts; // Add the leadCampaignDetails counts

        return view('backend.promoters.index', $data);
    }


    public function promoterCampaigns($user_id)
    {
        $data['campaigns'] = Campaign::where('campaign_type', 'lead_generation')
            ->whereJsonContains('contact_ids', $user_id) // Check if user_id exists in contact_ids
            ->withCount('leadCampaignDetails')
            ->with('businessLocation')
            ->latest()
            ->get();

        return view('backend.promoters.campaigns', $data);
    }

    public function promoterLeads($user_id)
    {
        $data['leads'] = Campaign::where('campaign_type', 'lead_generation')
            ->whereJsonContains('contact_ids', $user_id) // Check if user_id exists in contact_ids
            ->withCount('leadCampaignDetails')
            ->with(['businessLocation', 'leadCampaignDetails'])
            ->latest()
            ->get();

        return view('backend.promoters.leads');
    }
}
