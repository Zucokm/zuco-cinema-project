<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#0a0a0a] text-gray-200">

    <div class="min-h-screen bg-[#0a0a0a]">

        @include('layouts.navigation')

        @isset($header)
        <header class="bg-[#0a0a0a]/90 backdrop-blur-xl border-b border-white/5 shadow-[0_10px_30px_rgba(0,0,0,0.5)] relative z-40">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/4 h-full bg-indigo-500/5 blur-[50px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 relative z-10">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main>
            {{ $slot }}
        </main>


        <style>
            /* အဝိုင်းလေးကို အသက်ဝင်နေသလို မှိတ်တုတ်မှိတ်တုတ် လင်းစေမယ့် Animation */
            @keyframes cursor-pulse-glow {

                0%,
                100% {
                    opacity: 1;
                    box-shadow: 0 0 5px rgba(223, 24, 115, 0.4), inset 0 0 2px rgba(223, 24, 115, 0.4);
                }

                50% {
                    opacity: 0.3;
                    box-shadow: 0 0 20px rgba(223, 24, 115, 0.8), inset 0 0 8px rgba(223, 24, 115, 0.6);
                }
            }

            .cursor-breathe {
                animation: cursor-pulse-glow 1.5s infinite ease-in-out;
            }
        </style>

        <div id="cursor-dot" class="fixed top-0 left-0 pointer-events-none z-[10000] hidden md:block">
            <div class="w-2 h-2 bg-[#df1873] rounded-full shadow-[0_0_10px_#df1873]"></div>
        </div>

        <div id="cursor-ring" class="fixed top-0 left-0 pointer-events-none z-[10000] hidden md:block transition-all duration-150 ease-out">
            <div id="ring-visual" class="w-8 h-8 border-[1.5px] border-[#df1873] rounded-full cursor-breathe transition-all duration-300"></div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const cursorDot = document.getElementById('cursor-dot');
                const cursorRing = document.getElementById('cursor-ring');
                const ringVisual = document.getElementById('ring-visual');

                // Mouse ရွှေ့တိုင်း Cursor ကို လိုက်ရွှေ့မယ်
                window.addEventListener('mousemove', (e) => {
                    const posX = e.clientX;
                    const posY = e.clientY;

                    // ဗဟိုတည့်တည့်ဖြစ်အောင် translate(-50%, -50%) ကို တွဲသုံးထားပါတယ်
                    cursorDot.style.transform = `translate3d(${posX}px, ${posY}px, 0) translate(-50%, -50%)`;
                    cursorRing.style.transform = `translate3d(${posX}px, ${posY}px, 0) translate(-50%, -50%)`;
                });

                // Button တွေ၊ Link တွေပေါ်ရောက်တဲ့အခါ Effect ပြောင်းမယ်
                const interactiveElements = document.querySelectorAll('a, button, input, select, textarea');

                interactiveElements.forEach(el => {
                    el.addEventListener('mouseenter', () => {
                        // Mouse တင်လိုက်ရင် မှိတ်တုတ်ဖြစ်တာကို ခဏရပ်ပြီး၊ အဝိုင်းကိုကြီးသွားစေမယ်
                        ringVisual.classList.remove('cursor-breathe');
                        ringVisual.classList.add('scale-[1.5]', 'bg-[#df1873]/20', 'border-[#df1873]');
                    });

                    el.addEventListener('mouseleave', () => {
                        // Mouse ဖယ်လိုက်ရင် မှိတ်တုတ်ဖြစ်တာ ပြန်စမယ်၊ မူလအရွယ် ပြန်ဖြစ်မယ်
                        ringVisual.classList.add('cursor-breathe');
                        ringVisual.classList.remove('scale-[1.5]', 'bg-[#df1873]/20', 'border-[#df1873]');
                    });
                });
            });
        </script>
    </div>
</body>

</html>