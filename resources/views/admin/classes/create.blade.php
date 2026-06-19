@extends('admin.layout')

@section('page_title', 'Add Class')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Add New Class</h5>
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

        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Class Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Class 1" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Grade Level</label>
                <input type="number" name="grade_level" class="form-control" placeholder="e.g. 1" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Save Class
            </button>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection