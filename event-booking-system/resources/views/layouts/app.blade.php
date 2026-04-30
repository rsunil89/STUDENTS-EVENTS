<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Event Booking') - EventBook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-nav { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in-left { animation: fadeInLeft 0.5s ease-in; }
        @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        .fade-in-right { animation: fadeInRight 0.5s ease-in; }
        @keyframes fadeInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(102,126,234,0.3); }
        .btn-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); transition: all 0.3s ease; }
        .btn-success:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(17,153,142,0.3); }
        .btn-danger { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); transition: all 0.3s ease; }
        .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(235,51,73,0.3); }
        .stat-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-card-green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .stat-card-blue { background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%); }
        .glass-card { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); }
        .badge-upcoming { background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%); }
        .badge-ongoing { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .badge-completed { background: linear-gradient(135deg, #636e72 0%, #b2bec3 100%); }
        .badge-cancelled { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); }
        .badge-confirmed { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .badge-pending { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .input-field { transition: all 0.3s ease; border: 2px solid #e2e8f0; }
        .input-field:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
        .hero-section { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); position: relative; overflow: hidden; }
        .hero-section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .hero-section::after { content: ''; position: absolute; top: -50%; right: -20%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(102,126,234,0.15) 0%, transparent 70%); border-radius: 50%; }
        .hero-image-card { position: relative; overflow: hidden; }
        .hero-image-card::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 50%; background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); }
        .pulse { animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.7; } }
        .float { animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .shimmer { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent); background-size: 200% 100%; animation: shimmer 2s infinite; }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        .event-card-img { height: 180px; object-fit: cover; width: 100%; }
        .gradient-overlay { background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .bg-pattern-dots { background-image: radial-gradient(circle, #667eea 1px, transparent 1px); background-size: 20px 20px; }
        .text-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .event-card-image-wrapper { height: 200px; overflow: hidden; position: relative; }
        .event-card-image-wrapper img { transition: transform 0.5s ease; }
        .event-card-image-wrapper:hover img { transform: scale(1.1); }
        .category-tag { transition: all 0.3s ease; }
        .category-tag:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(102,126,234,0.3); }
        .feature-icon { transition: all 0.3s ease; }
        .feature-icon:hover { transform: scale(1.1) rotate(5deg); }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="gradient-nav shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('events.index') }}" class="flex items-center space-x-2 text-white font-bold text-xl">
                        <i class="fas fa-calendar-alt text-indigo-400"></i>
                        <span>Event<span class="text-indigo-400">Book</span></span>
                    </a>
                    <div class="ml-10 flex items-center space-x-1">
                        <a href="{{ route('events.index') }}" class="text-gray-300 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                            <i class="fas fa-calendar-day mr-1"></i> Events
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                                <i class="fas fa-chart-pie mr-1"></i> Dashboard
                            </a>
                            <a href="{{ route('events.create') }}" class="text-gray-300 hover:text-white hover:bg-white/10 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                                <i class="fas fa-plus-circle mr-1"></i> Create Event
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <div class="flex items-center space-x-3 bg-white/10 rounded-lg px-4 py-1.5">
                            <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center text-white text-sm font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm text-gray-200 font-medium">{{ Auth::user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-400 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-white/5">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-white/10">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-white px-5 py-2 rounded-lg text-sm font-medium shadow-lg">
                            <i class="fas fa-user-plus mr-1"></i> Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 fade-in">
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-sm flex items-center" role="alert">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 fade-in">
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg shadow-sm flex items-center" role="alert">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="gradient-nav mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-2 text-white font-bold text-lg mb-3">
                        <i class="fas fa-calendar-alt text-indigo-400"></i>
                        <span>Event<span class="text-indigo-400">Book</span></span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Your ultimate student event booking platform. Discover, create, and book events seamlessly.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-gray-400 hover:bg-indigo-500 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-gray-400 hover:bg-indigo-500 hover:text-white transition-all"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-gray-400 hover:bg-indigo-500 hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-gray-400 hover:bg-indigo-500 hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-3">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('events.index') }}" class="text-gray-400 hover:text-indigo-400 transition"><i class="fas fa-chevron-right mr-1 text-xs"></i> Browse Events</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-indigo-400 transition"><i class="fas fa-chevron-right mr-1 text-xs"></i> Dashboard</a></li>
                            <li><a href="{{ route('events.create') }}" class="text-gray-400 hover:text-indigo-400 transition"><i class="fas fa-chevron-right mr-1 text-xs"></i> Create Event</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-3">Categories</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-music mr-2 text-indigo-400"></i> Music & Concerts</li>
                        <li><i class="fas fa-graduation-cap mr-2 text-indigo-400"></i> Academic</li>
                        <li><i class="fas fa-running mr-2 text-indigo-400"></i> Sports</li>
                        <li><i class="fas fa-laptop-code mr-2 text-indigo-400"></i> Tech & Workshops</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-3">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-envelope mr-2 text-indigo-400"></i> support@eventbook.com</li>
                        <li><i class="fas fa-phone mr-2 text-indigo-400"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-map-marker-alt mr-2 text-indigo-400"></i> Dundalk Institute of Technology</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} EventBook. Made with <i class="fas fa-heart text-red-500"></i> for students.</p>
            </div>
        </div>
    </footer>
</body>
</html>
