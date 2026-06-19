@extends('admin.layout')

@section('page_title', 'Receipts')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>All Receipts</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Receipt Number</th>
                    <th>Student</th>
                    <th>Total Paid</th>
                    <th>Payment Method</th>
                    <th>Issue Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($receipts as $receipt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $receipt->receipt_number }}</td>
                    <td>{{ $receipt->student->name ?? 'N/A' }}</td>
                    <td>Rs. {{ number_format($receipt->total_paid, 2) }}</td>
                    <td>{{ $receipt->payment->payment_method ?? 'N/A' }}</td>
                    <td>{{ $receipt->issue_date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No receipts found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $receipts->links() }}
    </div>
</div>

@endsection