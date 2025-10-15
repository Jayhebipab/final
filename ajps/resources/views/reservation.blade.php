<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tattoo Reservation</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black min-h-screen flex items-center justify-center">
  <form action="{{ route('reservation.submit') }}" method="POST" class="bg-black text-white p-8 rounded-lg space-y-6 w-full max-w-xl">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm mb-1">First Name</label>
        <input type="text" name="first_name" class="w-full bg-transparent border border-white px-3 py-2 rounded-md" />
      </div>
      <div>
        <label class="block text-sm mb-1">Last Name</label>
        <input type="text" name="last_name" class="w-full bg-transparent border border-white px-3 py-2 rounded-md" />
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm mb-1">Email *</label>
        <input type="email" name="email" class="w-full bg-transparent border border-white px-3 py-2 rounded-md" required />
      </div>
      <div>
        <label class="block text-sm mb-1">Phone Number *</label>
        <input type="tel" name="phone" class="w-full bg-transparent border border-white px-3 py-2 rounded-md" required />
      </div>
    </div>

    <div>
      <label class="block text-sm mb-1">Preferred Date</label>
      <input type="date" name="preferred_date" class="w-full bg-transparent border border-white px-3 py-2 rounded-md" />
    </div>

    <div>
      <label class="block text-sm mb-1">Preferred Location *</label>
      <select name="location" class="w-full bg-transparent border border-white px-3 py-2 rounded-md text-white" required>
        <option value="" disabled selected>Select a location</option>
        <option value="branch1" class="bg-black">Branch 1</option>
        <option value="branch2" class="bg-black">Branch 2</option>
      </select>
    </div>

    <div>
      <label class="block text-sm mb-1">Info About Your Tattoo *</label>
      <textarea name="tattoo_info" rows="4" class="w-full bg-transparent border border-white px-3 py-2 rounded-md" required></textarea>
    </div>

    <div class="text-center">
      <button type="submit" class="bg-white text-black font-medium px-10 py-2 rounded-md shadow-lg hover:bg-gray-200 transition">
        Send
      </button>
    </div>
  </form>
</body>
</html>
