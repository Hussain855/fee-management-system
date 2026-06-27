<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermController extends Controller
{
    public function index(Request $request)
    {
        $query = Term::query();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $terms = $query->paginate(10);
        return view('admin.terms.index', compact('terms'));
    }

    public function create()
    {
        return view('admin.terms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'due_date' => 'required|date',
        ]);
        Term::create($request->all());
        return redirect()->route('terms.index')
            ->with('success', 'Term added successfully!');
    }

    public function edit($id)
    {
        $term = Term::findOrFail($id);
        return view('admin.terms.edit', compact('term'));
    }

    public function update(Request $request, $id)
    {
        $term = Term::findOrFail($id);
        $term->update($request->all());
        return redirect()->route('terms.index')
            ->with('success', 'Term updated successfully!');
    }

    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Term::findOrFail($id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->route('terms.index')
            ->with('success', 'Term deleted successfully!');
    }
}