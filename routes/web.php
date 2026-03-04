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
    Route::get('/dashboard', function () {
        $today = \Carbon\Carbon::today();

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

        $todaysBookings = \App\Models\Booking::whereDate('created_at', $today)
            ->where('status', 'confirmed')
            ->with(['user', 'showtime.movie', 'showtime.cinemaHall'])
            ->latest()
            ->get();

        // Monthly Revenue for Chart
        $monthlyStats = \App\Models\Booking::selectRaw('SUM(total_amount) as total, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'confirmed')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyStats[$i] ?? 0;
        }

        // Tickets per Movie for Pie Chart
        $ticketsPerMovie = \App\Models\Ticket::whereHas('booking', function ($q) {
                $q->where('status', 'confirmed');
            })
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->select('movies.title', \Illuminate\Support\Facades\DB::raw('count(tickets.id) as count'))
            ->groupBy('movies.title')
            ->pluck('count', 'movies.title')
            ->toArray();

        return view('admin.dashboard', compact('todayRevenue', 'todayTickets', 'todayCheckedIn', 'todaysBookings', 'chartData', 'ticketsPerMovie'));
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
});

require __DIR__ . '/auth.php';
