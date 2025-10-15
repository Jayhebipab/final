<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Adrenaline Junky Piercinks</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2eT0YxLg9i4kS/Jb83a/9aNqI6F6x4Pz6F4n5e9y1d8f7h1e7h3n0l3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .professional-bg {
            background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/black_and_white_tattoo.jpg') }}');
            background-size: cover;
            background-position: center;
        }
        .professional-form-bg {
            background-color: rgba(10, 10, 10, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .professional-input {
            background-color: rgba(255, 255, 255, 0.05);
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }
        .professional-input:focus {
            outline: none;
            border-bottom-color: #66ccff;
        }
        .professional-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        select.professional-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.5); /* Placeholder color */
        }
        select.professional-input option {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body class="bg-black text-white font-sans">

    <header id="main-header" class="fixed top-0 w-full z-20 p-5 header-bg transition-transform duration-300 ease-in-out">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="flex-shrink-0">
                <img src="{{ asset('images/pic4.png') }}" alt="Adrenaline Junky Piercinks" class="h-24 md:h-28 lg:h-32 transition-transform duration-300 hover:scale-105">
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-8">
                    <li><a href="{{ url('/dashmain') }}" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Home</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">About</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Gallery</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Shop</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400 text-lg font-medium transition-colors uppercase">Contact</a></li>
                    <li><a href="#" class="py-2 px-4 border border-white rounded-full text-white hover:bg-white hover:text-black transition-all font-semibold uppercase">BOOK NOW</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="professional-bg text-white py-40 md:py-52 px-4 flex items-center justify-center min-h-screen">
        <div class="container mx-auto max-w-7xl">
            <div class="professional-form-bg p-8 md:p-16 rounded-lg shadow-xl grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-4xl md:text-5xl font-extrabold mb-6 tracking-wide">CONTACT US</h2>
                    <p class="text-lg text-gray-300 mb-8 max-w-md">
                        Contact us to book an appointment or reach out and message us for any inquiries.
                    </p>

                    <div class="mb-8">
                        <p class="text-xl font-semibold text-white mb-2">Email</p>
                        <a href="mailto:caranicolas.819@icloud.com" class="text-gray-300 hover:text-white transition-colors">caranicolas.819@icloud.com</a>
                    </div>
                    
                    <div class="mb-8">
                        <p class="text-xl font-semibold text-white mb-2">Social Media</p>
                        <div class="flex space-x-4">
                            <a href="https://www.instagram.com/theadrenalinejunkypiercinks/" class="text-white hover:opacity-75 transition-opacity">
                                <img src="{{ asset('images/ig.png') }}" alt="Instagram" class="h-8 w-8">
                            </a>
                            <a href="https://www.facebook.com/junkypiercing" class="text-white hover:opacity-75 transition-opacity">
                                <img src="{{ asset('images/fb.png') }}" alt="Facebook" class="h-8 w-8">
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-xl font-semibold text-white mb-2">Phone</p>
                        <div class="text-gray-300">
                            <p>General Line: +63 935 595 5699</p>
                        </div>
                    </div>
                </div>

                <div>
                    @if (session('success'))
                        <div class="bg-green-600 text-white p-4 rounded-lg mb-6 shadow-md">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-600 text-white p-4 rounded-lg mb-6 shadow-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('send.email') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <input type="text" name="firstname" placeholder="First Name *" class="w-full professional-input">
                            <input type="text" name="lastname" placeholder="Last Name *" class="w-full professional-input">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <input type="email" name="email" placeholder="Email *" class="w-full professional-input">
                            <input type="tel" name="phonenum" placeholder="Phone Number *" class="w-full professional-input">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <input type="date" name="date" placeholder="Preferred Date *" class="w-full professional-input">
                            <div class="relative w-full">
                                <select name="time" class="w-full professional-input appearance-none">
                                    <option value="" disabled selected>Preferred Time *</option>
                                    <option value="9:00 AM">9:00 AM</option>
                                    <option value="10:00 AM">10:00 AM</option>
                                    <option value="11:00 AM">11:00 AM</option>
                                    <option value="12:00 PM">12:00 PM</option>
                                    <option value="1:00 PM">1:00 PM</option>
                                    <option value="2:00 PM">2:00 PM</option>
                                    <option value="3:00 PM">3:00 PM</option>
                                    <option value="4:00 PM">4:00 PM</option>
                                    <option value="5:00 PM">5:00 PM</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <textarea name="info" placeholder="Info About Your Tattoo *" rows="4" class="w-full professional-input"></textarea>
                        <button type="submit" class="w-full py-3 px-6 bg-white text-black font-semibold uppercase tracking-wider hover:bg-gray-200 transition-colors rounded-lg shadow-lg">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-black text-white py-20 px-4">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-8 tracking-wide">OUR LOCATION</h2>
            <div class="flex flex-col md:flex-row items-center justify-center gap-10">
                <div class="max-w-md">
                    <p class="text-xl font-semibold mb-2">Adrenaline Junky Piercinks</p>
                    <p class="text-gray-400">7/11, 2nd Flr, National Road, Putatan, (In front of Muntinlupa City Hall), Muntinlupa City, Philippines</p>
                </div>
                
                <div class="w-full md:w-1/2 rounded-lg overflow-hidden shadow-lg mt-8 md:mt-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.656513511109!2d121.04279061523498!3d14.49392238986877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c6c4c3e3e0c7%3A0x6b8d9c2a6b2c2b3e!2sAdrenaline%20Junky%20Piercinks!5e0!3m2!1sen!2sph!4v1625056708688!5m2!1sen!2sph"
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer class="bg-gray-900 text-gray-400 py-8 px-4">
        <div class="container mx-auto flex flex-col items-center justify-center space-y-4">
            <div class="flex space-x-4">
                <a href="https://www.instagram.com/theadrenalinejunkypiercinks/" target="_blank" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-instagram text-2xl"></i>
                </a>
                <a href="https://www.facebook.com/junkypiercing" target="_blank" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-facebook-f text-2xl"></i>
                </a>
            </div>
            <p>© {{ date('Y') }} Adrenaline Junky Piercinks. All Rights Reserved.</p>
        </div>
    </footer>
 
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
        if (window.scrollY > 40) {
            header.classList.add('bg-black', 'bg-opacity-50', 'backdrop-blur-sm');
        } else {
            header.classList.remove('bg-black', 'bg-opacity-50', 'backdrop-blur-sm');
        }

        lastScrollY = window.scrollY;
    });
</script>

</body>
</html>