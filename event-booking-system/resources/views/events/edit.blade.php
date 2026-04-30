@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:text-indigo-800 transition inline-flex items-center group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Back to Event
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden fade-in">
        <!-- Header with Image -->
        <div class="relative h-48 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 alt="Edit event" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Edit Event</h1>
                        <p class="text-gray-300 text-sm">Update your event details</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8">
            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-heading text-indigo-500 mr-1"></i> Event Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                    @error('title') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-align-left text-indigo-500 mr-1"></i> Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">{{ old('description', $event->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-calendar-alt text-indigo-500 mr-1"></i> Event Date & Time <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="event_date" id="event_date"
                            value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                        @error('event_date') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-map-marker-alt text-indigo-500 mr-1"></i> Location <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                        @error('location') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-users text-indigo-500 mr-1"></i> Capacity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $event->capacity) }}" required min="1"
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                        @error('capacity') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-tag text-indigo-500 mr-1"></i> Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                            <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing" {{ old('status', $event->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('events.show', $event) }}" class="text-gray-600 hover:text-gray-800 transition font-medium">Cancel</a>
                    <button type="submit" class="btn-primary text-white px-8 py-3 rounded-xl font-medium inline-flex items-center shadow-lg card-hover">
                        <i class="fas fa-save mr-2"></i> Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
