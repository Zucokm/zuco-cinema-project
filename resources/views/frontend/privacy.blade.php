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

        .glass-card {
            background: rgba(17, 17, 17, 0.6);
            backdrop-filter: blur(20px);
            border: 1px border-gray-800;
        }

        .text-glow {
            text-shadow: 0 0 30px rgba(223, 24, 115, 0.4);
        }

        .gradient-border {
            position: relative;
            border-radius: 2rem;
        }

        .gradient-border::before {
            content: "";
            position: absolute;
            inset: -1px;
            border-radius: 2rem;
            padding: 1px;
            background: linear-gradient(to right, #df1873, #7c3aed);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
    </style>

    <div class="relative w-full bg-[#0a0a0a] min-h-screen overflow-hidden pb-24">
        <!-- Background Decorative Elements -->
        <div class="absolute top-0 right-0 w-[50rem] h-[50rem] bg-[#df1873]/5 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[40rem] h-[40rem] bg-indigo-600/5 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-[0.03] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-24">
            
            <!-- Header Section -->
            <div class="text-center mb-20 reveal-on-scroll">
                <span class="px-4 py-1.5 rounded-full bg-[#111] border border-gray-800 text-[#df1873] text-xs font-black tracking-[0.2em] uppercase mb-6 inline-block shadow-xl">Legal Documentation</span>
                <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tight">
                    Privacy <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] to-indigo-500 text-glow">& Policy</span>
                </h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed font-medium">
                    At ZUCO Cinemas, we value your privacy. This policy explains how we collect, use, and protect your information.
                </p>
                <div class="mt-10 flex justify-center items-center gap-4 text-sm text-gray-500 font-bold uppercase tracking-wider">
                    <span>Last Updated: {{ date('M d, Y') }}</span>
                    <span class="w-1 h-1 rounded-full bg-gray-800"></span>
                    <span>Version 1.0</span>
                </div>
            </div>

            <!-- Content Section -->
            <div class="space-y-12">
                
                <!-- 01. Introduction -->
                <div class="reveal-on-scroll">
                    <div class="glass-card p-8 md:p-12 rounded-[2.5rem] border border-gray-800 relative overflow-hidden group hover:border-[#df1873]/30 transition-all duration-500">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#df1873]/5 rounded-full blur-3xl group-hover:bg-[#df1873]/10 transition-colors"></div>
                        <div class="flex items-start gap-8">
                            <div class="hidden md:flex w-16 h-16 bg-[#0a0a0a] border border-gray-800 rounded-2xl items-center justify-center text-[#df1873] font-black text-2xl shadow-inner shrink-0 leading-none pt-1">
                                01
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-black text-white mb-6 flex items-center gap-4">
                                    <span class="md:hidden text-[#df1873]">01.</span>
                                    Introduction
                                </h2>
                                <div class="space-y-4 text-gray-400 leading-relaxed text-lg font-medium">
                                    <p>Welcome to ZUCO Cinemas. We are committed to protecting your personal data and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us.</p>
                                    <p>When you visit our website, and use our services, you trust us with your personal information. In this privacy notice, we describe our privacy policy. We seek to explain to you in the clearest way possible what information we collect, how we use it and what rights you have in relation to it.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 02. Information We Collect -->
                <div class="reveal-on-scroll" style="transition-delay: 100ms;">
                    <div class="glass-card p-8 md:p-12 rounded-[2.5rem] border border-gray-800 relative overflow-hidden group hover:border-indigo-500/30 transition-all duration-500">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-colors"></div>
                        <div class="flex items-start gap-8">
                            <div class="hidden md:flex w-16 h-16 bg-[#0a0a0a] border border-gray-800 rounded-2xl items-center justify-center text-indigo-500 font-black text-2xl shadow-inner shrink-0 leading-none pt-1">
                                02
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-black text-white mb-6 flex items-center gap-4">
                                    <span class="md:hidden text-indigo-500">02.</span>
                                    Information Collection
                                </h2>
                                <div class="space-y-4 text-gray-400 leading-relaxed text-lg font-medium">
                                    <p>We collect personal information that you voluntarily provide to us when registering at the Services, expressing an interest in obtaining information about us or our products and services, or otherwise contacting us.</p>
                                    <ul class="space-y-3 mt-6">
                                        <li class="flex items-center gap-4">
                                            <div class="w-1.5 h-1.5 rounded-full bg-[#df1873]"></div>
                                            <span>Personal Data (Name, Email, Phone Number)</span>
                                        </li>
                                        <li class="flex items-center gap-4">
                                            <div class="w-1.5 h-1.5 rounded-full bg-[#df1873]"></div>
                                            <span>Payment Information (Processed securely via KPay/WavePay)</span>
                                        </li>
                                        <li class="flex items-center gap-4">
                                            <div class="w-1.5 h-1.5 rounded-full bg-[#df1873]"></div>
                                            <span>Booking History and Preferences</span>
                                        </li>
                                        <li class="flex items-center gap-4">
                                            <div class="w-1.5 h-1.5 rounded-full bg-[#df1873]"></div>
                                            <span>Device and Usage Data</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 03. How We Use Your Info -->
                <div class="reveal-on-scroll" style="transition-delay: 200ms;">
                    <div class="glass-card p-8 md:p-12 rounded-[2.5rem] border border-gray-800 relative overflow-hidden group hover:border-purple-500/30 transition-all duration-500">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-purple-500/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-colors"></div>
                        <div class="flex items-start gap-8">
                            <div class="hidden md:flex w-16 h-16 bg-[#0a0a0a] border border-gray-800 rounded-2xl items-center justify-center text-purple-500 font-black text-2xl shadow-inner shrink-0 leading-none pt-1">
                                03
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-black text-white mb-6 flex items-center gap-4">
                                    <span class="md:hidden text-purple-500">03.</span>
                                    Usage Of Information
                                </h2>
                                <div class="space-y-4 text-gray-400 leading-relaxed text-lg font-medium">
                                    <p>We use personal information collected via our Services for a variety of business purposes described below.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                                        <div class="p-6 bg-[#0a0a0a] border border-gray-800 rounded-2xl">
                                            <h4 class="text-white font-bold mb-2">Account Management</h4>
                                            <p class="text-sm text-gray-500">To create and manage your user account for booking tickets and ordering food.</p>
                                        </div>
                                        <div class="p-6 bg-[#0a0a0a] border border-gray-800 rounded-2xl">
                                            <h4 class="text-white font-bold mb-2">Service Improvement</h4>
                                            <p class="text-sm text-gray-500">Testing new features and analyzing user behavior to make the app even better.</p>
                                        </div>
                                        <div class="p-6 bg-[#0a0a0a] border border-gray-800 rounded-2xl">
                                            <h4 class="text-white font-bold mb-2">Marketing</h4>
                                            <p class="text-sm text-gray-500">Sending you news about the latest movie releases and exclusive VIP offers.</p>
                                        </div>
                                        <div class="p-6 bg-[#0a0a0a] border border-gray-800 rounded-2xl">
                                            <h4 class="text-white font-bold mb-2">Security</h4>
                                            <p class="text-sm text-gray-500">To monitor for suspicious activity and protect our system and your data.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 04. Data Security -->
                <div class="reveal-on-scroll">
                    <div class="bg-gradient-to-br from-[#111] to-[#0a0a0a] p-8 md:p-12 rounded-[2.5rem] border border-gray-700 relative overflow-hidden group shadow-2xl">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#df1873]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        <div class="flex items-center gap-8">
                            <div class="hidden md:flex w-20 h-20 bg-[#df1873]/10 border border-[#df1873]/30 rounded-3xl items-center justify-center text-[#df1873] shadow-[0_0_30px_rgba(223,24,115,0.2)] shrink-0">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04a12.02 12.02 0 00-3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-3.142-1.204-6.04-3.182-8.227z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-black text-white mb-4">Security Protocol</h2>
                                <p class="text-gray-400 text-lg font-medium leading-relaxed">
                                    We use administrative, technical, and physical security measures to help protect your personal information. While we have taken reasonable steps to secure the personal information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 05. Contact -->
                <div class="reveal-on-scroll">
                    <div class="text-center py-16">
                        <h2 class="text-3xl font-black text-white mb-6">Still Have Questions?</h2>
                        <p class="text-gray-400 mb-10 max-w-xl mx-auto font-medium">If you have any questions or comments about this policy, you may email us or visit our contact page.</p>
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <a href="{{ route('contact.index') }}" class="bg-[#df1873] hover:bg-[#c21463] text-white font-bold px-10 py-4 rounded-2xl transition-all shadow-[0_0_20px_rgba(223,24,115,0.3)] hover:scale-105">Contact Us</a>
                            <a href="mailto:privacy@zucocinema.com" class="bg-transparent hover:bg-white/5 text-gray-300 border border-gray-800 font-bold px-10 py-4 rounded-2xl transition-all hover:scale-105">Email Privacy Team</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Scripts for animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { 
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            });
            
            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
</x-app-layout>
