import { createRouter, createWebHistory } from 'vue-router'
import Homepage from '../components/homepage.vue'
import Admin from '../components/admin.vue'
import Contact from '../components/contactt.vue'
import Shop from '../components/shop.vue'
import Piercing from '../components/piercing.vue'
import About from '../components/about.vue'

// 🔽 i-import lang generic form
import ArtistForm from '../components/artists/ArtistForm.vue'
import Tattoo from '../components/tattoo.vue'

const routes = [
  { 
    path: '/', 
    name: 'Homepage', 
    component: Homepage, 
    meta: { title: 'Home | Adrenaline Junky Piercinks' } 
  },
  { 
    path: '/admin', 
    name: 'Admin', 
    component: Admin, 
    meta: { title: 'Admin | Adrenaline Junky Piercinks' } 
  },
  { 
    path: '/shop', 
    name: 'Shop', 
    component: Shop, 
    meta: { title: 'Shop | Adrenaline Junky Piercinks' } 
  },
  { 
    path: '/about', 
    name: 'About', 
    component: About, 
    meta: { title: 'About | Adrenaline Junky Piercinks' } 
  },
  { 
    path: '/piercing', 
    name: 'Piercing', 
    component: Piercing, 
    meta: { title: 'Piercing | Adrenaline Junky Piercinks' } 
  },
  { 
    path: '/tattoo', 
    name: 'Tattoo', 
    component: Tattoo, 
    meta: { title: 'Tattoo | Adrenaline Junky Piercinks' } 
  },
  { 
    path: '/contactt', 
    name: 'Contactt', 
    component: Contact, 
    meta: { title: 'Contact | Adrenaline Junky Piercinks' } 
  },

  // 🔽 dynamic route
  { 
    path: '/gallery/artists/:name', 
    name: 'ArtistForm', 
    component: ArtistForm, 
    meta: { title: 'Artist | Adrenaline Junky Piercinks' } 
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// 🔹 Update tab title after navigation
router.afterEach((to) => {
  const defaultTitle = 'Adrenaline Junky Piercinks'

  if (to.name === 'ArtistForm' && to.params.name) {
    document.title = `${to.params.name} - Artist | ${defaultTitle}`
  } else {
    document.title = to.meta.title || defaultTitle
  }
})

export default router
