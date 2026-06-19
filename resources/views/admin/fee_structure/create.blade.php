@extends('admin.layout')

@section('page_title', 'Add Fee Structure')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add Fee Structure</h5>
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

        <form action="{{ route('fee_structure.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Class</label>
                    <select name="class_id" class="form-control" required>
                        <option value="">-- Select Class --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
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
                    <label class="form-label">Tuition Fee</label>
                    <input type="number" name="tuition_fee" class="form-control" placeholder="0.00" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Lab Fee</label>
                    <input type="number" name="lab_fee" class="form-control" placeholder="0.00" step="0.01">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Library Fee</label>
                    <input type="number" name="library_fee" class="form-control" placeholder="0.00" step="0.01">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sports Fee</label>
                    <input type="number" name="sports_fee" class="form-control" placeholder="0.00" step="0.01">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="number" name="total_amount" class="form-control" placeholder="0.00" step="0.01" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Save Fee Structure
            </button>
            <a href="{{ route('fee_structure.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection