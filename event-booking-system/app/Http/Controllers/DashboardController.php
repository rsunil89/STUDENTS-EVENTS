<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $myEvents = Event::where('user_id', $user->id)->latest()->get();

        $myBookings = Booking::where('user_id', $user->id)
            ->with('event')
            ->latest()
            ->get();

        $upcomingEvents = Event::where('status', 'upcoming')
            ->where('event_date', '>=', now())
            ->latest()
            ->take(6)
            ->get();

        $myEventsCount = $myEvents->count();
        $myBookingsCount = $myBookings->count();
        $upcomingEventsCount = $upcomingEvents->count();

        return view('dashboard', compact(
            'myEvents',
            'myBookings',
            'upcomingEvents',
            'myEventsCount',
            'myBookingsCount',
            'upcomingEventsCount'
        ));
    }
}