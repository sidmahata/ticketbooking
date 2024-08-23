<?php

namespace App\Http\Controllers;

use App\Contracts\BookingSearch;
use App\Contracts\DistanceCalculator;
use App\Contracts\Report;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Station;
use App\Services\NewBookingService;
use PdfReport;
use ExcelReport;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BookingSearch $bookingSearch)
    {
        $bookings = [];
        if(request()->has('search')){
            $bookings = $bookingSearch->search(request('search'));
        }else{
            $bookings = Booking::with(['fromStation', 'toStation'])->orderBy('id', 'desc')->get();
        }
        return view('booking.index', ['bookings'=>$bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stations = Station::all();
        return view('booking.create', ['stations'=>$stations]);
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
    public function report(Report $report, Request $request){
        $queryBuilder = Booking::with(['fromStation', 'toStation'])->orderBy('id', 'desc');
        $columns = [
            'Client Name' => 'client_name',
            'From Station' => function($result) {
                return $result->fromStation->name;
            },
            'To Station' => function($result) {
                return $result->toStation->name;
            },
            'Total Distance' => 'total_distance',
            'Total Fare' => 'total_fare'
        ];
        return $report->download(
            queryBuilder: $queryBuilder,
            columns: $columns,
            type: $request->type,
            fileName: "Booking Report"
        );
    }
}
