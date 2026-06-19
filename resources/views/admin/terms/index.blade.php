@extends('admin.layout')

@section('page_title', 'Terms')

@section('content')

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-calendar me-2"></i>All Terms</h5>
        <a href="{{ route('terms.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Term
        </a>
    </div>
    <div class="card-body">

        <form method="GET" action="{{ route('terms.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control"
                    placeholder="Search by term name..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('terms.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Term Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($terms as $term)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $term->name }}</td>
                    <td>{{ $term->start_date }}</td>
                    <td>{{ $term->end_date }}</td>
                    <td>{{ $term->due_date }}</td>
                    <td>
                        <a href="{{ route('terms.edit', $term->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('terms.destroy', $term->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this term?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No terms found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $terms->appends(request()->query())->links() }}
    </div>
</div>

@endsection