@extends('admin.layout')

@section('page_title', 'Fee Dues')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-invoice me-2"></i>All Fee Dues</h5>
        <a href="{{ route('fee_dues.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Fee Due
        </a>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('fee_dues.index') }}" class="row g-2 mb-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control"
                    placeholder="Search by student name..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- All Status --</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Partially Paid" {{ request('status') == 'Partially Paid' ? 'selected' : '' }}>Partially Paid</option>
                    <option value="Paid" {{ request('status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Overdue" {{ request('status') == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('fee_dues.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Term</th>
                    <th>Amount Due</th>
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feeDues as $due)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $due->student->name ?? 'N/A' }}</td>
                    <td>{{ $due->term->name ?? 'N/A' }}</td>
                    <td>Rs. {{ number_format($due->amount_due, 2) }}</td>
                    <td>Rs. {{ number_format($due->amount_paid, 2) }}</td>
                    <td>Rs. {{ number_format($due->outstanding_balance, 2) }}</td>
                    <td>
                        @if($due->status == 'Paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($due->status == 'Partially Paid')
                            <span class="badge bg-warning">Partially Paid</span>
                        @elseif($due->status == 'Overdue')
                            <span class="badge bg-danger">Overdue</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('fee_dues.edit', $due->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('fee_dues.destroy', $due->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this fee due?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No fee dues found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $feeDues->appends(request()->query())->links() }}
    </div>
</div>

@endsection