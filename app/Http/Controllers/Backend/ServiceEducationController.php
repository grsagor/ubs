<?php

namespace App\Http\Controllers\Backend;

use App\ServiceEducation;
use App\Traits\ImageFileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceEducationRequest;
use App\Http\Requests\UpdateServiceEducationRequest;

class ServiceEducationController extends Controller
{
    use ImageFileUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.services.education.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceEducationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceEducationRequest $request, ServiceEducation $serviceEducation)
    {
        try {
            $requestedData                               = $request->all();

            $requestedData['thumbnail']                  = $this->image($request->file('thumbnail'), 'uploads/service_education/', 800, 500);

            $requestedData['images']                     = $this->image($request->file('images'), 'uploads/service_education/', 800, 500);

            $serviceEducation->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->back()->with('status', $output);
        } catch (\Throwable $e) {

            dd($e->getmessage());

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEducation $serviceEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceEducation $serviceEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceEducationRequest  $request
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceEducationRequest $request, ServiceEducation $serviceEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceEducation  $serviceEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEducation $serviceEducation)
    {
        //
    }
}
