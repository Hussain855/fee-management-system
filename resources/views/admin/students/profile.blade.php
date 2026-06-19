@extends('admin.layout')

@section('page_title', 'Student Profile')

@section('content')

<div class="row">
    <div class="col-md-12 mb-3">
        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left me-1"></i>Back to Students
</a>
<a href="{{ route('students.profile.pdf', $student->id) }}" class="btn btn-danger btn-sm">
    <i class="fas fa-file-pdf me-1"></i>Download PDF
</a>
    </div>
</div>

<div class="row">

    {{-- Student Info Card --}}
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                </div>
                <h4 class="fw-bold">{{ $student->name }}</h4>
                <p class="text-muted">Roll No: {{ $student->roll_number }}</p>
                <span class="badge bg-primary fs-6">{{ $student->classModel->name ?? 'N/A' }}</span>
                <span class="badge bg-secondary fs-6">{{ $student->section->name ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Personal Info</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Guardian</th>
                        <td>{{ $student->guardian_name }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $student->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $student->address }}</td>
                    </tr>
                    <tr>
                        <th>Admission</th>
                        <td>{{ $student->date_of_admission }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Right Side --}}
    <div class="col-md-8">

        {{-- Fee Summary Cards --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body text-center">
                        <h6>Total Fees</h6>
                        <h4>Rs. {{ number_format($total_fees, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h6>Total Paid</h6>
                        <h4>Rs. {{ number_format($total_paid, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger">
                    <div class="card-body text-center">
                        <h6>Balance</h6>
                        <h4>Rs. {{ number_format($total_balance, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card text-white bg-warning">
                    <div class="card-body text-center">
                        <h6>Total Fines</h6>
                        <h4>Rs. {{ number_format($total_fines, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-info">
                    <div class="card-body text-center">
                        <h6>Total Discounts</h6>
                        <h4>Rs. {{ number_format($total_discounts, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fee Dues Table --}}
        <div class="card mb-3">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="fas fa-file-invoice me-2"></i>Fee Dues</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Term</th>
                            <th>Amount Due</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->feeDues as $due)
                        <tr>
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No fee dues found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Payments Table --}}
        <div class="card mb-3">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="fas fa-money-bill me-2"></i>Payment History</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Date</th>
                            <th>Partial</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->payments as $payment)
                        <tr>
                            <td>Rs. {{ number_format($payment->amount_paid, 2) }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>{{ $payment->is_partial ? 'Yes' : 'No' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No payments found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Discounts Table --}}
        <div class="card mb-3">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="fas fa-tags me-2"></i>Discounts</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Type</th>
                            <th>Percentage</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->discounts as $discount)
                        <tr>
                            <td>{{ $discount->type }}</td>
                            <td>{{ $discount->percentage }}%</td>
                            <td>Rs. {{ number_format($discount->amount, 2) }}</td>
                            <td>{{ $discount->description ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No discounts found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Fines Table --}}
        <div class="card">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Fines</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Amount</th>
                            <th>Reason</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->fines as $fine)
                        <tr>
                            <td>Rs. {{ number_format($fine->fine_amount, 2) }}</td>
                            <td>{{ $fine->reason }}</td>
                            <td>{{ $fine->applied_date }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No fines found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection