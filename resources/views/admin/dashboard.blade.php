<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-[#df1873] blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-[#df1873]/20 rounded-xl group-hover:border-[#df1873]/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#df1873] transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Overview Analytics
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Zuco Admin Panel</p>
                </div>
            </div>
            
            <a href="{{ route('admin.scanner') }}" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-[#df1873] to-purple-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200 animate-pulse"></div>
                
                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-[#df1873]/50 group-hover:border-transparent group-hover:bg-gradient-to-r group-hover:from-[#df1873] group-hover:to-purple-600 text-white font-bold py-2.5 px-6 rounded-xl transition-all duration-300 transform group-hover:-translate-y-0.5 shadow-[0_0_20px_rgba(223,24,115,0.2)]">
                    <svg class="w-5 h-5 text-[#df1873] group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    <span>Scan Ticket</span>
                </div>
            </a>
            
        </div>
    </x-slot>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #df1873; border-radius: 10px; }
        
        /* Clean input date picker icon for dark mode */
        ::-webkit-calendar-picker-indicator { filter: invert(1); opacity: 0.5; cursor: pointer; }
        ::-webkit-calendar-picker-indicator:hover { opacity: 1; }
    </style>

    <div class="bg-[#0a0a0a] min-h-screen py-10 relative overflow-hidden">
        
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[40rem] h-[40rem] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-lg rounded-[1.5rem] p-6 border border-gray-800 relative group hover:border-[#df1873]/50 transition-colors">
                    <div class="absolute top-0 right-0 p-4 opacity-10 text-[#df1873] group-hover:scale-110 group-hover:opacity-20 transition-all">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="text-gray-400 text-xs font-black tracking-widest uppercase mb-2">Today's Revenue</div>
                    <div class="text-3xl font-black text-white flex items-end gap-1">
                        {{ number_format($todayRevenue) }} <span class="text-sm text-[#df1873] mb-1.5 uppercase">Ks</span>
                    </div>
                </div>

                <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-lg rounded-[1.5rem] p-6 border border-gray-800 relative group hover:border-blue-500/50 transition-colors">
                    <div class="absolute top-0 right-0 p-4 opacity-10 text-blue-500 group-hover:scale-110 group-hover:opacity-20 transition-all">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <div class="text-gray-400 text-xs font-black tracking-widest uppercase mb-2">Tickets Sold Today</div>
                    <div class="text-3xl font-black text-white">{{ number_format($todayTickets) }}</div>
                </div>

                <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-lg rounded-[1.5rem] p-6 border border-gray-800 relative group hover:border-green-500/50 transition-colors">
                    <div class="absolute top-0 right-0 p-4 opacity-10 text-green-500 group-hover:scale-110 group-hover:opacity-20 transition-all">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="text-gray-400 text-xs font-black tracking-widest uppercase mb-2">Checked-in Today</div>
                    <div class="text-3xl font-black text-white">{{ number_format($todayCheckedIn) }}</div>
                </div>

                <a href="{{ route('admin.payments.index') }}" class="bg-gradient-to-br from-yellow-900/40 to-[#111] backdrop-blur-xl overflow-hidden shadow-lg rounded-[1.5rem] p-6 border border-yellow-700/50 relative group hover:border-yellow-500 transition-colors block">
                    <div class="flex justify-between items-start">
                        <div class="relative z-10">
                            <div class="text-yellow-500/80 text-xs font-black tracking-widest uppercase mb-2">Pending Payments</div>
                            <div class="text-3xl font-black text-yellow-500">{{ number_format($pendingPaymentsCount) }}</div>
                        </div>
                        <div class="bg-yellow-500/20 p-3 rounded-xl text-yellow-500 group-hover:scale-110 group-hover:bg-yellow-500 group-hover:text-gray-900 transition-all relative z-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Date Range Filter --}}
            <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-8 bg-[#111]/80 backdrop-blur-md p-5 rounded-[1.5rem] shadow-lg border border-gray-800" x-data="{ mode: '{{ request('filter_month') ? 'month' : 'custom' }}' }">
                <div class="flex flex-col md:flex-row gap-5 items-end">
                    
                    <div class="w-full md:w-auto">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Filter By</label>
                        <div class="relative">
                            <select x-model="mode" class="w-full md:w-48 appearance-none bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors">
                                <option value="custom">Custom Range</option>
                                <option value="month">Specific Month</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <template x-if="mode === 'custom'">
                        <div class="flex flex-col sm:flex-row gap-5 w-full md:w-auto">
                            <div class="w-full sm:w-auto">
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Start Date</label>
                                <input type="date" name="start_date" value="{{ $startDate }}" class="w-full sm:w-40 bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors">
                            </div>
                            <div class="w-full sm:w-auto">
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">End Date</label>
                                <input type="date" name="end_date" value="{{ $endDate }}" class="w-full sm:w-40 bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors">
                            </div>
                        </div>
                    </template>

                    <template x-if="mode === 'month'">
                        <div class="w-full md:w-auto">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Select Month</label>
                            <input type="month" name="filter_month" value="{{ request('filter_month', \Carbon\Carbon::now()->format('Y-m')) }}" class="w-full md:w-48 bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors">
                        </div>
                    </template>

                    <button type="submit" class="w-full md:w-auto bg-white text-black hover:bg-gray-200 px-8 py-3 rounded-xl font-black text-sm transition-colors shadow-lg shadow-white/10 mt-4 md:mt-0">
                        Apply Filter
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                
                <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] p-6 sm:p-8">
                    <h3 class="text-lg font-black text-white mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#df1873] rounded-full"></span>
                        Revenue Trends
                    </h3>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] p-6 sm:p-8" x-data="{ showModal: false }">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-black text-white flex items-center gap-2">
                            <span class="w-2 h-6 bg-purple-500 rounded-full"></span>
                            Sales by Movie
                        </h3>
                        <button @click="showModal = true" class="text-xs bg-[#0a0a0a] hover:bg-gray-800 text-gray-400 hover:text-white px-4 py-2 rounded-lg transition-colors border border-gray-700 font-bold uppercase tracking-wider">
                            View All
                        </button>
                    </div>

                    <div class="relative h-72 w-full">
                        <canvas id="ticketsPieChart"></canvas>
                    </div>

                    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                            
                            <div x-show="showModal" 
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" @click="showModal = false"></div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <div x-show="showModal" 
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="relative inline-block align-bottom bg-[#111] rounded-[2rem] border border-gray-800 text-left overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.8)] transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                                
                                <div class="px-6 pt-6 pb-4 border-b border-gray-800 flex justify-between items-center">
                                    <h3 class="text-lg font-black text-white" id="modal-title">All Movies Sales Report</h3>
                                    <button @click="showModal = false" class="text-gray-500 hover:text-white bg-gray-900 p-2 rounded-full transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                
                                <div class="px-6 py-4">
                                    <div class="max-h-[50vh] overflow-y-auto custom-scrollbar pr-2">
                                        <table class="min-w-full">
                                            <thead class="bg-[#0a0a0a] sticky top-0">
                                                <tr>
                                                    <th class="px-4 py-3 text-left text-[10px] font-black text-gray-500 uppercase tracking-widest rounded-l-lg">Movie Title</th>
                                                    <th class="px-4 py-3 text-right text-[10px] font-black text-gray-500 uppercase tracking-widest rounded-r-lg">Tickets</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-800/50">
                                                @foreach($ticketsPerMovie as $movieName => $count)
                                                <tr class="hover:bg-gray-800/30 transition-colors">
                                                    <td class="px-4 py-3.5 text-sm font-bold text-white">{{ $movieName }}</td>
                                                    <td class="px-4 py-3.5 text-sm text-[#df1873] font-black text-right">{{ number_format($count) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-800 flex justify-between items-center bg-[#0a0a0a]/50">
                    <h3 class="text-lg font-black text-white">Recent Transactions</h3>
                    <span class="bg-[#df1873]/20 text-[#df1873] text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-[#df1873]/30">Today</span>
                </div>
                
                <div class="p-6">
                    @if($todaysBookings->isEmpty())
                        <div class="text-center py-10">
                            <svg class="w-12 h-12 text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <p class="text-gray-500 font-medium">No bookings recorded today.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto custom-scrollbar pb-4">
                            <table class="min-w-full text-left whitespace-nowrap">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Reference</th>
                                        <th class="px-4 py-3 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Customer</th>
                                        <th class="px-4 py-3 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Movie & Time</th>
                                        <th class="px-4 py-3 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Status</th>
                                        <th class="px-4 py-3 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800/60">
                                    @foreach($todaysBookings as $booking)
                                    <tr class="hover:bg-gray-800/20 transition-colors group">
                                        <td class="px-4 py-4 font-mono text-sm text-[#df1873] font-bold">{{ $booking->booking_reference }}</td>
                                        <td class="px-4 py-4">
                                            <div class="text-sm font-bold text-white">{{ $booking->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="text-sm font-bold text-gray-300">{{ $booking->showtime->movie->title }}</div>
                                            <div class="text-xs text-gray-500 mt-0.5">
                                                {{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }} &bull; {{ $booking->showtime->cinemaHall->name }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            @if($booking->status === 'checked-in')
                                                <span class="inline-flex items-center gap-1.5 bg-green-500/10 text-green-500 border border-green-500/20 px-2.5 py-1 rounded text-[11px] font-bold uppercase tracking-wider">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Checked In
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2.5 py-1 rounded text-[11px] font-bold uppercase tracking-wider">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Confirmed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-right text-sm font-black text-white group-hover:text-[#df1873] transition-colors">
                                            {{ number_format($booking->total_amount) }} <span class="text-[10px] text-gray-500 uppercase">Ks</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-6">
                            {{ $todaysBookings->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Set global default colors for Chart.js to match dark theme
        Chart.defaults.color = '#6b7280';
        Chart.defaults.font.family = "'Figtree', sans-serif";

        // --- 1. Revenue Chart ---
        const ctx = document.getElementById('revenueChart');
        
        // Create Gradient for Bar Chart
        let gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(223, 24, 115, 1)');
        gradient.addColorStop(1, 'rgba(168, 85, 247, 0.5)'); // Purple fade

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Revenue (Ks)',
                    data: @json($chartData),
                    borderWidth: 0,
                    borderRadius: 6,
                    backgroundColor: gradient,
                    hoverBackgroundColor: '#c21463'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { color: '#1f2937', borderDash: [5, 5] },
                        ticks: {
                            callback: function(value) { return value.toLocaleString(); }
                        }
                    },
                    x: { grid: { display: false } }
                },
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111',
                        titleColor: '#fff',
                        bodyColor: '#df1873',
                        borderColor: '#374151',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) { return context.raw.toLocaleString() + ' Ks'; }
                        }
                    }
                }
            }
        });

        // --- 2. Tickets Pie Chart ---
        const ctxPie = document.getElementById('ticketsPieChart');
        
        let rawLabels = @json(array_keys($ticketsPerMovie));
        let rawData = @json(array_values($ticketsPerMovie));

        let combinedData = rawLabels.map((label, i) => {
            return { label: label, value: rawData[i] };
        });
        combinedData.sort((a, b) => b.value - a.value);

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

        if (otherCount > 0) {
            finalLabels.push('Others');
            finalData.push(otherCount);
        }

        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: finalLabels,
                datasets: [{
                    data: finalData,
                    backgroundColor: [
                        '#df1873', '#8b5cf6', '#3b82f6', '#10b981', '#f59e0b',
                        '#374151' // Others
                    ],
                    borderColor: '#111', // Matches card background
                    borderWidth: 2,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Makes it a thinner ring
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { 
                            boxWidth: 10,
                            usePointStyle: true, // Makes legend icons circular
                            padding: 20,
                            font: { size: 12, weight: 'bold' },
                            color: '#9ca3af'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#374151',
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                let total = context.chart._metasets[context.datasetIndex].total;
                                let percentage = Math.round((value / total) * 100) + '%';
                                return ` ${value} Tickets (${percentage})`;
                            }
                        }
                    }
                },
                layout: { padding: 10 }
            }
        });
    </script>
</x-app-layout>