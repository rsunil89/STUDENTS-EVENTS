@extends('layouts.app')

@section('title', 'Events')

@section('content')
<!-- Hero Section -->
<div class="hero-section mb-12 -mt-8 pt-12 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 fade-in">
                Discover <span class="text-indigo-400">Amazing Events</span>
            </h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-8">
                Browse through upcoming events, book your spot, and never miss out on the fun!
            </p>
            @auth
                <a href="{{ route('events.create') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-medium inline-flex items-center shadow-xl">
                    <i class="fas fa-plus-circle mr-2"></i> Create Your Event
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-medium inline-flex items-center shadow-xl">
                    <i class="fas fa-user-plus mr-2"></i> Get Started
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">
    @if($events->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg fade-in">
            <div class="text-6xl mb-4">🎉</div>
            <p class="text-gray-500 text-lg mb-4">No events available at the moment.</p>
            @auth
                <a href="{{ route('events.create') }}" class="btn-primary text-white px-6 py-2 rounded-lg inline-block">Create the first event!</a>
            @endauth
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover fade-in">
                    <div class="h-2 gradient-bg"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h2 class="text-xl font-bold text-gray-900">{{ $event->title }}</h2>
                            <span class="px-3 py-1 text-xs text-white rounded-full font-medium
                                @if($event->status === 'upcoming') badge-upcoming
                                @elseif($event->status === 'ongoing') badge-ongoing
                                @else badge-completed @endif">
                                <i class="fas fa-circle text-xs mr-1 opacity-75"></i>
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                        <div class="space-y-2 mb-4">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-calendar-alt text-indigo-400 w-5"></i>
                                {{ $event->event_date->format('M d, Y g:i A') }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-indigo-400 w-5"></i>
                                {{ $event->location }}
                            </p>
                        </div>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ Str::limit($event->description, 100) }}</p>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-2">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center text-white text-xs font-bold border-2 border-white">👥</div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">
                                    <span class="text-indigo-600 font-bold">{{ $event->bookings_count }}</span>/{{ $event->capacity }}
                                </span>
                            </div>
                            <a href="{{ route('events.show', $event) }}" class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
                                View Details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $events->links() }}
        </div>
    @endif
</div>
@endsection
