@extends('admin.layout')

@section('page_title', 'Payment Receipt')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card" id="receipt-area">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Payment Receipt</h5>
                <div>
                    <button onclick="printReceipt()" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-print me-1"></i>Print Receipt
                    </button>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>
            <div class="card-body p-4" id="print-section">

                {{-- School Header --}}
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Fee Management System</h3>
                    <p class="text-muted mb-0">School Fee Payment Receipt</p>
                    <hr>
                </div>

                {{-- Receipt Info --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Receipt Number:</strong><br>
                            <span class="text-primary fw-bold fs-5">{{ $payment->receipt->receipt_number ?? 'N/A' }}</span>
                        </p>
                        <p><strong>Issue Date:</strong><br>
                            {{ $payment->receipt->issue_date ?? 'N/A' }}
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p><strong>Payment Date:</strong><br>
                            {{ $payment->payment_date }}
                        </p>
                        <p><strong>Payment Method:</strong><br>
                            <span class="badge bg-primary fs-6">{{ $payment->payment_method }}</span>
                        </p>
                    </div>
                </div>

                <hr>

                {{-- Student Info --}}
                <div class="mb-3">
                    <h6 class="fw-bold text-uppercase text-muted">Student Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Student Name</th>
                            <td>{{ $payment->student->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Roll Number</th>
                            <td>{{ $payment->student->roll_number ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Class</th>
                            <td>{{ $payment->student->classModel->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td>{{ $payment->student->section->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Guardian Name</th>
                            <td>{{ $payment->student->guardian_name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Payment Info --}}
                <div class="mb-3">
                    <h6 class="fw-bold text-uppercase text-muted">Payment Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Amount Paid</th>
                            <td class="text-success fw-bold fs-5">
                                Rs. {{ number_format($payment->amount_paid, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Partial Payment</th>
                            <td>{{ $payment->is_partial ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Outstanding Balance</th>
                            <td class="text-danger fw-bold">
                                Rs. {{ number_format($payment->feeDue->outstanding_balance ?? 0, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Fee Status</th>
                            <td>
                                @if($payment->feeDue->status == 'Paid')
                                    <span class="badge bg-success fs-6">Paid</span>
                                @elseif($payment->feeDue->status == 'Partially Paid')
                                    <span class="badge bg-warning fs-6">Partially Paid</span>
                                @else
                                    <span class="badge bg-danger fs-6">{{ $payment->feeDue->status }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <hr>

                {{-- Footer --}}
                <div class="text-center mt-3">
                    <p class="text-muted small">This is a computer generated receipt. No signature required.</p>
                    <p class="text-muted small">Thank you for your payment!</p>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
@media print {
    .sidebar, .navbar-top, .btn, nav { display: none !important; }
    #print-section { padding: 0 !important; }
    .card { border: none !important; box-shadow: none !important; }
}
</style>

<script>
function printReceipt() {
    window.print();
}
</script>

@endsection