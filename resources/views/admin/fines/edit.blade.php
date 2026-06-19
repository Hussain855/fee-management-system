@extends('admin.layout')

@section('page_title', 'Edit Fine')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Fine</h5>
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

        <form action="{{ route('fines.update', $fine->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Student</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $fine->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->roll_number }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fee Due</label>
                    <select name="fee_due_id" class="form-control" required>
                        <option value="">-- Select Fee Due --</option>
                        @foreach($feeDues as $due)
                            <option value="{{ $due->id }}" {{ $fine->fee_due_id == $due->id ? 'selected' : '' }}>
                                {{ $due->student->name ?? '' }} - Rs. {{ $due->amount_due }} ({{ $due->status }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fine Amount</label>
                    <input type="number" name="fine_amount" class="form-control" value="{{ $fine->fine_amount }}" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Applied Date</label>
                    <input type="date" name="applied_date" class="form-control" value="{{ $fine->applied_date }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Reason</label>
                    <input type="text" name="reason" class="form-control" value="{{ $fine->reason }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Update Fine
            </button>
            <a href="{{ route('fines.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection