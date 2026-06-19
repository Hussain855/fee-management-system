@extends('admin.layout')

@section('page_title', 'Add Discount')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add Discount</h5>
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

        <form action="{{ route('discounts.store') }}" method="POST">
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
                    <label class="form-label">Discount Type</label>
                    <select name="type" class="form-control" required>
                        <option value="">-- Select Type --</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Scholarship">Scholarship</option>
                        <option value="Need Based">Need Based</option>
                        <option value="Staff Child">Staff Child</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Percentage</label>
                    <input type="number" name="percentage" class="form-control" placeholder="e.g. 10.00" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" placeholder="0.00" step="0.01" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Optional description"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Save Discount
            </button>
            <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection