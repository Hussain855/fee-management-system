<?php

namespace App\Http\Controllers;

use App\Models\FeeDue;
use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\Term;
use Illuminate\Http\Request;

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
        $data['outstanding_balance'] = $data['amount_due'];
        FeeDue::create($data);
        return redirect()->route('fee_dues.index')->with('success', 'Fee due added successfully!');
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
        $feeDue->update($request->all());
        return redirect()->route('fee_dues.index')->with('success', 'Fee due updated successfully!');
    }

    public function destroy($id)
    {
        FeeDue::findOrFail($id)->delete();
        return redirect()->route('fee_dues.index')->with('success', 'Fee due deleted successfully!');
    }
}