<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class SectionController extends Controller
{
   public function index(Request $request)
{
    $query = Section::with('classModel');
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }
    $sections = $query->paginate(10);
    return view('admin.sections.index', compact('sections'));
}

    public function create()
    {
        $classes = ClassModel::all();
        return view('admin.sections.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'name' => 'required',
        ]);
        Section::create($request->all());
        return redirect()->route('sections.index')->with('success', 'Section added successfully!');
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $classes = ClassModel::all();
        return view('admin.sections.edit', compact('section', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        $section->update($request->all());
        return redirect()->route('sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy($id)
    {
        Section::findOrFail($id)->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully!');
    }
}