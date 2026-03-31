<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-[#df1873] blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-[#df1873]/20 rounded-xl group-hover:border-[#df1873]/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#df1873] transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Analytics Reports
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Comprehensive Data & Insights</p>
                </div>
            </div>

            <button onclick="window.print()" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-gray-700 to-gray-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200"></div>

                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-gray-600/50 group-hover:border-transparent group-hover:bg-gradient-to-r group-hover:from-gray-700 group-hover:to-gray-600 text-white font-bold py-2.5 px-6 rounded-xl transition-all duration-300 transform group-hover:-translate-y-0.5 shadow-[0_0_20px_rgba(100,100,100,0.2)]">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Print Report</span>
                </div>
            </button>

        </div>
    </x-slot>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(223, 24, 115, 0.7);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(223, 24, 115, 1);
        }

        ::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.5;
            cursor: pointer;
        }

        ::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printable-area,
            #printable-area * {
                visibility: visible;
            }

            #printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }

            .shadow-lg,
            .shadow-xl {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }

            .bg-\[\#111\] {
                background: #fff !important;
                color: #000 !important;
            }

            * {
                color: #000 !important;
            }
        }
    </style>

    <div class="bg-[#0a0a0a] min-h-screen py-10 relative overflow-hidden" id="printable-area">

        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none no-print"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[40rem] h-[40rem] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none no-print"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('admin.reports.index') }}" class="mb-8 bg-[#111]/80 backdrop-blur-md p-6 rounded-[1.5rem] shadow-lg border border-gray-800 no-print">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">

                    <div class="flex flex-col justify-end">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Start Date</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="w-full bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors [color-scheme:dark]">
                    </div>

                    <div class="flex flex-col justify-end">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">End Date</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="w-full bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors [color-scheme:dark]">
                    </div>

                    <div class="flex flex-col justify-end">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Filter By Movie</label>
                        <div class="relative">
                            <select name="movie_id" class="w-full bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors appearance-none pr-10">
                                <option value="">All Movies</option>
                                @foreach($moviesList as $movie)
                                <option value="{{ $movie->id }}" {{ $selectedMovie == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col justify-end">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Filter By Director</label>
                        <div class="relative">
                            <select name="director" class="w-full bg-[#0a0a0a] border border-gray-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors appearance-none pr-10">
                                <option value="">All Directors</option>
                                @foreach($directorsList as $dir)
                                <option value="{{ $dir }}" {{ $selectedDirector == $dir ? 'selected' : '' }}>{{ $dir }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col justify-end">
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 border border-transparent bg-gradient-to-r from-[#df1873] to-purple-600 text-white hover:from-[#c21463] hover:to-purple-700 px-4 py-3 rounded-xl font-black text-sm transition-all shadow-[0_0_15px_rgba(223,24,115,0.4)]">
                                Generate
                            </button>
                            <a href="{{ route('admin.reports.index') }}" class="px-4 py-3 border border-transparent bg-gray-800 hover:bg-gray-700 text-white rounded-xl font-black text-sm transition-colors flex items-center justify-center">
                                Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Summary KPIs --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <div class="bg-gradient-to-br from-[#1a1014] to-[#111] backdrop-blur-xl overflow-hidden shadow-lg rounded-[1.5rem] p-8 border border-[#df1873]/30 relative group hover:border-[#df1873] transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute -right-4 -top-4 p-4 opacity-10 text-[#df1873] group-hover:scale-110 group-hover:opacity-20 transition-all duration-500">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div class="text-[#df1873] text-sm font-black tracking-widest uppercase mb-2">Total Generated Revenue</div>
                        <div class="text-4xl md:text-5xl font-black text-white flex items-baseline gap-2 drop-shadow-md">
                            <span>{{ number_format($totalRevenue) }}</span> <span class="text-lg text-[#df1873] uppercase font-bold">Ks</span>
                        </div>
                        <p class="text-gray-400 text-xs mt-3 font-medium">Selected Period: {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-[#11131a] to-[#111] backdrop-blur-xl overflow-hidden shadow-lg rounded-[1.5rem] p-8 border border-indigo-500/30 relative group hover:border-indigo-500 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute -right-4 -top-4 p-4 opacity-10 text-indigo-500 group-hover:scale-110 group-hover:opacity-20 transition-all duration-500">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div class="text-indigo-400 text-sm font-black tracking-widest uppercase mb-2">Total Tickets Sold</div>
                        <div class="text-4xl md:text-5xl font-black text-white drop-shadow-md">{{ number_format($totalTickets) }}</div>
                        <p class="text-gray-400 text-xs mt-3 font-medium">From all confirmed bookings in period</p>
                    </div>
                </div>

            </div>

            {{-- Chart Section --}}
            <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] p-6 sm:p-8 mb-8">
                <h3 class="text-lg font-black text-white mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-gradient-to-b from-[#df1873] to-purple-600 rounded-full"></span>
                    Revenue Growth (Timeline)
                </h3>
                <div class="relative h-80 w-full">
                    <canvas id="mainRevenueChart"></canvas>
                </div>
            </div>

            {{-- 2 Columns for Data Tables --}}
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                {{-- Daily Movie Sales --}}
                <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] overflow-hidden flex flex-col">
                    <div class="px-6 py-5 border-b border-gray-800 flex justify-between items-center bg-[#0a0a0a]/50">
                        <h3 class="text-base font-black text-white flex items-center gap-2">
                            <span class="w-2 h-6 bg-green-500 rounded-full"></span>
                            Movie Performance
                        </h3>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest bg-gray-900 px-2 py-1 rounded">Latest Sales</span>
                    </div>

                    <div class="p-0 overflow-x-auto custom-scrollbar flex-1">
                        @if($moviePerformances->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-500 font-medium">No sales recorded for this criteria.</p>
                        </div>
                        @else
                        <table class="min-w-full text-left whitespace-nowrap">
                            <thead class="bg-[#0a0a0a]">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Date</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Movie</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Tickets</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800 text-right">Revenue</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800/60">
                                @foreach($moviePerformances as $mp)
                                <tr class="hover:bg-gray-800/30 transition-colors group">
                                    <td class="px-6 py-4 text-xs font-bold text-gray-400">{{ \Carbon\Carbon::parse($mp->sale_date)->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-white">{{ $mp->movie_title }}</div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">{{ $mp->director ?? 'Unknown Director' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center justify-center bg-indigo-500/10 text-indigo-400 px-3 py-1 rounded-full text-xs font-black min-w-[3rem]">
                                            {{ number_format($mp->ticket_count) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-black text-[#df1873]">{{ number_format($mp->revenue) }} Ks</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                    @if($moviePerformances->hasPages())
                    <div class="px-6 py-4 border-t border-gray-800 bg-[#0a0a0a]/30 no-print">
                        {{ $moviePerformances->withQueryString()->links() }}
                    </div>
                    @endif
                </div>

                {{-- Director Performance --}}
                <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] overflow-hidden flex flex-col">
                    <div class="px-6 py-5 border-b border-gray-800 flex justify-between items-center bg-[#0a0a0a]/50">
                        <h3 class="text-base font-black text-white flex items-center gap-2">
                            <span class="w-2 h-6 bg-yellow-500 rounded-full"></span>
                            Director Ranking
                        </h3>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest bg-gray-900 px-2 py-1 rounded">Ranked by Viewership</span>
                    </div>

                    <div class="p-0 overflow-x-auto custom-scrollbar flex-1">
                        @if($directorPerformances->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-500 font-medium">No records found.</p>
                        </div>
                        @else
                        <table class="min-w-full text-left whitespace-nowrap">
                            <thead class="bg-[#0a0a0a]">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800 w-12 text-center">#</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800">Director</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800 text-center">Movies</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800 text-center">Tickets (Views)</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest border-b border-gray-800 text-right">Gross Revenue</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800/60">
                                @foreach($directorPerformances as $index => $dp)
                                <tr class="hover:bg-gray-800/30 transition-colors group">
                                    <td class="px-6 py-4 text-center">
                                        @if($index == 0)
                                        <span class="text-yellow-500 font-black text-lg">1</span>
                                        @elseif($index == 1)
                                        <span class="text-gray-400 font-black text-base">2</span>
                                        @elseif($index == 2)
                                        <span class="text-amber-700 font-black text-base">3</span>
                                        @else
                                        <span class="text-gray-600 font-bold text-sm">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-white">{{ $dp->director ?? 'Unknown' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm font-bold text-gray-400">{{ $dp->total_movies }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm font-black text-indigo-400">{{ number_format($dp->total_tickets) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-black text-[#df1873]">{{ number_format($dp->total_revenue) }} Ks</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Chart Setup -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.color = '#6b7280';
            Chart.defaults.font.family = "'Figtree', sans-serif";

            const ctx = document.getElementById('mainRevenueChart');
            if (!ctx) return;

            // Gradient Fill
            let gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(223, 24, 115, 0.4)');
            gradient.addColorStop(1, 'rgba(168, 85, 247, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Revenue (Ks)',
                        data: @json($chartData),
                        borderColor: '#df1873',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#111',
                        pointBorderColor: '#df1873',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // Smooth curves
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#1f2937',
                                borderDash: [5, 5]
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString() + ' Ks';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#111',
                            titleColor: '#fff',
                            bodyColor: '#df1873',
                            borderColor: '#374151',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.raw.toLocaleString() + ' Ks';
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                }
            });
        });
    </script>
</x-app-layout>
