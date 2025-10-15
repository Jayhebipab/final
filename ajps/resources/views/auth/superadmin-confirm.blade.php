@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-2xl p-8">
        <!-- Title -->
        <h2 class="text-2xl font-extrabold text-white text-center mb-6">
            🔑 Super Admin Verification
        </h2>

        <!-- Error Message -->
        @if(session('error'))
            <div class="bg-red-600/90 text-white p-3 rounded-lg mb-4 text-sm text-center shadow">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('dashboard.users.auth.check') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-1">Email Address</label>
                <input type="email" 
                       name="email" 
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="you@example.com" required>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-1">Password</label>
                <input type="password" 
                       name="password" 
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="••••••••" required>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <!-- Confirm -->
                <button type="submit" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold py-2 rounded-lg shadow-lg">
                    Confirm Access
                </button>
                <!-- Cancel -->
                <a href="{{ url('/dashboard') }}" 
                   class="flex-1 bg-gray-500 hover:bg-gray-600 transition-colors text-white font-semibold py-2 rounded-lg shadow-lg text-center">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Hint -->
        <p class="text-xs text-gray-400 text-center mt-6">
            Access restricted to <span class="font-semibold text-blue-400">Super Admin</span> only.
        </p>
    </div>
</div>
@endsection
