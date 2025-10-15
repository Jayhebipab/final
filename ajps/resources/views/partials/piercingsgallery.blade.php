<div class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-2xl font-semibold mb-6">Piercing Gallery — Add / Update</h1>

  {{-- ✅ Success message --}}
  @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
      ✅ {{ session('success') }}
    </div>
  @endif

  <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mb-10">
    <form action="{{ route('piercingsgallery.store') }}" method="POST" enctype="multipart/form-data" id="piercingForm">
      @csrf

      {{-- 🏷️ Header Title --}}
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Header Title</label>
        <input
          type="text"
          name="headertitle"
          value="{{ old('headertitle', $gallery->headertitle ?? '') }}"
          class="w-full p-2 border border-gray-300 rounded-lg"
          placeholder="Enter Piercing Header Title">
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- 💎 Piercing Images Section --}}
        <div>
          <h3 class="text-lg font-semibold text-gray-700 mb-3">
            {{ $gallery->headertitle ?? 'Piercing Collection Images' }}
          </h3>

          {{-- Upload field --}}
          <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 text-gray-500 rounded-lg cursor-pointer">
            <span class="text-3xl font-bold">+</span>
            <input type="file" name="piercingimages[]" id="piercingInput" multiple class="hidden" accept="image/*">
          </label>

          {{-- ✅ Existing + Preview Piercing Images --}}
          @php
            $piercingImgs = [];
            if (!empty($gallery->piercingimages)) {
                if (is_array($gallery->piercingimages)) {
                    $piercingImgs = $gallery->piercingimages;
                } else {
                    $decoded = json_decode($gallery->piercingimages, true);
                    $piercingImgs = is_array($decoded) ? $decoded : explode(',', $gallery->piercingimages);
                }
            }
          @endphp

          <div id="piercingGallery" class="mt-5 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($piercingImgs as $image)
              @if ($image && file_exists(public_path('images/Piercings/' . $image)))
                <div class="relative">
                  <img src="{{ asset('images/Piercings/' . $image) }}" alt="Piercing Image" class="w-full h-32 object-cover rounded-lg border shadow">
                </div>
              @endif
            @endforeach
          </div>
        </div>

        {{-- 💰 Price List Section --}}
        <div>
          {{-- Price list header --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Price List Header</label>
            <input
              type="text"
              name="listheader"
              value="{{ old('listheader', $gallery->listheader ?? '') }}"
              class="w-full p-2 border border-gray-300 rounded-lg"
              placeholder="Enter Price List Header">
          </div>

          <h4 class="text-lg font-semibold text-gray-700 mb-2 border-t pt-3">
            {{ $gallery->listheader ?? 'Piercing Price List & Jewelry' }}
          </h4>

          {{-- Upload field --}}
          <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 text-gray-500 rounded-lg cursor-pointer">
            <span class="text-3xl font-bold">+</span>
            <input type="file" name="pricelistimages[]" id="priceInput" multiple class="hidden" accept="image/*">
          </label>

          {{-- ✅ Existing + Preview Price List --}}
          @php
            $priceImgs = [];
            if (!empty($gallery->pricelistimages)) {
                if (is_array($gallery->pricelistimages)) {
                    $priceImgs = $gallery->pricelistimages;
                } else {
                    $decodedPrice = json_decode($gallery->pricelistimages, true);
                    $priceImgs = is_array($decodedPrice) ? $decodedPrice : explode(',', $gallery->pricelistimages);
                }
            }
          @endphp

          <div id="priceGallery" class="mt-5 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($priceImgs as $img)
              @if ($img && file_exists(public_path('images/listtattoo/' . $img)))
                <div class="relative">
                  <img src="{{ asset('images/listtattoo/' . $img) }}" alt="Price List Image" class="w-full h-32 object-cover rounded-lg border shadow">
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>

      {{-- 💾 Submit Button --}}
      <div class="mt-8 pt-4 border-t">
        <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
          Save Piercing Gallery
        </button>
      </div>
    </form>
  </div>
</div>

{{-- ✅ Live Image Preview --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const piercingInput = document.getElementById('piercingInput');
  const piercingGallery = document.getElementById('piercingGallery');
  const priceInput = document.getElementById('priceInput');
  const priceGallery = document.getElementById('priceGallery');

  // 🖼️ Multiple Piercing Preview
  piercingInput.addEventListener('change', function () {
    [...this.files].forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-full h-32 object-cover rounded-lg border shadow';
        piercingGallery.appendChild(img);
      };
      reader.readAsDataURL(file);
    });
  });

  // 💰 Multiple Price List Preview
  priceInput.addEventListener('change', function () {
    [...this.files].forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-full h-32 object-cover rounded-lg border shadow';
        priceGallery.appendChild(img);
      };
      reader.readAsDataURL(file);
    });
  });
});
</script>
