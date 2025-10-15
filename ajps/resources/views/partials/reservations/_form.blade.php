<form action="{{ $action }}" method="POST" class="space-y-5">
  @csrf
  @if ($method === 'PUT')
    @method('PUT')
  @endif

  {{-- First & Last Name --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm text-gray-300 mb-1">First Name</label>
      <input type="text" name="first_name" value="{{ old('first_name', $reservation->first_name ?? '') }}"
             class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded" />
    </div>
    <div>
      <label class="block text-sm text-gray-300 mb-1">Last Name</label>
      <input type="text" name="last_name" value="{{ old('last_name', $reservation->last_name ?? '') }}"
             class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded" />
    </div>
  </div>

  {{-- Email & Phone --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm text-gray-300 mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email', $reservation->email ?? '') }}"
             class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded" />
    </div>
    <div>
      <label class="block text-sm text-gray-300 mb-1">Phone</label>
      <input type="text" name="phone" value="{{ old('phone', $reservation->phone ?? '') }}"
             class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded" />
    </div>
  </div>

  {{-- Date --}}
  <div>
    <label class="block text-sm text-gray-300 mb-1">Preferred Date</label>
    <input type="date" name="preferred_date" value="{{ old('preferred_date', $reservation->preferred_date ?? '') }}"
           class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded" />
  </div>

  {{-- Location --}}
  <div>
    <label class="block text-sm text-gray-300 mb-1">Location</label>
    <select name="location" class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded">
      <option value="branch1" {{ old('location', $reservation->location ?? '') == 'branch1' ? 'selected' : '' }}>Branch 1</option>
      <option value="branch2" {{ old('location', $reservation->location ?? '') == 'branch2' ? 'selected' : '' }}>Branch 2</option>
    </select>
  </div>

  {{-- Tattoo Info --}}
  <div>
    <label class="block text-sm text-gray-300 mb-1">Tattoo Info</label>
    <textarea name="tattoo_info" rows="4"
              class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-2 rounded">{{ old('tattoo_info', $reservation->tattoo_info ?? '') }}</textarea>
  </div>

  {{-- Submit --}}
  <div class="text-right">
    <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-black font-medium px-6 py-2 rounded">
      {{ $method === 'PUT' ? 'Update Reservation' : 'Create Reservation' }}
    </button>
  </div>
</form>