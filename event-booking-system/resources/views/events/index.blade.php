@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="hero-section mb-12 -mt-8 pt-12 pb-20 relative" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
    <div class="absolute inset-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1920&q=80"
             alt="Event background"
             class="w-full h-full object-cover opacity-10">
        <div class="absolute inset-0" style="background: linear-gradient(135deg, #1a1a2e 0%, transparent 50%, #0f3460 100%);"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/10 text-indigo-300 text-sm font-medium mb-6 backdrop-blur-sm">
                <i class="fas fa-sparkles mr-2"></i> Discover amazing student events
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 fade-in">
                Discover <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Amazing Events</span>
            </h1>

            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-8">
                Browse through upcoming events, book your spot, and never miss out on the fun!
            </p>

            <div class="flex flex-wrap justify-center gap-4">
                @auth
                    <a href="{{ route('events.create') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-medium inline-flex items-center shadow-xl">
                        <i class="fas fa-plus-circle mr-2"></i> Create Your Event
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-medium inline-flex items-center shadow-xl">
                        <i class="fas fa-user-plus mr-2"></i> Get Started
                    </a>
                @endauth

                <a href="#events-list" class="bg-white/10 backdrop-blur-sm text-white px-8 py-3 rounded-lg font-medium inline-flex items-center hover:bg-white/20 transition-all">
                    <i class="fas fa-arrow-down mr-2"></i> Browse Events
                </a>
            </div>
        </div>
    </div>
</div>

<div id="events-list" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">
    <!-- Category Filters -->
    <div class="flex flex-wrap gap-3 mb-8 justify-center">
        <a href="{{ route('events.index') }}"
           class="category-tag px-5 py-2 rounded-full text-sm font-medium shadow-md {{ request('category') ? 'bg-white text-gray-700 border border-gray-200 hover:bg-indigo-50' : 'bg-indigo-600 text-white' }}">
            <i class="fas fa-th-large mr-1"></i> All Events
        </a>

        <a href="{{ route('events.index', ['category' => 'music']) }}"
           class="category-tag px-5 py-2 rounded-full text-sm font-medium shadow-sm border border-gray-200 {{ request('category') === 'music' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-indigo-50' }}">
            <i class="fas fa-music mr-1"></i> Music
        </a>

        <a href="{{ route('events.index', ['category' => 'academic']) }}"
           class="category-tag px-5 py-2 rounded-full text-sm font-medium shadow-sm border border-gray-200 {{ request('category') === 'academic' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-indigo-50' }}">
            <i class="fas fa-graduation-cap mr-1"></i> Academic
        </a>

        <a href="{{ route('events.index', ['category' => 'sports']) }}"
           class="category-tag px-5 py-2 rounded-full text-sm font-medium shadow-sm border border-gray-200 {{ request('category') === 'sports' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-indigo-50' }}">
            <i class="fas fa-running mr-1"></i> Sports
        </a>

        <a href="{{ route('events.index', ['category' => 'tech']) }}"
           class="category-tag px-5 py-2 rounded-full text-sm font-medium shadow-sm border border-gray-200 {{ request('category') === 'tech' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-indigo-50' }}">
            <i class="fas fa-laptop-code mr-1"></i> Tech
        </a>

        <a href="{{ route('events.index', ['category' => 'arts']) }}"
           class="category-tag px-5 py-2 rounded-full text-sm font-medium shadow-sm border border-gray-200 {{ request('category') === 'arts' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-indigo-50' }}">
            <i class="fas fa-palette mr-1"></i> Arts
        </a>
    </div>

    @if($events->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg fade-in">
            <div class="text-6xl mb-4">🎉</div>

            @if(request('category'))
                <p class="text-gray-500 text-lg mb-4">No {{ ucfirst(request('category')) }} events found.</p>
                <a href="{{ route('events.index') }}" class="btn-primary text-white px-6 py-2 rounded-lg inline-block">
                    Show all events
                </a>
            @else
                <p class="text-gray-500 text-lg mb-4">No events available at the moment.</p>
                @auth
                    <a href="{{ route('events.create') }}" class="btn-primary text-white px-6 py-2 rounded-lg inline-block">
                        Create the first event!
                    </a>
                @endauth
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover fade-in group">
                    <div class="event-card-image-wrapper relative">
                        <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&w=800&q=80"
                             alt="{{ $event->title }}"
                             class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                        <div class="absolute top-3 right-3">
                            <span class="px-3 py-1 text-xs text-white rounded-full font-medium shadow-lg backdrop-blur-sm
                                @if($event->status === 'upcoming') bg-blue-500/90
                                @elseif($event->status === 'ongoing') bg-green-500/90
                                @else bg-gray-500/90 @endif">
                                <i class="fas fa-circle text-xs mr-1 opacity-75"></i>
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>

                        <div class="absolute bottom-3 left-3">
                            <div class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1.5 shadow-lg">
                                <p class="text-xs font-bold text-indigo-600">{{ $event->event_date->format('M') }}</p>
                                <p class="text-lg font-bold text-gray-900 -mt-1">{{ $event->event_date->format('d') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <h2 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1">
                            {{ $event->title }}
                        </h2>

                        <div class="space-y-1.5 mb-3 mt-2">
                            <p class="text-sm text-gray-500">
                                <i class="far fa-clock text-indigo-400 w-4 mr-1"></i>
                                {{ $event->event_date->format('g:i A') }}
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt text-indigo-400 w-4 mr-1"></i>
                                {{ $event->location }}
                            </p>
                        </div>

                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                            {{ Str::limit($event->description, 100) }}
                        </p>

                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span><span class="font-semibold text-indigo-600">{{ $event->bookings_count }}</span> booked</span>
                                <span>{{ $event->capacity }} spots</span>
                            </div>

                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500"
                                     style="width: {{ $event->capacity > 0 ? min(($event->bookings_count / $event->capacity) * 100, 100) : 0 }}%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                            <span class="text-xs text-gray-500">
                                @if($event->bookings_count >= $event->capacity)
                                    <span class="text-red-500 font-medium">Full</span>
                                @else
                                    <span class="text-green-500 font-medium">{{ $event->capacity - $event->bookings_count }} left</span>
                                @endif
                            </span>

                            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors group/btn">
                                View Details
                                <i class="fas fa-arrow-right ml-1 group-hover/btn:translate-x-1 transition-transform"></i>
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