<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $keywords = [
            'music' => ['music', 'song', 'band', 'concert', 'choir', 'dj'],
            'academic' => ['academic', 'study', 'workshop', 'lecture', 'seminar', 'class', 'revision', 'career'],
            'sports' => ['sports', 'football', 'running', 'gym', 'fitness', 'training', 'match'],
            'tech' => ['tech', 'coding', 'software', 'web', 'database', 'ai', 'cyber', 'laravel', 'react', 'development'],
            'arts' => ['arts', 'design', 'ux', 'creative', 'painting', 'drawing', 'media'],
        ];

        $events = Event::where('status', '!=', 'cancelled')
            ->when($category && isset($keywords[$category]), function ($query) use ($keywords, $category) {
                $query->where(function ($q) use ($keywords, $category) {
                    foreach ($keywords[$category] as $word) {
                        $q->orWhere('title', 'like', '%' . $word . '%')
                          ->orWhere('description', 'like', '%' . $word . '%');
                    }
                });
            })
            ->withCount(['bookings' => function ($q) {
                $q->where('status', 'confirmed');
            }])
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('events.index', compact('events', 'category'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'upcoming';

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        $event->loadCount(['bookings' => function ($q) {
            $q->where('status', 'confirmed');
        }]);

        $isBooked = false;

        if (Auth::check()) {
            $isBooked = $event->bookings()
                ->where('user_id', Auth::id())
                ->where('status', '!=', 'cancelled')
                ->exists();
        }

        return view('events.show', compact('event', 'isBooked'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }
}