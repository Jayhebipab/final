<template>
  <div class="min-h-screen bg-black text-white">
    <!-- 🩸 Header Section -->
    <div
      class="w-full h-[60vh] md:h-[420px] relative flex items-center md:items-end justify-center px-4"
      style="background-image: url('/images/Piercings/header.jpg'); background-size: cover; background-position: center;"
    >
      <div class="absolute inset-0 bg-black/50"></div>
      <div class="relative z-10 flex items-center gap-6 mb-12">
        <h1
          class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white drop-shadow-lg leading-tight"
        >
          {{ titleHeader }}
        </h1>
      </div>
    </div>

    <!-- 💎 Piercing Gallery -->
    <div class="p-8">
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-6xl mx-auto mt-18"
      >
        <div
          v-for="(imageName, index) in piercingImages"
          :key="index"
          class="bg-black rounded-2xl shadow-lg overflow-hidden transform transition hover:scale-105 cursor-pointer"
          @click="openModal(`/images/Piercings/${imageName}`)"
        >
          <img
            :src="`/images/Piercings/${imageName}`"
            :alt="'Piercing ' + (index + 1)"
            class="w-full h-72 object-cover"
          />
        </div>
      </div>
    </div>

    <!-- 💰 Price List Header Section -->
    <div class="w-full h-170 relative mt-20">
      <img
        src="/images/listtattoo/cover.jpg"
        alt="Price List Cover"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/50"></div>
      <div class="absolute inset-0 flex items-end justify-center pb-20">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white drop-shadow-lg">
          {{ priceListHeader }}
        </h1>
      </div>
    </div>

    <!-- 💸 Price List Gallery -->
    <div class="p-8 bg-black">
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 max-w-6xl mx-auto mt-8"
      >
        <div
          v-for="(imageName, index) in priceListImages"
          :key="index"
          class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden transform transition hover:scale-105 cursor-pointer"
          @click="openModal(`/images/listtattoo/${imageName}`)"
        >
          <img
            :src="`/images/listtattoo/${imageName}`"
            :alt="'Price ' + (index + 1)"
            class="w-full h-[400px] object-cover"
          />
        </div>
      </div>
    </div>

    <!-- 🖼️ Image Modal -->
    <div
      v-if="selectedImage"
      class="fixed inset-0 bg-black/80 flex items-center justify-center z-50"
      @click="closeModal"
    >
      <img
        :src="selectedImage"
        alt="Fullscreen"
        class="max-w-4xl max-h-[90vh] rounded-lg shadow-2xl"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

// ✅ State
const titleHeader = ref("Loading...");
const priceListHeader = ref("Loading...");
const piercingImages = ref([]);
const priceListImages = ref([]);
const selectedImage = ref(null);

// ✅ Modal methods
const openModal = (img) => {
  selectedImage.value = img;
};

const closeModal = () => {
  selectedImage.value = null;
};

// ✅ Fetch piercing gallery data from Laravel
const fetchGalleryData = async () => {
  try {
    const response = await axios.get("/api/piercing-gallery");
    const data = response.data;

    titleHeader.value = data.headertitle;
    priceListHeader.value = data.listheader;
    piercingImages.value = data.piercingimages;
    priceListImages.value = data.pricelistimages;
  } catch (error) {
    console.error("Error fetching piercing data:", error);
    titleHeader.value = "PIERCING COLLECTIONS (Error)";
    priceListHeader.value = "Price List (Error)";
  }
};

onMounted(() => {
  fetchGalleryData();
});
</script>

<style scoped>
/* Optional: smooth modal fade effect */
.fixed {
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
