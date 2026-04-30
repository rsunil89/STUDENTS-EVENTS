@extends('layouts.app')

@section('title', 'Events')

@section('content')
<!-- Hero Section with Background Image -->
<div class="hero-section mb-12 -mt-8 pt-12 pb-20 relative" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
    <div class="absolute inset-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
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
    <!-- Decorative floating elements -->
    <div class="absolute top-20 left-10 w-20 h-20 border border-indigo-500/20 rounded-full float hidden lg:block"></div>
    <div class="absolute bottom-10 right-20 w-32 h-32 border border-purple-500/10 rounded-full float hidden lg:block" style="animation-delay: 1s;"></div>
    <div class="absolute top-40 right-40 w-16 h-16 bg-indigo-500/5 rounded-lg rotate-45 float hidden lg:block" style="animation-delay: 0.5s;"></div>
</div>

<div id="events-list" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">
    @if($events->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg fade-in">
            <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                 alt="No events" 
                 class="w-48 h-48 object-cover rounded-full mx-auto mb-6 shadow-lg">
            <div class="text-6xl mb-4">🎉</div>
            <p class="text-gray-500 text-lg mb-4">No events available at the moment.</p>
            @auth
                <a href="{{ route('events.create') }}" class="btn-primary text-white px-6 py-2 rounded-lg inline-block">Create the first event!</a>
            @endauth
        </div>
    @else
        <!-- Category Filters -->
        <div class="flex flex-wrap gap-3 mb-8 justify-center">
            <button class="category-tag px-5 py-2 rounded-full bg-indigo-600 text-white text-sm font-medium shadow-md">
                <i class="fas fa-th-large mr-1"></i> All Events
            </button>
            <button class="category-tag px-5 py-2 rounded-full bg-white text-gray-700 text-sm font-medium shadow-sm hover:bg-indigo-50 border border-gray-200">
                <i class="fas fa-music mr-1"></i> Music
            </button>
            <button class="category-tag px-5 py-2 rounded-full bg-white text-gray-700 text-sm font-medium shadow-sm hover:bg-indigo-50 border border-gray-200">
                <i class="fas fa-graduation-cap mr-1"></i> Academic
            </button>
            <button class="category-tag px-5 py-2 rounded-full bg-white text-gray-700 text-sm font-medium shadow-sm hover:bg-indigo-50 border border-gray-200">
                <i class="fas fa-running mr-1"></i> Sports
            </button>
            <button class="category-tag px-5 py-2 rounded-full bg-white text-gray-700 text-sm font-medium shadow-sm hover:bg-indigo-50 border border-gray-200">
                <i class="fas fa-laptop-code mr-1"></i> Tech
            </button>
            <button class="category-tag px-5 py-2 rounded-full bg-white text-gray-700 text-sm font-medium shadow-sm hover:bg-indigo-50 border border-gray-200">
                <i class="fas fa-palette mr-1"></i> Arts
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover fade-in group">
                    <!-- Event Image -->
                    <div class="event-card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="{{ $event->title }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <!-- Status Badge on Image -->
                        <div class="absolute top-3 right-3">
                            <span class="px-3 py-1 text-xs text-white rounded-full font-medium shadow-lg backdrop-blur-sm
                                @if($event->status === 'upcoming') bg-blue-500/90
                                @elseif($event->status === 'ongoing') bg-green-500/90
                                @else bg-gray-500/90 @endif">
                                <i class="fas fa-circle text-xs mr-1 opacity-75"></i>
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                        <!-- Date Badge on Image -->
                        <div class="absolute bottom-3 left-3">
                            <div class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1.5 shadow-lg">
                                <p class="text-xs font-bold text-indigo-600">{{ $event->event_date->format('M') }}</p>
                                <p class="text-lg font-bold text-gray-900 -mt-1">{{ $event->event_date->format('d') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-2">
                            <h2 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1">{{ $event->title }}</h2>
                        </div>
                        <div class="space-y-1.5 mb-3">
                            <p class="text-sm text-gray-500">
                                <i class="far fa-clock text-indigo-400 w-4 mr-1"></i>
                                {{ $event->event_date->format('g:i A') }}
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt text-indigo-400 w-4 mr-1"></i>
                                {{ $event->location }}
                            </p>
                        </div>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ Str::limit($event->description, 100) }}</p>
                        
                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span><span class="font-semibold text-indigo-600">{{ $event->bookings_count }}</span> booked</span>
                                <span>{{ $event->capacity }} spots</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500" 
                                     style="width: {{ $event->capacity > 0 ? min(($event->bookings_count / $event->capacity) * 100, 100) : 0 }}%;
                                            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                            <div class="flex items-center space-x-2">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center text-white text-xs font-bold border-2 border-white shadow-sm">
                                        <i class="fas fa-users text-[10px]"></i>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">
                                    @if($event->bookings_count >= $event->capacity)
                                        <span class="text-red-500 font-medium">Full</span>
                                    @else
                                        <span class="text-green-500 font-medium">{{ $event->capacity - $event->bookings_count }} left</span>
                                    @endif
                                </span>
                            </div>
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

<!-- Features Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-8">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Why Choose <span class="text-gradient">EventBook</span>?</h2>
        <p class="text-gray-500">Everything you need to manage student events</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl p-6 shadow-lg text-center card-hover">
            <div class="w-16 h-16 rounded-2xl gradient-bg flex items-center justify-center text-white text-2xl mx-auto mb-4 feature-icon shadow-lg">
                <i class="fas fa-bolt"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Easy Booking</h3>
            <p class="text-gray-500 text-sm">Book your spot in any event with just one click. Instant confirmation and seamless experience.</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-lg text-center card-hover">
            <div class="w-16 h-16 rounded-2xl stat-card-green flex items-center justify-center text-white text-2xl mx-auto mb-4 feature-icon shadow-lg">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Create Events</h3>
            <p class="text-gray-500 text-sm">Organize your own events and manage attendees. Set capacity, track bookings, and more.</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-lg text-center card-hover">
            <div class="w-16 h-16 rounded-2xl stat-card-blue flex items-center justify-center text-white text-2xl mx-auto mb-4 feature-icon shadow-lg">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Secure & Reliable</h3>
            <p class="text-gray-500 text-sm">Your data is safe with us. Secure authentication and reliable booking management system.</p>
        </div>
    </div>
</div>
@endsection
