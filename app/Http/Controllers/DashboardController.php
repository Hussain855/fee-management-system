<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\FeeDue;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $total_students = Student::count();
        $total_paid = FeeDue::where('status', 'Paid')->count();
        $total_pending = FeeDue::where('status', 'Pending')->count();
        $total_overdue = FeeDue::where('status', 'Overdue')->count();
        $total_partial = FeeDue::where('status', 'Partially Paid')->count();
        $recent_payments = Payment::with('student')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Bar chart data - last 7 payments
        $payments = Payment::orderBy('payment_date', 'asc')
            ->take(7)
            ->get();
        $payment_labels = $payments->map(fn($p) => \Carbon\Carbon::parse($p->payment_date)->format('d M'))->toArray();
        $payment_data = $payments->map(fn($p) => $p->amount_paid)->toArray();

        return view('admin.dashboard', compact(
            'total_students', 'total_paid', 'total_pending',
            'total_overdue', 'total_partial', 'recent_payments',
            'payment_labels', 'payment_data'
        ));
    }
}