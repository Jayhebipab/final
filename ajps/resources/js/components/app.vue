<template>
  <div id="app">
    <!-- 🔽 Age Verification Modal -->
    <div 
      v-if="showAgeModal"
      class="fixed inset-0 flex items-center justify-center min-h-screen text-white bg-cover bg-center z-[9999]"
      :style="{ backgroundImage: `url(${under18Bg})` }"
    >
      <!-- overlay -->
      <div class="absolute inset-0 bg-black/70"></div>

      <!-- modal box -->
      <div class="relative z-10 bg-white text-black p-8 rounded-lg max-w-md w-full text-center shadow-xl">
        <h2 class="text-2xl font-bold mb-4">Age Verification</h2>
        <p class="mb-6">Are you 18 years old or above?</p>
        <div class="flex justify-center gap-4">
          <button  
            @click="confirmAge(true)"
            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
          >
            Yes, I am 18+
          </button>
          <button
            @click="confirmAge(false)"
            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
          >
            No, I’m under 18
          </button>
        </div>
      </div>
    </div>

    <!-- 🔹 Navbar -->
    <header
      ref="headerRef"
      id="main-header"
      class="fixed top-0 w-full z-50 p-5 transition-all duration-500 ease-in-out"
    >
      <div class="container mx-auto flex justify-between items-center px-4">
        <div class="flex-shrink-0">
          <img
            :src="logo"
            alt="Adrenaline Junky Piercinks"
            class="h-24 md:h-28 lg:h-32 rounded-full"
          />
        </div>

        <nav class="hidden md:flex space-x-8 items-center mr-27">
          <router-link to="/" class="uppercase font-medium transition hover:text-gray-400" exact-active-class="text-gray-400">Home</router-link>
          <router-link to="/about" class="uppercase font-medium transition hover:text-gray-400" exact-active-class="text-gray-400">About</router-link>

          <div class="relative group">
            <router-link to="/gallery" class="uppercase font-medium transition hover:text-gray-400" exact-active-class="text-gray-400">
              Artists
            </router-link>
            <div class="absolute hidden group-hover:block text-white pt-6 pb-2 w-48 -mt-5 left-1/2 transform -translate-x-1/2 text-center">
              <router-link to="/gallery/artists/Cara-Nicolas" class="block py-2 hover:text-gray-400 transition-all duration-300" exact-active-class="text-gray-400">Cara Nicolas</router-link>
              <router-link to="/gallery/artists/leo-Botulan" class="block py-2 hover:text-gray-400 transition-all duration-300" exact-active-class="text-gray-400">Leo Botulan</router-link>
              <router-link to="/gallery/artists/Ivan-Nicolas" class="block py-2 hover:text-gray-400 transition-all duration-300" exact-active-class="text-gray-400">Ivan Nicolas</router-link>
              <router-link to="/gallery/artists/Jr-Barro" class="block py-2 hover:text-gray-400 transition-all duration-300" exact-active-class="text-gray-400">JR Barro</router-link>
            </div>
          </div>

          <router-link to="/tattoo" class="uppercase font-medium transition hover:text-gray-400" exact-active-class="text-gray-400">Tattoo</router-link>
          <router-link to="/piercing" class="uppercase font-medium transition hover:text-gray-400" exact-active-class="text-gray-400">Piercing</router-link>
          <router-link to="/shop" class="uppercase font-medium transition hover:text-gray-400" exact-active-class="text-gray-400">Shop</router-link>
          <router-link to="/contactt" class="uppercase font-medium transition hover:text-gray-400" exact-active-class="text-gray-400">Contact</router-link>
          <router-link to="/contactt" class="py-2 px-4 border border-white rounded-full text-white hover:bg-white hover:text-black transition-all font-semibold uppercase">BOOK NOW!</router-link>
        </nav>

        <button @click="toggleMenu" class="md:hidden text-white focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path v-if="!menuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Mobile nav -->
      <div v-show="menuOpen" class="md:hidden bg-black bg-opacity-90 mt-2 rounded-lg py-4">
        <ul class="flex flex-col space-y-4 text-center">
          <li><router-link @click="menuOpen = false" to="/" class="text-white hover:text-gray-400 uppercase font-medium">Home</router-link></li>
          <li><router-link @click="menuOpen = false" to="/about" class="text-white hover:text-gray-400 uppercase font-medium">About</router-link></li>
          <li class="relative">
            <button @click="toggleGalleryMobile" class="text-white hover:text-gray-400 uppercase font-medium focus:outline-none">
              Artists
              <svg :class="{ 'rotate-180': galleryMobileOpen }" class="inline-block w-4 h-4 ml-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
            <ul v-show="galleryMobileOpen" class="flex flex-col space-y-2 mt-2 bg-gray-900/70 p-2 rounded">
              <li><router-link @click="closeAllMenus" to="/gallery/tattoos" class="block text-white hover:text-gray-400">Cara Nicolas</router-link></li>
              <li><router-link @click="closeAllMenus" to="/gallery/piercings" class="block text-white hover:text-gray-400">Leo Botulan</router-link></li>
              <li><router-link @click="closeAllMenus" to="/gallery/art" class="block text-white hover:text-gray-400">Ivan Nicolas</router-link></li>
              <li><router-link @click="closeAllMenus" to="/gallery/art" class="block text-white hover:text-gray-400">JR Barro</router-link></li>
            </ul>
          </li>
          <li><router-link @click="menuOpen = false" to="/tattoo" class="text-white hover:text-gray-400 uppercase font-medium">Tattoo</router-link></li>
          <li><router-link @click="menuOpen = false" to="/artist" class="text-white hover:text-gray-400 uppercase font-medium">Piercing</router-link></li>
          <li><router-link @click="menuOpen = false" to="/shop" class="text-white hover:text-gray-400 uppercase font-medium">Shop</router-link></li>
          <li><router-link @click="menuOpen = false" to="/contactt" class="text-white hover:text-gray-400 uppercase font-medium">Contact</router-link></li>
          <li>
            <router-link @click="menuOpen = false" to="/contactt" class="py-2 px-4 border border-white rounded-full text-white hover:bg-white hover:text-black transition-all font-semibold uppercase">BOOK NOW!</router-link>
          </li>
        </ul>
      </div>
    </header>

    <!-- 🔹 Homepage Hero -->
    <div v-if="$route.name === 'homepage'">
      <main :style="heroBgStyle" class="relative h-screen w-full flex items-center justify-center">
        <div class="hero-overlay absolute inset-0"></div>
        <div class="container mx-auto relative z-10 flex flex-col md:flex-row items-center justify-center px-4 text-white">
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

      <!-- socials -->
      <div class="fixed bottom-5 left-5 z-20 flex flex-col space-y-4">
        <a href="https://www.instagram.com/theadrenalinejunkypiercinks/" target="_blank" class="transform transition-transform duration-300 hover:scale-125">
          <img :src="igIcon" alt="Instagram" class="h-12 w-12 md:h-14 md:w-14">
        </a>
        <a href="https://www.facebook.com/junkypiercing" target="_blank" class="transform transition-transform duration-300 hover:scale-125">
          <img :src="fbIcon" alt="Facebook" class="h-12 w-12 md:h-14 md:w-14">
        </a>
      </div>

      <a href="https://www.facebook.com/messages/t/102727365381254" target="_blank" class="fixed bottom-5 right-5 z-20 transform transition-transform duration-300 hover:scale-125">
        <img :src="messengerIcon" alt="Messenger" class="h-12 w-12 md:h-14 md:w-14">
      </a>
    </div>

    <!-- 🔹 Page Transition -->
    <main>
      <transition name="fade-slide" mode="out-in">
        <router-view v-slot="{ Component }">
          <component :is="Component" />
        </router-view>
      </transition>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import logo from '@assets/images/pic4.png';
import fbIcon from '@assets/images/fb.png';
import igIcon from '@assets/images/ig.png';
import messengerIcon from '@assets/images/mess.png';
import heroBg from '@assets/images/bg.jpg';
import under18Bg from "@assets/images/18bg.png";

const menuOpen = ref(false);
const galleryMobileOpen = ref(false);
const showAgeModal = ref(true);

function toggleMenu() {
  menuOpen.value = !menuOpen.value;
  if (!menuOpen.value) {
    galleryMobileOpen.value = false;
  }
}

function toggleGalleryMobile() {
  galleryMobileOpen.value = !galleryMobileOpen.value;
}

function closeAllMenus() {
  menuOpen.value = false;
  galleryMobileOpen.value = false;
}

function confirmAge(isAdult) {
  if (isAdult) {
    showAgeModal.value = false;
  } else {
    window.location.href = "https://google.com";
  }
}

const heroBgStyle = `background-image: url(${heroBg}); background-size: cover; background-position: center;`;

const headerRef = ref(null);

onMounted(() => {
  const link = document.createElement('link');
  link.rel = 'icon';
  link.type = 'image/png';
  link.href = logo;
  document.head.appendChild(link);
});

onMounted(() => {
  let lastScrollY = window.scrollY;
  let accumulatedScrollUp = 0;
  const revealThreshold = 250; 
  const hideThreshold = 200; 

  const handleScroll = () => {
    const header = headerRef.value;
    if (!header) return;

    if (window.scrollY > 0) {
      header.classList.add("bg-black", "bg-opacity-50", "backdrop-blur-sm");
    } else {
      header.classList.remove("bg-black", "bg-opacity-50", "backdrop-blur-sm");
    }

    if (window.scrollY > lastScrollY && window.scrollY > hideThreshold) {
      header.classList.add("-translate-y-full");
      accumulatedScrollUp = 0;
    }
    else if (window.scrollY < lastScrollY) {
      accumulatedScrollUp += lastScrollY - window.scrollY;
      if (accumulatedScrollUp >= revealThreshold) {
        header.classList.remove("-translate-y-full");
      }
    }

    if (window.scrollY === 0) {
      header.classList.remove(
        "bg-black",
        "bg-opacity-50",
        "backdrop-blur-sm",
        "-translate-y-full"
      );
    }

    lastScrollY = window.scrollY;
  };

  window.addEventListener("scroll", handleScroll);

  onBeforeUnmount(() => {
    window.removeEventListener("scroll", handleScroll);
  });
});
</script>

<style>
html, body, #app {
  background-color: #000;
  margin: 0;
  padding: 0;
  min-height: 100%;
  color: white;
}

.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-slide-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

.fade-slide-enter-to,
.fade-slide-leave-from {
  opacity: 1;
  transform: translateY(0);
}
</style>
