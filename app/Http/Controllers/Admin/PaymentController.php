<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Screenshot ပါပြီး Pending ဖြစ်နေတဲ့ Payment တွေကို ယူမယ်
        $payments = Payment::where('status', 'pending')
            ->whereNotNull('screenshot_path')
            ->with(['booking.user', 'booking.showtime.movie'])
            ->latest()
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function approve(Payment $payment)
    {
        $payment->update([
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // Update booking status to confirmed
        $payment->booking->update([
            'status' => 'confirmed'
        ]);

        if (request()->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Payment approved successfully.']);
        }

        return redirect()->back()->with('success', 'Payment verified and approved successfully.');
    }

    public function reject(Payment $payment)
    {
        $payment->update([
            'status' => 'failed'
        ]);

        // Payment ငြင်းလိုက်ရင် Booking ကိုပါ Cancel လုပ်မယ် (ခုံတွေ ပြန်လွတ်သွားအောင်)
        $payment->booking->update([
            'status' => 'cancelled'
        ]);

        return redirect()->back()->with('success', 'Payment rejected and booking cancelled.');
    }
}
