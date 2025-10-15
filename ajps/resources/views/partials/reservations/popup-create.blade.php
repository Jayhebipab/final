<div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
    <div class="bg-gray-800 w-full max-w-2xl p-6 rounded-xl shadow-lg relative border border-gray-700">
        {{-- Close button changed to direct click event for modal --}}
        <a href="{{ route('dashboard', ['page' => 'reservation']) }}" class="absolute top-2 right-3 text-2xl text-gray-500 hover:text-red-500">×</a>

        <h1 class="text-2xl font-bold text-white mb-6">New Reservation</h1>

        <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    {{-- Placeholders instead of labels --}}
                    <input type="text" name="first_name" placeholder="First Name *" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400" />
                </div>
                <div>
                    <input type="text" name="last_name" placeholder="Last Name *" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <input type="email" name="email" placeholder="Email *" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400" />
                </div>
                <div>
                    <input type="text" name="phone" placeholder="Phone Number *" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <input type="text" name="preferred_date" placeholder="mm/dd/yyyy *" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400" onfocus="(this.type='date')" onblur="(this.type='text')" />
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=""></path></svg>
                    </span>
                </div>
                <div class="relative">
                    <select name="preferred_time" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg appearance-none focus:outline-none focus:ring focus:ring-blue-400">
                        <option value="" disabled selected>Preferred Time *</option>
                        {{-- Added more time options --}}
                        <option value="9:00 AM">9:00 AM</option>
                        <option value="10:00 AM">10:00 AM</option>
                        <option value="11:00 AM">11:00 AM</option>
                        <option value="12:00 PM">12:00 PM</option>
                        <option value="1:00 PM">1:00 PM</option>
                        <option value="2:00 PM">2:00 PM</option>
                        <option value="3:00 PM">3:00 PM</option>
                        <option value="4:00 PM">4:00 PM</option>
                        <option value="5:00 PM">5:00 PM</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>

            <div>
                <div class="relative">
                    {{-- Changed name from 'location' to 'service' and updated options --}}
                    <select name="service" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg appearance-none focus:outline-none focus:ring focus:ring-blue-400">
                        <option value="" disabled selected>Select Service *</option>
                        <option value="tattoo">Tattoo</option>
                        <option value="piercing">Piercing</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>

            <div>
                <textarea name="info" rows="4" placeholder="Info About Your Tattoo / Piercing *" required class="w-full bg-gray-900 text-white border border-gray-600 px-4 py-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400"></textarea>
            </div>

            <div class="text-center">
                {{-- Button styling updated to match image --}}
                <button type="submit" class="w-full bg-white text-gray-800 font-bold px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    SEND
                </button>
            </div>
        </form>
    </div>
</div>