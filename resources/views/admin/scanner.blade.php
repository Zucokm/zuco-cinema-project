<x-app-layout>
    <style>
        /* Custom styles for the HTML5-QRCode Scanner UI to fit dark theme */
        #reader {
            border: none !important;
            border-radius: 1rem;
            overflow: hidden;
        }

        #reader__dashboard_section_csr span {
            color: #9ca3af !important;
            font-family: 'Figtree', sans-serif;
            font-size: 12px;
        }

        #reader__dashboard_section_swaplink {
            color: #df1873 !important;
            text-decoration: none;
            font-weight: bold;
        }

        #reader__camera_selection {
            background: #111;
            color: white;
            border: 1px solid #374151;
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 10px;
            width: 100%;
            outline: none;
        }

        #reader button {
            background: #df1873;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin: 5px;
        }

        #reader button:hover {
            background: #c21463;
            box-shadow: 0 0 10px rgba(223, 24, 115, 0.4);
        }

        #reader video {
            border-radius: 1rem;
            object-fit: cover;
        }

        /* Custom animated scan line */
        .scan-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: #df1873;
            box-shadow: 0 0 15px 2px #df1873, 0 0 5px 1px #df1873;
            animation: scan 2s linear infinite;
            z-index: 10;
            display: none;
        }

        @keyframes scan {
            0% {
                top: 0;
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                top: 100%;
                opacity: 0;
            }
        }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-[#df1873] blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-[#df1873]/20 rounded-xl group-hover:border-[#df1873]/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#df1873] transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Ticket Scanner
                    </h2>
                    <p class="text-xs font-bold text-green-500 uppercase tracking-widest mt-0.5 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Camera Active
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="bg-[#111] hover:bg-gray-800 border border-gray-700 text-white font-bold py-2 px-5 rounded-xl transition-all shadow-lg text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">

        <div class="absolute top-[-10%] left-[20%] w-[30rem] h-[30rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-7 space-y-6">
                    <div class="bg-[#111]/80 backdrop-blur-xl p-6 rounded-[2rem] border border-gray-800/60 shadow-2xl relative group">

                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-black text-white uppercase tracking-widest flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Scan QR Code
                            </h3>
                            <div id="loading" class="hidden text-[10px] bg-[#df1873]/20 text-[#df1873] border border-[#df1873]/30 px-3 py-1 rounded-full font-black uppercase tracking-widest animate-pulse">Verifying...</div>
                        </div>

                        <div class="relative w-full rounded-[1.5rem] overflow-hidden bg-[#050505] border-2 border-dashed border-gray-700 p-1 group-hover:border-[#df1873]/30 transition-colors">
                            <div id="reader-wrapper" class="relative overflow-hidden rounded-[1.2rem]">
                                <div id="reader" class="w-full"></div>
                                <div id="scan-line" class="scan-line"></div>
                            </div>

                            <div class="absolute top-4 left-4 w-8 h-8 border-t-4 border-l-4 border-[#df1873] rounded-tl-lg pointer-events-none opacity-50"></div>
                            <div class="absolute top-4 right-4 w-8 h-8 border-t-4 border-r-4 border-[#df1873] rounded-tr-lg pointer-events-none opacity-50"></div>
                            <div class="absolute bottom-4 left-4 w-8 h-8 border-b-4 border-l-4 border-[#df1873] rounded-bl-lg pointer-events-none opacity-50"></div>
                            <div class="absolute bottom-4 right-4 w-8 h-8 border-b-4 border-r-4 border-[#df1873] rounded-br-lg pointer-events-none opacity-50"></div>
                        </div>
                    </div>

                    <div class="bg-[#111]/60 backdrop-blur-md p-6 rounded-[1.5rem] border border-gray-800 shadow-lg">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Manual Entry
                        </label>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-bold">#</span>
                                </div>
                                <input type="text" id="manual-input" placeholder="e.g. ZUCO-XXXX"
                                    class="w-full bg-[#0a0a0a] border border-gray-700 text-white rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-bold uppercase transition shadow-inner placeholder-gray-600">
                            </div>
                            <button onclick="handleManualEntry()" class="bg-gray-800 hover:bg-gray-700 border border-gray-600 text-white px-8 py-3 rounded-xl font-bold transition shadow-md w-full sm:w-auto">
                                Check
                            </button>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="bg-[#111]/90 backdrop-blur-2xl p-6 rounded-[2rem] border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col items-center justify-center text-center min-h-[450px] sticky top-24" id="result-container">

                        <div id="default-state" class="w-full flex flex-col items-center animate-fade-in">
                            <div class="relative w-24 h-24 mb-6">
                                <div class="absolute inset-0 bg-gray-800 blur-xl opacity-20 rounded-full"></div>
                                <div class="relative w-full h-full bg-[#0a0a0a] border border-gray-800 rounded-full flex items-center justify-center shadow-inner">
                                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-xl font-black text-white mb-2">Awaiting Scan</h3>
                            <p class="text-gray-500 font-medium text-sm max-w-[200px]">Point the camera at a ticket QR code to verify it here.</p>
                        </div>

                        <div id="success-state" class="hidden w-full flex flex-col animate-fade-in-up">
                            <div class="relative w-20 h-20 mb-4 mx-auto" id="result-icon-container">
                                <div class="absolute inset-0 blur-lg opacity-40 rounded-full" id="result-glow"></div>
                                <div class="relative w-full h-full rounded-full flex items-center justify-center border-2 shadow-inner" id="result-circle">
                                    <svg class="w-10 h-10" id="result-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-black mb-1" id="result-title">Valid Ticket</h3>
                            <p class="text-gray-500 text-xs font-mono font-bold tracking-widest mb-6" id="res-ref">REF: </p>

                            <div class="bg-[#0a0a0a]/80 rounded-[1.5rem] p-5 text-left w-full border border-gray-800 shadow-inner">
                                <div class="space-y-4">
                                    <div class="flex flex-col">
                                        <span class="text-gray-600 text-[10px] uppercase font-black tracking-widest mb-1">Movie</span>
                                        <span class="text-white font-bold text-base leading-tight" id="res-movie"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="flex flex-col">
                                            <span class="text-gray-600 text-[10px] uppercase font-black tracking-widest mb-1">Customer</span>
                                            <span class="text-gray-300 font-bold text-sm truncate" id="res-customer"></span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-gray-600 text-[10px] uppercase font-black tracking-widest mb-1">Seats</span>
                                            <span class="text-[#df1873] font-black text-sm break-words" id="res-seats"></span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-end border-t border-gray-800/60 pt-4 mt-2">
                                        <div class="flex flex-col">
                                            <span class="text-gray-600 text-[10px] uppercase font-black tracking-widest mb-1">Showtime</span>
                                            <span class="text-gray-300 font-bold text-xs" id="res-date"></span>
                                        </div>
                                        <span class="font-black text-[10px] px-3 py-1.5 rounded-lg uppercase tracking-widest border" id="res-status"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="payment-actions" class="hidden mt-5 w-full bg-yellow-500/10 border border-yellow-500/20 rounded-xl p-4">
                                <div class="flex items-center justify-center gap-2 text-yellow-500 mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <span class="text-[10px] font-black uppercase tracking-widest">Payment Verification Required</span>
                                </div>
                                <div class="flex gap-2">
                                    <a id="view-screenshot-btn" href="#" target="_blank" class="flex-1 bg-[#111] hover:bg-gray-800 border border-gray-700 text-gray-300 py-2.5 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Receipt
                                    </a>
                                    <button id="approve-payment-btn" type="button" class="flex-1 bg-green-600 hover:bg-green-500 text-white py-2.5 rounded-lg text-xs font-bold transition shadow-lg flex items-center justify-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Approve
                                    </button>
                                </div>
                            </div>

                            <button onclick="resetScanner()" class="mt-6 w-full bg-gradient-to-r from-gray-800 to-gray-700 hover:from-gray-700 hover:to-gray-600 text-white py-3.5 rounded-xl font-bold transition shadow-lg flex items-center justify-center gap-2 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Scan Next Ticket
                            </button>
                        </div>

                        <div id="error-state" class="hidden w-full flex flex-col items-center animate-fade-in-up">
                            <div class="relative w-24 h-24 mb-6">
                                <div class="absolute inset-0 bg-red-600 blur-xl opacity-30 rounded-full animate-pulse"></div>
                                <div class="relative w-full h-full bg-red-900/30 border-2 border-red-500 rounded-full flex items-center justify-center shadow-inner">
                                    <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-red-500 mb-2">Scan Failed</h3>
                            <p class="text-gray-400 font-medium mb-8 max-w-[250px]" id="error-msg">Ticket not found or invalid format.</p>

                            <button onclick="resetScanner()" class="w-full bg-[#111] hover:bg-gray-800 border border-gray-700 text-white py-3.5 rounded-xl font-bold transition shadow-lg">
                                Try Again
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        let html5QrcodeScanner;
        let isScanning = true;

        // Start scan line animation when camera is rendering
        const scanLine = document.getElementById('scan-line');

        function onScanSuccess(decodedText, decodedResult) {
            if (!isScanning) return;

            isScanning = false;
            scanLine.style.display = 'none'; // Hide laser
            document.getElementById('loading').classList.remove('hidden');

            // Send to backend
            fetch('{{ route("admin.scanner.verify") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        qr_code: decodedText
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loading').classList.add('hidden');
                    document.getElementById('default-state').classList.add('hidden');

                    if (data.status === 'success') {
                        showResult('success', data.message, data.data);
                    } else if (data.status === 'warning') {
                        showResult('warning', data.message, data.data);
                    } else {
                        document.getElementById('success-state').classList.add('hidden');
                        document.getElementById('error-state').classList.remove('hidden');
                        document.getElementById('error-msg').innerText = data.message;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loading').classList.add('hidden');
                    document.getElementById('default-state').classList.add('hidden');
                    document.getElementById('error-state').classList.remove('hidden');
                    document.getElementById('error-msg').innerText = 'An unexpected error occurred. Please try again.';
                    isScanning = true;
                });
        }

        function resetScanner() {
            isScanning = true;
            scanLine.style.display = 'block'; // Show laser again
            document.getElementById('success-state').classList.add('hidden');
            document.getElementById('error-state').classList.add('hidden');
            document.getElementById('payment-actions').classList.add('hidden');
            document.getElementById('default-state').classList.remove('hidden');
            document.getElementById('manual-input').value = '';
        }

        document.addEventListener('DOMContentLoaded', () => {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false
            );
            html5QrcodeScanner.render((text, result) => {
                scanLine.style.display = 'block'; // Show laser once camera is up
                onScanSuccess(text, result);
            }, (error) => {
                // Ignore general errors to keep scanning
            });
        });

        function showResult(type, message, data) {
            const successContainer = document.getElementById('success-state');
            const titleEl = document.getElementById('result-title');

            // Dynamic Icon Elements
            const glowEl = document.getElementById('result-glow');
            const circleEl = document.getElementById('result-circle');
            const iconEl = document.getElementById('result-icon');

            // Reset classes
            glowEl.className = 'absolute inset-0 blur-lg opacity-40 rounded-full';
            circleEl.className = 'relative w-full h-full rounded-full flex items-center justify-center border-2 shadow-inner';
            titleEl.className = 'text-2xl font-black mb-1';

            if (type === 'success') {
                titleEl.classList.add('text-green-500');
                glowEl.classList.add('bg-green-500');
                circleEl.classList.add('bg-green-900/30', 'border-green-500', 'text-green-500');
                iconEl.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
            } else if (type === 'warning') {
                titleEl.classList.add('text-yellow-500');
                glowEl.classList.add('bg-yellow-500');
                circleEl.classList.add('bg-yellow-900/30', 'border-yellow-500', 'text-yellow-500');
                iconEl.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>';
            }

            titleEl.innerText = message;

            if (data) {
                document.getElementById('res-ref').innerText = 'REF: ' + data.reference;
                document.getElementById('res-movie').innerText = data.movie;
                document.getElementById('res-customer').innerText = data.customer;
                document.getElementById('res-seats').innerText = data.seats;
                document.getElementById('res-date').innerText = data.date + ' | ' + data.time;

                const statusEl = document.getElementById('res-status');
                statusEl.innerText = data.status.replace('_', '-');
                statusEl.className = 'font-black text-[10px] px-3 py-1.5 rounded-lg uppercase tracking-widest border';

                if (data.status === 'checked-in') {
                    statusEl.classList.add('bg-blue-900/20', 'text-blue-400', 'border-blue-800');
                } else if (data.status === 'confirmed') {
                    statusEl.classList.add('bg-green-900/20', 'text-green-400', 'border-green-800');
                } else if (data.status === 'cancelled') {
                    statusEl.classList.add('bg-red-900/20', 'text-red-400', 'border-red-800');
                } else {
                    statusEl.classList.add('bg-gray-800', 'text-gray-300', 'border-gray-700');
                }

                // Handle Payment Actions
                const paymentActions = document.getElementById('payment-actions');
                if (data.payment_id) {
                    paymentActions.classList.remove('hidden');

                    const viewBtn = document.getElementById('view-screenshot-btn');
                    if (data.screenshot_url) {
                        viewBtn.href = data.screenshot_url;
                        viewBtn.classList.remove('hidden');
                    } else {
                        viewBtn.classList.add('hidden');
                    }

                    const approveBtn = document.getElementById('approve-payment-btn');
                    approveBtn.onclick = function() {
                        approvePayment(data.payment_id, data.reference);
                    };
                } else {
                    paymentActions.classList.add('hidden');
                }
            }

            successContainer.classList.remove('hidden');
        }

        function approvePayment(id, reference) {
            if (!confirm('Are you sure you want to approve this payment?')) return;

            const approveBtn = document.getElementById('approve-payment-btn');
            const originalHTML = approveBtn.innerHTML;
            approveBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...';
            approveBtn.disabled = true;

            fetch(`/admin/payments/${id}/approve`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        isScanning = true;
                        onScanSuccess(reference, null); // Re-verify to show checked-in status
                    }
                })
                .catch(err => {
                    alert('Error approving payment');
                    approveBtn.innerHTML = originalHTML;
                    approveBtn.disabled = false;
                });
        }

        function handleManualEntry() {
            const input = document.getElementById('manual-input');
            const code = input.value.trim();
            if (code) {
                onScanSuccess(code, null);
            }
        }

        document.getElementById('manual-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') handleManualEntry();
        });
    </script>
</x-app-layout>