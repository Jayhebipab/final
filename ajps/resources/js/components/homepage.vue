<template>
  <div>
    <!-- HERO -->
    <main class="relative h-screen w-full flex items-center justify-center overflow-hidden">
      <!-- Background Layer -->
      <transition name="fade-bg" mode="out-in">
<div
  :key="currentBg"
  class="absolute inset-0 bg-no-repeat bg-center bg-cover w-full"
  :style="{ backgroundImage: `url(${currentBg})` }"
></div>
      </transition>

      <!-- Dark Overlay -->
      <div class="hero-overlay absolute inset-0"></div>

      <!-- Progress Circle (Top Right) -->
      <div class="hidden md:absolute md:top-5 md:right-5 md:z-20 md:flex">
  <svg class="w-8 h-8 sm:w-12 sm:h-12 transform -rotate-90">
    <!-- Background Circle (light gray track) -->
    <circle
      class="text-gray-500"
      stroke="currentColor"
      stroke-width="3"
      fill="transparent"
      r="20"
      cx="24"
      cy="24"
    />
    <!-- Progress Circle (white stroke) -->
    <circle
      class="text-white transition-all duration-100"
      stroke="currentColor"
      stroke-width="3"
      fill="transparent"
      r="20"
      cx="24"
      cy="24"
      :stroke-dasharray="circumference"
      :stroke-dashoffset="progressOffset"
      stroke-linecap="round"
    />
  </svg>
</div>

      <!-- Content -->
      <div
        class="container mx-auto relative z-10 flex flex-col md:flex-row items-center justify-center px-4 text-white"
      >
        <div class="text-center md:text-left md:w-full">
          <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight mb-4">
            ADRENALINE JUNKY PIERCINKS
          </h1>
          <p class="text-lg md:text-xl font-light leading-relaxed">
            Your destination for professional tattoos and piercings.<br class="hidden md:block">
            We also offer unique tattoo sponsor services for weddings and other events.
          </p>
          <p class="text-sm md:text-base font-light leading-relaxed mt-4">EST. 2019</p>
        </div>
      </div>
    </main>

    <!-- Messenger Button -->
    <a
      href="https://www.facebook.com/messages/t/102727365381254"
      target="_blank"
      class="fixed bottom-5 right-5 z-20 transform transition-transform duration-300 hover:scale-125"
    >
      <img :src="messengerIcon" alt="Messenger" class="h-12 w-12 md:h-14 md:w-14" />
    </a>

    <!-- spacing just for test -->
    <div class="h-[200vh]"></div>
  </div>


  <footer class="bg-gradient-to-t from-black via-gray-900 to-black text-gray-400 py-8 px-4">
  <div class="container mx-auto flex flex-col items-center space-y-6">
    <br><br><br><br><br><br></br>
    
    import fbIcon from '@assets/images/fb.png';
import igIcon from '@assets/images/ig.png';
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
import { ref, onMounted, onBeforeUnmount, computed } from "vue"
import messengerIcon from "@assets/images/mess.png"
import fbIcon from '@assets/images/fb.png';
import igIcon from '@assets/images/ig.png';

// dalawang bg images
import bg1 from "@assets/images/bg.jpg"
import bg2 from "@assets/images/bg3.jpeg"

const currentBg = ref(bg1)

// circle progress
const progress = ref(0) // 0 to 100
const radius = 20
const circumference = 2 * Math.PI * radius
const progressOffset = computed(
  () => circumference - (progress.value / 100) * circumference
)

let progressId

onMounted(() => {
  let index = 0
  const images = [bg1, bg2]

  // update progress every 100ms
  progressId = setInterval(() => {
    progress.value += 1.25 // (100 / (8000ms / 100ms)) = 1.25
    if (progress.value >= 100) {
      progress.value = 0
      index = (index + 1) % images.length
      currentBg.value = images[index]
    }
  }, 100)
})

onBeforeUnmount(() => {
  clearInterval(progressId)
})
</script>

<style>
.hero-overlay {
  background-color: rgba(0, 0, 0, 0.7);
}

/* Fade Transition */
.fade-bg-enter-active,
.fade-bg-leave-active {
  transition: opacity .6s ease;
}
.fade-bg-enter-from,
.fade-bg-leave-to {
  opacity: 0;
}
</style>
