<?php

namespace App\Http\Controllers\Backend;

use App\Region;
use Illuminate\Http\Request;
use App\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    protected $slug_service;

    public function __construct(SlugService $slug_service)
    {
        $this->slug_service               = $slug_service;
    }

    public function index()
    {
        $this->NotSuperAdmin();

        $data['regions'] = Region::query()
            ->latest()
            ->get();

        return view('backend.region.index', $data);
    }

    public function create()
    {
        $this->NotSuperAdmin();

        return view('backend.region.create');
    }

    public function store(Request $request, Region $region)
    {
        $this->NotSuperAdmin();

        try {
            $requestedData = $request->all();

            $this->validateJobRequest($request);

            $requestedData['business_id']   = Auth::user()->business_id;

            $requestedData['slug'] = $this->slug_service->slug_create($request->name, $region);

            $requestedData                  = $region->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => __('Region inserted successfully.'),
            ];

            return redirect()->route('region.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $this->NotSuperAdmin();

        $data = Region::find($id);

        return view('backend.region.edit', compact('data'));
    }

    public function update(Request $request, Region $region)
    {
        $this->NotSuperAdmin();

        try {
            $this->validateJobRequest($request, $region->id);

            $requestedData = $request->all();

            $region->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => 'Updated Successfully!!!',
            ];
            return redirect()->route('region.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function statusChange($id)
    {
        $this->NotSuperAdmin();

        // Retrieve the region by its ID
        $data = Region::find($id);

        // Toggle the status: if 0, set to 1; if 1, set to 0
        $data->status = $data->status == 0 ? 1 : 0;

        // Save the updated region
        $data->save();

        // Prepare the output message
        $output = [
            'success' => true,
            'msg' => 'Status changed successfully!!!',
        ];

        // Redirect to the region index route with the status message
        return redirect()->back()->with('status', $output);
    }

    protected function validateJobRequest(Request $request, $regionId = null)
    {
        // Determine the validation rules based on the presence of $regionId (whether it's store or update)
        $rules = [
            'name' => [
                'required',
                $regionId ? 'unique:region,name,' . $regionId : 'unique:region,name',
            ]
        ];

        // Validate the request
        $request->validate($rules, [
            'name.required' => 'The region field is required',
            'name.unique' => 'The region field must be unique',
        ]);
    }

    protected function NotSuperAdmin()
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }
    }
}
