@extends('admin.layout')

@section('page_title', 'Discounts')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-tags me-2"></i>All Discounts</h5>
        <a href="{{ route('discounts.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Discount
        </a>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('discounts.index') }}" class="row g-2 mb-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control"
                    placeholder="Search by student name..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-control">
                    <option value="">-- All Types --</option>
                    <option value="Sibling" {{ request('type') == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                    <option value="Scholarship" {{ request('type') == 'Scholarship' ? 'selected' : '' }}>Scholarship</option>
                    <option value="Need Based" {{ request('type') == 'Need Based' ? 'selected' : '' }}>Need Based</option>
                    <option value="Staff Child" {{ request('type') == 'Staff Child' ? 'selected' : '' }}>Staff Child</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('discounts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Type</th>
                    <th>Percentage</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($discounts as $discount)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $discount->student->name ?? 'N/A' }}</td>
                    <td>{{ $discount->type }}</td>
                    <td>{{ $discount->percentage }}%</td>
                    <td>Rs. {{ number_format($discount->amount, 2) }}</td>
                    <td>{{ $discount->description ?? '-' }}</td>
                    <td>
                        <a href="{{ route('discounts.edit', $discount->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this discount?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No discounts found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $discounts->appends(request()->query())->links() }}
    </div>
</div>

@endsection