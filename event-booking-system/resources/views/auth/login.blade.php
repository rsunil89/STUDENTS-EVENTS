@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-5xl fade-in">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            <!-- Left Side -->
            <div class="md:w-1/2 bg-gradient-to-br from-indigo-600 to-purple-700 p-8 md:p-12 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" 
                         class="w-full h-full object-cover opacity-20">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/90 to-purple-700/90"></div>
                </div>

                <div class="relative z-10 text-white">
                    <h2 class="text-3xl font-bold mb-4">Welcome Back</h2>
                    <p class="text-indigo-200">Sign in to manage your events</p>
                </div>
            </div>

            <!-- Right Side -->
            <div class="md:w-1/2 p-8 md:p-12">

                <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Sign In</h1>

                {{-- ✅ FIXED FORM (HTTPS) --}}
                <form method="POST" action="{{ secure_url('/login') }}">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full border rounded-lg p-3"
                            placeholder="admin@example.com">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full border rounded-lg p-3"
                            placeholder="password">
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg">
                        Sign In
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
//