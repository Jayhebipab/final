<div 
  x-data="{ 
    openAdd: false, 
    openAddStep2: false, 
    openView: false, 
    selectedItem: {},

    closeModal() {
      this.openAddStep2 = false;
      this.openAdd = false;
      this.openView = false;
    },

    openProduct(item) {
      this.selectedItem = item;
      this.openView = true;
    }
  }" 
  class="p-6 bg-gray-100 min-h-screen font-sans"
>

  <h1 class="text-3xl font-bold flex items-center gap-2 mb-6 text-gray-800">
    📋 Inventory
  </h1>

  @if (session('success'))
      <div id="alert-success" class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300 shadow">
        ✅ {{ session('success') }}
      </div>
  @endif
  @if (session('error'))
      <div id="alert-error" class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300 shadow">
        ❌ {{ session('error') }}
      </div>
  @endif

  {{-- 🔍 Search + Add --}}
  <div class="bg-white p-4 rounded-lg shadow flex flex-wrap items-center gap-2 mb-6">
    <input type="text" placeholder="🔍 Search by product name"
      class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900">
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
      Search
    </button>
    <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg font-medium transition">
      Reset
    </button>
    <button 
      @click="openAdd = true" 
      class="ml-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition flex items-center gap-1"
    >
      ➕ Add New
    </button>
  </div>

  {{-- 📋 Product Table --}}
  <div class="bg-white rounded-lg shadow overflow-x-auto">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-800 text-white font-semibold rounded-t-lg">
      <span>🧾 Product List</span>
    </div>
    <table class="w-full text-sm text-center">
      <thead class="text-xs uppercase bg-gray-200 text-gray-700">
        <tr>
          <th class="px-4 py-2">#ID</th>
          <th class="px-4 py-2">Product Name</th>
          <th class="px-4 py-2">Category Name</th>
          <th class="px-4 py-2">Quantity</th>
          <th class="px-4 py-2">Cost Price</th>
          <th class="px-4 py-2">Selling Price</th>
          <th class="px-4 py-2">Action</th>
        </tr>
      </thead>
<tbody class="divide-y divide-gray-100 text-gray-600">
  @forelse ($inventories as $item)
    <tr>
      <td class="px-4 py-2">{{ $item->id }}</td>
      <td class="px-4 py-2">{{ $item->product_name }}</td>
      <td class="px-4 py-2">{{ $item->category }}</td>
      <td class="px-4 py-2">{{ $item->quantity }}</td>
      <td class="px-4 py-2">{{ number_format($item->cost_price, 2) }}</td>
      <td class="px-4 py-2">{{ number_format($item->selling_price, 2) }}</td>
      <td class="px-4 py-2">
                      <button 
                type="button"
                class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium"
                @click="openProduct({
                  id: {{ $item->id }},
                  photo: '{{ asset($item->photo ?? 'images/default.png') }}',
                  title: '{{ $item->product_name ?? '' }}',
                  description: `{{ $item->description ?? '' }}`,
                  category: '{{ $item->category ?? '' }}',
                  selling_price: '{{ $item->selling_price ?? 0 }}',
                  quantity: '{{ $item->quantity ?? 0 }}'
                })"
              >
                👁️ View Product
              </button>
      </td>
    </tr>
  @empty
    <tr>
      <td colspan="6" class="px-4 py-4 text-gray-500 italic">
        No products found in inventory.
      </td>
    </tr>
  @endforelse
</tbody>
    </table>
  </div>
  

  {{-- ➕ ADD PRODUCT MODAL --}}
  <div 
    x-show="openAdd"
    x-transition.opacity.duration.300ms
    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm"
    x-cloak
  >
    <div 
      x-transition.scale.origin.center.duration.300ms
      class="bg-white rounded-xl shadow-2xl max-w-lg w-full overflow-hidden"
    >
      {{-- Header --}}
      <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
        <h3 class="text-lg font-bold text-gray-900">
          ➕ Add New Product — Step <span x-text="openAddStep2 ? '2' : '1'"></span>
        </h3>
        <button 
          @click="closeModal()" 
          class="text-gray-400 hover:text-gray-600 transition text-xl leading-none"
        >
          ✖
        </button>
      </div>

      {{-- Form --}}
      <form action="/submit-product" method="POST" class="relative">
        @csrf

        {{-- STEP 1 --}}
        <div 
          x-show="!openAddStep2" 
          x-transition.opacity.duration.300ms
          class="p-6 space-y-4"
        >
  <div class="hidden">
  <label for="id" class="block text-sm font-semibold text-gray-700">ID</label>
  <input type="text" name="id" id="id"
    class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900">
  </div>


          {{-- ✅ Company Dropdown --}}
          <div>
  <select name="company_name" id="company_name" required
  class="mt-1 w-full border border-gray-300 rounded-md p-2.5 focus:ring-blue-500 focus:border-blue-500 text-gray-800 bg-white">
  <option value="" disabled selected>-- Select Company --</option>
  @foreach ($suppliers as $supplier)
    <option value="{{ $supplier->id }}" class="text-gray-800">
      {{ $supplier->company_name }}
    </option>
  @endforeach

            </select>
          </div>

          <div>
            <label for="date_delivered" class="block text-sm font-semibold text-gray-700">Date Delivered</label>
            <input type="date" name="date_delivered" id="date_delivered" required
              class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        {{-- STEP 2 --}}
        <div 
          x-show="openAddStep2" 
          x-transition.opacity.duration.300ms
          class="p-6 space-y-4"
        >
<div>
  <label for="product_id" class="block text-sm font-semibold text-gray-700">Product ID</label>
  <input type="text" name="product_id" id="product_id" required
    class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900 focus:ring-blue-500 focus:border-blue-500">
</div>

  <div>
  <label for="product_name" class="block text-sm font-semibold text-gray-700">Product Name</label>
  <input type="text" name="product_name" id="product_name" readonly
    class="mt-1 w-full border border-gray-300 rounded-md p-2.5 bg-gray-100 text-gray-900">
  </div>

  <div>
  <label for="category" class="block text-sm font-semibold text-gray-700">Category</label>
  <input type="text" name="category" id="category" readonly
    class="mt-1 w-full border border-gray-300 rounded-md p-2.5 bg-gray-100 text-gray-900">
  </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="cost_price" class="block text-sm font-semibold text-gray-700">Cost Price</label>
              <input type="number" step="0.01" name="cost_price" id="cost_price" required
                class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
              <label for="selling_price" class="block text-sm font-semibold text-gray-700">Selling Price</label>
              <input type="number" step="0.01" name="selling_price" id="selling_price" required
                class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900 focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>

          <div>
            <label for="quantity" class="block text-sm font-semibold text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" required
              class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

       {{-- Footer --}}
<div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 border-t">
  <template x-if="openAddStep2">
    <button 
      type="button" 
      @click="openAddStep2 = false"
      class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium"
    >
      ⬅️ Back
    </button>
  </template>

  <button 
    type="button" 
    @click="closeModal()"
    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium"
  >
    Cancel
  </button>

  <template x-if="!openAddStep2">
    <button 
      type="button" 
      @click="openAddStep2 = true"
      class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium flex items-center gap-1"
    >
      Next ➡️
    </button>
  </template>

  <template x-if="openAddStep2">
    <div class="flex gap-2">
      <button 
        type="submit"
        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium flex items-center gap-1"
      >
        💾 Save Product
      </button>
    </div>
  </template>
          </div>


        </div>
      </form>
    </div>
     {{-- 🖼️ VIEW / UPDATE PRODUCT PANEL --}}
<div 
  x-show="openView" 
  x-transition.opacity.duration.300ms
  class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm"
  x-cloak
>
  <div 
    x-transition.scale.origin.center.duration.300ms
    class="bg-white rounded-xl shadow-2xl max-w-lg w-full overflow-hidden"
  >
    {{-- Header --}}
    <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
      <h3 class="text-lg font-bold text-gray-900">
        🖼️ Product Details
      </h3>
      <button 
        @click="openView = false"
        class="text-gray-400 hover:text-gray-600 transition text-xl leading-none"
      >
        ✖
      </button>
    </div>

    {{-- Form --}}
    <form action="/inventory/update-photo" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
      @csrf
      <input type="hidden" name="id" :value="selectedItem.id">

<div class="text-center">
  <!-- Default or existing photo -->
  <img 
    x-ref="previewImage"
    :src="selectedItem.photo || '/images/default.png'" 
    class="w-40 h-40 object-cover rounded-lg mx-auto border"
    alt="Product Image"
  >
  <p class="text-xs text-gray-500 mt-1 italic">Current Photo Preview</p>
</div>

<div class="mt-4">
  <label for="photo" class="block text-sm font-semibold text-gray-700">Upload New Photo</label>
  <input 
    type="file" 
    name="photo" 
    id="photo"
    accept="image/*"
    class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900"
    @change="
      const file = $event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => $refs.previewImage.src = e.target.result;
        reader.readAsDataURL(file);
      }
    "
  >
</div>

      <div>
        <label class="block text-sm font-semibold text-gray-700">Title</label>
        <input 
          type="text" 
          name="title" 
          :value="selectedItem.title"
          class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900"
        >
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700">Description</label>
        <textarea 
          name="description" 
          rows="3"
          class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900"
          x-text="selectedItem.description"
        ></textarea>
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700">Selling Price</label>
        <input 
          type="number" 
          step="0.01"
          name="selling_price"
          :value="selectedItem.selling_price"
          class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900"
        >
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-700">Quantity</label>
        <input 
          type="number" 
          name="quantity"
          :value="selectedItem.quantity"
          class="mt-1 w-full border border-gray-300 rounded-md p-2.5 text-gray-900"
        >
      </div>

      {{-- Footer --}}
      <div class="pt-4 border-t flex justify-end gap-3">
        <button 
          type="button"
          @click="openView = false"
          class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium"
        >
          Cancel
        </button>

        <button 
          type="submit"
          class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition font-medium flex items-center gap-1"
        >
          ✏️ Update
        </button>
      </div>
    </form>
  </div>
</div>

  </div>

{{-- ✅ Script to update selected company name --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    @endif
});

// 🔍 Auto-fill product details
document.getElementById('product_id').addEventListener('input', function() {
    const productId = this.value.trim();

    if (productId !== '') {
        fetch(`/inventory/get-product/${productId}`)
            .then(response => {
                if (!response.ok) throw new Error('Product not found');
                return response.json();
            })
            .then(data => {
                document.getElementById('product_name').value = data.name || '';
                document.getElementById('category').value = data.category || '';
            })
            .catch(() => {
                document.getElementById('product_name').value = '';
                document.getElementById('category').value = '';
            });
    } else {
        document.getElementById('product_name').value = '';
        document.getElementById('category').value = '';
    }
});

// 🔄 Auto-update supplier name input
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('company_name');
    const input = document.getElementById('selected_company');

    if (select && input) {
        select.addEventListener('change', function() {
            input.value = this.options[this.selectedIndex].text || '';
        });
    }
});
</script>
