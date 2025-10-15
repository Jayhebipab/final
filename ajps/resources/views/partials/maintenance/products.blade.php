<div x-data="{ openEdit: false, openAdd: false, product: {} }" class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
    Product
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
    <input type="text" placeholder="Search by product name"
      class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-1">
      🔍 Search
    </button>
    <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded flex items-center gap-1">
      ❌ Reset
    </button>
    <button @click="openAdd = true" 
            class="ml-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-1">
      ➕ Add Product
    </button>
  </div>

  {{-- Product Table --}}
  <div class="bg-white rounded-lg shadow overflow-x-auto">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-800 text-white font-semibold rounded-t-lg">
      <span>Products</span>
    </div>
    <table class="w-full text-sm text-center">
      <thead class="text-xs uppercase bg-gray-200">
        <tr>
          <th class="px-4 py-2">#ID</th>
          <th class="px-4 py-2">Product Name</th>
          <th class="px-4 py-2">Category Name</th>
          <th class="px-4 py-2">Cost Price</th>
          <th class="px-4 py-2">Selling Price</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr class="border-b">
            <td class="px-4 py-2">{{ $product->id }}</td>
            <td class="px-4 py-2">{{ $product->name }}</td>
            <td class="px-4 py-2">{{ $product->category }}</td>
            <td class="px-4 py-2">₱{{ number_format($product->cost_price, 2) }}</td>
            <td class="px-4 py-2">₱{{ number_format($product->selling_price, 2) }}</td>
            <td class="px-4 py-2 flex justify-center gap-2">
              <button @click="openEdit = true; product = {{ $product->toJson() }};"
                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">✏️ Edit</button>
              <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                    onsubmit="return confirm('Delete this product?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">🗑️ Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- 🟢 Edit Panel --}}
  <div x-show="openEdit" 
       class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50"
       x-transition>
    <div class="bg-white w-1/3 p-6 shadow-lg relative">
      <button @click="openEdit = false" class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
      <h2 class="text-xl font-semibold mb-4">Edit Product</h2>
      
      <form :action="'/products/' + product.id" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
          <label class="block text-sm">Product Name</label>
          <input type="text" name="name" x-model="product.name"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Category</label>
          <input type="text" name="category" x-model="product.category"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Cost Price</label>
          <input type="number" step="0.01" name="cost_price" x-model="product.cost_price"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Selling Price</label>
          <input type="number" step="0.01" name="selling_price" x-model="product.selling_price"
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
      <h2 class="text-xl font-semibold mb-4">Add Product</h2>
      
      <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-sm">Product Name</label>
          <input type="text" name="name" class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Category</label>
          <input type="text" name="category" class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Cost Price</label>
          <input type="number" step="0.01" name="cost_price" class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Selling Price</label>
          <input type="number" step="0.01" name="selling_price" class="w-full border rounded px-3 py-2"/>
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
