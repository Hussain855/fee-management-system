<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Student;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
   public function index(Request $request)
{
    $query = Discount::with('student');
    if ($request->search) {
        $query->whereHas('student', function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }
    if ($request->type) {
        $query->where('type', $request->type);
    }
    $discounts = $query->paginate(10);
    return view('admin.discounts.index', compact('discounts'));
}

    public function create()
    {
        $students = Student::all();
        return view('admin.discounts.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'type' => 'required',
            'percentage' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
        Discount::create($request->all());
        return redirect()->route('discounts.index')->with('success', 'Discount added successfully!');
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $students = Student::all();
        return view('admin.discounts.edit', compact('discount', 'students'));
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->update($request->all());
        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully!');
    }

    public function destroy($id)
    {
        Discount::findOrFail($id)->delete();
        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully!');
    }
}