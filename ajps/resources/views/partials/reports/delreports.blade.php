<div x-data="{ openEdit: false, openCreate: false, user: {} }" class="p-6 bg-gray-100 min-h-screen">

  <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
    Delivery Reports
  </h1>

  <!-- Search Section -->
  <div class="bg-white p-4 rounded-lg shadow mb-6 flex items-center gap-2">
    <input type="text" placeholder="Search by Company Name"
      class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-1">
      🔍 Search
    </button>
    <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded flex items-center gap-1">
      ❌ Reset
    </button>
  </div>

  <!-- Reports Table -->
  <div class="bg-white rounded-lg shadow overflow-x-auto">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-800 text-white font-semibold rounded-t-lg">
      <span>Reports</span>
    </div>

    <table class="w-full text-sm text-center">
      <thead class="text-xs uppercase bg-gray-200">
        <tr>
          <th class="px-4 py-2">#ID</th>
          <th class="px-4 py-2">Company Name</th>
          <th class="px-4 py-2">Item Name</th>
          <th class="px-4 py-2">Quantity</th>
          <th class="px-4 py-2">Cost Price</th>
          <th class="px-4 py-2">Date Received</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($deliveries as $delivery)
          <tr class="border-b">
            <td class="px-4 py-2">{{ $delivery->id }}</td>
            <td class="px-4 py-2">{{ $delivery->company_name }}</td>
            <td class="px-4 py-2">{{ $delivery->item_name }}</td>
            <td class="px-4 py-2">{{ $delivery->quantity }}</td>
            <td class="px-4 py-2">₱{{ number_format($delivery->cost_price, 2) }}</td>
            <td class="px-4 py-2">
              {{ \Carbon\Carbon::parse($delivery->date_receive)->format('M d, Y') }}
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="py-4 text-gray-500 italic">No delivery reports found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
