@extends('admin.layout')

@section('page_title', 'Add Fine')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add Fine</h5>
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

        <form action="{{ route('fines.store') }}" method="POST">
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
                            <option value="{{ $due->id }}">{{ $due->student->name ?? '' }} - Rs. {{ $due->amount_due }} ({{ $due->status }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fine Amount</label>
                    <input type="number" name="fine_amount" class="form-control" placeholder="0.00" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Applied Date</label>
                    <input type="date" name="applied_date" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Reason</label>
                    <input type="text" name="reason" class="form-control" value="Late Payment" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Save Fine
            </button>
            <a href="{{ route('fines.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection