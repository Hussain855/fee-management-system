<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
{
    $query = ClassModel::query();
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('grade_level', 'like', '%' . $request->search . '%');
    }
    $classes = $query->paginate(10);
    return view('admin.classes.index', compact('classes'));
}

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:classes',
            'grade_level' => 'required|unique:classes',
        ]);
        ClassModel::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Class added successfully!');
    }

    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = ClassModel::findOrFail($id);
        $class->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        ClassModel::findOrFail($id)->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}