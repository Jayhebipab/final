<div class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
    Reservation Management
  </h1>

  {{-- Add New Reservation Button --}}
  <div class="mb-6">
    <a href="{{ route('dashboard', ['page' => 'reservation-create']) }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
      ➕ New Reservation
    </a>
  </div>

  {{-- Reservation List --}}
  <div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-lg font-semibold mb-4">Reservation List</h2>
    <table class="min-w-full text-sm">
      <thead class="bg-gray-200 text-gray-600">
        <tr>
          <th class="px-4 py-2">ID</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Phone#</th>
          <th class="px-4 py-2">Preferred date</th>
          <th class="px-4 py-2">Preferred time</th>
          <th class="px-4 py-2">Service</th>
          <th class="px-4 py-2">Instruction</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reservations as $reservation)
          <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">{{ $reservation->id }}</td>
            <td class="px-4 py-2">{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
            <td class="px-4 py-2">{{ $reservation->phone }}</td>
            <td class="px-4 py-2">{{ $reservation->preferred_date }}</td>
            <td class="px-4 py-2">{{ $reservation->location }}</td>
            <td class="px-4 py-2 space-x-2">
              
              {{-- Edit Button with Alert --}}
              <a href="{{ route('reservations.edit.show', $reservation->id) }}"
   class="text-blue-600 hover:underline text-sm">
   Edit
</a>

              {{-- Delete Form --}}
              <form action="{{ route('reservations.destroy', $reservation->id) }}"
                    method="POST"
                    class="inline"
                    onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:underline text-sm">Delete</button>
              </form>

            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
