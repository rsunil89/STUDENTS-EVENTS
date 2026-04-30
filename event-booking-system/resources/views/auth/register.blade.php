@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-5xl fade-in">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <!-- Left Side - Image & Branding -->
            <div class="md:w-1/2 bg-gradient-to-br from-indigo-600 to-purple-700 p-8 md:p-12 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Students" 
                         class="w-full h-full object-cover opacity-20">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/90 to-purple-700/90"></div>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center space-x-2 text-white font-bold text-2xl mb-6">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Event<span class="text-indigo-300">Book</span></span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Join Us Today!</h2>
                    <p class="text-indigo-200 text-lg mb-8">Create your account and start exploring a world of student events and activities.</p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 text-white">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <span class="text-sm">Book tickets to exciting events</span>
                        </div>
                        <div class="flex items-center space-x-3 text-white">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <span class="text-sm">Create and promote your events</span>
                        </div>
                        <div class="flex items-center space-x-3 text-white">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="text-sm">Connect with fellow students</span>
                        </div>
                    </div>
                </div>
                <!-- Decorative circles -->
                <div class="absolute -bottom-10 -right-10 w-40 h-40 border border-white/10 rounded-full"></div>
                <div class="absolute -top-10 -left-10 w-32 h-32 border border-white/10 rounded-full"></div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="md:w-1/2 p-8 md:p-12">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 rounded-2xl gradient-bg flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Create Account</h1>
                    <p class="text-gray-500 text-sm mt-1">Fill in your details to get started</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 pl-10 input-field"
                                placeholder="John Doe">
                        </div>
                        @error('name') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 pl-10 input-field"
                                placeholder="you@student.com">
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 pl-10 input-field"
                                placeholder="Min. 8 characters">
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 pl-10 input-field"
                                placeholder="Confirm your password">
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-primary text-white py-3 rounded-xl font-medium shadow-lg text-base flex items-center justify-center card-hover">
                        <i class="fas fa-user-plus mr-2"></i> Create Account
                    </button>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Sign in</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
