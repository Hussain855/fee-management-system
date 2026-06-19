@extends('admin.layout')

@section('page_title', 'Students')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-user-graduate me-2"></i>All Students</h5>
        <div class="d-flex gap-2">
    <a href="{{ route('students.pdf') }}" class="btn btn-danger btn-sm">
        <i class="fas fa-file-pdf me-1"></i>Export PDF
    </a>
    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>Add Student
    </a>
</div>
    </div>
    <div class="card-body">

        {{-- Search & Filter Bar --}}
        <form method="GET" action="{{ route('students.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                    placeholder="Search by name or roll number..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="class_id" class="form-control">
                    <option value="">-- All Classes --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="section_id" class="form-control">
                    <option value="">-- All Sections --</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                            {{ $section->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>

        {{-- Students Table --}}
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Guardian</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->roll_number }}</td>
                    <td>{{ $student->classModel->name ?? 'N/A' }}</td>
                    <td>{{ $student->section->name ?? 'N/A' }}</td>
                    <td>{{ $student->guardian_name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        <a href="{{ route('students.profile', $student->id) }}" class="btn btn-info btn-sm">
    <i class="fas fa-eye"></i> Profile
</a>
<a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-edit"></i> Edit
</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No students found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        {{ $students->appends(request()->query())->links() }}

    </div>
</div>

@endsection