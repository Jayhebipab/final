
@php
    $suppliers = $suppliers ?? collect();
@endphp

<div x-data="{ openEdit: false, openAdd: false, supplier: {} }" class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
    🏭 Suppliers
  </h1>

  {{-- ✅ Alerts --}}
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

  {{-- Search + Add --}}
  <div class="bg-white p-4 rounded-lg shadow mb-6 flex items-center gap-2">
    <form action="{{ route('suppliers.index') }}" method="GET" class="flex flex-1 gap-2">
      <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Search by phone number"
        class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">🔍 Search</button>
      <a href="{{ route('suppliers.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">❌ Reset</a>
    </form>
    <button @click="openAdd = true" 
            class="ml-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-1">
      ➕ Add Supplier
    </button>
  </div>

  {{-- Supplier Table --}}
  <div class="bg-white rounded-lg shadow overflow-x-auto">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-800 text-white font-semibold rounded-t-lg">
      <span>Suppliers List</span>
    </div>
    <table class="w-full text-sm text-center">
      <thead class="text-xs uppercase bg-gray-200">
        <tr>
          <th class="px-4 py-2">#ID</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Company</th>
          <th class="px-4 py-2">Address</th>
          <th class="px-4 py-2">Contact</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($suppliers as $supplier)
          <tr class="border-b">
            <td class="px-4 py-2">{{ $supplier->id }}</td>
            <td class="px-4 py-2">{{ $supplier->name }}</td>
            <td class="px-4 py-2">{{ $supplier->company_name }}</td>
            <td class="px-4 py-2">{{ $supplier->address }}</td>
            <td class="px-4 py-2">{{ $supplier->contact }}</td>
            <td class="px-4 py-2 flex justify-center gap-2">
              <button @click="openEdit = true; supplier = {{ $supplier->toJson() }}"
                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">✏️ Edit</button>
              <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" 
                    onsubmit="return confirm('Delete this supplier?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">🗑️ Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-gray-500">No suppliers found.</td>
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
      <h2 class="text-xl font-semibold mb-4">Edit Supplier</h2>
      
      <form :action="'/suppliers/' + supplier.id" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
          <label class="block text-sm">Name</label>
          <input type="text" name="name" x-model="supplier.name"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Company</label>
          <input type="text" name="company_name" x-model="supplier.company_name"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Address</label>
          <input type="text" name="address" x-model="supplier.address"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Contact</label>
          <input type="text" name="contact" x-model="supplier.contact"
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

  {{-- 🟢 Add Panel --}}
  <div x-show="openAdd" 
       class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50"
       x-transition>
    <div class="bg-white w-1/3 p-6 shadow-lg relative">
      <button @click="openAdd = false" class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
      <h2 class="text-xl font-semibold mb-4">Add Supplier</h2>
      
      <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-sm">Name</label>
          <input type="text" name="name" class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Company</label>
          <input type="text" name="company_name" class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Address</label>
          <input type="text" name="address" class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Contact</label>
          <input type="text" name="contact" class="w-full border rounded px-3 py-2"/>
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" @click="openAdd = false"
                  class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
          <button type="submit"
                  class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">➕ Add</button>
        </div>
      </form>
    </div>
  </div>
</div>