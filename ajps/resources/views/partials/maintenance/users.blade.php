<div x-data="{ openEdit: false, openCreate: false, user: {} }" class="p-6 bg-gray-100 min-h-screen">

  <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
    👤 Users Management
  </h1>

  {{-- ✅ Alerts --}}
  @if (session('success'))
    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
      ✅ {{ session('success') }}
    </div>
  @endif
  @if (session('error'))
    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
      ❌ {{ session('error') }}
    </div>
  @endif

  {{-- Search + Add --}}
  <div class="bg-white p-4 rounded-lg shadow mb-6 flex items-center gap-2">
    <input type="text" placeholder="Search by name or email"
      class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-1">
      🔍 Search
    </button>
    <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded flex items-center gap-1">
      ❌ Reset
    </button>
    <button @click="openCreate = true" 
            class="ml-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-1">
      ➕ Add User
    </button>
  </div>

  {{-- Users Table --}}
  <div class="bg-white rounded-lg shadow overflow-x-auto">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-800 text-white font-semibold rounded-t-lg">
      <span>Users</span>
    </div>
    <table class="w-full text-sm text-center">
      <thead class="text-xs uppercase bg-gray-200">
        <tr>
          <th class="px-4 py-2">#ID</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Role</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr class="border-b hover:bg-gray-50 transition">
            <td class="px-4 py-2">{{ $user->id }}</td>
            <td class="px-4 py-2">{{ $user->name }}</td>
            <td class="px-4 py-2">{{ $user->email }}</td>
            <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
            <td class="px-4 py-2 flex justify-center gap-2">
              <button @click="openEdit = true; user = {{ $user->toJson() }}"
                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">✏️ Edit</button>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                    onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">🗑️ Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-4 text-gray-500">No users found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- 🟢 Edit Panel --}}
  <div x-show="openEdit" 
       class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50"
       x-transition>
    <div class="bg-white w-1/3 p-6 shadow-lg relative">
      <button @click="openEdit = false" class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
      <h2 class="text-xl font-semibold mb-4">✏️ Edit User</h2>

      <form :action="`/users/${user.id}`" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
          <label class="block text-sm">Name</label>
          <input type="text" name="name" x-model="user.name"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Email</label>
          <input type="email" name="email" x-model="user.email"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Role</label>
          <select name="role" x-model="user.role"
                  class="w-full border rounded px-3 py-2">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
          </select>
        </div>
        <div>
          <label class="block text-sm">New Password (optional)</label>
          <input type="password" name="password" placeholder="New Password"
                 class="w-full border rounded px-3 py-2 mb-2"/>
          <input type="password" name="password_confirmation" placeholder="Confirm Password"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" @click="openEdit = false"
                  class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
          <button type="submit"
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">💾 Save</button>
        </div>
      </form>
    </div>
  </div>

 {{-- 🟢 Create Panel --}}
<div x-show="openCreate" 
     class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50"
     x-transition>
  <div class="bg-white w-1/3 p-6 shadow-lg relative" 
       x-data="{ password: '', confirm: '', email: '', emailExists: false }">
       
    <button @click="openCreate = false" class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
    <h2 class="text-xl font-semibold mb-4">➕ Add User</h2>

    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm">Name</label>
        <input type="text" name="name" required
               class="w-full border rounded px-3 py-2"/>
      </div>

      {{-- ✅ Email with live duplicate check --}}
      <div class="space-y-2">
        <label class="block text-sm">Email</label>
        <input type="email" name="email" x-model="email" required
               @blur="fetch(`/users/check-email?email=${email}`)
                        .then(res => res.json())
                        .then(data => emailExists = data.exists)"
               class="w-full border rounded px-3 py-2"/>

        <p class="text-sm" 
           :class="emailExists ? 'text-red-600' : (email.length > 0 ? 'text-green-600' : 'text-gray-500')">
          <span x-show="email.length === 0">⚪ Enter an email</span>
          <span x-show="email.length > 0 && emailExists">❌ Email already exists</span>
          <span x-show="email.length > 0 && !emailExists">✅ Email available</span>
        </p>
      </div>

      {{-- ✅ Password with live validation --}}
      <div class="space-y-2">
        <label class="block text-sm">Password</label>
        <input type="password" name="password" x-model="password" required
               class="w-full border rounded px-3 py-2"/>
        <p class="text-sm" 
           :class="password.length >= 6 ? 'text-green-600' : 'text-red-600'">
          <span x-show="password.length === 0">⚪ Enter a password (min 6 characters)</span>
          <span x-show="password.length > 0 && password.length < 6">❌ Password too short</span>
          <span x-show="password.length >= 6">✅ Password length OK</span>
        </p>
      </div>

      <div class="space-y-2">
        <label class="block text-sm">Confirm Password</label>
        <input type="password" name="password_confirmation" x-model="confirm" required
               class="w-full border rounded px-3 py-2"/>
        <p class="text-sm"
           :class="confirm.length > 0 && confirm === password ? 'text-green-600' : 'text-red-600'">
          <span x-show="confirm.length === 0">⚪ Please confirm password</span>
          <span x-show="confirm.length > 0 && confirm !== password">❌ Passwords do not match</span>
          <span x-show="confirm.length > 0 && confirm === password">✅ Passwords match</span>
        </p>
      </div>

      <div>
        <label class="block text-sm">Role</label>
        <select name="role" required
                class="w-full border rounded px-3 py-2">
          <option value="admin">Admin</option>
          <option value="staff">Staff</option>
        </select>
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" @click="openCreate = false"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
        <button type="submit"
                :disabled="emailExists"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 disabled:bg-gray-400">➕ Add</button>
      </div>
    </form>
  </div>
</div>
</div>
