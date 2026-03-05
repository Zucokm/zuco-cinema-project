<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Ticket;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function seatSelection(Showtime $showtime)
    {

        $cinemaHall = $showtime->cinemaHall()->with('cinema')->first();
        $seatsByRow = $cinemaHall->seats()->orderBy('row')->orderBy('number')->get()->groupBy('row');


        $bookedSeatIds = Ticket::whereHas('booking', function ($query) use ($showtime) {
            $query->where('showtime_id', $showtime->id)
                ->whereIn('status', ['pending', 'confirmed']);
        })->pluck('seat_id')->toArray();

        return view('frontend.seat_selection', compact('showtime', 'cinemaHall', 'seatsByRow', 'bookedSeatIds'));
    }

    public function processSeats(Request $request, Showtime $showtime)
    {

        $request->validate([
            'seat_ids' => 'required|array|min:1'
        ]);


        session(['booking_seats' => $request->seat_ids]);


        return redirect()->route('book.food', $showtime->id);
    }

    public function foodSelection(Showtime $showtime)
    {
        $seatIds = session('booking_seats', []);


        if (empty($seatIds)) {
            return redirect()->route('book.seats', $showtime->id);
        }


        $seats = \App\Models\Seat::whereIn('id', $seatIds)->with('seatType')->get();
        $seatTotal = $seats->sum(function ($seat) {
            return $seat->seatType ? $seat->seatType->price : 5000;
        });

        // Filter food items based on Cinema availability (Cinema Menus Stock)
        $cinemaId = $showtime->cinemaHall->cinema_id;
        $foodItems = \App\Models\FoodItem::whereHas('cinemaItems', function ($query) use ($cinemaId) {
            $query->where('cinema_id', $cinemaId)
                  ->where('isAvailable', true);
        })->get();

        return view('frontend.food_selection', compact('showtime', 'seats', 'seatTotal', 'foodItems'));
    }

    public function processFood(Request $request, Showtime $showtime)
    {

        $foodCart = json_decode($request->food_cart, true) ?? [];


        session(['booking_food' => $foodCart]);

        return redirect()->route('book.checkout', $showtime->id);
    }

    public function checkout(Showtime $showtime)
    {
        $seatIds = session('booking_seats', []);


        if (empty($seatIds)) {
            return redirect()->route('book.seats', $showtime->id);
        }


        $seats = \App\Models\Seat::whereIn('id', $seatIds)->with('seatType')->get();
        $seatTotal = $seats->sum(function ($seat) {
            return $seat->seatType ? $seat->seatType->price : 5000;
        });


        $foodCart = session('booking_food', []);
        $foodItemIds = array_keys($foodCart);
        $foodItems = \App\Models\FoodItem::whereIn('id', $foodItemIds)->get();

        $foodTotal = 0;
        $orderFoods = [];

        foreach ($foodItems as $item) {
            $qty = $foodCart[$item->id];
            $subtotal = $item->price * $qty;
            $foodTotal += $subtotal;

            $orderFoods[] = [
                'item' => $item,
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];
        }


        $grandTotal = $seatTotal + $foodTotal;

        return view('frontend.checkout', compact('showtime', 'seats', 'seatTotal', 'orderFoods', 'foodTotal', 'grandTotal'));
    }

    public function myTickets()
    {
        $bookings = \App\Models\Booking::where('bookings.user_id', auth()->id())
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->orderBy('showtimes.date', 'desc')
            ->orderBy('showtimes.start_time', 'desc')
            ->select('bookings.*')
            ->with(['showtime.movie', 'showtime.cinemaHall.cinema', 'tickets.seat', 'foodOrders.orderItems.foodItem'])
            ->get();

        return view('frontend.my_tickets', compact('bookings'));
    }


    public function confirmBooking(Request $request, Showtime $showtime)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'payment_screenshot' => 'required_if:payment_method,kpay,wavepay|image|max:2048', // 2MB Max
        ]);

        $seatIds = session('booking_seats', []);

        if (empty($seatIds)) {
            return redirect()->route('home')->with('error', 'No seats selected.');
        }

        try {
            return DB::transaction(function () use ($seatIds, $showtime, $request) {
                // 1. Check for Double Booking (Race Condition Check)
                // ဒီ Showtime အတွက် ရွေးထားတဲ့ခုံတွေက ရောင်းပြီးသား (သို့) Pending ဖြစ်နေပြီလား စစ်မယ်
                $isTaken = Ticket::whereHas('booking', function ($query) use ($showtime) {
                    $query->where('showtime_id', $showtime->id)
                          ->whereIn('status', ['confirmed', 'pending']);
                })->whereIn('seat_id', $seatIds)->exists();

                if ($isTaken) {
                    throw new \Exception('Oh no! Some seats were just booked by another user. Please select different seats.');
                }

                // 2. Calculate Totals
                $seats = \App\Models\Seat::whereIn('id', $seatIds)->with('seatType')->get();
                $seatTotal = $seats->sum(function ($seat) {
                    return $seat->seatType ? $seat->seatType->price : 5000;
                });

                $foodCart = session('booking_food', []);
                $foodTotal = 0;
                $totalFoodQty = 0;
                $foodItemsList = [];

                if (!empty($foodCart)) {
                    $foodItems = \App\Models\FoodItem::whereIn('id', array_keys($foodCart))->get();
                    foreach ($foodItems as $item) {
                        $qty = $foodCart[$item->id];
                        $foodTotal += ($item->price * $qty);
                        $totalFoodQty += $qty;
                        $foodItemsList[] = $item;
                    }
                }

                // 3. Create Booking
                $booking = \App\Models\Booking::create([
                    'user_id' => auth()->id(),
                    'showtime_id' => $showtime->id,
                    'booking_reference' => 'ZUCO-' . strtoupper(uniqid()),
                    'total_amount' => $seatTotal + $foodTotal,
                    'status' => $request->hasFile('payment_screenshot') ? 'pending' : 'confirmed',
                ]);

                // 4. Create Tickets
                foreach ($seats as $seat) {
                    \App\Models\Ticket::create([
                        'booking_id' => $booking->id,
                        'seat_id' => $seat->id,
                        'price' => $seat->seatType ? $seat->seatType->price : 5000,
                    ]);
                }

                // 5. Create Food Orders
                if (!empty($foodCart) && $foodTotal > 0) {
                    $foodOrder = \App\Models\FoodOrder::create([
                        'booking_id' => $booking->id,
                        'total_amount' => $foodTotal,
                        'status' => 'confirmed',
                        'total_items' => $totalFoodQty,
                    ]);

                    foreach ($foodItemsList as $item) {
                        \App\Models\OrderItem::create([
                            'food_order_id' => $foodOrder->id,
                            'food_item_id' => $item->id,
                            'price' => $item->price,
                            'quantity' => $foodCart[$item->id],
                        ]);
                    }
                }

                 // Handle Screenshot Upload
                $screenshotPath = null;
                if ($request->hasFile('payment_screenshot')) {
                    $screenshotPath = $request->file('payment_screenshot')->store('payment_screenshots', 'public');
                }

                // 6. Create Payment Record
                \App\Models\Payment::create([
                    'booking_id' => $booking->id,
                    'payment_method' => $request->payment_method,
                    'amount' => $booking->total_amount,
                    'status' => $screenshotPath ? 'pending' : 'success', // If screenshot uploaded, set to pending for admin review
                    'paid_at' => now(),
                    'transaction_id' => 'TXN-' . strtoupper(uniqid()),
                    'screenshot_path' => $screenshotPath,
                ]);

                session()->forget(['booking_seats', 'booking_food']);

                if (auth()->user()->role === 'admin') {
                    return redirect()->route('admin.pos')
                        ->with('success', 'Booking Confirmed Successfully!')
                        ->with('last_booking_id', $booking->id);
                }

                return redirect()->route('my-tickets')->with('success', 'Payment Successful! Your tickets and food have been booked.');
            });
        } catch (\Exception $e) {
            // Error တက်ရင် Session ရှင်းပြီး ပြန်ရွေးခိုင်းမယ်
            session()->forget(['booking_seats', 'booking_food']);
            return redirect()->route('book.seats', $showtime->id)->with('error', $e->getMessage());
        }
    }

    public function cancelBooking(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'This booking is already cancelled.');
        }

        $showtimeStart = \Carbon\Carbon::parse($booking->showtime->date . ' ' . $booking->showtime->start_time);
        
        // Logic Update:
        // Confirmed ဖြစ်ပြီးသားဆိုရင် (၁) နာရီကြို Cancel ရမယ်
        // Pending (ငွေမသွင်းရသေး/စစ်ဆေးဆဲ) ဆိုရင် ပွဲချိန်မတိုင်ခင်ထိ Cancel ခွင့်ပြုမယ်
        if ($booking->status === 'confirmed') {
            if ($showtimeStart->copy()->subHour()->isPast()) {
                return back()->with('error', 'Confirmed bookings can only be cancelled up to 1 hour before showtime.');
            }
        } else {
            if ($showtimeStart->isPast()) {
                return back()->with('error', 'You cannot cancel a booking for a past showtime.');
            }
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        // Payment ရှိရင် Status ကို failed ပြောင်းမယ် (Admin ဆီမှာ Pending မပြတော့အောင်)
        if ($booking->payment) {
            $booking->payment->update(['status' => 'failed']);
        }

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function showTicket(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->load(['payment', 'showtime.movie', 'showtime.cinemaHall.cinema', 'tickets.seat', 'foodOrders.orderItems.foodItem']);

        return view('frontend.ticket', compact('booking'));
    }

    public function pos(Request $request)
    {
        $query = \App\Models\Movie::whereHas('showtimes', function($q) {
            $q->where('date', '>=', \Carbon\Carbon::today());
        });

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $movies = $query->with(['showtimes' => function($q) {
            $q->where('date', '>=', \Carbon\Carbon::today())->orderBy('date')->orderBy('start_time');
        }, 'showtimes.cinemaHall.cinema'])->get();

        return view('admin.pos', compact('movies'));
    }

    public function scanner()
    {
        return view('admin.scanner');
    }

    public function verifyTicket(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        $booking = \App\Models\Booking::where('booking_reference', $request->qr_code)
            ->with(['user', 'showtime.movie', 'showtime.cinemaHall', 'tickets.seat', 'payment'])
            ->first();

        if (!$booking) {
            return response()->json(['status' => 'error', 'message' => 'Invalid Ticket! Booking not found.'], 404);
        }

        $responseData = [
            'reference' => $booking->booking_reference,
            'movie' => $booking->showtime->movie->title,
            'customer' => $booking->user->name,
            'seats' => $booking->tickets->map(fn($t) => $t->seat?->seat_code ?? 'N/A')->implode(', '),
            'date' => \Carbon\Carbon::parse($booking->showtime->date)->format('d M Y'),
            'time' => \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A'),
            'status' => $booking->status,
        ];

        // Check if the showtime is for today
        if (\Carbon\Carbon::parse($booking->showtime->date)->notEqualTo(\Carbon\Carbon::today())) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Wrong Date! Ticket is for ' . \Carbon\Carbon::parse($booking->showtime->date)->format('d M'),
                'data' => $responseData
            ]);
        }

        // Check current status
        if ($booking->status === 'checked-in') {
            return response()->json([
                'status' => 'warning',
                'message' => 'Already Checked-in!',
                'data' => $responseData
            ]);
        }

        if ($booking->status === 'cancelled') {
            return response()->json([
                'status' => 'warning',
                'message' => 'Ticket Cancelled!',
                'data' => $responseData
            ]);
        }

        // Check Payment Status (Pending Verification)
        if ($booking->payment && $booking->payment->status === 'pending') {
            // Add payment details for admin action
            $responseData['payment_id'] = $booking->payment->id;
            $responseData['screenshot_url'] = $booking->payment->screenshot_path ? asset('storage/' . $booking->payment->screenshot_path) : null;

            return response()->json([
                'status' => 'warning',
                'message' => 'Payment Verification Pending!',
                'data' => $responseData
            ]);
        }

        if ($booking->status !== 'confirmed') {
            return response()->json(['status' => 'error', 'message' => 'This ticket is not confirmed yet.'], 422);
        }

        // Update status to 'checked-in'
        $booking->status = 'checked-in';
        $booking->save();

        // Update status in response data
        $responseData['status'] = 'checked-in';

        return response()->json([
            'status' => 'success',
            'message' => 'Check-in Successful!',
            'data' => $responseData
        ]);
    }
}
