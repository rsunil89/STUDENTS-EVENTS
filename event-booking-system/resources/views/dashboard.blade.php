@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Welcome Header -->
    <div class="hero-section rounded-2xl p-8 mb-8 -mt-4">
        <div class="relative z-10">
            <h1 class="text-3xl font-bold text-white mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-gray-300">Here's what's happening with your events and bookings.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 text-white shadow-lg card-hover">
            <div class="flex items-center justify-between mb-2">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <span class="text-3xl font-bold">{{ $myEventsCount }}</span>
            </div>
            <p class="text-white/80 text-sm font-medium">My Events</p>
        </div>
        <div class="stat-card-green rounded-2xl p-6 text-white shadow-lg card-hover">
            <div class="flex items-center justify-between mb-2">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <span class="text-3xl font-bold">{{ $myBookingsCount }}</span>
            </div>
            <p class="text-white/80 text-sm font-medium">My Bookings</p>
        </div>
        <div class="stat-card-blue rounded-2xl p-6 text-white shadow-lg card-hover">
            <div class="flex items-center justify-between mb-2">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-globe"></i>
                </div>
                <span class="text-3xl font-bold">{{ $totalEvents }}</span>
            </div>
            <p class="text-white/80 text-sm font-medium">Total Events</p>
        </div>
        <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl p-6 text-white shadow-lg card-hover">
            <div class="flex items-center justify-between mb-2">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-users"></i>
                </div>
                <span class="text-3xl font-bold">{{ $totalBookings }}</span>
            </div>
            <p class="text-white/80 text-sm font-medium">Total Bookings</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- My Events -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden fade-in">
            <div class="h-2 gradient-bg"></div>
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-calendar-alt text-indigo-500 mr-2"></i> My Events
                    </h2>
                    <a href="{{ route('events.create') }}" class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
                        <i class="fas fa-plus mr-1"></i> New
                    </a>
                </div>
                @if($myEvents->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-calendar-plus text-4xl mb-3 text-gray-300"></i>
                        <p>You haven't created any events yet.</p>
                        <a href="{{ route('events.create') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium mt-2 inline-block">Create your first event →</a>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($myEvents as $event)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-indigo-50 transition">
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $event->title }}</p>
                                    <p class="text-xs text-gray-500">
                                        <i class="fas fa-calendar mr-1"></i>{{ $event->event_date->format('M d, Y') }}
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-users mr-1"></i>{{ $event->bookings_count }}/{{ $event->capacity }}
                                    </p>
                                </div>
                                <div class="flex items-center space-x-2 ml-4">
                                    <span class="px-2 py-1 text-xs text-white rounded-full font-medium
                                        @if($event->status === 'upcoming') badge-upcoming
                                        @elseif($event->status === 'ongoing') badge-ongoing
                                        @elseif($event->status === 'completed') badge-completed
                                        @else badge-cancelled @endif">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                    <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- My Bookings -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden fade-in">
            <div class="h-2 stat-card-green"></div>
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-ticket-alt text-green-500 mr-2"></i> My Bookings
                </h2>
                @if($myBookings->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-ticket-alt text-4xl mb-3 text-gray-300"></i>
                        <p>You haven't booked any events yet.</p>
                        <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium mt-2 inline-block">Browse events →</a>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($myBookings as $booking)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-green-50 transition">
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $booking->event->title }}</p>
                                    <p class="text-xs text-gray-500">
                                        <i class="fas fa-calendar mr-1"></i>{{ $booking->event->event_date->format('M d, Y') }}
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-map-marker mr-1"></i>{{ $booking->event->location }}
                                    </p>
                                </div>
                                <div class="flex items-center space-x-2 ml-4">
                                    <span class="px-2 py-1 text-xs text-white rounded-full font-medium
                                        @if($booking->status === 'confirmed') badge-confirmed
                                        @else badge-cancelled @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    @if($booking->status === 'confirmed')
                                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Cancel this booking?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mt-8 fade-in">
        <div class="h-2 stat-card-blue"></div>
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-rocket text-blue-500 mr-2"></i> Upcoming Events
            </h2>
            @if($upcomingEvents->isEmpty())
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-calendar-day text-4xl mb-3 text-gray-300"></i>
                    <p>No upcoming events at the moment.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($upcomingEvents as $event)
                        <div class="p-4 bg-gray-50 rounded-xl hover:bg-blue-50 transition card-hover">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-semibold text-gray-900">{{ $event->title }}</h3>
                                <span class="text-xs text-white px-2 py-0.5 rounded-full badge-upcoming">Upcoming</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-1"><i class="fas fa-calendar mr-1"></i>{{ $event->event_date->format('M d, Y g:i A') }}</p>
                            <p class="text-xs text-gray-500 mb-2"><i class="fas fa-map-marker mr-1"></i>{{ $event->location }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500"><i class="fas fa-users mr-1"></i>{{ $event->bookings_count }}/{{ $event->capacity }}</span>
                                <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
