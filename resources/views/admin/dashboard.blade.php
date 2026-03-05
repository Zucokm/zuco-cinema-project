<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <a href="{{ route('admin.scanner') }}" class="bg-[#df1873] hover:bg-[#c21463] text-white font-bold py-2 px-4 rounded-lg shadow-md transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                Scan Ticket
            </a>
        </div>
    </x-slot>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #df1873; border-radius: 10px; }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-[#df1873]">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase mb-1">Today's Revenue</div>
                    <div class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($todayRevenue) }} Ks</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase mb-1">Tickets Sold Today</div>
                    <div class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($todayTickets) }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase mb-1">Checked-in Today</div>
                    <div class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($todayCheckedIn) }}</div>
                </div>

                <a href="{{ route('admin.payments.index') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition group">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase mb-1">Pending Payments</div>
                            <div class="text-3xl font-black text-yellow-600">{{ number_format($pendingPaymentsCount) }}</div>
                        </div>
                        <svg class="w-8 h-8 text-yellow-500 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Monthly Revenue ({{ date('Y') }})</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6" x-data="{ showModal: false }">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tickets Sold by Movie</h3>
                        <button @click="showModal = true" class="text-xs bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 px-3 py-1 rounded transition border border-gray-200 dark:border-gray-600">
                            View List
                        </button>
                    </div>

                    <div class="relative h-72 w-full">
                        <canvas id="ticketsPieChart"></canvas>
                    </div>

                    <div x-show="showModal" style="display: none;" 
                        class="fixed inset-0 z-50 overflow-y-auto" 
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="showModal" 
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showModal = false" aria-hidden="true"></div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <div x-show="showModal" 
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="relative inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                                
                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white border-b dark:border-gray-700 pb-2 mb-4 flex justify-between items-center" id="modal-title">
                                                <span>All Movies Sales Report</span>
                                                <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </h3>
                                            
                                            <div class="max-h-[60vh] overflow-y-auto custom-scrollbar">
                                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                                                        <tr>
                                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Movie Title</th>
                                                            <th scope="col" class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tickets</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                        @foreach($ticketsPerMovie as $movieName => $count)
                                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                                                            <td class="px-3 py-2 text-sm font-medium text-gray-900 dark:text-white">{{ $movieName }}</td>
                                                            <td class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-right font-mono">{{ number_format($count) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 dark:bg-gray-700/30 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" @click="showModal = false" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Today's Bookings</h3>
                    
                    @if($todaysBookings->isEmpty())
                        <p class="text-gray-500">No bookings found for today.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase font-bold text-xs">
                                    <tr>
                                        <th class="px-4 py-3">Reference</th>
                                        <th class="px-4 py-3">User</th>
                                        <th class="px-4 py-3">Movie</th>
                                        <th class="px-4 py-3">Time</th>
                                        <th class="px-4 py-3 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($todaysBookings as $booking)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                        <td class="px-4 py-3 font-mono text-[#df1873]">{{ $booking->booking_reference }}</td>
                                        <td class="px-4 py-3">{{ $booking->user->name }}</td>
                                        <td class="px-4 py-3">{{ $booking->showtime->movie->title }}</td>
                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}
                                            <span class="text-xs text-gray-500 block">{{ $booking->showtime->cinemaHall->name }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-right font-bold">{{ number_format($booking->total_amount) }} Ks</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- 1. Revenue Chart ---
        const ctx = document.getElementById('revenueChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue (Ks)',
                    data: @json($chartData),
                    borderWidth: 0,
                    borderRadius: 4,
                    backgroundColor: '#df1873',
                    hoverBackgroundColor: '#c21463'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { color: '#374151' } },
                    x: { grid: { display: false } }
                },
                plugins: { legend: { display: false } }
            }
        });

        // --- 2. Tickets Pie/Doughnut Chart (Top 5 + Others Logic) ---
        const ctxPie = document.getElementById('ticketsPieChart');
        
        // Data ရယူခြင်း
        let rawLabels = @json(array_keys($ticketsPerMovie));
        let rawData = @json(array_values($ticketsPerMovie));

        // Data များကိုတွဲပြီး Sort လုပ်ခြင်း (အများဆုံးမှ အနည်းဆုံးသို့)
        let combinedData = rawLabels.map((label, i) => {
            return { label: label, value: rawData[i] };
        });
        combinedData.sort((a, b) => b.value - a.value);

        // Top 5 ကိုခွဲထုတ်ခြင်း
        let finalLabels = [];
        let finalData = [];
        let otherCount = 0;
        const LIMIT = 5;

        combinedData.forEach((item, index) => {
            if (index < LIMIT) {
                finalLabels.push(item.label);
                finalData.push(item.value);
            } else {
                otherCount += item.value;
            }
        });

        // Others ရှိပါက ထပ်ထည့်ခြင်း
        if (otherCount > 0) {
            finalLabels.push('Others');
            finalData.push(otherCount);
        }

        // Chart ရေးဆွဲခြင်း
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: finalLabels,
                datasets: [{
                    data: finalData,
                    backgroundColor: [
                        '#df1873', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6',
                        '#94a3b8' // Others အရောင်
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { 
                            boxWidth: 12,
                            padding: 15,
                            font: { size: 11 },
                            color: '#9ca3af'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                let total = context.chart._metasets[context.datasetIndex].total;
                                let percentage = Math.round((value / total) * 100) + '%';
                                return label + ': ' + value + ' (' + percentage + ')';
                            }
                        }
                    }
                },
                layout: { padding: 10 }
            }
        });
    </script>
</x-app-layout>