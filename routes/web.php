<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\PageController;

// ==========================================

// ==========================================
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/movies', [PageController::class, 'movies'])->name('movies.index');
Route::get('/cinemas', [PageController::class, 'cinemas'])->name('cinemas.index');
Route::get('/movies/{movie}', [PageController::class, 'movieDetails'])->name('movie.details');
Route::get('/cinemas/{cinema}', [PageController::class, 'cinemaDetails'])->name('cinema.details');


// ==========================================

// ==========================================
Route::middleware('auth')->group(function () {

    // Booking Flow 
    Route::get('/showtimes/{showtime}/book-seats', [BookingController::class, 'seatSelection'])->name('book.seats');
    Route::post('/showtimes/{showtime}/process-seats', [BookingController::class, 'processSeats'])->name('book.process-seats');
    Route::get('/showtimes/{showtime}/food', [BookingController::class, 'foodSelection'])->name('book.food');
    Route::post('/showtimes/{showtime}/process-food', [BookingController::class, 'processFood'])->name('book.process-food');
    Route::get('/showtimes/{showtime}/checkout', [BookingController::class, 'checkout'])->name('book.checkout');
    Route::post('/showtimes/{showtime}/confirm-booking', [BookingController::class, 'confirmBooking'])->name('book.confirm');
    Route::get('/my-tickets', [BookingController::class, 'myTickets'])->name('my-tickets');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
    Route::get('/bookings/{booking}/ticket', [BookingController::class, 'showTicket'])->name('booking.ticket');

    // Profile Management 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================

// ==========================================
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {

        return redirect()->route('admin.dashboard');
    }
 
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================

// ==========================================
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});


// ==========================================

// ==========================================
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
        $today = \Carbon\Carbon::today();
        
        // Date Range Filter
        if ($request->filled('filter_month')) {
            $month = \Carbon\Carbon::parse($request->filter_month);
            $start = $month->copy()->startOfMonth();
            $end = $month->copy()->endOfMonth();
            $startDate = $start->format('Y-m-d');
            $endDate = $end->format('Y-m-d');
        } else {
            $startDate = $request->input('start_date', \Carbon\Carbon::now()->startOfYear()->format('Y-m-d'));
            $endDate = $request->input('end_date', \Carbon\Carbon::now()->format('Y-m-d'));
            $start = \Carbon\Carbon::parse($startDate)->startOfDay();
            $end = \Carbon\Carbon::parse($endDate)->endOfDay();
        }

        $todayRevenue = \App\Models\Booking::whereDate('created_at', $today)
            ->where('status', 'confirmed')
            ->sum('total_amount');

        $todayTickets = \App\Models\Ticket::whereHas('booking', function ($query) use ($today) {
            $query->whereDate('created_at', $today)
                  ->where('status', 'confirmed');
        })->count();

        $todayCheckedIn = \App\Models\Ticket::whereHas('booking', function ($query) use ($today) {
            $query->where('status', 'checked-in')
                  ->whereHas('showtime', function ($q) use ($today) {
                      $q->where('date', $today);
                  });
        })->count();

        $pendingPaymentsCount = \App\Models\Payment::where('status', 'pending')->count();

        $todaysBookings = \App\Models\Booking::whereDate('created_at', $today)
            ->whereIn('status', ['confirmed', 'checked-in'])
            ->with(['user', 'showtime.movie', 'showtime.cinemaHall'])
            ->latest()
            ->paginate(10);

        // --- Revenue Chart Logic ---
        $diffInDays = $start->diffInDays($end);
        $chartLabels = [];
        $chartData = [];

        if ($diffInDays <= 60) { // ရက် ၆၀ အောက်ဆိုရင် နေ့အလိုက်ပြမယ်
            $revenueStats = \App\Models\Booking::selectRaw('SUM(total_amount) as total, DATE(created_at) as date')
                ->whereBetween('created_at', [$start, $end])
                ->where('status', 'confirmed')
                ->groupBy('date')
                ->pluck('total', 'date')
                ->toArray();
            
            $period = \Carbon\CarbonPeriod::create($start, $end);
            foreach ($period as $date) {
                $dateString = $date->format('Y-m-d');
                $chartLabels[] = $date->format('d M');
                $chartData[] = $revenueStats[$dateString] ?? 0;
            }
        } else { // ရက် ၆၀ ထက်များရင် လအလိုက်ပြမယ်
            $revenueStats = \App\Models\Booking::selectRaw('SUM(total_amount) as total, DATE_FORMAT(created_at, "%Y-%m") as month_year')
                ->whereBetween('created_at', [$start, $end])
                ->where('status', 'confirmed')
                ->groupBy('month_year')
                ->pluck('total', 'month_year')
                ->toArray();

            $current = $start->copy()->startOfMonth();
            $endMonth = $end->copy()->endOfMonth();
            
            while ($current <= $endMonth) {
                $key = $current->format('Y-m');
                $chartLabels[] = $current->format('M Y');
                $chartData[] = $revenueStats[$key] ?? 0;
                $current->addMonth();
            }
        }

        // --- Tickets Pie Chart Logic (Filtered) ---
        $ticketsPerMovie = \App\Models\Ticket::whereHas('booking', function ($q) use ($start, $end) {
                $q->where('status', 'confirmed')
                  ->whereBetween('created_at', [$start, $end]);
            })
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->select('movies.title', \Illuminate\Support\Facades\DB::raw('count(tickets.id) as count'))
            ->groupBy('movies.title')
            ->pluck('count', 'movies.title')
            ->toArray();

        return view('admin.dashboard', compact(
            'todayRevenue', 'todayTickets', 'todayCheckedIn', 'todaysBookings', 
            'chartData', 'chartLabels', 'ticketsPerMovie', 'pendingPaymentsCount',
            'startDate', 'endDate'
        ));
    })->name('dashboard');

    // Staff
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');

    // Admin Resources (CRUDs)
    Route::resource('movies', \App\Http\Controllers\Admin\MovieController::class);
    Route::resource('cinemas', \App\Http\Controllers\Admin\CinemaController::class);
    Route::resource('cinema-halls', \App\Http\Controllers\Admin\CinemaHallController::class);
    Route::resource('seat-types', \App\Http\Controllers\Admin\SeatTypeController::class);

    // Seats Custom Routes & Resource
    Route::delete('seats/clear/{hall_id}', [\App\Http\Controllers\Admin\SeatController::class, 'clearByHall'])->name('seats.clear');
    Route::resource('seats', \App\Http\Controllers\Admin\SeatController::class);

    Route::resource('showtimes', \App\Http\Controllers\Admin\ShowtimeController::class);
    Route::resource('food-types', \App\Http\Controllers\Admin\FoodTypeController::class);
    Route::resource('food-items', \App\Http\Controllers\Admin\FoodItemController::class);

    // Cinema Items Management
    Route::get('cinema-items', [\App\Http\Controllers\Admin\CinemaItemController::class, 'index'])->name('cinema-items.index');
    Route::get('cinema-items/{cinema}/manage', [\App\Http\Controllers\Admin\CinemaItemController::class, 'manage'])->name('cinema-items.manage');
    Route::post('cinema-items/{cinema}/store', [\App\Http\Controllers\Admin\CinemaItemController::class, 'store'])->name('cinema-items.store');

    // Admin POS (Booking)
    Route::get('/pos', [BookingController::class, 'pos'])->name('pos');

    // QR Scanner
    Route::get('/scanner', [BookingController::class, 'scanner'])->name('scanner');
    Route::post('/scanner/verify', [BookingController::class, 'verifyTicket'])->name('scanner.verify');

    // Payment Verification
    Route::get('/payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/export', [\App\Http\Controllers\Admin\PaymentController::class, 'export'])->name('payments.export');
    Route::post('/payments/{payment}/approve', [\App\Http\Controllers\Admin\PaymentController::class, 'approve'])->name('payments.approve');
    Route::post('/payments/{payment}/reject', [\App\Http\Controllers\Admin\PaymentController::class, 'reject'])->name('payments.reject');
});

require __DIR__ . '/auth.php';
