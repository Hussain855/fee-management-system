@extends('admin.layout')

@section('page_title', 'Edit Fee Due')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Fee Due</h5>
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

        <form action="{{ route('fee_dues.update', $feeDue->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Student</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $feeDue->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->roll_number }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fee Structure</label>
                    <select name="fee_structure_id" class="form-control" required>
                        <option value="">-- Select Fee Structure --</option>
                        @foreach($feeStructures as $fee)
                            <option value="{{ $fee->id }}" {{ $feeDue->fee_structure_id == $fee->id ? 'selected' : '' }}>
                                {{ $fee->classModel->name ?? '' }} - Rs. {{ $fee->total_amount }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Term</label>
                    <select name="term_id" class="form-control" required>
                        <option value="">-- Select Term --</option>
                        @foreach($terms as $term)
                            <option value="{{ $term->id }}" {{ $feeDue->term_id == $term->id ? 'selected' : '' }}>
                                {{ $term->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Due</label>
                    <input type="number" name="amount_due" class="form-control" value="{{ $feeDue->amount_due }}" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Pending" {{ $feeDue->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Partially Paid" {{ $feeDue->status == 'Partially Paid' ? 'selected' : '' }}>Partially Paid</option>
                        <option value="Paid" {{ $feeDue->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Overdue" {{ $feeDue->status == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Update Fee Due
            </button>
            <a href="{{ route('fee_dues.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection