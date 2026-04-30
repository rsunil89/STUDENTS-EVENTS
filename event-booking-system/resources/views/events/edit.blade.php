@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Event
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden fade-in">
        <div class="h-3 gradient-bg"></div>
        <div class="p-8">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center text-white text-xl">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Event</h1>
                    <p class="text-sm text-gray-500">Update your event details</p>
                </div>
            </div>

            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                    @error('title') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">{{ old('description', $event->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Event Date & Time <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="event_date" id="event_date"
                            value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                        @error('event_date') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location <span class="text-red-500">*</span></label>
                        <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                        @error('location') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity <span class="text-red-500">*</span></label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $event->capacity) }}" required min="1"
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3 input-field">
                        @error('capacity') <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
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
                    <button type="submit" class="btn-primary text-white px-8 py-3 rounded-xl font-medium inline-flex items-center shadow-lg">
                        <i class="fas fa-save mr-2"></i> Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
