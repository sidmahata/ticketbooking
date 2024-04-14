<?php

namespace App\Http\Controllers;

use App\Contracts\DistanceCalculator;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Station;
use App\Services\NewBookingService;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('booking.index', ['bookings'=>Booking::with(['fromStation', 'toStation'])->orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('booking.create', ['stations'=>Station::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request, DistanceCalculator $distanceCalculator)
    {
        $bookingService = new NewBookingService($request, $distanceCalculator);
        $bookingService->create();
        return redirect()->route('booking.show', ['booking'=>$bookingService->getNewBooking()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking = Booking::with(['fromStation', 'toStation'])->whereId($booking->id)->first(); 
        return view('booking.show', ['booking'=>$booking]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
