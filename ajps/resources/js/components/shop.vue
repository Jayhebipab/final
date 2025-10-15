<template>
  <div class="min-h-screen bg-black text-white relative">
    <div
      class="w-full h-[60vh] md:h-[420px] relative flex items-center md:items-end justify-center px-4"
      style="background-image: url('/images/shop-cover.jpg'); background-size: cover; background-position: center;"
    >
      <div class="absolute inset-0 bg-black/50"></div>

      <div class="relative z-10 flex items-center gap-6 mb-12">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white drop-shadow-lg">
          SHOP
        </h1>

        <div class="flex items-center gap-4">
          <button @click="toggleSearch" class="hover:scale-110 transition">
            <img src="/images/search.png" alt="Search" class="w-7 h-7" />
          </button>

          <button @click="toggleCart" class="hover:scale-110 transition relative">
            <img src="/images/cart.png" alt="Cart" class="w-7 h-7" />
            <span
              v-if="cart.length > 0"
              class="absolute -top-2 -right-2 bg-red-600 text-xs font-bold px-2 py-0.5 rounded-full"
            >
              {{ cart.length }}
            </span>
          </button>
        </div>
      </div>
    </div>

    <div class="p-8">
      <h2 class="text-3xl font-bold text-center mb-8">Shop Our Products</h2>

      <div v-if="error" class="text-red-500 text-center mb-4">
        {{ error }}
      </div>

      <div v-if="piercingProducts.length === 0" class="text-center text-gray-400">
        No products found.
      </div>

      <div
        v-else
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-6xl mx-auto"
      >
        <div
          v-for="(item, index) in piercingProducts"
          :key="index"
          @click="openItemDetails(item)"
          class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden cursor-pointer transform transition duration-300 hover:ring-2 hover:ring-blue-500"
        >
          <img
            :src="item.image"
            :alt="item.title"
            class="w-full h-72 object-cover"
            @error="item.image = '/images/default.png'"
          />

          <div class="p-6">
            <h2 class="text-2xl font-semibold mb-2">{{ item.title }}</h2>
            <p class="text-gray-400 mb-2 truncate">{{ item.description }}</p>

            <p class="text-lg font-bold text-yellow-400 mb-2">₱{{ item.price }}</p>

            <p
              v-if="item.quantity > 0"
              :class="['text-sm mb-4', item.quantity > 5 ? 'text-green-400' : 'text-orange-400']"
            >
              {{ item.quantity > 5 ? 'In stock' : 'Few stocks left' }}
            </p>
            <p
              v-else
              class="text-sm text-red-500 mb-4 font-semibold"
            >
              Out of stock
            </p>

            <p class="text-sm text-blue-400 font-medium">Click to view details...</p>
          </div>
        </div>
      </div>
    </div>

    <transition name="fade-slide">
      <div
        v-if="itemDetailsPanel.isOpen && itemDetailsPanel.item"
        class="fixed inset-0 bg-black/80 z-[100] flex justify-center items-center p-4 overflow-y-auto"
        @click.self="itemDetailsPanel.isOpen = false"
      >
        <div class="w-full max-w-4xl m-0 sm:m-4 transform transition-all duration-300 ease-out">
          
          <div
            class="bg-gray-900 rounded-xl shadow-2xl flex flex-col lg:flex-row h-auto max-h-[90vh] relative"
            @click.stop
          >
            <button
              @click="itemDetailsPanel.isOpen = false"
              class="absolute top-3 right-3 text-white bg-black/50 p-2 rounded-full hover:bg-black/70 transition z-10"
            >
              ✖
            </button>

            <div class="lg:w-1/2 p-4 flex-shrink-0">
              
              <div class="w-full h-72 sm:h-96 lg:h-full relative overflow-hidden rounded-lg">
                <img
                  :src="currentImage"
                  :alt="itemDetailsPanel.item.title"
                  class="w-full h-full object-cover rounded-lg transition-transform duration-500 hover:scale-110 cursor-zoom-in"
                />
              </div>
              
              <div v-if="itemDetailsPanel.item.images && itemDetailsPanel.item.images.length > 1" class="flex gap-2 mt-4 overflow-x-auto pb-2">
                <img
                  v-for="(img, idx) in itemDetailsPanel.item.images"
                  :key="idx"
                  :src="img"
                  :class="[
                    'w-16 h-16 object-cover rounded-md cursor-pointer border-2 transition',
                    img === currentImage ? 'border-yellow-500 scale-105' : 'border-gray-700 hover:border-yellow-400'
                  ]"
                  @click="currentImage = img"
                />
              </div>
              
            </div>

            <div class="lg:w-1/2 p-6 overflow-y-auto flex flex-col">
              
              <div class="flex-grow">
                <h2 class="text-3xl sm:text-4xl font-extrabold mb-2 text-white">{{ itemDetailsPanel.item.title }}</h2>
                <span class="text-xs font-medium text-gray-500 mb-4 inline-block">{{ itemDetailsPanel.item.category || 'Uncategorized' }}</span>
                <p class="text-gray-300 mb-6 whitespace-pre-wrap leading-relaxed text-sm">
                  {{ itemDetailsPanel.item.description }}
                </p>
              </div>

              <div class="mt-4 pt-4 border-t border-gray-700 flex-shrink-0">
                  
                  <div class="mb-4 bg-gray-800 p-3 rounded-md">
                      <p class="text-sm text-gray-400 font-medium">Price:</p>
                      <p class="text-4xl font-black text-yellow-400">₱{{ itemDetailsPanel.item.price }}</p>
                  </div>
                  
                  <div class="mb-6">
                      <p
                        v-if="itemDetailsPanel.item.quantity > 5"
                        class="text-sm text-green-400 font-semibold flex items-center gap-2"
                      >
                         <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> In stock: {{ itemDetailsPanel.item.quantity }}
                      </p>
                      <p
                        v-else-if="itemDetailsPanel.item.quantity > 0"
                        class="text-sm text-orange-400 font-semibold flex items-center gap-2"
                      >
                         <span class="w-2 h-2 bg-orange-500 rounded-full"></span> Few stocks left ({{ itemDetailsPanel.item.quantity }} left)
                      </p>
                      <p
                        v-else
                        class="text-sm text-red-500 font-semibold flex items-center gap-2"
                      >
                         <span class="w-2 h-2 bg-red-500 rounded-full"></span> Out of stock
                      </p>
                  </div>

                  <div class="flex flex-col sm:flex-row gap-4 mb-6"> <button
                      @click="addToCart(itemDetailsPanel.item); itemDetailsPanel.isOpen = false;"
                      :disabled="itemDetailsPanel.item.quantity <= 0"
                      :class="[
                          'flex-1 px-4 py-3 rounded-full font-bold transition transform hover:scale-[1.02] shadow-lg',
                          itemDetailsPanel.item.quantity > 0 ? 'bg-blue-600 hover:bg-blue-700' : 'bg-gray-700 cursor-not-allowed opacity-70'
                      ]"
                    >
                      Add to Cart
                    </button>
                    <button
                      @click="buyNow(itemDetailsPanel.item); itemDetailsPanel.isOpen = false;"
                      :disabled="itemDetailsPanel.item.quantity <= 0"
                      :class="[
                          'flex-1 px-4 py-3 rounded-full font-bold transition transform hover:scale-[1.02] shadow-lg',
                          itemDetailsPanel.item.quantity > 0 ? 'bg-yellow-600 text-black hover:bg-yellow-500' : 'bg-gray-700 cursor-not-allowed opacity-70'
                      ]"
                    >
                      Buy Now
                    </button>
                  </div>


              </div>

            </div>
          </div>
          
          <div class="mt-8">
            <h3 class="text-xl font-bold mb-4 text-white">You Might Also Like:</h3>
            <div class="overflow-hidden relative autoscroll-container">
              <div class="flex gap-4 pb-4 autoscroll-content">
                
                <template v-for="n in 2" :key="n">
                  <div
                    v-for="(relatedItem, idx) in relatedProducts"
                    :key="`${n}-${idx}`"
                    @click="openItemDetails(relatedItem)"
                    class="flex-shrink-0 w-32 sm:w-40 bg-gray-800 rounded-lg shadow-lg cursor-pointer transform transition duration-300 hover:ring-2 hover:ring-blue-500 hover:pause-animation"
                  >
                    <img
                      :src="relatedItem.image"
                      :alt="relatedItem.title"
                      class="w-full h-32 sm:h-40 object-cover rounded-t-lg"
                      @error="relatedItem.image = '/images/default.png'"
                    />
                    <div class="p-3">
                      <p class="text-sm font-semibold truncate">{{ relatedItem.title }}</p>
                      <p class="text-xs font-bold text-yellow-400 mt-1">₱{{ relatedItem.price }}</p>
                    </div>
                  </div>
                </template>
                
                <div v-if="relatedProducts.length === 0" class="text-gray-500 p-4">
                  No related products found.
                </div>
              </div>
            </div>
          </div>
          </div>
      </div>
    </transition>

    <transition name="slide">
      <div
        v-if="isCartOpen"
        class="fixed top-0 right-0 h-full w-72 sm:w-80 bg-gray-900 shadow-lg z-50 flex flex-col"
      >
        <div class="flex justify-between items-center p-4 border-b border-gray-700">
          <h2 class="text-xl font-bold">Your Cart</h2>
          <button @click="toggleCart" class="text-gray-400 hover:text-white">✖</button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-4">
          <div v-if="cart.length === 0" class="text-gray-400 text-center mt-10">
            Your cart is empty.
          </div>

          <div
            v-for="(item, index) in cart"
            :key="index"
            class="flex items-center gap-4 bg-gray-800 p-3 rounded-lg"
          >
            <img :src="item.image" class="w-16 h-16 rounded object-cover" />
            <div class="flex-1">
              <h3 class="font-semibold">{{ item.title }}</h3>
              <p class="text-yellow-400">₱{{ item.price }}</p>
            </div>
            <button
              @click="removeFromCart(index)"
              class="text-red-500 hover:text-red-700"
            >
              ✖
            </button>
          </div>
        </div>

        <div class="p-4 border-t border-gray-700">
          <button
            class="w-full bg-green-600 py-2 rounded-lg font-bold hover:bg-green-700 transition"
          >
            Checkout
          </button>
        </div>
      </div>
    </transition>

    <footer
      class="bg-gradient-to-t from-black via-gray-900 to-black text-gray-400 py-8 px-4"
    >
      <div class="container mx-auto flex flex-col items-center space-y-6">
        <div class="flex space-x-8">
          <a
            href="https://www.facebook.com/junkypiercing"
            target="_blank"
            class="transform transition duration-300 hover:scale-125 hover:drop-shadow-[0_0_8px_#3b82f6]"
          >
            <img :src="fbIcon" alt="Facebook" class="h-9 w-9" />
          </a>
          <a
            href="https://www.instagram.com/theadrenalinejunkypiercinks/"
            target="_blank"
            class="transform transition duration-300 hover:scale-125 hover:drop-shadow-[0_0_8px_#ec4899]"
          >
            <img :src="igIcon" alt="Instagram" class="h-9 w-9" />
          </a>
        </div>
        <p class="text-sm tracking-widest text-gray-400 uppercase font-light">
          © 2025 Adrenaline Junky Piercinks — All Rights Reserved
        </p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import fbIcon from "@assets/images/fb.png";
import igIcon from "@assets/images/ig.png";

const cart = ref([]);
const isSearchOpen = ref(false);
const isCartOpen = ref(false);
const piercingProducts = ref([]);
const error = ref("");

// State para sa Item Details Panel
const itemDetailsPanel = ref({
    isOpen: false,
    item: null,
});

// State para sa kasalukuyang image na naka-display sa modal
const currentImage = ref(null);

const relatedProducts = ref([]);

// Function para mag-filter ng sample related items (DEMO ONLY)
const getRelatedProducts = (currentItem) => {
    // Kinukuha lang ang unang 5 items na hindi ang kasalukuyang item.
    return piercingProducts.value
        .filter(item => item.title !== currentItem.title)
        .slice(0, 5); 
};

// Function para magbukas ng Item Details Panel
const openItemDetails = (item) => {
    itemDetailsPanel.value.item = item;
    itemDetailsPanel.value.isOpen = true;
    
    // I-set ang main image at related products
    currentImage.value = item.image; 
    relatedProducts.value = getRelatedProducts(item);
};

const toggleSearch = () => (isSearchOpen.value = !isSearchOpen.value);
const toggleCart = () => (isCartOpen.value = !isCartOpen.value);
const addToCart = (item) => cart.value.push(item);
const removeFromCart = (index) => cart.value.splice(index, 1);
const buyNow = (item) => alert(`Proceeding to checkout: ${item.title}`);

onMounted(async () => {
  try {
    const response = await axios.get("/inventories");
    piercingProducts.value = response.data.map((item) => {
        
        // Mocking multiple images para sa demo. Palitan ito ng actual images galing sa API.
        const defaultImage = item.image ? item.image : "/images/default.png";
        const imagesList = [defaultImage];
        if (item.image2) imagesList.push(item.image2);
        if (item.image3) imagesList.push(item.image3);
        // Kung walang image2 at image3, mag-duplicate na lang ng default image para may thumbnails
        if (imagesList.length === 1 && item.title.includes('Titanium')) {
            imagesList.push('/images/product-sample-2.jpg');
            imagesList.push('/images/product-sample-3.jpg');
        }


        return {
          title: item.title,
          description: item.long_description || item.description || "No description available for this product. Please check the links below.",
          price: item.price,
          quantity: item.quantity || 0,
          image: defaultImage,
          images: imagesList, // Multiple images list
          category: item.category || 'Jewelry',
          shopeeUrl: item.shopee_url || null,
          lazadaUrl: item.lazada_url || null,
        };
    });
  } catch (err) {
    console.error("Error fetching inventories:", err);
    error.value = "Failed to load products.";
  }
});
</script>

<style>
/* Style para sa Cart Drawer (Sliding animation) */
.slide-enter-from {
  transform: translateX(100%);
}
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s ease;
}
.slide-leave-to {
  transform: translateX(100%);
}

/* Style para sa Item Details Panel (Fade-Slide/Scale animation) */
.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: scale(0.95);
}
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}

/* ⭐️ Auto-Scroll Animation Styles ⭐️ */

.autoscroll-container {
    overflow-x: hidden; 
}

.autoscroll-content {
    animation: scroll-left 40s linear infinite; /* Ang animation */
    min-width: 200%; 
    padding-bottom: 0 !important; 
    white-space: nowrap; 
}

/* Kapag nag-hover sa container, hihinto ang animation */
.autoscroll-container:hover .autoscroll-content {
    animation-play-state: paused;
}

/* Keyframes para gumalaw pa-kaliwa */
@keyframes scroll-left {
    0% {
        transform: translateX(0);
    }
    100% {
        /* Gumagalaw nang 50% para umikot ang duplicated list */
        transform: translateX(-50%); 
    }
}

/* Optional: Para huminto din ang animation pag nag-hover sa item */
.hover\:pause-animation:hover {
    animation-play-state: paused !important;
}
</style>