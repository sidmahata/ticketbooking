<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistanceRequest;
use App\Http\Requests\UpdateDistanceRequest;
use App\Models\Distance;

class DistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistanceRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistanceRequest $request, Distance $distance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distance $distance)
    {
        //
    }
}
