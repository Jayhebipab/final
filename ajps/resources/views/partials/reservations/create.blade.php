<div class="bg-gray-100 min-h-screen font-sans" x-data="{ openReserve: false }">
    <div class="p-8 w-full">
        <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
            ➕ Reservation List     
        </h1>

        <!-- Search & Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow mb-6 flex items-center gap-3 flex-wrap">
            <!-- Search Box -->
            <input
                id="searchInput"
                type="text"
                placeholder="Search by phone number, name, or email..."
                class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            />

            <!-- Status Filter -->
            <select id="statusFilter" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <option value="">All Status</option>
                <option value="Approved">Approved</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Finished">Finished</option>
            </select>

            <!-- Buttons -->
            <button id="searchButton" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-1 transition">
                🔍 Search
            </button>
            <button id="resetButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg flex items-center gap-1 transition">
                ❌ Reset
            </button>
            <button @click="openReserve = true"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-1 transition">
                ➕ Add Reservation
            </button>
        </div>

        <!-- Reservation List Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-gray-800">
            <div class="bg-gray-800 text-white p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Reservation List</h2>
                <div id="resultsCount" class="bg-blue-600 px-3 py-1 rounded-full text-xs font-bold hidden">
                    <span id="countSpan"></span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3">#ID</th>
                            <th class="px-6 py-3">Customer Information</th>
                            <th class="px-6 py-3">Service</th>
                            <th class="px-6 py-3">Reservation Details</th>
                            <th class="px-6 py-3">Instruction</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="reservationsTableBody" class="bg-white divide-y divide-gray-200">
                        @foreach ($reservations as $reservation)
                        <tr class="hover:bg-gray-50 transition"
                            data-name="{{ strtolower($reservation->first_name) }} {{ strtolower($reservation->last_name) }}"
                            data-email="{{ strtolower($reservation->email) }}"
                            data-phone="{{ $reservation->phone }}"
                            data-status="{{ $reservation->status }}"
                            onclick="showReservationDetails({{ json_encode($reservation) }})">
                            <td class="px-6 py-4">#{{ $reservation->id }}</td>
                            <td class="px-4 py-3">
                                <div class="font-semibold">{{ $reservation->first_name }} {{ $reservation->last_name }}</div>
                                <div class="text-xs text-gray-600">📧 {{ $reservation->email }}</div>
                                <div class="text-xs text-gray-600">📞 {{ $reservation->phone }}</div>
                            </td>
                            <td class="px-4 py-3">📅 <strong>{{ $reservation->service }}</strong></td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                📅 {{ \Carbon\Carbon::parse($reservation->preferred_date)->format('M d, Y') }} <br>
                                🕒 {{ date('h:i A', strtotime($reservation->preferred_time)) }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500 truncate max-w-xs">{{ $reservation->instruction }}</td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $reservation->status == 'Approved' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $reservation->status == 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $reservation->status == 'Finished' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    ● {{ $reservation->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-y-2">
                                <form action="{{ route('reservations.finish', $reservation->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs w-full
                                            {{ in_array($reservation->status, ['Cancelled','Finished']) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ in_array($reservation->status, ['Cancelled','Finished']) ? 'disabled' : '' }}>
                                        Finish
                                    </button>
                                </form>
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs w-full
                                            {{ in_array($reservation->status, ['Cancelled','Finished']) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ in_array($reservation->status, ['Cancelled','Finished']) ? 'disabled' : '' }}>
                                        Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 🟢 Centered Reservation Panel -->
    <div x-show="openReserve"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        x-transition>
        <div class="bg-white w-full max-w-lg p-6 shadow-lg rounded-lg relative">
            <button @click="openReserve = false" 
                    class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
            <h2 class="text-xl font-semibold mb-4">➕ Create New Reservation</h2>

            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm">First Name</label>
                    <input type="text" name="first_name" required class="w-full border rounded px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm">Last Name</label>
                    <input type="text" name="last_name" required class="w-full border rounded px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm">Email</label>
                    <input type="email" name="email" required class="w-full border rounded px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm">Phone</label>
                    <input type="text" name="phone" required class="w-full border rounded px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm">Service</label>
                    <input type="text" name="service" required class="w-full border rounded px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm">Preferred Date</label>
                    <input type="date" name="preferred_date" required class="w-full border rounded px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm">Preferred Time</label>
                    <input type="time" name="preferred_time" required class="w-full border rounded px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm">Instruction</label>
                    <textarea name="instruction" rows="3" class="w-full border rounded px-3 py-2 resize-none"></textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const statusFilter = document.getElementById('statusFilter');
    const tableBody = document.getElementById('reservationsTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    const resultsCountDiv = document.getElementById('resultsCount');
    const countSpan = document.getElementById('countSpan');

    // Filter function
    function filterReservations() {
        const searchText = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        let visibleCount = 0;

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const status = row.getAttribute('data-status');

            // HIDE if Pending
            if (status === "Pending") {
                row.style.display = 'none';
                continue;
            }

            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            const phone = row.getAttribute('data-phone');

            const matchesSearch = name.includes(searchText) || email.includes(searchText) || phone.includes(searchText);
            const matchesStatus = statusValue === "" || status === statusValue;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        }

        if (searchText.length > 0 || statusValue !== "") {
            resultsCountDiv.classList.remove('hidden');
            countSpan.textContent = visibleCount + ' Reservations Found';
        } else {
            resultsCountDiv.classList.add('hidden');
        }
    }

    // Event listeners
    searchButton.addEventListener('click', filterReservations);
    searchInput.addEventListener('keyup', filterReservations);
    statusFilter.addEventListener('change', filterReservations);

    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = '';
        filterReservations();
    });
});


</script>
