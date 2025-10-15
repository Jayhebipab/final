<script setup>
import { reactive, ref } from 'vue';
import fbIcon from '@assets/images/fb.png';
import igIcon from '@assets/images/ig.png';
const form = reactive({
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    date: '',
    time: '',
    service: '',
    info: '',
});

const successMessage = ref('');
const errorMessage = ref('');
const isSending = ref(false);

const validateForm = () => {
    if (
        !form.firstname ||
        !form.lastname ||
        !form.email ||
        !form.phone ||
        !form.date ||
        !form.time ||
        !form.service ||
        !form.info
    ) {
        return false;
    }
    return true;
};

// Function para sa pag-handle ng form submission
const submitForm = async () => {
    if (!validateForm()) {
        errorMessage.value = '❌ Please fill in all required fields.';
        successMessage.value = '';
        setTimeout(() => (errorMessage.value = ''), 5000);
        return;
    }

    isSending.value = true;
    errorMessage.value = '';
    successMessage.value = '';

    try {
        const response = await fetch('/send-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(form),
        });

        const result = await response.json();

        if (result.success) {
            successMessage.value = '✅ Thank you! Your message has been sent.';
            errorMessage.value = '';

            // Reset form
            Object.assign(form, {
                firstname: '',
                lastname: '',
                email: '',
                phone: '',
                date: '',
                time: '',
                service: '',
                info: '',
            });
        } else {
            errorMessage.value = '❌ ' + result.message;
            successMessage.value = '';
        }
    } catch (error) {
        console.error('Submission error:', error);
        errorMessage.value = '❌ Something went wrong. Please try again.';
        successMessage.value = '';
    } finally {
        isSending.value = false;
        setTimeout(() => {
            successMessage.value = '';
            errorMessage.value = '';
        }, 5000);
    }
};
</script>

<template>
    <br><br><br><br><br>
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
    <div class="flex space-x-6">
      <a href="https://www.facebook.com/junkypiercing" target="_blank">
        <img :src="fbIcon" alt="Facebook" class="h-8 w-8 hover:opacity-80 transition" />
      </a>
      <a href="https://www.instagram.com/theadrenalinejunkypiercinks/" target="_blank">
        <img :src="igIcon" alt="Instagram" class="h-8 w-8 hover:opacity-80 transition" />
      </a>
    </div>
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
                    <div v-if="successMessage" class="bg-green-600 text-white p-4 rounded-lg mb-6 shadow-md">
                        {{ successMessage }}
                    </div>
                    <div v-if="errorMessage" class="bg-red-600 text-white p-4 rounded-lg mb-6 shadow-md">
                        {{ errorMessage }}
                    </div>

                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <input type="text" v-model="form.firstname" placeholder="First Name *" class="w-full professional-input">
                            <input type="text" v-model="form.lastname" placeholder="Last Name *" class="w-full professional-input">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <input type="email" v-model="form.email" placeholder="Email *" class="w-full professional-input">
                            <input 
  type="tel" 
  v-model="form.phone" 
  placeholder="Phone Number *" 
  class="w-full professional-input">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <input type="date" v-model="form.date" placeholder="Preferred Date *" class="w-full professional-input">
                            <div class="relative w-full">
                                <select v-model="form.time" class="w-full professional-input appearance-none">
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
                        <div class="relative w-full">
                            <select v-model="form.service" class="w-full professional-input appearance-none">
                                <option value="" disabled selected>Select Service *</option>
                                <option value="Tattoo">Tattoo</option>
                                <option value="Piercing">Piercing</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <textarea v-model="form.info" placeholder="Info About Your Tattoo / Piercing *" rows="4" class="w-full professional-input"></textarea>
                        <button type="submit" class="w-full py-3 px-6 bg-white text-black font-semibold uppercase tracking-wider hover:bg-gray-200 transition-colors rounded-lg shadow-lg">
                            <span v-if="!isSending">Send</span>
                            <span v-else>Sending...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
<section class="bg-black text-white py-20 px-4">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-8 tracking-wide">OUR LOCATION</h2>
            <br><br><br></br>
            <div class="flex flex-col md:flex-row items-center justify-center gap-10">
                <div class="max-w-md">
                    <p class="text-xl font-semibold mb-2">Adrenaline Junky Piercinks</p>
                    <p class="text-gray-400">7/11, 2nd Flr, National Road, Putatan, (In front of Muntinlupa City Hall), Muntinlupa City, Philippines</p>
                </div>
                <div class="w-full md:w-1/2 rounded-lg overflow-hidden shadow-lg mt-8 md:mt-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d262.38379125846643!2d121.04477512936309!3d14.39452277690819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d0fa06ec1541%3A0x2703c40b18fa6b04!2s7-Eleven%20BRUGER%200078!5e0!3m2!1sen!2sph!4v1757982559859!5m2!1sen!2sph"
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
    <div class="my-40"></div>
  <footer class="bg-gradient-to-t from-black via-gray-900 to-black text-gray-400 py-8 px-4">
  <div class="container mx-auto flex flex-col items-center space-y-6">
    <br><br><br><br><br><br></br>
    
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


<style scoped>
.professional-bg {
  background-color: #000000; /* black */
}
.professional-form-bg {
  background-color: #1a1a1a; /* deep gray */
}
.professional-input {
  background-color: #2d3748; /* slate gray */
  color: #e2e8f0;           /* light gray text */
  padding: 0.75rem 1rem;
  border-radius: 0.5rem;
  border: 1px solid #4a5568; /* subtle border */
}
.professional-input:focus {
  outline: none;
  border-color: #3b82f6; /* blue accent when focused */
  box-shadow: 0 0 8px #3b82f6; /* neon glow */
}
.professional-input::placeholder {
  color: #a0aec0; /* muted gray */
}

</style>