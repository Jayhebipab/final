@extends('layouts.app')

@section('title', 'Tattoo Reservation Dashboard')

@section('content')
<div class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 border-b border-gray-700 flex flex-col items-center justify-center">
            <img src="{{ asset('images/pic4.png') }}" alt="Logo" class="h-20" />
            <span class="text-2xl font-bold"></span>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard', ['page' => 'dashboard']) }}"
                class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ $page === 'dashboard' ? 'bg-gray-800' : '' }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('dashboard', ['page' => 'reservation']) }}"
                class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ $page === 'reservation' ? 'bg-gray-800' : '' }}">
                ➕ Reservation
            </a>

            <a href="{{ route('dashboard', ['page' => 'booking']) }}"
                class="flex items-center w-full px-4 py-2 text-left rounded-lg hover:bg-gray-700 transition {{ $page === 'booking' ? 'bg-gray-800' : '' }}">
                📥 Booking Request
            </a>
            
            <a href="{{ route('dashboard', ['page' => 'mainshop']) }}"
                class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ $page === 'mainshop' ? 'bg-gray-800' : '' }}">
                🛒 Shop
            </a>
            <a href="{{ route('dashboard', ['page' => 'tattoogallery']) }}"
                class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ $page === 'tattoogallery' ? 'bg-gray-800' : '' }}">
                Tattoo Gallery
            </a>
            <a href="{{ route('dashboard', ['page' => 'piercingsgallery']) }}"
                class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ $page === 'piercinggallery' ? 'bg-gray-800' : '' }}">
                Piercing Gallery
            </a>
           <a href="{{ route('dashboard', ['page' => 'inventory']) }}"
    class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ $page === 'inventory' ? 'bg-gray-800' : '' }}">
    📋 Inventory
</a>

<a href="{{ route('dashboard', ['page' => 'artist']) }}"
    class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ $page === 'artist' ? 'bg-gray-800' : '' }}">
    ✒️ Artist
</a>
  <div x-data="{ open: {{ in_array($page, ['products', 'equipments', 'suppliers', 'users']) ? 'true' : 'false' }} }" class="relative">
    <button @click="open = !open"
            class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ in_array($page, ['products','equipments','suppliers','users']) ? 'bg-gray-800' : '' }}">
        ⚙️ Maintenance
        <svg class="ml-auto w-4 h-4 transform transition-transform"
             :class="{ 'rotate-180': open }"
             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open" 
         @click.away="open = false"
         x-transition
         class="mt-1 w-full bg-gray-700 rounded-lg shadow-lg overflow-hidden">

        <a href="{{ route('dashboard', ['page' => 'products']) }}"
           class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-600 transition text-gray-200 {{ $page === 'products' ? 'bg-gray-800' : '' }}">
           📦 Product
        </a>

        <a href="{{ route('dashboard', ['page' => 'equipments']) }}"
           class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-600 transition text-gray-200 {{ $page === 'equipments' ? 'bg-gray-800' : '' }}">
           🖌️ Tattoo Equipment
        </a>

        <a href="{{ route('dashboard', ['page' => 'suppliers']) }}"
           class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-600 transition text-gray-200 {{ $page === 'suppliers' ? 'bg-gray-800' : '' }}">
           🚚 Supplier
        </a>

        <a href="{{ route('dashboard', ['page' => 'users']) }}"
           class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-600 transition text-gray-200 {{ $page === 'users' ? 'bg-gray-800' : '' }}">
           👥 Users
        </a>
    </div>
</div>
<div x-data="{ open: {{ in_array($page, ['audtrail', 'delreports']) ? 'true' : 'false' }} }" class="relative">
    <button @click="open = !open"
            class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-700 transition {{ in_array($page, ['audtrail','delreports']) ? 'bg-gray-800' : '' }}">
        📊 Reports
        <svg class="ml-auto w-4 h-4 transform transition-transform"
                :class="{ 'rotate-180': open }"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open" 
         @click.away="open = false"
         x-transition
         class="mt-1 w-full bg-gray-700 rounded-lg shadow-lg overflow-hidden">

        <a href="{{ route('dashboard', ['page' => 'audtrail']) }}"
            class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-600 transition text-gray-200 {{ $page === 'audtrail' ? 'bg-gray-800' : '' }}">
            📑 Audit Trail
        </a>

        <a href="{{ route('dashboard', ['page' => 'delreports']) }}"
            class="flex items-center w-full px-4 py-2 rounded-lg hover:bg-gray-600 transition text-gray-200 {{ $page === 'delreports' ? 'bg-gray-800' : '' }}">
            🚚 Delivery Reports
        </a>
    </div>
</div>

        </nav>

        <a href="{{ route('logout') }}"
            class="m-4 mt-auto px-4 py-2 text-left text-red-500 hover:bg-gray-800 rounded-lg transition">
            🔓 Logout
        </a>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-10 bg-gray-100 overflow-y-auto">
        @if ($page === 'booking')
            {{-- Passing the bookings data to the partial --}}
            @include('partials.booking-requests', ['bookings' => $bookings])

        @elseif ($page === 'reservation')
            {{-- Passing the reservations data to the partial --}}
            @include('partials.reservations.create', ['reservations' => $reservations])

            {{-- New Reservation Popup --}}
            @if (!empty($showCreateForm))
                @include('partials.reservations.popup-create')
            @endif

            @if(session('editReservation'))
            @include('partials.reservations.popup-edit', ['reservation' => session('editReservation')])
            @endif
        @elseif ($page === 'inventory')
            @include('partials.inventory')
        @elseif ($page === 'piercingsgallery')
            @include('partials.piercingsgallery')
        @elseif ($page === 'tattoogallery')
            @include('partials.tattoogallery')
        @elseif ($page === 'mainshop')
            @include('partials.mainshop')
        @elseif ($page === 'artist')
            @include('partials.artist', [
    'artist' => \App\Models\Artist::all()
])
        @elseif ($page === 'users')
            @include('partials.maintenance.users', ['users' => $users])
        @elseif ($page === 'products')
            @include('partials.maintenance.products', ['products' => $products])
        @elseif ($page === 'delreports')
            @include('partials.reports.delreports', ['delreports'])
        @elseif ($page === 'audtrail')
            @include('partials.reports.audtrail', ['audtrail'])  
        @elseif ($page === 'equipments')
            @include('partials.maintenance.equipments', [
    'equipments' => \App\Models\Equipment::all()
])
        @elseif ($page === 'suppliers')
            @include('partials.maintenance.suppliers', ['suppliers'])    
        @else
            <h1 class="text-3xl font-semibold mb-6">Welcome, {{ $name ?? 'Admin' }}</h1>

{{-- 📊 Dashboard Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Total Booking Requests --}}
    <div class="bg-white p-6 rounded-xl shadow flex items-center justify-between border-l-4 border-blue-500 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center space-x-4">
            <div class="bg-blue-100 p-3 rounded-full">📨</div>
            <div>
                <p class="text-sm text-gray-500">Total Booking Requests</p>
                <h2 class="text-2xl font-bold">8</h2>
                <p class="text-sm text-gray-400">All booking requests in system</p>
            </div>
        </div>
        <div class="text-blue-500 text-xl">➔</div>
    </div>

    {{-- Approved Bookings --}}
    <div class="bg-white p-6 rounded-xl shadow flex items-center justify-between border-l-4 border-green-500 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center space-x-4">
            <div class="bg-green-100 p-3 rounded-full">✅</div>
            <div>
                <p class="text-sm text-gray-500">Approved Bookings</p>
                <h2 class="text-2xl font-bold">3</h2>
                <p class="text-sm text-gray-400">Confirmed reservations</p>
            </div>
        </div>
        <div class="text-green-500 text-xl">➔</div>
    </div>

    {{-- Pending Bookings --}}
    <div class="bg-white p-6 rounded-xl shadow flex items-center justify-between border-l-4 border-yellow-500 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center space-x-4">
            <div class="bg-yellow-100 p-3 rounded-full">🕒</div>
            <div>
                <p class="text-sm text-gray-500">Pending Bookings</p>
                <h2 class="text-2xl font-bold">5</h2>
                <p class="text-sm text-gray-400">Awaiting approval</p>
            </div>
        </div>
        <div class="text-yellow-500 text-xl">➔</div>
    </div>

</div>

{{-- 📊 Charts Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Booking Overview Chart --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4">📈 Booking Overview</h2>
        <canvas id="bookingChart" height="150"></canvas>
    </div>

    {{-- Users Overview --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4">👥 Users with Email</h2>
        <div class="flex items-center justify-between mb-4">
            <p class="text-gray-500">Total Registered Users</p>
            <h2 class="text-2xl font-bold text-blue-600">{{ $usersCount ?? 0 }}</h2>
        </div>
        <canvas id="userChart" height="150"></canvas>
    </div>

</div>

{{-- 📊 Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Booking Overview Chart
    const ctxBooking = document.getElementById('bookingChart').getContext('2d');
    new Chart(ctxBooking, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pending', 'Rejected'],
            datasets: [{
                data: [3, 5, 2], // dynamic data dito kung gusto mo
                backgroundColor: ['#22c55e', '#facc15', '#ef4444'],
                borderWidth: 1
            }]
        }
    });

    // User Overview Chart
    const ctxUser = document.getElementById('userChart').getContext('2d');
    new Chart(ctxUser, {
        type: 'bar',
        data: {
            labels: ['With Email', 'Without Email'],
            datasets: [{
                label: 'Users',
                data: [{{ $usersWithEmail ?? 0 }}, {{ $usersWithoutEmail ?? 0 }}],
                backgroundColor: ['#3b82f6', '#9ca3af']
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>

        @endif
    </main>
</div>



<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
