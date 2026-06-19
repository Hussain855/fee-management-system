@extends('admin.layout')

@section('page_title', 'Add Fee Due')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add Fee Due</h5>
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

        <form action="{{ route('fee_dues.store') }}" method="POST">
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
                    <label class="form-label">Fee Structure</label>
                    <select name="fee_structure_id" class="form-control" required>
                        <option value="">-- Select Fee Structure --</option>
                        @foreach($feeStructures as $fee)
                            <option value="{{ $fee->id }}">{{ $fee->classModel->name ?? '' }} - Rs. {{ $fee->total_amount }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Term</label>
                    <select name="term_id" class="form-control" required>
                        <option value="">-- Select Term --</option>
                        @foreach($terms as $term)
                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Due</label>
                    <input type="number" name="amount_due" class="form-control" placeholder="0.00" step="0.01" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Save Fee Due
            </button>
            <a href="{{ route('fee_dues.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection