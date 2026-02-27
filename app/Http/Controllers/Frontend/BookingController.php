<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Ticket;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function seatSelection(Showtime $showtime)
    {

        $cinemaHall = $showtime->cinemaHall()->with('cinema')->first();
        $seatsByRow = $cinemaHall->seats()->get()->groupBy('row');


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

        $foodItems = \App\Models\FoodItem::all();

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
        $bookings = \App\Models\Booking::where('user_id', auth()->id())
            ->with(['showtime.movie', 'showtime.cinemaHall.cinema', 'tickets.seat', 'foodOrders.orderItems.foodItem'])
            ->latest()
            ->get();

        return view('frontend.my_tickets', compact('bookings'));
    }


    public function confirmBooking(Request $request, Showtime $showtime)
    {
        $seatIds = session('booking_seats', []);

        if (empty($seatIds)) {
            return redirect()->route('home')->with('error', 'No seats selected.');
        }


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


        $booking = \App\Models\Booking::create([
            'user_id' => auth()->id(),
            'showtime_id' => $showtime->id,
            'booking_reference' => 'ZUCO-' . strtoupper(uniqid()),
            'total_amount' => $seatTotal + $foodTotal,
            'status' => 'confirmed',
        ]);


        foreach ($seats as $seat) {
            \App\Models\Ticket::create([
                'booking_id' => $booking->id,
                'seat_id' => $seat->id,
                'price' => $seat->seatType ? $seat->seatType->price : 5000,
            ]);
        }


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


        session()->forget(['booking_seats', 'booking_food']);

        return redirect()->route('home')->with('success', 'Payment Successful! Your tickets and food have been booked.');
    }

    public function cancelBooking(Request $request, Booking $booking)
    {
        // 1. Authorization: ကိုယ်ပိုင်တဲ့ Booking ဟုတ်မဟုတ် စစ်မယ်
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Validation: Cancel လုပ်ပြီးသားလား (သို့) ရုပ်ရှင်ပြပြီးသွားပြီလား စစ်မယ်
        if ($booking->status === 'cancelled') {
            return back()->with('error', 'This booking is already cancelled.');
        }

        $showtimeStart = \Carbon\Carbon::parse($booking->showtime->date . ' ' . $booking->showtime->start_time);
        
        if ($showtimeStart->isPast()) {
            return back()->with('error', 'You cannot cancel a booking for a showtime that has already started or passed.');
        }

        // 3. Process: Status ကို Cancelled ပြောင်းမယ်
        // (Seat Selection Logic မှာ status 'confirmed'/'pending' ကိုပဲ ယူထားလို့ ဒီလိုပြောင်းလိုက်တာနဲ့ ခုံတွေ အလိုလို ပြန်အားသွားပါလိမ့်မယ်)
        $booking->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function showTicket(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->load(['showtime.movie', 'showtime.cinemaHall.cinema', 'tickets.seat', 'foodOrders.orderItems.foodItem']);

        return view('frontend.ticket', compact('booking'));
    }
}
