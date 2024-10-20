<?php

namespace App\Http\Controllers\Backend;

use App\LanguageSpeech;
use Illuminate\Http\Request;
use App\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LanguageSpeechController extends Controller
{
    protected $slug_service;

    public function __construct(SlugService $slug_service)
    {
        $this->slug_service               = $slug_service;
    }

    public function index()
    {
        $this->NotSuperAdmin();

        $data['languages'] = LanguageSpeech::query()
            ->latest()
            ->get();

        return view('backend.languageSpeech.index', $data);
    }

    public function create()
    {
        $this->NotSuperAdmin();

        return view('backend.languageSpeech.create');
    }

    public function store(Request $request, LanguageSpeech $languageSpeech)
    {
        $this->NotSuperAdmin();

        try {
            $requestedData = $request->all();

            $this->validateJobRequest($request);

            $requestedData['business_id']   = Auth::user()->business_id;

            $requestedData['slug'] = $this->slug_service->slug_create($request->name, $languageSpeech);

            $requestedData                  = $languageSpeech->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => __('Language inserted successfully.'),
            ];

            return redirect()->route('language.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $this->NotSuperAdmin();

        $data = LanguageSpeech::find($id);

        return view('backend.languageSpeech.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->NotSuperAdmin();

        try {
            $languageSpeech = LanguageSpeech::find($id);

            $this->validateJobRequest($request, $languageSpeech->id);

            $requestedData = $request->all();

            $languageSpeech->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => 'Updated Successfully!!!',
            ];
            return redirect()->route('language.index')->with('status', $output);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function statusChange($id)
    {
        $this->NotSuperAdmin();

        // Retrieve the languageSpeech by its ID
        $data = LanguageSpeech::find($id);

        // Toggle the status: if 0, set to 1; if 1, set to 0
        $data->status = $data->status == 0 ? 1 : 0;

        // Save the updated languageSpeech
        $data->save();

        // Prepare the output message
        $output = [
            'success' => true,
            'msg' => 'Status changed successfully!!!',
        ];

        // Redirect to the languageSpeech index route with the status message
        return redirect()->back()->with('status', $output);
    }

    protected function validateJobRequest(Request $request, $languageId = null)
    {
        // Set validation rules for storing or updating
        $rules = [
            'name' => [
                'required',
                $languageId ? 'unique:languageSpeech,name,' . $languageId . ',id' : 'unique:languageSpeech,name',
            ],
        ];

        // Perform validation with custom messages
        $request->validate($rules, [
            'name.required' => 'The language field is required',
            'name.unique' => 'The language field must be unique',
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
