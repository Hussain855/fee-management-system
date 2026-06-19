<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Student;
use App\Models\FeeDue;
use Illuminate\Http\Request;

class FineController extends Controller
{
   public function index(Request $request)
{
    $query = Fine::with('student', 'feeDue');
    if ($request->search) {
        $query->whereHas('student', function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }
    $fines = $query->paginate(10);
    return view('admin.fines.index', compact('fines'));
}

    public function create()
    {
        $students = Student::all();
        $feeDues = FeeDue::with('student')->get();
        return view('admin.fines.create', compact('students', 'feeDues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fee_due_id' => 'required',
            'student_id' => 'required',
            'fine_amount' => 'required|numeric',
            'applied_date' => 'required|date',
        ]);
        Fine::create($request->all());
        return redirect()->route('fines.index')->with('success', 'Fine added successfully!');
    }

    public function edit($id)
    {
        $fine = Fine::findOrFail($id);
        $students = Student::all();
        $feeDues = FeeDue::with('student')->get();
        return view('admin.fines.edit', compact('fine', 'students', 'feeDues'));
    }

    public function update(Request $request, $id)
    {
        $fine = Fine::findOrFail($id);
        $fine->update($request->all());
        return redirect()->route('fines.index')->with('success', 'Fine updated successfully!');
    }

    public function destroy($id)
    {
        Fine::findOrFail($id)->delete();
        return redirect()->route('fines.index')->with('success', 'Fine deleted successfully!');
    }
}