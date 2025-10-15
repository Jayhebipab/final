<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrenaline Junky Piercinks | Tattoo & Piercing</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2eT0YxLg9i4kS/Jb83a/9aNqI6F6x4Pz6F4n5e9y1d8f7h1e7h3n0l3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Custom Styles */
        .header-bg {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }

        .hero-overlay {
            /* Dark overlay para mas lumitaw ang text */
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body class="bg-black text-white overflow-x-hidden font-sans">
    

<header id="main-header" class="fixed top-0 w-full z-20 p-5 transition-transform duration-300 ease-in-out">
    <div class="container mx-auto flex justify-between items-center px-4">
        <div class="flex-shrink-0">
            <img src="{{ asset('images/pic4.png') }}" alt="Adrenaline Junky Piercinks" class="h-24 md:h-28 lg:h-32 transition-transform duration-300 hover:scale-105">
        </div>

        <nav class="hidden md:block">
            <ul class="flex space-x-8">
                <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Home</a></li>
                <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">About</a></li>
                <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Gallery</a></li>
                <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Shop</a></li>
                <li>
                    <a href="{{ url('/contact') }}" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Contact</a>
                </li>
                <li>
                    <a href="{{ url('/contact') }}" class="py-2 px-4 border border-white rounded-full text-white hover:bg-white hover:text-black transition-all font-semibold uppercase">
                        BOOK NOW
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="relative h-screen w-full flex items-center justify-center" style="background-image: url('{{ asset('images/bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="hero-overlay absolute inset-0"></div>
    <div class="container mx-auto relative z-10 flex flex-col md:flex-row items-center justify-center px-4">
        <div class="text-center md:text-left md:w-full">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight mb-4">ADRENALINE JUNKY PIERCINKS</h1>
            <p class="text-lg md:text-xl font-light leading-relaxed">
                Your destination for professional tattoos and piercings.<br class="hidden md:block">
                We also offer unique tattoo sponsor services for weddings and other events.
            </p>
            <p class="text-sm md:text-base font-light leading-relaxed mt-4">
                EST. 2019
            </p>
        </div>
    </div>
</main>

<div class="fixed bottom-5 left-5 z-20 flex flex-col space-y-4">
    <a href="https://www.instagram.com/theadrenalinejunkypiercinks/" target="_blank" class="transform transition-transform duration-300 hover:scale-125">
        <i class="fab fa-instagram text-white text-3xl"></i>
    </a>
    <a href="https://www.facebook.com/junkypiercing" target="_blank" class="transform transition-transform duration-300 hover:scale-125">
        <i class="fab fa-facebook-f text-white text-3xl"></i>
    </a>
</div>

<a href="https://www.facebook.com/messages/t/102727365381254" target="_blank" 
   class="fixed bottom-5 right-5 z-20 transform transition-transform duration-300 hover:scale-125">
    <img src="{{ asset('images/mess.png') }}" alt="Messenger" class="h-12 w-12 md:h-14 md:w-14">
</a>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<div id="page-transition-overlay" class="fixed inset-0 z-50 bg-black opacity-0 pointer-events-none transition-opacity duration-10"></div>

<script>
    let lastScrollY = window.scrollY;
    const header = document.getElementById('main-header');
    let scrollUpCount = 0;
    const scrollUpThreshold = 450;

    window.addEventListener('scroll', () => {
        // Condition for SCROLLING DOWN
        if (window.scrollY > lastScrollY && window.scrollY > 100) {
            header.classList.add('-translate-y-full');
            scrollUpCount = 0; // Reset counter when scrolling down
        } 
        // Condition for SCROLLING UP
        else if (window.scrollY < lastScrollY) {
            scrollUpCount += lastScrollY - window.scrollY; // Add scroll distance to the counter

            if (scrollUpCount >= scrollUpThreshold) {
                header.classList.remove('-translate-y-full');
            }
        }
        
        // This part is the key.
        // If the user is at the very top of the page, always show the header.
        if (window.scrollY === 0) {
            header.classList.remove('-translate-y-full');
        }

        // Add or remove background based on scroll position
        if (window.scrollY > 450) {
            header.classList.add('bg-black', 'bg-opacity-50', 'backdrop-blur-sm');
        } else {
            header.classList.remove('bg-black', 'bg-opacity-50', 'backdrop-blur-sm');
        }

        lastScrollY = window.scrollY;
    });

    // Page Transition Script
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.getElementById('page-transition-overlay');
        const transitionLinks = document.querySelectorAll('a');

        transitionLinks.forEach(link => {
            if (link.getAttribute('href') && link.getAttribute('href') !== '#') {
                link.addEventListener('click', function(event) {
                    // Check if the link is an external link
                    if (this.hostname !== window.location.hostname) {
                        return; // Let the external link behave normally
                    }

                    event.preventDefault(); // Prevent the default link action

                    const targetPage = this.getAttribute('href');

                    overlay.classList.remove('opacity-0', 'pointer-events-none');
                    overlay.classList.add('opacity-100');

                    setTimeout(() => {
                        window.location.href = targetPage;
                    }, );
                });
            }
        });
    });

      // 🔹 AGE MODAL SCRIPT
  document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("ageModal");
    const btnYes = document.getElementById("btnYes");
    const btnNo = document.getElementById("btnNo");

    btnYes.addEventListener("click", () => {
      modal.style.display = "none"; // allow access
      localStorage.setItem("ageVerified", "true"); // remember choice
    });

    btnNo.addEventListener("click", () => {
      window.location.href = "https://google.com"; // redirect underage
    });

    // Check if already verified
    if (localStorage.getItem("ageVerified") === "true") {
      modal.style.display = "none";
    }
  });
</script>

</body>
</html>