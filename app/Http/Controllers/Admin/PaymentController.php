<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');

        $query = Payment::query()
            ->whereNotNull('screenshot_path')
            ->with(['booking.user', 'booking.showtime.movie']);

        if ($status === 'history') {
            $query->whereIn('status', ['success', 'failed']);
        } else {
            $query->where('status', 'pending');
        }

        // Date Filter Logic
        // Date Filter Logic (Updated)
        if ($request->filled('date')) {
            $query->whereHas('booking.showtime', function ($q) use ($request) {
                $q->whereDate('date', $request->date);
            });
        }

        // Pagination
        $payments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.payments.index', compact('payments', 'status'));
    }

    public function export(Request $request)
    {
        $status = $request->input('status', 'pending');

        $query = Payment::query()
            ->whereNotNull('screenshot_path')
            ->with(['booking.user', 'booking.showtime.movie']);

        if ($status === 'history') {
            $query->whereIn('status', ['success', 'failed']);
        } else {
            $query->where('status', 'pending');
        }

        if ($request->filled('date')) {
            if ($status === 'history') {
                $query->whereDate('created_at', $request->date);
            } else {
                $query->whereHas('booking.showtime', function ($q) use ($request) {
                    $q->whereDate('date', $request->date);
                });
            }
        }

        $payments = $query->latest()->get();

        $csvFileName = 'payments_' . $status . '_' . date('Y-m-d_H-i') . '.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$csvFileName\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($payments) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Booking Ref', 'Customer', 'Amount', 'Method', 'Status', 'Date', 'Transaction ID']);

            foreach ($payments as $payment) {
                fputcsv($handle, [
                    $payment->id,
                    $payment->booking->booking_reference ?? 'N/A',
                    $payment->booking->user->name ?? 'N/A',
                    $payment->amount,
                    strtoupper($payment->payment_method),
                    ucfirst($payment->status),
                    $payment->created_at->format('Y-m-d H:i:s'),
                    $payment->transaction_id
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
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
