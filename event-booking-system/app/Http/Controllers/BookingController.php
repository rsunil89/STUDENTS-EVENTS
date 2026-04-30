<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if ($event->status === 'cancelled' || $event->status === 'completed') {
            return back()->with('error', 'Cannot book a cancelled or completed event.');
        }

        if ($event->event_date < now()) {
            return back()->with('error', 'Cannot book a past event.');
        }

        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'You have already booked this event.');
        }

        $confirmedCount = $event->bookings()->where('status', 'confirmed')->count();
        if ($confirmedCount >= $event->capacity) {
            return back()->with('error', 'This event is fully booked.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'status' => 'confirmed',
        ]);

        return back()->with('success', 'Successfully booked the event!');
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
