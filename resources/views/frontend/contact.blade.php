<x-app-layout>
    <style>
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        /* Hide map controls cleanly */
        .gmnoprint {
            display: none !important;
        }
    </style>

    <div class="relative w-full bg-[#0a0a0a] min-h-screen overflow-hidden pb-24">
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/15 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40rem] h-[40rem] bg-purple-600/15 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            
            <div class="text-center mb-16 reveal-on-scroll">
                <span class="px-4 py-1.5 rounded-full bg-[#111] border border-gray-800 text-[#df1873] text-sm font-bold tracking-widest uppercase mb-6 inline-block shadow-lg">Get In Touch</span>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">We'd Love To <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] to-purple-500 drop-shadow-[0_0_15px_rgba(223,24,115,0.3)]">Hear From You</span></h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">Have a question about showtimes, tickets, or just want to say hello? Our team is here to help you.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                
                <div class="space-y-6 reveal-on-scroll">
                    <div class="bg-[#111]/60 backdrop-blur-xl p-8 rounded-[2rem] border border-gray-800 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:border-[#df1873]/50 hover:bg-[#111]/80 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-[#0a0a0a] border border-gray-800 rounded-2xl flex items-center justify-center mb-6 text-[#df1873] group-hover:scale-110 group-hover:shadow-[0_0_15px_rgba(223,24,115,0.3)] transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Visit Us</h3>
                        <p class="text-gray-400 leading-relaxed font-medium">No. 123, Pyay Road, Kamayut Township,<br>Yangon, Myanmar.</p>
                    </div>

                    <div class="bg-[#111]/60 backdrop-blur-xl p-8 rounded-[2rem] border border-gray-800 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:border-purple-500/50 hover:bg-[#111]/80 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-[#0a0a0a] border border-gray-800 rounded-2xl flex items-center justify-center mb-6 text-purple-500 group-hover:scale-110 group-hover:shadow-[0_0_15px_rgba(168,85,247,0.3)] transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Email Us</h3>
                        <p class="text-gray-400 leading-relaxed mb-1 font-medium">General: <a href="mailto:info@zucocinema.com" class="hover:text-purple-400 transition-colors">info@zucocinema.com</a></p>
                        <p class="text-gray-400 leading-relaxed font-medium">Support: <a href="mailto:support@zucocinema.com" class="hover:text-purple-400 transition-colors">support@zucocinema.com</a></p>
                    </div>

                    <div class="bg-[#111]/60 backdrop-blur-xl p-8 rounded-[2rem] border border-gray-800 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:border-blue-500/50 hover:bg-[#111]/80 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-[#0a0a0a] border border-gray-800 rounded-2xl flex items-center justify-center mb-6 text-blue-500 group-hover:scale-110 group-hover:shadow-[0_0_15px_rgba(59,130,246,0.3)] transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Call Us</h3>
                        <p class="text-gray-400 leading-relaxed mb-1 font-medium"><a href="tel:+959123456789" class="hover:text-blue-400 transition-colors">+95 9 123 456 789</a></p>
                        <p class="text-gray-400 leading-relaxed font-medium">Mon - Sun: 9:00 AM - 10:00 PM</p>
                    </div>
                </div>

                <div class="reveal-on-scroll">
                    <div class="bg-[#111]/80 backdrop-blur-xl p-8 md:p-10 rounded-[2.5rem] border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative overflow-hidden">
                        
                        @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" class="mb-8 bg-green-900/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl flex items-start gap-4 relative shadow-lg">
                            <div class="bg-green-500/20 rounded-full p-2 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="pt-0.5">
                                <strong class="font-bold text-lg block text-white">Message Sent!</strong>
                                <span class="text-sm opacity-90 mt-1 block">{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="absolute top-4 right-4 text-green-400 hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-gray-300 mb-2">Your Name</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <input type="text" name="name" id="name" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="John Doe">
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email Address</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <input type="email" name="email" id="email" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="john@example.com">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-bold text-gray-300 mb-2">Subject</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    </div>
                                    <input type="text" name="subject" id="subject" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="How can we help?">
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-300 mb-2">Message</label>
                                <textarea name="message" id="message" rows="5" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white px-4 py-4 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600 resize-none" placeholder="Write your message here..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-[#df1873] hover:bg-[#c21463] text-white font-bold py-4 rounded-xl transition-all shadow-[0_0_20px_rgba(223,24,115,0.3)] hover:shadow-[0_0_25px_rgba(223,24,115,0.5)] flex justify-center items-center gap-2 group mt-8">
                                <span>Send Message</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="mt-24 reveal-on-scroll relative">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                        <svg class="w-8 h-8 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        Find Us Here
                    </h2>
                </div>
                
                <div class="relative p-2 bg-[#111]/80 backdrop-blur-md rounded-[2.5rem] border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    <div id="map" class="h-[450px] md:h-[500px] w-full rounded-[2rem] overflow-hidden bg-[#0a0a0a]"></div>
                    
                    <div class="absolute bottom-8 left-8 bg-[#0a0a0a]/90 backdrop-blur-xl border border-gray-800 p-5 rounded-2xl shadow-2xl flex items-center gap-4 pointer-events-none">
                        <div class="bg-[#df1873] p-3 rounded-xl text-white shadow-[0_0_15px_rgba(223,24,115,0.4)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold">ZUCO Cinema (Main)</h4>
                            <p class="text-gray-400 text-xs font-medium mt-1">Junction Square, Yangon</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });

        // Google Maps Initialization
        function initMap() {
            // Coordinates for Pyay Road, Kamayut Township, Yangon
            const zucoLocation = { lat: 16.8284, lng: 96.1299 }; 
            
            // Custom Dark Theme (Aubergine adjusted for Pitch Black)
            const mapStyles = [
                { "elementType": "geometry", "stylers": [{ "color": "#111111" }] },
                { "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] },
                { "elementType": "labels.text.stroke", "stylers": [{ "color": "#212121" }] },
                { "featureType": "administrative", "elementType": "geometry", "stylers": [{ "color": "#757575" }] },
                { "featureType": "administrative.country", "elementType": "labels.text.fill", "stylers": [{ "color": "#9e9e9e" }] },
                { "featureType": "administrative.land_parcel", "stylers": [{ "visibility": "off" }] },
                { "featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{ "color": "#bdbdbd" }] },
                { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] },
                { "featureType": "poi.park", "elementType": "geometry", "stylers": [{ "color": "#181818" }] },
                { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] },
                { "featureType": "poi.park", "elementType": "labels.text.stroke", "stylers": [{ "color": "#1b1b1b" }] },
                { "featureType": "road", "elementType": "geometry.fill", "stylers": [{ "color": "#2c2c2c" }] },
                { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "color": "#8a8a8a" }] },
                { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#373737" }] },
                { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#3c3c3c" }] },
                { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [{ "color": "#4e4e4e" }] },
                { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] },
                { "featureType": "transit", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] },
                { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#000000" }] },
                { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#3d3d3d" }] }
            ];

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: zucoLocation,
                styles: mapStyles,
                disableDefaultUI: true, // Hides messy default UI
                zoomControl: true,      // Keeps only zoom buttons
            });

            // The exact custom Pink SVG marker you provided
            const marker = new google.maps.Marker({
                position: zucoLocation,
                map: map,
                title: "ZUCO Cinema",
                icon: {
                    url: "data:image/svg+xml;charset=UTF-8," + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23df1873" width="48px" height="48px"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>'),
                    scaledSize: new google.maps.Size(48, 48)
                },
                animation: google.maps.Animation.DROP
            });
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
</x-app-layout>