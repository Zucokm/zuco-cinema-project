<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Revenue Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-[#df1873]">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase mb-1">Today's Revenue</div>
                    <div class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($todayRevenue) }} Ks</div>
                </div>

                <!-- Tickets Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase mb-1">Tickets Sold Today</div>
                    <div class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($todayTickets) }}</div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Monthly Revenue Chart -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Monthly Revenue ({{ date('Y') }})</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Tickets by Movie Pie Chart -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Tickets Sold by Movie</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="ticketsPieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Table -->
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

        const ctxPie = document.getElementById('ticketsPieChart');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: @json(array_keys($ticketsPerMovie)),
                datasets: [{
                    data: @json(array_values($ticketsPerMovie)),
                    backgroundColor: [
                        '#df1873', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6',
                        '#ec4899', '#6366f1', '#14b8a6', '#f97316', '#ef4444'
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
                        labels: { color: '#9ca3af' }
                    }
                }
            }
        });
    </script>
</x-app-layout>