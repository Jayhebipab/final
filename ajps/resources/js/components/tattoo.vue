<template>
  <div class="min-h-screen bg-black text-white">
    <!-- 🔹 HEADER SECTION -->
    <div
      class="w-full h-[60vh] md:h-[420px] relative flex items-center md:items-end justify-center px-4"
      style="background-image: url('/images/Tattoo/header-bg.jpg'); background-size: cover; background-position: center;"
    >
      <div class="absolute inset-0 bg-black/50"></div>
      <div class="relative z-10 flex items-center gap-6 mb-12">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white drop-shadow-lg leading-tight">
          {{ titleHeader }}
        </h1>
      </div>
    </div>

    <!-- 🔹 TATTOO IMAGES GRID -->
    <div class="p-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-6xl mx-auto mt-18">
        <div
          v-for="(imageName, index) in tattooImages"
          :key="index"
          class="bg-black rounded-2xl shadow-lg overflow-hidden transform transition hover:scale-105 cursor-pointer"
          @click="openModal(`/images/Tattoo/${imageName}`)"
        >
          <img
            :src="`/images/Tattoo/${imageName}`"
            :alt="'Tattoo Image ' + (index + 1)"
            class="w-full h-72 object-cover"
          />
        </div>
      </div>
    </div>

    <!-- 🔹 PRICE LIST HEADER COVER -->
    <div class="w-full h-[500px] relative mt-20">
      <img
        src="/images/piercing/lip.jpg"
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

    <!-- 🔹 PRICE LIST IMAGES GRID -->
    <div class="p-8 bg-black">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 max-w-6xl mx-auto mt-8">
        <div
          v-for="(imageName, index) in priceListImages"
          :key="index"
          class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden transform transition hover:scale-105 cursor-pointer"
          @click="openModal(`/images/pricelist/${imageName}`)"
        >
          <img
            :src="`/images/pricelist/${imageName}`"
            :alt="'Price ' + (index + 1)"
            class="w-full h-[400px] object-cover"
          />
        </div>
      </div>
    </div>

    <!-- 🔹 MODAL PREVIEW -->
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

// ✅ INITIAL VARIABLES
const titleHeader = ref("Loading...");
const priceListHeader = ref("Loading...");
const tattooImages = ref([]);
const priceListImages = ref([]);
const selectedImage = ref(null);

// ✅ MODAL FUNCTIONS
const openModal = (img) => {
  selectedImage.value = img;
};
const closeModal = () => {
  selectedImage.value = null;
};

// ✅ FETCH DATA FROM LARAVEL CONTROLLER
const fetchGalleryData = async () => {
  try {
    const response = await axios.get("/tattoo-gallery-data"); // ← matches your Laravel route
    const data = response.data;

    titleHeader.value = data.headertitle || "Tattoo Gallery";
    priceListHeader.value = data.listheader || "Tattoo Price List";
    tattooImages.value = data.tattooimages || [];
    priceListImages.value = data.pricelistimages || [];
  } catch (error) {
    console.error("Error fetching gallery data:", error);
    titleHeader.value = "Tattoo Gallery (Error)";
    priceListHeader.value = "Price List (Error)";
  }
};

onMounted(() => {
  fetchGalleryData();
});
</script>

<style scoped>
img {
  transition: transform 0.3s ease;
}
img:hover {
  transform: scale(1.05);
}
</style>
