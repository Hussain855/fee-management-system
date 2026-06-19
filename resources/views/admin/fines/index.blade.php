@extends('admin.layout')

@section('page_title', 'Fines')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>All Fines</h5>
        <a href="{{ route('fines.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Fine
        </a>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('fines.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control"
                    placeholder="Search by student name..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('fines.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Fine Amount</th>
                    <th>Reason</th>
                    <th>Applied Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fine->student->name ?? 'N/A' }}</td>
                    <td>Rs. {{ number_format($fine->fine_amount, 2) }}</td>
                    <td>{{ $fine->reason }}</td>
                    <td>{{ $fine->applied_date }}</td>
                    <td>
                        <a href="{{ route('fines.edit', $fine->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('fines.destroy', $fine->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this fine?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No fines found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $fines->appends(request()->query())->links() }}
    </div>
</div>

@endsection