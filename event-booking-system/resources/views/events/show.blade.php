@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-800 transition inline-flex items-center group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Back to Events
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden fade-in">
        <!-- Event Hero Image -->
        <div class="relative h-64 md:h-80 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="px-4 py-1.5 text-xs text-white rounded-full font-medium inline-flex items-center backdrop-blur-sm
                            @if($event->status === 'upcoming') bg-blue-500/80
                            @elseif($event->status === 'ongoing') bg-green-500/80
                            @elseif($event->status === 'completed') bg-gray-500/80
                            @else bg-red-500/80 @endif">
                            <i class="fas fa-circle text-xs mr-1 opacity-75"></i>
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>
                    @auth
                        @if(Auth::id() === $event->user_id)
                            <div class="flex space-x-2">
                                <a href="{{ route('events.edit', $event) }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center hover:bg-white/30 transition-all">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500/80 backdrop-blur-sm text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center hover:bg-red-600/90 transition-all">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $event->title }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-4 card-hover">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Date & Time</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $event->event_date->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $event->event_date->format('g:i A') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 card-hover">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl stat-card-green flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Location</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 card-hover">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl stat-card-blue flex items-center justify-center text-white shadow-lg">
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
                    <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-info-circle text-indigo-500 mr-2"></i> About This Event
                    </h2>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <p class="text-gray-700 leading-relaxed">{{ $event->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Booking Progress -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-chart-bar text-indigo-500 mr-2"></i> Booking Progress
                </h2>
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600"><span class="font-bold text-indigo-600">{{ $event->bookings_count }}</span> confirmed</span>
                        <span class="text-gray-600">{{ $event->capacity }} max</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 ease-out relative"
                             style="width: {{ $event->capacity > 0 ? min(($event->bookings_count / $event->capacity) * 100, 100) : 0 }}%;
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            @if($event->bookings_count > 0)
                                <span class="absolute inset-0 flex items-center justify-center text-[10px] font-bold text-white">
                                    {{ round(($event->bookings_count / $event->capacity) * 100) }}%
                                </span>
                            @endif
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

            <!-- Organizer Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-user-circle text-indigo-500 mr-2"></i> Organized By
                </h2>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-full gradient-bg flex items-center justify-center text-white text-xl font-bold shadow-lg">
                        {{ substr($event->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ $event->user->name }}</p>
                        <p class="text-sm text-gray-500">Event Organizer</p>
                    </div>
                </div>
            </div>

            <!-- Booking Action -->
            @auth
                @if($event->status !== 'cancelled' && $event->status !== 'completed')
                    @if($isBooked)
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6 text-center card-hover">
                            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                            </div>
                            <p class="text-green-700 font-semibold text-lg">You're booked for this event!</p>
                            <p class="text-green-600 text-sm mt-1">Check your dashboard for details.</p>
                            <a href="{{ route('dashboard') }}" class="mt-4 inline-flex items-center text-green-700 font-medium text-sm hover:text-green-800">
                                <i class="fas fa-arrow-right mr-1"></i> Go to Dashboard
                            </a>
                        </div>
                    @elseif($event->bookings_count < $event->capacity)
                        <form action="{{ route('bookings.store', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-success text-white px-8 py-4 rounded-xl font-medium inline-flex items-center shadow-lg w-full justify-center text-lg card-hover">
                                <i class="fas fa-ticket-alt mr-2"></i> Book Now - Secure Your Spot!
                            </button>
                        </form>
                    @else
                        <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-xl p-6 text-center card-hover">
                            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-times-circle text-red-500 text-3xl"></i>
                            </div>
                            <p class="text-red-700 font-semibold text-lg">Fully Booked</p>
                            <p class="text-red-600 text-sm mt-1">No spots available for this event.</p>
                        </div>
                    @endif
                @else
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl p-6 text-center">
                        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-ban text-gray-400 text-3xl"></i>
                        </div>
                        <p class="text-gray-600 font-semibold text-lg">This event is {{ $event->status }}</p>
                    </div>
                @endif
            @else
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-100 rounded-xl p-8 text-center card-hover">
                    <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-lock text-indigo-500 text-3xl"></i>
                    </div>
                    <p class="text-gray-700 font-medium text-lg mb-4">Sign in to book this event</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('login') }}" class="btn-primary text-white px-6 py-3 rounded-lg font-medium inline-flex items-center shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-indigo-600 border-2 border-indigo-200 px-6 py-3 rounded-lg font-medium inline-flex items-center hover:bg-indigo-50 transition-all">
                            <i class="fas fa-user-plus mr-2"></i> Register
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
