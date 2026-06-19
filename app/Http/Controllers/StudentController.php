<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('classModel', 'section');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('roll_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->section_id) {
            $query->where('section_id', $request->section_id);
        }

        $students = $query->paginate(10);
        $classes = ClassModel::all();
        $sections = Section::all();

        return view('admin.students.index', compact('students', 'classes', 'sections'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $sections = Section::all();
        return view('admin.students.create', compact('classes', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'roll_number' => 'required|unique:students',
            'class_id' => 'required',
            'section_id' => 'required',
            'guardian_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'date_of_admission' => 'required|date',
        ]);
        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassModel::all();
        $sections = Section::all();
        return view('admin.students.edit', compact('student', 'classes', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    public function profile($id)
{
    $student = Student::with(
        'classModel',
        'section',
        'feeDues.term',
        'payments',
        'discounts',
        'fines'
    )->findOrFail($id);

    $total_fees = $student->feeDues->sum('amount_due');
    $total_paid = $student->feeDues->sum('amount_paid');
    $total_balance = $student->feeDues->sum('outstanding_balance');
    $total_fines = $student->fines->sum('fine_amount');
    $total_discounts = $student->discounts->sum('amount');

    return view('admin.students.profile', compact(
        'student', 'total_fees', 'total_paid',
        'total_balance', 'total_fines', 'total_discounts'
    ));
}

public function exportPdf()
{
    $students = Student::with('classModel', 'section')->get();
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pdf.students', compact('students'));
    return $pdf->download('students-list.pdf');
}

public function profilePdf($id)
{
    $student = Student::with(
        'classModel', 'section',
        'feeDues.term', 'payments',
        'discounts', 'fines'
    )->findOrFail($id);

    $total_fees = $student->feeDues->sum('amount_due');
    $total_paid = $student->feeDues->sum('amount_paid');
    $total_balance = $student->feeDues->sum('outstanding_balance');
    $total_fines = $student->fines->sum('fine_amount');
    $total_discounts = $student->discounts->sum('amount');

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pdf.student_profile',
        compact('student', 'total_fees', 'total_paid',
                'total_balance', 'total_fines', 'total_discounts'));
    return $pdf->download('student-profile-'.$student->roll_number.'.pdf');
}
}