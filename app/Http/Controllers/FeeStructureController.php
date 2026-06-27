<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use App\Models\ClassModel;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeStructureController extends Controller
{
    public function index()
    {
        $feeStructures = FeeStructure::with('classModel', 'term')->get();
        return view('admin.fee_structure.index', compact('feeStructures'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $terms = Term::all();
        return view('admin.fee_structure.create', compact('classes', 'terms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'term_id' => 'required',
            'tuition_fee' => 'required|numeric',
            'lab_fee' => 'nullable|numeric',
            'library_fee' => 'nullable|numeric',
            'sports_fee' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
        ]);
        FeeStructure::create($request->all());
        return redirect()->route('fee_structure.index')
            ->with('success', 'Fee structure added successfully!');
    }

    public function edit($id)
    {
        $feeStructure = FeeStructure::findOrFail($id);
        $classes = ClassModel::all();
        $terms = Term::all();
        return view('admin.fee_structure.edit', compact('feeStructure', 'classes', 'terms'));
    }

    public function update(Request $request, $id)
    {
        $feeStructure = FeeStructure::findOrFail($id);
        $feeStructure->update($request->all());
        return redirect()->route('fee_structure.index')
            ->with('success', 'Fee structure updated successfully!');
    }

    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        FeeStructure::findOrFail($id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->route('fee_structure.index')
            ->with('success', 'Fee structure deleted successfully!');
    }
}