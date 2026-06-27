<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return redirect()->route('classes.index')
            ->with('success', 'Class added successfully!');
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
        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ClassModel::findOrFail($id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully!');
    }
}