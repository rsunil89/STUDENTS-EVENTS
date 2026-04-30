@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Events
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden fade-in">
        <div class="h-3 gradient-bg"></div>
        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                    <span class="px-4 py-1.5 text-xs text-white rounded-full font-medium inline-flex items-center
                        @if($event->status === 'upcoming') badge-upcoming
                        @elseif($event->status === 'ongoing') badge-ongoing
                        @elseif($event->status === 'completed') badge-completed
                        @else badge-cancelled @endif">
                        <i class="fas fa-circle text-xs mr-1 opacity-75"></i>
                        {{ ucfirst($event->status) }}
                    </span>
                </div>
                @auth
                    @if(Auth::id() === $event->user_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('events.edit', $event) }}" class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center text-white">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Date & Time</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $event->event_date->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $event->event_date->format('g:i A') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg stat-card-green flex items-center justify-center text-white">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Location</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg stat-card-blue flex items-center justify-center text-white">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Capacity</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $event->bookings_count }} / {{ $event->capacity }} booked</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($event->description)
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">About This Event</h2>
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-gray-700 leading-relaxed">{{ $event->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Booking Progress -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-3">Booking Progress</h2>
                <div class="bg-gray-50 rounded-xl p-5">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600"><span class="font-bold text-indigo-600">{{ $event->bookings_count }}</span> confirmed</span>
                        <span class="text-gray-600">{{ $event->capacity }} max</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 ease-out"
                             style="width: {{ $event->capacity > 0 ? min(($event->bookings_count / $event->capacity) * 100, 100) : 0 }}%;
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        @if($event->bookings_count >= $event->capacity)
                            <i class="fas fa-exclamation-triangle text-red-500 mr-1"></i> This event is fully booked!
                        @else
                            <i class="fas fa-info-circle text-indigo-500 mr-1"></i>
                            {{ $event->capacity - $event->bookings_count }} spots remaining
                        @endif
                    </p>
                </div>
            </div>

            <!-- Booking Action -->
            @auth
                @if($event->status !== 'cancelled' && $event->status !== 'completed')
                    @if($isBooked)
                        <div class="bg-green-50 border border-green-200 rounded-xl p-5 text-center">
                            <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                            <p class="text-green-700 font-medium">You're booked for this event!</p>
                            <p class="text-green-600 text-sm mt-1">Check your dashboard for details.</p>
                        </div>
                    @elseif($event->bookings_count < $event->capacity)
                        <form action="{{ route('bookings.store', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-success text-white px-8 py-3 rounded-xl font-medium inline-flex items-center shadow-lg w-full justify-center text-lg">
                                <i class="fas fa-ticket-alt mr-2"></i> Book Now
                            </button>
                        </form>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-xl p-5 text-center">
                            <i class="fas fa-times-circle text-red-500 text-3xl mb-2"></i>
                            <p class="text-red-700 font-medium">Fully Booked</p>
                            <p class="text-red-600 text-sm mt-1">No spots available for this event.</p>
                        </div>
                    @endif
                @else
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 text-center">
                        <i class="fas fa-ban text-gray-400 text-3xl mb-2"></i>
                        <p class="text-gray-600 font-medium">This event is {{ $event->status }}</p>
                    </div>
                @endif
            @else
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-100 rounded-xl p-6 text-center">
                    <i class="fas fa-lock text-indigo-400 text-3xl mb-2"></i>
                    <p class="text-gray-700 font-medium mb-3">Sign in to book this event</p>
                    <a href="{{ route('login') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
