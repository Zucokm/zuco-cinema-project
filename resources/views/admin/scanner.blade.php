<x-app-layout>
    <div class="bg-[#0a0a0a] min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8 border-l-4 border-[#df1873] pl-4">
                <h1 class="text-3xl font-bold text-white">Ticket Scanner</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition">Back to Dashboard</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Scanner Section -->
                <div class="bg-[#111] p-6 rounded-2xl border border-gray-800 shadow-lg">
                    <div id="reader" class="w-full rounded-lg overflow-hidden bg-black"></div>
                    <p class="text-gray-500 text-sm mt-4 text-center">Point camera at the QR Code</p>
                    <div id="loading" class="hidden text-center mt-2 text-[#df1873] font-bold">Verifying...</div>

                    <div class="mt-6 pt-6 border-t border-gray-800">
                        <label class="block text-gray-400 text-sm font-bold mb-2">Manual Entry</label>
                        <div class="flex gap-2">
                            <input type="text" id="manual-input" placeholder="Enter Booking Ref (e.g. ZUCO-XXXX)" 
                                class="w-full bg-black border border-gray-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-[#df1873] transition">
                            <button onclick="handleManualEntry()" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-bold border border-gray-700 transition">Check</button>
                        </div>
                    </div>
                </div>

                <!-- Result Section -->
                <div class="bg-[#111] p-6 rounded-2xl border border-gray-800 shadow-lg flex flex-col justify-center items-center text-center min-h-[300px]" id="result-container">
                    
                    <!-- Default State -->
                    <div id="default-state">
                        <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Ready to Scan</h3>
                        <p class="text-gray-500">Scan a ticket to see details here.</p>
                    </div>

                    <!-- Success State -->
                    <div id="success-state" class="hidden w-full">
                        <div class="w-20 h-20 bg-green-900/30 rounded-full flex items-center justify-center mb-4 mx-auto border border-green-500">
                            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-green-500 mb-1" id="result-title">Valid Ticket</h3>
                        <p class="text-gray-400 text-sm mb-6" id="res-ref">REF: </p>

                        <div class="bg-gray-900/50 rounded-xl p-4 text-left space-y-3 w-full border border-gray-800">
                            <div class="flex justify-between"><span class="text-gray-500 text-xs">Movie</span> <span class="text-white font-bold text-sm text-right" id="res-movie"></span></div>
                            <div class="flex justify-between"><span class="text-gray-500 text-xs">Customer</span> <span class="text-white font-bold text-sm text-right" id="res-customer"></span></div>
                            <div class="flex justify-between"><span class="text-gray-500 text-xs">Seats</span> <span class="text-[#df1873] font-bold text-sm text-right" id="res-seats"></span></div>
                            <div class="flex justify-between items-center"><span class="text-gray-500 text-xs">Date</span> <span class="text-white font-bold text-sm text-right" id="res-date"></span></div>
                            <div class="flex justify-between items-center"><span class="text-gray-500 text-xs">Status</span> <span class="font-bold text-xs px-2 py-1 rounded uppercase" id="res-status"></span></div>
                        </div>

                        <!-- Payment Actions (Hidden by default) -->
                        <div id="payment-actions" class="hidden mt-4 pt-4 border-t border-gray-800 w-full">
                            <p class="text-yellow-500 text-xs font-bold mb-2 text-center">Action Required</p>
                            <div class="flex gap-2">
                                <a id="view-screenshot-btn" href="#" target="_blank" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-lg text-sm font-bold transition">View Screenshot</a>
                                <button id="approve-payment-btn" type="button" class="flex-1 bg-green-600 hover:bg-green-500 text-white py-2 rounded-lg text-sm font-bold transition">Approve Now</button>
                            </div>
                        </div>
                        
                        <button onclick="resetScanner()" class="mt-6 w-full bg-gray-800 hover:bg-gray-700 text-white py-3 rounded-xl font-bold transition">Scan Next</button>
                    </div>

                    <!-- Error State -->
                    <div id="error-state" class="hidden">
                        <div class="w-20 h-20 bg-red-900/30 rounded-full flex items-center justify-center mb-4 mx-auto border border-red-500">
                            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-red-500 mb-2">Invalid Ticket</h3>
                        <p class="text-gray-400 mb-6" id="error-msg">Ticket not found.</p>
                        <button onclick="resetScanner()" class="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 rounded-xl font-bold transition">Try Again</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        let html5QrcodeScanner;
        let isScanning = true;

        function onScanSuccess(decodedText, decodedResult) {
            if (!isScanning) return;
            
            isScanning = false;
            document.getElementById('loading').classList.remove('hidden');

            // Send to backend
            fetch('{{ route("admin.scanner.verify") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ qr_code: decodedText })
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
                isScanning = true; // Allow retry on network error
            });
        }

        function resetScanner() {
            isScanning = true;
            document.getElementById('success-state').classList.add('hidden');
            document.getElementById('error-state').classList.add('hidden');
            document.getElementById('payment-actions').classList.add('hidden');
            document.getElementById('default-state').classList.remove('hidden');
            // Reset styles
            showResult('success', 'Valid Ticket', null);
        }

        document.addEventListener('DOMContentLoaded', () => {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: { width: 250, height: 250 } },
                /* verbose= */ false
            );
            html5QrcodeScanner.render(onScanSuccess, (error) => {
                // handle scan failure, usually better to ignore and keep scanning.
            });
        });

        function showResult(type, message, data) {
            const successContainer = document.getElementById('success-state');
            const titleEl = document.getElementById('result-title');
            const iconContainer = successContainer.querySelector('div:first-child');
            const icon = iconContainer.querySelector('svg');

            // Reset classes
            titleEl.className = 'text-2xl font-bold mb-1';
            iconContainer.className = 'w-20 h-20 rounded-full flex items-center justify-center mb-4 mx-auto border';
            icon.className = 'w-10 h-10';

            if (type === 'success') {
                titleEl.classList.add('text-green-500');
                iconContainer.classList.add('bg-green-900/30', 'border-green-500');
                icon.classList.add('text-green-500');
            } else if (type === 'warning') {
                titleEl.classList.add('text-yellow-500');
                iconContainer.classList.add('bg-yellow-900/30', 'border-yellow-500');
                icon.classList.add('text-yellow-500');
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
                
                statusEl.className = 'font-bold text-xs px-2 py-1 rounded uppercase border';
                if (data.status === 'checked-in') {
                    statusEl.classList.add('bg-blue-900/30', 'text-blue-400', 'border-blue-800');
                } else if (data.status === 'confirmed') {
                    statusEl.classList.add('bg-green-900/30', 'text-green-400', 'border-green-800');
                } else if (data.status === 'cancelled') {
                    statusEl.classList.add('bg-red-900/30', 'text-red-400', 'border-red-800');
                } else {
                    statusEl.classList.add('bg-gray-800', 'text-white', 'border-gray-700');
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
                    approveBtn.onclick = function() { approvePayment(data.payment_id, data.reference); };
                } else {
                    paymentActions.classList.add('hidden');
                }
            }

            successContainer.classList.remove('hidden');
        }

        function approvePayment(id, reference) {
            if(!confirm('Are you sure you want to approve this payment?')) return;

            const approveBtn = document.getElementById('approve-payment-btn');
            const originalText = approveBtn.innerText;
            approveBtn.innerText = 'Processing...';
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
                if(data.status === 'success') {
                    // Automatically check-in by re-verifying the ticket
                    isScanning = true;
                    onScanSuccess(reference, null);
                }
            })
            .catch(err => {
                alert('Error approving payment');
                approveBtn.innerText = originalText;
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

        document.getElementById('manual-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') handleManualEntry();
        });
    </script>
</x-app-layout>