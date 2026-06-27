<?php

namespace App\Http\Controllers;

use App\Models\FeeDue;
use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeDueController extends Controller
{
    public function index(Request $request)
    {
        $query = FeeDue::with('student', 'term');
        if ($request->search) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $feeDues = $query->paginate(10);
        return view('admin.fee_dues.index', compact('feeDues'));
    }

    public function create()
    {
        $students = Student::all();
        $feeStructures = FeeStructure::all();
        $terms = Term::all();
        return view('admin.fee_dues.create', compact('students', 'feeStructures', 'terms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'fee_structure_id' => 'required',
            'term_id' => 'required',
            'amount_due' => 'required|numeric',
        ]);
        $data = $request->all();
        $data['amount_paid'] = 0;
        $data['outstanding_balance'] = $data['amount_due'];
        $data['status'] = 'Pending';
        FeeDue::create($data);
        return redirect()->route('fee_dues.index')
            ->with('success', 'Fee due added successfully!');
    }

    public function edit($id)
    {
        $feeDue = FeeDue::findOrFail($id);
        $students = Student::all();
        $feeStructures = FeeStructure::all();
        $terms = Term::all();
        return view('admin.fee_dues.edit', compact('feeDue', 'students', 'feeStructures', 'terms'));
    }

    public function update(Request $request, $id)
    {
        $feeDue = FeeDue::findOrFail($id);
        
        $amount_due = $request->amount_due;
        $amount_paid = $request->amount_paid ?? $feeDue->amount_paid;
        $outstanding_balance = $amount_due - $amount_paid;
        
        // Auto set status
        if ($outstanding_balance <= 0) {
            $status = 'Paid';
            $outstanding_balance = 0;
        } else {
            $status = 'Pending';
        }

        $feeDue->update([
            'student_id' => $request->student_id,
            'fee_structure_id' => $request->fee_structure_id,
            'term_id' => $request->term_id,
            'amount_due' => $amount_due,
            'amount_paid' => $amount_paid,
            'outstanding_balance' => $outstanding_balance,
            'status' => $status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('fee_dues.index')
            ->with('success', 'Fee due updated successfully!');
    }

    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        FeeDue::findOrFail($id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        return redirect()->route('fee_dues.index')
            ->with('success', 'Fee due deleted successfully!');
    }
}