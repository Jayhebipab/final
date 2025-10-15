    <div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-semibold mb-6">Tattoo Gallery — Add / Update</h1>

    {{-- ✅ Success message --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
        ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mb-10">
        <form action="{{ route('tattoogallery.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
        @csrf

        {{-- 🏷️ Header Title --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Header Title</label>
            <input
            type="text"
            name="title_header"
            value="{{ old('title_header', $galleries->first()->headertitle ?? '') }}"
            class="w-full p-2 border border-gray-300 rounded-lg"
            placeholder="Enter Header Title">
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- 🎨 Tattoo Images Section --}}
            <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                {{ $galleries->first()->headertitle ?? 'Tattoo Portfolio Images' }}
            </h3>

            {{-- Upload field --}}
            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 text-gray-500 rounded-lg cursor-pointer">
                <span class="text-3xl font-bold">+</span>
                <input type="file" name="tattoo_images[]" id="tattooInput" multiple class="hidden" accept="image/*">
            </label>

            {{-- ✅ Existing + Preview Tattoo Images --}}
            @php
                $images = [];
                $firstGallery = $galleries->first() ?? null;

                if ($firstGallery && !empty($firstGallery->tattooimages)) {
                    if (is_array($firstGallery->tattooimages)) {
                        $images = $firstGallery->tattooimages;
                    } else {
                        $decoded = json_decode($firstGallery->tattooimages, true);
                        $images = is_array($decoded) ? $decoded : explode(',', $firstGallery->tattooimages);
                    }
                }
            @endphp

            <div id="tattooGallery" class="mt-5 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($images as $image)
                @if ($image && file_exists(public_path('images/Tattoo/' . $image)))
                    <div class="relative">
                    <img src="{{ asset('images/Tattoo/' . $image) }}" alt="Tattoo Image" class="w-full h-32 object-cover rounded-lg border shadow">
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
                name="pricelist_header"
                value="{{ old('pricelist_header', $galleries->first()->listheader ?? '') }}"
                class="w-full p-2 border border-gray-300 rounded-lg"
                placeholder="Enter Price List Header">
            </div>

            <h4 class="text-lg font-semibold text-gray-700 mb-2 border-t pt-3">
                {{ $galleries->first()->listheader ?? 'Price List of Services' }}
            </h4>

            {{-- Upload field --}}
            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 text-gray-500 rounded-lg cursor-pointer">
                <span class="text-3xl font-bold">+</span>
                <input type="file" name="price_images[]" id="priceInput" multiple class="hidden" accept="image/*">
            </label>

            {{-- ✅ Existing + Preview Price List --}}
            @php
                $priceImgs = [];

                if ($firstGallery && !empty($firstGallery->pricelistimages)) {
                    if (is_array($firstGallery->pricelistimages)) {
                        $priceImgs = $firstGallery->pricelistimages;
                    } else {
                        $decodedPrice = json_decode($firstGallery->pricelistimages, true);
                        $priceImgs = is_array($decodedPrice) ? $decodedPrice : explode(',', $firstGallery->pricelistimages);
                    }
                }
            @endphp

            <div id="priceGallery" class="mt-5 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($priceImgs as $img)
                @if ($img && file_exists(public_path('images/pricelist/' . $img)))
                    <div class="relative">
                    <img src="{{ asset('images/pricelist/' . $img) }}" alt="Price List Image" class="w-full h-32 object-cover rounded-lg border shadow">
                    </div>
                @endif
                @endforeach
            </div>
            </div>
        </div>

        {{-- 💾 Submit Button --}}
        <div class="mt-8 pt-4 border-t">
            <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
            Save Tattoo Gallery
            </button>
        </div>
        </form>
    </div>
    </div>

    {{-- ✅ Live Image Preview --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const tattooInput = document.getElementById('tattooInput');
    const tattooGallery = document.getElementById('tattooGallery');
    const priceInput = document.getElementById('priceInput');
    const priceGallery = document.getElementById('priceGallery');

    // 🖼️ Multiple Tattoo Preview
    tattooInput.addEventListener('change', function () {
        [...this.files].forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-full h-32 object-cover rounded-lg border shadow';
            tattooGallery.appendChild(img);
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
