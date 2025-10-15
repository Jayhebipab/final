<template>
  <div class="min-h-screen bg-black text-white">
    <!-- 🔹 Cover Photo -->
<div
  class="w-full h-[30vh] md:h-[420px] relative flex items-center md:items-end justify-center px-4"
  style="background-image: url(''); background-size: cover; background-position: center;"
>
  <!-- Overlay para makita text kahit maliwanag yung image -->
  <div class="absolute inset-0 bg-black/50"></div>

  <!-- Title -->
  <h1
    class="relative z-10 text-4xl sm:text-5xl md:text-6xl font-extrabold text-center text-white drop-shadow-lg leading-tight max-w-4xl mb-8 md:mb-20 mt-45"
  >
    ABOUT US
  </h1>
</div>

  </div>

  <footer class="bg-gradient-to-t from-black via-gray-900 to-black text-gray-400 py-8 px-4">
  <div class="container mx-auto flex flex-col items-center space-y-6">
    <br><br><br><br><br><br></br>
    
    <!-- Divider -->

    <!-- Social Icons -->
    <div class="flex space-x-8">
      <a href="https://www.facebook.com/junkypiercing" target="_blank" 
         class="transform transition duration-300 hover:scale-125 hover:drop-shadow-[0_0_8px_#3b82f6]">
        <img :src="fbIcon" alt="Facebook" class="h-9 w-9" />
      </a>
      <a href="https://www.instagram.com/theadrenalinejunkypiercinks/" target="_blank"
         class="transform transition duration-300 hover:scale-125 hover:drop-shadow-[0_0_8px_#ec4899]">
        <img :src="igIcon" alt="Instagram" class="h-9 w-9" />
      </a>
    </div>

    <!-- Footer Text -->
    <p class="text-sm tracking-widest text-gray-400 uppercase font-light">
      © 2024 Adrenaline Junky Piercinks — All Rights Reserved
    </p>
  </div>
</footer>
</template>



<script setup>
import { ref } from "vue";
import fbIcon from '@assets/images/fb.png';
import igIcon from '@assets/images/ig.png';
// Piercing product list (example)
const piercingProducts = ref([
  {
    title: "Basic Ear Piercing",
    description: "Safe and stylish ear piercing jewelry.",
    image: "/images/piercing/ear1.jpg",
    price: 500,
  },
  {
    title: "Nose Piercing",
    description: "Trendy nose piercing jewelry in various styles.",
    image: "/images/piercing/nose1.jpg",
    price: 650,
  },
  {
    title: "Lip Piercing",
    description: "Unique lip piercing with durable metal.",
    image: "/images/piercing/lip1.jpg",
    price: 700,
  },
  {
    title: "Eyebrow Piercing",
    description: "Modern eyebrow piercing designs.",
    image: "/images/piercing/brow1.jpg",
    price: 750,
  },
  {
    title: "Belly Piercing",
    description: "Elegant belly button piercing jewelry.",
    image: "/images/piercing/belly1.jpg",
    price: 900,
  },
  {
    title: "Cartilage Piercing",
    description: "Durable cartilage piercing with stylish look.",
    image: "/images/piercing/cartilage1.jpg",
    price: 800,
  },
]);
</script>
