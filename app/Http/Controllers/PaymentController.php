<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\FeeDue;
use App\Models\Student;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('student', 'feeDue')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $students = Student::all();
        $feeDues = FeeDue::with('student')->where('status', '!=', 'Paid')->get();
        return view('admin.payments.create', compact('students', 'feeDues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fee_due_id' => 'required',
            'student_id' => 'required',
            'amount_paid' => 'required|numeric',
            'payment_date' => 'required',
            'payment_method' => 'required',
        ]);

        $payment = Payment::create($request->all());

        // Auto update fee due status
        $feeDue = FeeDue::findOrFail($request->fee_due_id);
        $feeDue->amount_paid += $request->amount_paid;
        $feeDue->outstanding_balance = $feeDue->amount_due - $feeDue->amount_paid;

        if ($feeDue->outstanding_balance <= 0) {
            $feeDue->status = 'Paid';
            $feeDue->outstanding_balance = 0;
        } else {
            $feeDue->status = 'Partially Paid';
        }
        $feeDue->save();

        // Auto create receipt
        Receipt::create([
            'payment_id' => $payment->id,
            'student_id' => $request->student_id,
            'receipt_number' => 'REC-' . strtoupper(uniqid()),
            'issue_date' => now(),
            'total_paid' => $request->amount_paid,
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully!');
    }

    public function show($id)
    {
        $payment = Payment::with('student', 'feeDue', 'receipt')->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $payment = Payment::findOrFail($id);

        // First delete the receipt
        Receipt::where('payment_id', $id)->delete();

        // Then reverse fee due amount
        $feeDue = FeeDue::find($payment->fee_due_id);
        if ($feeDue) {
            $feeDue->amount_paid -= $payment->amount_paid;
            $feeDue->outstanding_balance = $feeDue->amount_due - $feeDue->amount_paid;
            if ($feeDue->outstanding_balance <= 0) {
                $feeDue->status = 'Paid';
                $feeDue->outstanding_balance = 0;
            } elseif ($feeDue->amount_paid > 0) {
                $feeDue->status = 'Partially Paid';
            } else {
                $feeDue->status = 'Pending';
            }
            $feeDue->save();
        }

        // Finally delete payment
        $payment->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully!');
    }

    public function exportPdf()
    {
        $payments = Payment::with('student')->orderBy('id', 'desc')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pdf.payments', compact('payments'));
        return $pdf->download('payments-list.pdf');
    }
}