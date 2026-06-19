@extends('admin.layout')

@section('page_title', 'Add Payment')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add Payment</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Student</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->roll_number }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fee Due</label>
                    <select name="fee_due_id" class="form-control" required>
                        <option value="">-- Select Fee Due --</option>
                        @foreach($feeDues as $due)
                            <option value="{{ $due->id }}">{{ $due->student->name ?? '' }} - Rs. {{ $due->outstanding_balance }} ({{ $due->status }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Paid</label>
                    <input type="number" name="amount_paid" class="form-control" placeholder="0.00" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Date</label>
                    <input type="datetime-local" name="payment_date" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-control" required>
                        <option value="">-- Select Method --</option>
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Online">Online</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Is Partial Payment?</label>
                    <select name="is_partial" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Save Payment
            </button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection