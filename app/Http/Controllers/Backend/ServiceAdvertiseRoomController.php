<?php

namespace App\Http\Controllers\Backend;

use App\ServiceAdvertiseRoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceAdvertiseRoomRequest;
use App\Http\Requests\UpdateServiceAdvertiseRoomRequest;

class ServiceAdvertiseRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.services.advertise_room.advertise');
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
     * @param  \App\Http\Requests\StoreServiceAdvertiseRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceAdvertiseRoomRequest $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceAdvertiseRoomRequest  $request
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceAdvertiseRoomRequest $request, ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }
}
