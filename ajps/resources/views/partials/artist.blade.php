<div x-data="{ openEdit: false, openAdd: false, openArtworks: false, artist: {}, artworks: [] }" 
     class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-2xl font-semibold flex items-center gap-2 mb-4">
    ✒️ Artists
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

  {{-- 🔍 Search + Add --}}
  <div class="bg-white p-4 rounded-lg shadow mb-6 flex items-center gap-2">
    <input type="text" placeholder="Search by fullname"
      class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-1">
      🔍 Search
    </button>
    <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded flex items-center gap-1">
      ❌ Reset
    </button>
    <button @click="openAdd = true" 
            class="ml-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-1">
      ➕ Add Artist
    </button>
  </div>

  {{-- 📋 Artists Table --}}
  <div class="bg-white rounded-lg shadow overflow-x-auto">
    <div class="flex justify-between items-center px-4 py-3 bg-gray-800 text-white font-semibold rounded-t-lg">
      <span>Artists</span>
    </div>
    <table class="w-full text-sm text-center">
      <thead class="text-xs uppercase bg-gray-200">
        <tr>
          <th class="px-4 py-2">#ID</th>
          <th class="px-4 py-2">Fullname</th>
          <th class="px-4 py-2">Contact Number</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($artists as $artist)
          <tr class="border-b">
            <td class="px-4 py-2">{{ $artist->id }}</td>
            <td class="px-4 py-2">{{ $artist->fullname }}</td>
            <td class="px-4 py-2">{{ $artist->contact_number }}</td>
            <td class="px-4 py-2">{{ $artist->email }}</td>
<td class="px-4 py-2 flex justify-center gap-2">
  {{-- 🎨 View Artworks --}}
<button onclick="openArtworksPanel('{{ $artist->id }}', '{{ $artist->fullname }}', '{{ $artist->description ?? '' }}')"
  class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
  🎨 View Artworks
</button>

              {{-- ✏️ Edit --}}
              <button 
                @click='openEdit = true; artist = @json($artist)' 
                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                ✏️ Edit
              </button>

              {{-- 🗑️ Delete --}}
              <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" 
                    onsubmit="return confirm('Delete this artist?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                  🗑️ Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-3">No artists found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>



  {{-- ✏️ Edit Panel --}}
  <div x-show="openEdit" 
       class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50"
       x-transition>
    <div class="bg-white w-1/3 p-6 shadow-lg relative">
      <button @click="openEdit = false" class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
      <h2 class="text-xl font-semibold mb-4">Edit Artist</h2>
      
      <form :action="'/artists/' + artist.id" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
          <label class="block text-sm">Fullname</label>
          <input type="text" name="fullname" x-model="artist.fullname"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Contact Number</label>
          <input type="text" name="contact_number" x-model="artist.contact_number"
                 class="w-full border rounded px-3 py-2"/>
        </div>
        <div>
          <label class="block text-sm">Email</label>
          <input type="email" name="email" x-model="artist.email"
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

  {{-- ➕ Add Panel --}}
<div x-show="openAdd" 
     class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50"
     x-transition>
  <div class="bg-white w-1/3 p-6 shadow-lg relative">
    <button @click="openAdd = false" 
            class="absolute top-3 right-3 text-gray-600 hover:text-black">✖</button>
    <h2 class="text-xl font-semibold mb-4">Add Artist</h2>
    
    <form action="{{ route('artists.store') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm">Fullname</label>
        <input type="text" name="fullname" class="w-full border rounded px-3 py-2"/>
      </div>
      <div>
        <label class="block text-sm">Contact Number</label>
        <input type="text" name="contact_number" class="w-full border rounded px-3 py-2"/>
      </div>
      <div>
        <label class="block text-sm">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2"/>
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

{{-- 🎨 Edit Artist Panel --}}
<div id="artworksPanel" 
  class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden justify-center items-center transition-opacity duration-300">

  <div id="artworksContent"
    class="bg-white w-full max-w-4xl p-8 rounded-2xl shadow-2xl relative transform scale-95 opacity-0 transition-all duration-300 ease-out h-[90vh] overflow-y-auto">
    
    {{-- Close Button --}}
    <button onclick="closeArtworksPanel()" 
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition-colors text-2xl">
      ✖
    </button>
    
    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Artist Page</h2>

    <form id="artworksForm" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      {{-- Fullname --}}
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Fullname</label>
        <input type="text" name="fullname" id="artist_fullname" 
          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
      </div>

      {{-- Description --}}
      <div>
        <label class="block text-gray-700 font-semibold mb-2">BIO</label>
        <textarea name="description" id="artist_description" rows="4"
           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none" 
      maxlength="255"></textarea>
      </div>

      {{-- 🧑‍🎨 Profile Picture --}}
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Profile Picture</label>

        <!-- Add Profile Button -->
        <button type="button" onclick="document.getElementById('profileFileInput').click()"
          class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors mb-3">
          ➕
        </button>

        <!-- Hidden File Input -->
        <input type="file" id="profileFileInput" accept="image/*" class="hidden">

        <!-- Profile Preview -->
        <div id="profilePreview" class="w-32 h-32 relative rounded-full overflow-hidden shadow hidden">
          <img src="" class="w-full h-full object-cover">
          <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full px-2 py-1 text-xs shadow">✖</button>
        </div>
      </div>

      {{-- Cover Photo (Single) --}}
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Cover Photo</label>

        <!-- Add Cover Button -->
        <button type="button" onclick="document.getElementById('coverFileInput').click()"
          class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors mb-3">
          ➕
        </button>

        <!-- Hidden File Input -->
        <input type="file" id="coverFileInput" accept="image/*" class="hidden">

        <!-- Cover Preview -->
        <div id="coverPreview" class="w-40 h-28 relative rounded-lg overflow-hidden shadow hidden">
          <img src="" class="w-full h-full object-cover">
          <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full px-2 py-1 text-xs shadow">✖</button>
        </div>
      </div>

      {{-- Artwork Images (Multiple) --}}
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Artwork Images</label>

        <!-- Add Image Button -->
        <button type="button" onclick="document.getElementById('hiddenFileInput').click()"
          class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors mb-3">
          ➕
        </button>

        <!-- Hidden File Input -->
        <input type="file" id="hiddenFileInput" accept="image/*" class="hidden">

        <!-- Preview Container -->
        <div id="previewContainer" class="flex flex-wrap gap-3"></div>
      </div>

      {{-- Update Button --}}
      <div class="flex justify-end pt-4">
        <button type="submit"
          class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold shadow-md">
          🔄 Update
        </button>
      </div>
    </form>
  </div>
</div>


{{-- JS for modal open/close + image preview handling --}}
<script>
  // =====================
  // PROFILE PHOTO
  // =====================
  const profileInput = document.getElementById('profileFileInput');
  const profilePreview = document.getElementById('profilePreview');
  const profileImg = profilePreview.querySelector('img');
  const profileRemoveBtn = profilePreview.querySelector('button');

  profileInput.addEventListener('change', () => {
    const file = profileInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = e => {
        profileImg.src = e.target.result;
        profilePreview.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    }
  });

  profileRemoveBtn.addEventListener('click', () => {
    profileInput.value = '';
    profilePreview.classList.add('hidden');
    profileImg.src = '';
  });


  // =====================
  // OPEN ARTWORKS PANEL
  // =====================
  async function openArtworksPanel(artistId) {
    const panel = document.getElementById('artworksPanel');
    const content = document.getElementById('artworksContent');
    const previewContainer = document.getElementById('previewContainer');
    const profilePreview = document.getElementById('profilePreview');
    const coverPreview = document.getElementById('coverPreview');
    const profileImg = document.getElementById('profileImg');
    const coverImg = document.getElementById('coverImg');

    // Clear previous previews
    previewContainer.innerHTML = "";

    try {
      // ✅ Fetch artist with artworks (foreign key: artist_id)
 const response = await fetch(`/artists/${artistId}/artworks`);
      if (!response.ok) throw new Error('Failed to fetch artist data');
      const data = await response.json();

      if (data.error) {
        console.error("Server Error:", data.error);
        alert("Error loading artist artworks: " + data.error);
        return;
      }

      // Fill artist info
      document.getElementById('artist_fullname').value = data.fullname ?? '';
      document.getElementById('artist_description').value = data.description ?? '';

      // Preview profile photo
      if (data.profile_photo) {
        profileImg.src = data.profile_photo;
        profilePreview.classList.remove('hidden');
      } else {
        profilePreview.classList.add('hidden');
      }

      // Preview cover photo
      if (data.cover_photo) {
        coverImg.src = data.cover_photo;
        coverPreview.classList.remove('hidden');
      } else {
        coverPreview.classList.add('hidden');
      }

      // ✅ Show all artworks (loop multiple images)
      if (data.artworks && data.artworks.length > 0) {
        data.artworks.forEach(img => {
          const previewDiv = document.createElement("div");
          previewDiv.classList.add(
            "relative",
            "w-28",
            "h-28",
            "rounded-lg",
            "overflow-hidden",
            "shadow",
            "group"
          );

          previewDiv.innerHTML = `
            <img src="${img}" class="w-full h-full object-cover">
            <button type="button" 
                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full px-2 py-1 text-xs opacity-0 group-hover:opacity-100 transition"
                    onclick="this.parentElement.remove()">✖</button>
          `;
          previewContainer.appendChild(previewDiv);
        });
      }

      // Set dynamic form action
      document.getElementById('artworksForm').action = `/artist/${artistId}/update`;

      // Show modal
      panel.classList.remove('hidden');
      panel.classList.add('flex');

      // Animate in
      setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
      }, 50);

    } catch (err) {
      console.error(err);
      alert('Error loading artist artworks.');
    }
  }


  // =====================
  // CLOSE PANEL
  // =====================
  function closeArtworksPanel() {
    const panel = document.getElementById('artworksPanel');
    const content = document.getElementById('artworksContent');

    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
      panel.classList.remove('flex');
      panel.classList.add('hidden');
    }, 200);
  }


  // =====================
  // COVER PHOTO (single)
  // =====================
  const coverFileInput = document.getElementById('coverFileInput');
  const coverPreview = document.getElementById('coverPreview');
  const coverImg = coverPreview.querySelector("img");
  const coverRemoveBtn = coverPreview.querySelector("button");

  coverFileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = e => {
      coverImg.src = e.target.result;
      coverPreview.classList.remove("hidden");
    };
    reader.readAsDataURL(file);
    this.value = "";
  });

  coverRemoveBtn.addEventListener("click", () => {
    coverPreview.classList.add("hidden");
    coverImg.src = "";
    coverFileInput.value = "";
  });


  // =====================
  // ARTWORK IMAGES (multiple)
  // =====================
  const hiddenFileInput = document.getElementById('hiddenFileInput');
  const previewContainer = document.getElementById('previewContainer');

  hiddenFileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
      const previewDiv = document.createElement("div");
      previewDiv.classList.add("relative", "w-28", "h-28", "rounded-lg", "overflow-hidden", "shadow", "group");

      previewDiv.innerHTML = `
        <img src="${e.target.result}" class="w-full h-full object-cover">
        <button type="button" 
                class="absolute top-1 right-1 bg-red-600 text-white rounded-full px-2 py-1 text-xs opacity-0 group-hover:opacity-100 transition"
                onclick="this.parentElement.remove()">✖</button>
      `;

      previewContainer.appendChild(previewDiv);
    };
    reader.readAsDataURL(file);
    this.value = "";
  });
</script>



