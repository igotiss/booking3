<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Stay;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Stay $stay) {
        $bookings = Booking::where('stay_id', $stay->id)
            ->where('user_id', auth()->id())
            ->get();
        //dd($bookings);

        return view('pages.bookings.makeBooking', compact('stay', 'bookings'));
    }

    public function store(BookingRequest $request) {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        Booking::create($validated);
        return redirect(route('stays.booking.create', $validated['stay_id']))->with('success', 'бронювання проведено, очікуйте на підтвердження власника');

    }
}

