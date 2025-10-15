@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-gray-800 border border-gray-700 rounded-xl shadow">
    <h1 class="text-2xl font-bold text-white mb-6">Edit Reservation</h1>

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-300 mb-1">First Name</label>
                <input type="text" name="first_name" value="{{ $reservation->first_name }}" class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-400" />
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Last Name</label>
                <input type="text" name="last_name" value="{{ $reservation->last_name }}" class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-400" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ $reservation->email }}" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-400" />
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Phone <span class="text-red-500">*</span></label>
                <input type="text" name="phone" value="{{ $reservation->phone }}" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-400" />
            </div>
        </div>

        <div>
            <label class="block text-sm text-gray-300 mb-1">Preferred Date</label>
            <input type="date" name="preferred_date" value="{{ $reservation->preferred_date }}" class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-400" />
        </div>

        <div>
            <label class="block text-sm text-gray-300 mb-1">Preferred Location <span class="text-red-500">*</span></label>
            <select name="location" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-400">
                <option value="branch1" {{ $reservation->location == 'branch1' ? 'selected' : '' }}>Branch 1</option>
                <option value="branch2" {{ $reservation->location == 'branch2' ? 'selected' : '' }}>Branch 2</option>
            </select>
        </div>

        <div>
            <label class="block text-sm text-gray-300 mb-1">Tattoo Info <span class="text-red-500">*</span></label>
            <textarea name="tattoo_info" rows="4" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-400">{{ $reservation->tattoo_info }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-black font-medium px-6 py-2 rounded">
                Update Reservation
            </button>
        </div>
    </form>
</div>
@endsection
