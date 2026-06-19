@extends('admin.layout')

@section('page_title', 'School Settings')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>School Settings</h5>
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

                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">School Name</label>
                        <input type="text" name="school_name" class="form-control"
                            value="{{ $setting->school_name }}" required>
                        <small class="text-muted">This name will appear on all receipts and PDF reports</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">School Address</label>
                        <input type="text" name="school_address" class="form-control"
                            value="{{ $setting->school_address }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">School Phone</label>
                        <input type="text" name="school_phone" class="form-control"
                            value="{{ $setting->school_phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">School Email</label>
                        <input type="email" name="school_email" class="form-control"
                            value="{{ $setting->school_email }}">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Settings
                    </button>
                </form>
            </div>
        </div>

        {{-- Preview Card --}}
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Current Settings Preview</h5>
            </div>
            <div class="card-body text-center">
                <h4 class="fw-bold">{{ $setting->school_name }}</h4>
                <p class="text-muted mb-1">{{ $setting->school_address }}</p>
                <p class="text-muted mb-1">Phone: {{ $setting->school_phone }}</p>
                <p class="text-muted mb-1">Email: {{ $setting->school_email }}</p>
            </div>
        </div>

    </div>
</div>

@endsection