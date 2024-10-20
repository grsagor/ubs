<?php

namespace App\Http\Controllers\Backend;

use App\Special;
use Illuminate\Http\Request;
use App\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SpecialController extends Controller
{
    protected $slug_service;

    public function __construct(SlugService $slug_service)
    {
        $this->slug_service               = $slug_service;
    }

    public function index()
    {
        $this->NotSuperAdmin();

        $data['specials'] = Special::query()
            ->latest()
            ->get();

        return view('backend.special.index', $data);
    }

    public function create()
    {
        $this->NotSuperAdmin();

        return view('backend.special.create');
    }

    public function store(Request $request, Special $speical)
    {
        $this->NotSuperAdmin();

        try {
            $requestedData = $request->all();

            $requestedData['business_id']   = Auth::user()->business_id;

            $requestedData['slug'] = $this->slug_service->slug_create($request->name, $speical);

            $requestedData                  = $speical->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => __('Inserted successfully.'),
            ];

            return redirect()->route('special.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $this->NotSuperAdmin();

        $data = Special::find($id);

        return view('backend.special.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->NotSuperAdmin();

        try {
            $special = Special::find($id);

            $requestedData = $request->all();

            $special->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => 'Updated Successfully!!!',
            ];
            return redirect()->route('special.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function statusChange($id)
    {
        $this->NotSuperAdmin();

        // Retrieve the special by its ID
        $data = Special::find($id);

        // Toggle the status: if 0, set to 1; if 1, set to 0
        $data->status = $data->status == 0 ? 1 : 0;

        // Save the updated special
        $data->save();

        // Prepare the output message
        $output = [
            'success' => true,
            'msg' => 'Status changed successfully!!!',
        ];

        // Redirect to the special index route with the status message
        return redirect()->back()->with('status', $output);
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
