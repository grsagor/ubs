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
        $data['regions'] = Region::query()
            ->latest()
            ->get();

        return view('backend.region.index', $data);
    }

    public function create()
    {
        return view('backend.region.create');
    }

    public function store(Request $request, Region $region)
    {
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
        $data = Region::find($id);

        return view('backend.region.edit', compact('data'));
    }

    public function update(Request $request, Region $region)
    {
        try {
            $this->validateJobRequest($request);

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

    protected function validateJobRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name' => 'required|unique:region',

        ], [
            'name.required' => 'The region field is required',
            'name.unique' => 'The region field must be unique',
        ]);
    }
}
