@extends('admin.layout')

@section('page_title', 'Sections')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-layer-group me-2"></i>All Sections</h5>
        <a href="{{ route('sections.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Section
        </a>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('sections.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control"
                    placeholder="Search by section name..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('sections.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Section Name</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sections as $section)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $section->name }}</td>
                    <td>{{ $section->classModel->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this section?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No sections found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $sections->appends(request()->query())->links() }}
    </div>
</div>

@endsection