<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Stay;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        $bookings = Booking::where('owner_id', auth()->id())->get()->sortByDesc("created_at");
        return view('pages.bookings.index', compact('bookings'));
    }

    public function indexOwn() {
        $bookings = Booking::where('user_id', auth()->id())->get()->sortByDesc("created_at");
        return view('pages.bookings.index-own', compact('bookings'));
    }

    public function changeStatus(Request $request) {
        $booking = Booking::where('id',$request->id)->first();
        if($booking->owner_id != auth()->id()) {
            return back()->withErrors(__('errors.you_not_owner'));
        }
        $booking->update(['status' => $request->status]);
        return redirect(route('booking.index'))->with('success', 'статус змінено успішно!');
    }

    public function create(Stay $stay, Request $request) {
        $bookings = Booking::where('stay_id', $stay->id)
            ->where('user_id', auth()->id())
            ->get();
        return view('pages.bookings.makeBooking', compact('stay', 'bookings'));
    }

    public function store(BookingRequest $request) {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        Booking::create($validated);
        return redirect(route('booking.create', $validated['stay_id']))->with('success', 'бронювання проведено, очікуйте на підтвердження власника');
    }
}

