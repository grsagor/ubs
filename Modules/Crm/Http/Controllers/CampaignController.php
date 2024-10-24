<?php

namespace Modules\Crm\Http\Controllers;

use DB;
use App\User;
use App\Footer;
use App\Country;
use App\Business;
use Notification;
use Carbon\Carbon;
use App\Transaction;
use App\BusinessLocation;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use App\Services\SlugService;
use Illuminate\Http\Response;
use App\Traits\ImageFileUpload;
use App\Utils\NotificationUtil;
use App\Services\UniqueIDService;
use Illuminate\Routing\Controller;
use Modules\Crm\Entities\Campaign;
use Illuminate\Support\Facades\Hash;
use Modules\Crm\Entities\CrmContact;
use Modules\Crm\Entities\LeadCampaignDetails;
use Modules\Crm\Notifications\SendCampaignNotification;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    protected $notificationUtil;
    protected $moduleUtil;
    protected $unique_id_service;
    protected $slug_service;

    /**
     * Constructor
     *
     * @param NotificationUtil $notificationUtil
     * @return void
     */
    public function __construct(NotificationUtil $notificationUtil, ModuleUtil $moduleUtil, UniqueIDService $unique_id_service, SlugService $slug_service)
    {
        $this->notificationUtil = $notificationUtil;
        $this->moduleUtil = $moduleUtil;
        $this->unique_id_service          = $unique_id_service;
        $this->slug_service               = $slug_service;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');

        $can_access_all_campaigns = auth()->user()->can('crm.access_all_campaigns');
        $can_access_own_campaigns = auth()->user()->can('crm.access_own_campaigns');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module')) || !($can_access_all_campaigns || $can_access_own_campaigns)) {
            abort(403, 'Unauthorized action.');
        }

        $data['campaigns'] = Campaign::with('createdBy')
            ->with('businessLocation')
            ->where('business_id', $business_id)
            ->select('*')
            ->latest()
            ->get();

        // return $data['campaigns'];

        if (!$can_access_all_campaigns && $can_access_own_campaigns) {
            $data['campaigns']->where('created_by', auth()->user()->id);
        }

        if (!empty(request()->get('campaign_type'))) {
            $data['campaigns']->where('campaign_type', request()->get('campaign_type'));
        }

        return view('crm::campaign.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');
        $can_access_all_campaigns = auth()->user()->can('crm.access_all_campaigns');
        $can_access_own_campaigns = auth()->user()->can('crm.access_own_campaigns');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module')) || !($can_access_all_campaigns || $can_access_own_campaigns)) {
            abort(403, 'Unauthorized action.');
        }

        $tags = Campaign::getTags();
        $leads = CrmContact::leadsDropdown($business_id, false);
        $customers = CrmContact::customersDropdown($business_id, false);
        $contact_ids = $request->get('contact_ids', '');

        $promoters = User::select('id', 'user_type', 'surname', 'first_name', 'last_name', 'username', 'email', 'language', 'contact_no')->get();

        $business_locations = BusinessLocation::where('business_id', $business_id)
            ->where('is_active', 1)
            ->orderByNameAsc()
            ->get();

        // return $business_locations;
        $contacts = [];
        foreach ($leads as $key => $lead) {
            $contacts[$key] = $lead;
        }

        foreach ($customers as $key => $customer) {
            $contacts[$key] = $customer;
        }

        return view('crm::campaign.create')
            ->with(compact('tags', 'leads', 'customers', 'contact_ids', 'contacts', 'promoters', 'business_locations'));
    }


    public function validateEmail(Request $request)
    {
        $email = $request->email;

        // Find the user by email
        $user = User::where('email', $email)->first();
        // dd($user);
        if ($user) {

            // Email matches 100%
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->surname . ' ' . $user->first_name . ' ' . $user->last_name
                ]
            ]);
        } else {
            // No exact match
            return response()->json([
                'success' => false
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');
        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module'))) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(
                'name',
                'campaign_type',
                'subject',
                'email_body',
                'sms_body',

                'business_location_id',
                'checkbox_education',
                'checkbox_experience',
                'checkbox_cv',
                'video_link'
            );

            $input['business_id'] = $business_id;
            $input['business_location_id'] = $input['business_location_id'];
            $input['created_by'] = $request->user()->id;

            $customers = $request->input('contact_id', []);
            $leads = $request->input('lead_id', []);
            $contacts = $request->input('contact', []);

            // Merge arrays and filter out null values
            $merged_contacts = array_filter(array_merge($customers, $leads, $contacts), function ($value) {
                return !is_null($value); // Remove null values
            });

            // Now, create an associative array with the original keys retained
            $contact_ids = [];
            foreach ($merged_contacts as $key => $value) {
                $contact_ids[$key] = $value;
            }

            // Save $contact_ids
            $input['contact_ids'] = $contact_ids;

            $input['additional_info'] = [
                'to' => $request->input('to'),
                'trans_activity' => $request->input('trans_activity'),
                'in_days' => $request->input('in_days')
            ];

            if ($input['campaign_type'] == 'lead_generation') {
                $input['info_from_customer'] = json_encode([
                    "checkbox_education" => $request->input('checkbox_education') === 'on' ? "1" : null,
                    "checkbox_experience" => $request->input('checkbox_experience') === 'on' ? "1" : null,
                    "checkbox_cv" => $request->input('checkbox_cv') === 'on' ? "1" : null,
                ]);

                $input['video_link'] = $request->input('video_link') ?? NULL;
            }

            $campaign = new Campaign();

            // Assign the unique slug to the requested data
            $input['slug'] = $this->slug_service->slug_create($input['name'], $campaign);

            // Generate a unique id
            $input['short_id'] = $this->unique_id_service->generateUniqueId($campaign, 'short_id');

            // dd($input);

            DB::beginTransaction();

            $campaign = Campaign::create($input);

            DB::commit();

            if ($request->get('send_notification') && !empty($campaign)) {
                $this->__sendCampaignNotification($campaign->id, $business_id);
            }

            $output = [
                'success' => true,
                'msg' => __('lang_v1.success'),
            ];
        } catch (Exception $e) {
            DB::rollBack();

            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong')
            ];
        }

        return redirect()
            ->action('\Modules\Crm\Http\Controllers\CampaignController@index')
            ->with('status', $output);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $can_access_all_campaigns = auth()->user()->can('crm.access_all_campaigns');
        $can_access_own_campaigns = auth()->user()->can('crm.access_own_campaigns');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module')) || !($can_access_all_campaigns || $can_access_own_campaigns)) {
            abort(403, 'Unauthorized action.');
        }

        $query = Campaign::with('createdBy')
            ->where('business_id', $business_id);

        if (!$can_access_all_campaigns && $can_access_own_campaigns) {
            $query->where('created_by', auth()->user()->id);
        }

        $campaign = $query->findOrFail($id);

        $notifiable_users = CrmContact::find($campaign->contact_ids);

        return view('crm::campaign.show')
            ->with(compact('campaign', 'notifiable_users'));
    }

    // details only for campaign type lead_generation
    public function details($business_location_slug, $short_id)
    {
        // $business_location_slug
        // This parameter is use only for the frontend url

        $data['campaign'] = Campaign::with('businessLocation')
            ->where('campaign_type', 'lead_generation')
            ->where('short_id', $short_id)
            ->first();

        if (!$data['campaign']) {
            return view('error.404_withoutheader');
        }

        $contact_info = implode(' | ', [
            $data['campaign']->businessLocation->landmark,
            $data['campaign']->businessLocation->city,
            $data['campaign']->businessLocation->state,
            $data['campaign']->businessLocation->zip_code,
            $data['campaign']->businessLocation->country
        ]);

        // Pass this to the view
        $data['address'] = $contact_info;

        $data['country'] = Country::get();

        return view('frontend.campaign.details', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $can_access_all_campaigns = auth()->user()->can('crm.access_all_campaigns');
        $can_access_own_campaigns = auth()->user()->can('crm.access_own_campaigns');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module')) || !($can_access_all_campaigns || $can_access_own_campaigns)) {
            abort(403, 'Unauthorized action.');
        }

        $query = Campaign::where('business_id', $business_id);

        if (!$can_access_all_campaigns && $can_access_own_campaigns) {
            $query->where('created_by', auth()->user()->id);
        }

        $campaign = $query->findOrFail($id);

        $tags = Campaign::getTags();
        $leads = CrmContact::leadsDropdown($business_id, false);
        $customers = CrmContact::customersDropdown($business_id, false);

        $contacts = [];
        foreach ($leads as $key => $lead) {
            $contacts[$key] = $lead;
        }

        foreach ($customers as $key => $customer) {
            $contacts[$key] = $customer;
        }

        $business_locations = BusinessLocation::where('business_id', $business_id)
            ->where('is_active', 1)
            ->orderByNameAsc()
            ->get();

        $promoter = User::where('id', $campaign->contact_ids)->first();
        // return $promoter->email;

        return view('crm::campaign.edit')
            ->with(compact('tags', 'campaign', 'leads', 'customers', 'contacts', 'business_locations', 'promoter'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $business_id = request()->session()->get('user.business_id');
        $can_access_all_campaigns = auth()->user()->can('crm.access_all_campaigns');
        $can_access_own_campaigns = auth()->user()->can('crm.access_own_campaigns');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module')) || !($can_access_all_campaigns || $can_access_own_campaigns)) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(
                'name',
                'campaign_type',
                'subject',
                'email_body',
                'sms_body',
                'checkbox_education',
                'checkbox_experience',
                'checkbox_cv',
                'video_link'
            );

            $customers = $request->input('contact_id', []);
            $leads = $request->input('lead_id', []);
            $contacts = $request->input('contact', []); //birthday_wishes

            $input['contact_ids'] = array_merge($customers, $leads, $contacts);

            if ($input['campaign_type'] == 'lead_generation') {

                $input['contact_ids'] = [$request['contact_id'][0]];

                $input['info_from_customer'] = json_encode([
                    "checkbox_education" => $request->input('checkbox_education') === 'on' ? "1" : null,
                    "checkbox_experience" => $request->input('checkbox_experience') === 'on' ? "1" : null,
                    "checkbox_cv" => $request->input('checkbox_cv') === 'on' ? "1" : null,
                ]);

                $input['video_link'] = $request->input('video_link') ?? NULL;
            }

            $input['additional_info'] = [
                'to' => $request->input('to'),
                'trans_activity' => $request->input('trans_activity'),
                'in_days' => $request->input('in_days')
            ];

            $query = Campaign::where('business_id', $business_id);

            if (!$can_access_all_campaigns && $can_access_own_campaigns) {
                $query->where('created_by', auth()->user()->id);
            }

            $campaign = $query->findOrFail($id);

            DB::beginTransaction();

            $campaign->update($input);

            DB::commit();

            if ($request->get('send_notification') && !empty($campaign)) {
                $this->__sendCampaignNotification($campaign->id, $business_id);
            }

            $output = [
                'success' => true,
                'msg' => __('lang_v1.success'),
            ];
        } catch (Exception $e) {
            DB::rollBack();

            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong')
            ];
        }

        return redirect()
            ->action('\Modules\Crm\Http\Controllers\CampaignController@index')
            ->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $can_access_all_campaigns = auth()->user()->can('crm.access_all_campaigns');
        $can_access_own_campaigns = auth()->user()->can('crm.access_own_campaigns');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module')) || !($can_access_all_campaigns || $can_access_own_campaigns)) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $query = Campaign::where('business_id', $business_id);

            if (!$can_access_all_campaigns && $can_access_own_campaigns) {
                $query->where('created_by', auth()->user()->id);
            }

            $query->where('id', $id)
                ->delete();

            $output = [
                'success' => true,
                'msg' => __('lang_v1.success'),
            ];

            return redirect()->back()->with('status', $output);
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong')
            ];
        }
    }

    public function sendNotification($id)
    {
        $business_id = request()->session()->get('user.business_id');
        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module'))) {
            abort(403, 'Unauthorized action.');
        }


        $output = $this->__sendCampaignNotification($id, $business_id);

        return redirect()->back()->with('status', $output);
    }

    public function __sendCampaignNotification($campaign_id, $business_id)
    {
        try {
            $campaign = Campaign::where('business_id', $business_id)
                ->findOrFail($campaign_id);

            $business = Business::findOrFail($business_id);

            if ((!empty($campaign->additional_info['to']) && in_array($campaign->additional_info['to'], ['lead', 'customer', 'contact']))
                || (!isset($campaign->additional_info['to']) && !empty($campaign->contact_ids))
            ) {
                $contact_ids = $campaign->contact_ids;
            } elseif (!empty($campaign->additional_info['to']) && in_array($campaign->additional_info['to'], ['transaction_activity'])) {
                $day = Carbon::now()->subDays($campaign->additional_info['in_days'])->toDateTimeString();
                $query = Transaction::where('business_id', $business_id)
                    ->select('contact_id', DB::raw('MAX(transaction_date) as last_shoped'));

                if ($campaign->additional_info['trans_activity'] == 'has_transactions') {
                    $query->having('last_shoped', '>=', $day);
                } elseif ($campaign->additional_info['trans_activity'] == 'has_no_transactions') {
                    $query->having('last_shoped', '<=', $day);
                }

                $transactions = $query
                    ->groupBy('contact_id')
                    ->get();

                $contact_ids = $transactions->pluck('contact_id')->toArray();
            }

            $notifiable_users = CrmContact::find($contact_ids);

            if (!empty($notifiable_users) && $campaign->campaign_type == 'sms') {
                $notification_data['sms_settings'] = request()->session()->get('business.sms_settings');
                foreach ($notifiable_users as $user) {
                    $notification_data['mobile_number'] = $user->mobile;
                    $notification_data['sms_body'] = preg_replace(["/{contact_name}/", "/{campaign_name}/", "/{business_name}/"], [$user->name, $campaign->name, $business->name], $campaign->sms_body);

                    $this->notificationUtil->sendSms($notification_data);
                }
            } elseif (!empty($notifiable_users) && $campaign->campaign_type == 'email') {
                Notification::send($notifiable_users, new SendCampaignNotification($campaign, $business));
            }

            DB::beginTransaction();

            $campaign->sent_on = Carbon::now();
            $campaign->save();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => __('lang_v1.success'),
            ];
        } catch (Exception $e) {
            DB::rollBack();

            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __('messages.something_went_wrong')
            ];
        }

        return $output;
    }

    public function campaignDataStore(Request $request)
    {
        try {
            $requestedData = [
                'crm_campaign_id' => $request->crm_campaign_id ?? null,
                'name' => $request->name ?? null,
                'phone' => $request->phone ?? null,
                'email' => $request->email ?? null,
                'current_address' => $request->current_address ?? null,
                'birth_country' => $request->birth_country ?? null,
                'note' => $request->note ?? null,
            ];

            // Education store
            if ($request->has('education_name_of_title')) {
                $educationData = [];
                foreach ($request->input('education_name_of_title') as $key => $education) {
                    // Check if the education title exists
                    if ($education) {
                        $edu = [
                            'education_name_of_title' => $education,
                            'education_start_date' => $request->input('education_start_date')[$key] ?? null,
                            'education_end_date' => $request->input('education_end_date')[$key] ?? null,
                            'education_file' => null, // Default to null
                            'education_original_file_name' => null, // Default to null
                        ];
                        if ($request->hasFile('education_file') && isset($request->file('education_file')[$key])) {
                            $uploadData = $this->fileUpload($request->file('education_file')[$key], 'uploads/lead_campaign_details/');
                            if (isset($uploadData['path']) && isset($uploadData['original_name'])) { // Check if keys exist
                                $edu['education_file'] = $uploadData['path']; // Store the uploaded file path
                                $edu['education_original_file_name'] = $uploadData['original_name']; // Store the original file name
                            }
                        }
                        $educationData[] = $edu;
                    }
                }
                // Store the educations as JSON; if no valid entries, set to null
                $requestedData['educations'] = !empty($educationData) ? json_encode($educationData, JSON_PRETTY_PRINT) : null;
            }

            // Experience store
            if ($request->has('experience_name_of_company')) {
                $experienceData = [];
                foreach ($request->input('experience_name_of_company') as $key => $company) {
                    // Check if the experience title exists
                    if ($company) {
                        $experience = [
                            'experience_name_of_company' => $company,
                            'experience_start_date' => $request->input('experience_start_date')[$key] ?? null,
                            'experience_end_date' => $request->input('experience_end_date')[$key] ?? null,
                            'experience_file' => null, // Default to null
                            'experience_original_file_name' => null, // Default to null
                        ];
                        if ($request->hasFile('experience_file') && isset($request->file('experience_file')[$key])) {
                            $uploadData = $this->fileUpload($request->file('experience_file')[$key], 'uploads/lead_campaign_details/');
                            if (isset($uploadData['path']) && isset($uploadData['original_name'])) { // Check if keys exist
                                $experience['experience_file'] = $uploadData['path']; // Store the uploaded file path
                                $experience['experience_original_file_name'] = $uploadData['original_name']; // Store the original file name
                            }
                        }
                        $experienceData[] = $experience;
                    }
                }
                // Store the experiences as JSON; if no valid entries, set to null
                $requestedData['experiences'] = !empty($experienceData) ? json_encode($experienceData, JSON_PRETTY_PRINT) : null;
            }

            // Additional file store
            if ($request->has('additional_name_of_title')) {
                $additionalFilesData = [];
                foreach ($request->input('additional_name_of_title') as $key => $ad_file) {
                    // Check if the title exists
                    if ($ad_file) {
                        // Create an array to hold the additional file data only if the title exists
                        $addData = [
                            'additional_name_of_title' => $ad_file,
                            'additional_file' => null, // Default to null
                            'additional_original_file_name' => null, // Default to null
                        ];

                        // Check if a file is uploaded for this additional title
                        if ($request->hasFile('additional_file') && isset($request->file('additional_file')[$key])) {
                            $uploadData = $this->fileUpload($request->file('additional_file')[$key], 'uploads/lead_campaign_details/');
                            if (isset($uploadData['path']) && isset($uploadData['original_name'])) { // Check if keys exist
                                $addData['additional_file'] = $uploadData['path']; // Store the uploaded file path
                                $addData['additional_original_file_name'] = $uploadData['original_name']; // Store the original file name
                            }
                        }

                        // Add to the additional files data array
                        $additionalFilesData[] = $addData;
                    }
                }

                // If there are no titles, set additional_files to null
                $requestedData['additional_files'] = !empty($additionalFilesData) ? json_encode($additionalFilesData, JSON_PRETTY_PRINT) : null;
            }

            // CV upload
            if ($request->has('cv')) {
                $uploadData = $this->fileUpload($request->file('cv'), 'uploads/lead_campaign_details/');

                // Create an array to hold the CV information
                $cvData = [];

                if (isset($uploadData['path']) && isset($uploadData['original_name'])) { // Check if keys exist
                    $cvData['cv_path'] = $uploadData['path']; // Store the uploaded file path
                    $cvData['cv_original_file_name'] = $uploadData['original_name']; // Store the original file name
                } else {
                    // Handle the case where the upload fails (optional)
                    $cvData['cv_path'] = null; // Or handle the error as needed
                    $cvData['cv_original_file_name'] = null; // Or handle the error as needed
                }

                // Store the CV data as a JSON-encoded string
                $requestedData['cv'] = json_encode($cvData, JSON_PRETTY_PRINT);
            }

            DB::beginTransaction();

            $campaign = Campaign::find($request->crm_campaign_id);

            // Generate contact id start
            $commonUtil = new \App\Utils\Util;
            $ref_count = $commonUtil->setAndGetReferenceCount('contacts', $campaign->business_id);

            $contact_id = $commonUtil->generateReferenceNumber('contacts', $ref_count, $campaign->business_id);
            // Generate contact id end


            $existing_user = User::where('email', $request->email)->first();

            if (!$existing_user) {
                // Insert user and return the created instance
                $user = User::create([
                    'user_type' => 'user_customer',
                    'first_name' => $request->name ?? null,
                    'username' => $request->email ?? null,
                    'email' => $request->email ?? null,
                    'password' => Hash::make($request->email ?? null),
                    'contact_no' => $request->phone ?? null,
                    'contact_number' => $request->phone ?? null,
                    'current_address' => $request->current_address ?? null,
                    'business_id' => $campaign->business_id,
                    'allow_login' => 1,
                    'status' => 'active',
                ]);
            }

            // Insert contact using the created user's ID
            $contact = CrmContact::create([
                'business_id' => $campaign->business_id,
                'user_id' => $existing_user->id ?? $user->id, // Access user ID here
                'type' => 'lead',
                'name' => $request->name ?? null,
                'mobile' => $request->phone ?? null,
                'email' => $request->email ?? null,
                'contact_id' => $contact_id,
                'contact_status' => 'active',
                'created_by' => auth()->check() ? auth()->user()->id : ($user->id ?? $existing_user->id),
                'country' => $request->birth_country ?? null,
                'address_line_1' => $request->current_address ?? null,
            ]);

            // Update the 'crm_contact_id' in the user table with the created contact's ID
            if (!$existing_user) {
                $user->update([
                    'crm_contact_id' => $contact->id, // Update with the contact's ID
                ]);
            }

            // Add the user and contact IDs to the requested data
            $requestedData['user_id'] = $existing_user->id ?? $user->id;
            $requestedData['contacts_id'] = $contact->id;
            $requestedData['business_id'] = $campaign->business_id;

            // dd($requestedData);
            // Create the LeadCampaignDetails record with the additional data
            LeadCampaignDetails::create($requestedData);

            DB::commit();

            // Generate a unique token for this submission
            $token = bin2hex(random_bytes(16)); // Generates a 32-character unique token

            // Store the token in the session (or database if preferred)
            session(['campaign_success_token' => $token]);

            // Prepare success message output
            $output = [
                'success' => true,
                'msg' => 'Inserted Successfully!!!',
            ];

            // Redirect to the success route with the token
            return redirect()->route('campaign.details.success', ['token' => $token])->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function campaignApplicantList($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $data['campaign_applicant_lists'] = LeadCampaignDetails::where('business_id', $business_id)
            ->where('crm_campaign_id', $id)
            ->with('user')
            ->latest()
            ->get();

        $data['campaign'] = Campaign::find($id);

        // return $data;
        return view('crm::campaign.campaign_applicant_list', $data);
    }

    public function campaignApplicantDetails($id)
    {
        $business_id = request()->session()->get('user.business_id');

        $data['details'] = LeadCampaignDetails::where('business_id', $business_id)
            ->where('id', $id)
            ->with(['user', 'contact.country'])
            ->first();

        // return $data;
        return view('crm::campaign.campaign_applicant_details', $data);
    }

    public function success($token)
    {
        // Get the token from the session
        $storedToken = session('campaign_success_token');

        // Check if the token matches and exists
        if ($storedToken && $storedToken === $token) {
            // Invalidate the token after use to prevent reuse
            session()->forget('campaign_success_token');

            // Display the success page
            return view('frontend.campaign.success');
        } else {
            // If token doesn't match, redirect to an error page 
            return view('error.404_withoutheader');
        }
    }


    public function fileUpload($file, $path)
    {
        if (!empty($file)) {
            // Get the original name and extension
            $originalName = $file->getClientOriginalName();
            $fileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

            // Move the file to the specified path
            $file->move(public_path($path), $fileName);

            // Return both the path and original name
            return [
                'path' => $path . $fileName,
                'original_name' => $originalName,
            ];
        }

        // Return a structure with nulls if no file is uploaded
        return [
            'path' => null,
            'original_name' => null,
        ];
    }
}
