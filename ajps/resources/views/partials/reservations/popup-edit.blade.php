<div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
  <div class="bg-white w-full max-w-2xl p-6 rounded-xl shadow-lg relative border border-gray-300">

    {{-- Cancel / Close Button that clears session --}}
    <a href="{{ route('reservations.edit.clear') }}"
       class="absolute top-2 right-3 text-2xl text-gray-500 hover:text-red-500"
       title="Cancel edit">×</a>

    <h1 class="text-2xl font-bold mb-6">Edit Reservation</h1>

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="space-y-5">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm mb-1">First Name</label>
          <input type="text" name="first_name" value="{{ $reservation->first_name }}" class="w-full border px-4 py-2 rounded" />
        </div>
        <div>
          <label class="block text-sm mb-1">Last Name</label>
          <input type="text" name="last_name" value="{{ $reservation->last_name }}" class="w-full border px-4 py-2 rounded" />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm mb-1">Email</label>
          <input type="email" name="email" value="{{ $reservation->email }}" class="w-full border px-4 py-2 rounded" />
        </div>
        <div>
          <label class="block text-sm mb-1">Phone</label>
          <input type="text" name="phone" value="{{ $reservation->phone }}" class="w-full border px-4 py-2 rounded" />
        </div>
      </div>

      <div>
        <label class="block text-sm mb-1">Preferred Date</label>
        <input type="date" name="preferred_date" value="{{ $reservation->preferred_date }}" class="w-full border px-4 py-2 rounded" />
      </div>

      <div>
        <label class="block text-sm mb-1">Location</label>
        <select name="location" class="w-full border px-4 py-2 rounded">
          <option value="branch1" {{ $reservation->location === 'branch1' ? 'selected' : '' }}>Branch 1</option>
          <option value="branch2" {{ $reservation->location === 'branch2' ? 'selected' : '' }}>Branch 2</option>
        </select>
      </div>

      <div>
        <label class="block text-sm mb-1">Tattoo Info</label>
        <textarea name="tattoo_info" rows="4" class="w-full border px-4 py-2 rounded">{{ $reservation->tattoo_info }}</textarea>
      </div>

      <div class="text-right">
        <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-black font-medium px-6 py-2 rounded">
          Update Reservation
        </button>
      </div>
    </form>
  </div>
</div>
