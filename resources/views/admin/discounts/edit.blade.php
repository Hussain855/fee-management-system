@extends('admin.layout')

@section('page_title', 'Edit Discount')

@section('content')

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Discount</h5>
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

        <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Student</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $discount->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->roll_number }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Discount Type</label>
                    <select name="type" class="form-control" required>
                        <option value="">-- Select Type --</option>
                        <option value="Sibling" {{ $discount->type == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                        <option value="Scholarship" {{ $discount->type == 'Scholarship' ? 'selected' : '' }}>Scholarship</option>
                        <option value="Need Based" {{ $discount->type == 'Need Based' ? 'selected' : '' }}>Need Based</option>
                        <option value="Staff Child" {{ $discount->type == 'Staff Child' ? 'selected' : '' }}>Staff Child</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Percentage</label>
                    <input type="number" name="percentage" class="form-control" value="{{ $discount->percentage }}" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{ $discount->amount }}" step="0.01" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ $discount->description }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>Update Discount
            </button>
            <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection