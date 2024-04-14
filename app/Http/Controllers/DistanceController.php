<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistanceRequest;
use App\Http\Requests\UpdateDistanceRequest;
use App\Models\Distance;
use App\Models\Station;

class DistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('distance.index', ['distances'=>Distance::with(['fromStation', 'toStation'])->orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('distance.create', ['stations'=>Station::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistanceRequest $request)
    {
        Distance::create([
            'from_station_id'=>$request->from_station,
            'to_station_id'=>$request->to_station,
            'distance'=>$request->distance,
        ]);
        return redirect()->route('distance');
    }

    /**
     * Display the specified resource.
     */
    public function show(Distance $distance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distance $distance)
    {
        return view('distance.edit', ['distance'=>$distance, 'stations'=>Station::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistanceRequest $request, Distance $distance)
    {
        $distance->update([
            'from_station_id'=>$request->from_station,
            'to_station_id'=>$request->to_station,
            'distance'=>$request->distance,
        ]);
        return redirect()->route('distance');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distance $distance)
    {
        $distance->delete();
        return redirect()->route('distance');
    }
}
