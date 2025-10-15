<div x-data="{ openReserve: false }" class="flex-1">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold flex items-center gap-2">
      📅 Booking Request Management
    </h1>
  </div>


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
        <button @click="openReserve = true"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
      ➕ Reserve
    </button>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-x-auto">
      <div class="flex justify-between items-center px-4 py-3 bg-gray-800 text-white font-semibold rounded-t-lg">
        <span>Booking Requests</span>
        <span class="bg-blue-500 text-white px-3 py-1 text-sm rounded-full">
          {{ $bookings->count() }} Requests Found
        </span>
      </div>
      <table class="w-full text-sm text-left">
        <thead class="text-xs uppercase bg-gray-200">
          <tr>
            <th class="px-4 py-2">#ID</th>
            <th class="px-4 py-2">Customer Information</th>
            <th class="px-4 py-2">Service</th>
            <th class="px-4 py-2">Reservation Details</th>
            <th class="px-4 py-2">Instruction</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $booking)
          {{-- Added onclick event to show modal --}}
          <tr class="border-b hover:bg-gray-50 cursor-pointer" onclick="showBookingModal({{ json_encode($booking) }})">
            <td class="px-4 py-3">#{{ $booking->id }}</td>
            <td class="px-4 py-3">
              <div class="font-semibold">{{ $booking->first_name }} {{ $booking->last_name }}</div>
              <div class="flex items-center gap-1 text-gray-600 text-xs">
                📧 {{ $booking->email }}
              </div>
              <div class="flex items-center gap-1 text-gray-600 text-xs">
                📞 {{ $booking->phone }}
              </div>
            </td>
            <td class="px-4 py-3 text-sm">
              <div class="flex items-center gap-1">
                📅 <strong>Service:</strong> {{ $booking->service }}
              </div>
            </td>
            <td class="px-4 py-3 text-sm italic text-gray-500">
              <div class="flex items-center gap-1">
                📅 <strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}
              </div>
              <div class="flex items-center gap-1">
                🕒 <strong>Time:</strong> {{ $booking->preferred_time }}
              </div>
            </td>
            <td class="px-4 py-3">
              <div class="text-sm italic text-gray-500 max-w-xs truncate overflow-hidden">
                {{ $booking->instruction }}
              </div>
              <div class="text-xs text-gray-500 mt-1">
                Created: {{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}
              </div>
            </td>
            <td class="px-4 py-3">
              <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">
                ● {{ $booking->status }}
              </span>
            </td>
            <td class="px-4 py-3">
              <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" class="mb-2">
                @csrf
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs w-full">
                  Approve
                </button>
              </form>
              <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs w-full">
                  Cancel
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- 🟢 Reserve Panel --}}
  <div x-show="openReserve"
      class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50"
      x-transition>
    <div class="bg-white w-1/3 p-6 shadow-lg relative overflow-y-auto max-h-screen">
      <button @click="openReserve = false" 
              class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
      <h2 class="text-xl font-semibold mb-4">➕ Create New Reservation</h2>

      <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block text-sm">First Name</label>
          <input type="text" name="first_name" required
                class="w-full border rounded px-3 py-2"/>
        </div>

        <div>
          <label class="block text-sm">Last Name</label>
          <input type="text" name="last_name" required
                class="w-full border rounded px-3 py-2"/>
        </div>

        <div>
          <label class="block text-sm">Email</label>
          <input type="email" name="email" required
                class="w-full border rounded px-3 py-2"/>
        </div>

        <div>
          <label class="block text-sm">Phone</label>
          <input type="text" name="phone" required
                class="w-full border rounded px-3 py-2"/>
        </div>

        <div>
          <label class="block text-sm">Service</label>
          <input type="text" name="service" required
                class="w-full border rounded px-3 py-2"/>
        </div>

        <div>
          <label class="block text-sm">Preferred Date</label>
          <input type="date" name="preferred_date" required
                class="w-full border rounded px-3 py-2"/>
        </div>

        <div>
          <label class="block text-sm">Preferred Time</label>
          <input type="time" name="preferred_time" required
                class="w-full border rounded px-3 py-2"/>
        </div>

        <div>
          <label class="block text-sm">Instruction</label>
          <textarea name="instruction" rows="3"
                    class="w-full border rounded px-3 py-2 resize-none"></textarea>
        </div>

        <div class="flex justify-end gap-2">
          <button type="button" @click="openReserve = false"
                  class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
          <button type="submit"
                  class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Create</button>
        </div>
      </form>
    </div>
  </div>

  </div>

  {{-- Booking Modal --}}
  <div id="bookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
      <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-lg">
          <div class="flex justify-between items-center border-b pb-3 mb-4">
              <h2 class="text-xl font-bold text-gray-800">Booking Details</h2>
              <button onclick="hideBookingModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
          </div>
          <div id="modalContent" class="space-y-4 text-gray-700"></div>
      </div>
  </div>

  <script>
      function showBookingModal(booking) {
          const modal = document.getElementById('bookingModal');
          const modalContent = document.getElementById('modalContent');
          
          modalContent.innerHTML = `
              <p><strong>ID:</strong> #${booking.id}</p>
              <p><strong>Name:</strong> ${booking.first_name} ${booking.last_name}</p>
              <p><strong>Email:</strong> ${booking.email}</p>
              <p><strong>Phone:</strong> ${booking.phone}</p>
              <p><strong>Service:</strong> ${booking.service}</p>
              <p><strong>Date:</strong> ${new Date(booking.preferred_date).toLocaleDateString()}</p>
              <p><strong>Time:</strong> ${booking.preferred_time}</p>
              <p><strong>Instruction:</strong></p>
              <pre class="bg-gray-100 p-3 rounded-lg whitespace-pre-wrap overflow-auto max-h-40">${booking.instruction}</pre>
              <p><strong>Status:</strong> <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">${booking.status}</span></p>
              <p class="mt-4"><strong>Received:</strong> ${new Date(booking.created_at).toLocaleString()}</p>
          `;

          // ✅ Use Laravel route() with placeholder
          const actionsDiv = document.createElement('div');
          actionsDiv.className = 'mt-4 flex justify-end space-x-3';
          actionsDiv.innerHTML = `
              <form action="{{ url('/bookings') }}/${booking.id}/approve" method="POST">
                  @csrf
                  <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">Approve</button>
              </form>
              <form action="{{ url('/bookings') }}/${booking.id}/cancel" method="POST">
                  @csrf
                  <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">Cancel</button>
              </form>
          `;
          modalContent.appendChild(actionsDiv);
          
          modal.classList.remove('hidden');
          modal.classList.add('flex');
      }
      
  </script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

