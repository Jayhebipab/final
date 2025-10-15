<div class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
    🛒 Shop 
  </h1>

  {{-- ✅ Alerts (Success/Error) --}}
  @if (session('success'))
    <div id="alert-success" class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
      ✅ {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div id="alert-error" class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
      ❌ {{ session('error') }}
    </div>
  @endif

  {{-- Search Bar --}}
  <div class="bg-white p-4 rounded-lg shadow mb-6 flex items-center gap-2">
    <input
      type="text"
      placeholder="Search by phone number"
      class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-1">
      🔍 Search
    </button>
    <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded flex items-center gap-1">
      ❌ Reset
    </button>
  </div>