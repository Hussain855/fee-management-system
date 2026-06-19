@extends('admin.layout')

@section('page_title', 'Fee Structure')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Fee Structures</h5>
        <a href="{{ route('fee_structure.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Fee Structure
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Class</th>
                    <th>Term</th>
                    <th>Tuition Fee</th>
                    <th>Lab Fee</th>
                    <th>Library Fee</th>
                    <th>Sports Fee</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feeStructures as $fee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fee->classModel->name ?? 'N/A' }}</td>
                    <td>{{ $fee->term->name ?? 'N/A' }}</td>
                    <td>Rs. {{ number_format($fee->tuition_fee, 2) }}</td>
                    <td>Rs. {{ number_format($fee->lab_fee, 2) }}</td>
                    <td>Rs. {{ number_format($fee->library_fee, 2) }}</td>
                    <td>Rs. {{ number_format($fee->sports_fee, 2) }}</td>
                    <td>Rs. {{ number_format($fee->total_amount, 2) }}</td>
                    <td>
                        <a href="{{ route('fee_structure.edit', $fee->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('fee_structure.destroy', $fee->id) }}" method="POST" style="display:inline">
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
                    <td colspan="9" class="text-center">No fee structures found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection