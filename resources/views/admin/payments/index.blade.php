@extends('admin.layout')

@section('page_title', 'Payments')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-money-bill me-2"></i>All Payments</h5>
       <div class="d-flex gap-2">
    <a href="{{ route('payments.pdf') }}" class="btn btn-danger btn-sm">
        <i class="fas fa-file-pdf me-1"></i>Export PDF
    </a>
    <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>Add Payment
    </a>
</div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Amount Paid</th>
                    <th>Payment Method</th>
                    <th>Payment Date</th>
                    <th>Partial</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->student->name ?? 'N/A' }}</td>
                    <td>Rs. {{ number_format($payment->amount_paid, 2) }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>
                        @if($payment->is_partial)
                            <span class="badge bg-warning">Yes</span>
                        @else
                            <span class="badge bg-success">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline">
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
                    <td colspan="7" class="text-center">No payments found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection