@extends('admin.layout')

@section('page_title', 'Add Term')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add New Term</h5>
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

        <form action="{{ route('terms.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Term Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Term 1 2025" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Due Date</label>
                <input type="date" name="due_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Save Term
            </button>
            <a href="{{ route('terms.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection