@extends('layouts.admin')

@section('adminContent')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Job Function</h1>
        <a href="{{ route('admin.job-functions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.job-functions.update', $jobFunction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Job Function Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $jobFunction->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" 
                            id="status" 
                            class="form-control @error('status') is-invalid @enderror" 
                            required>
                        <option value="active" {{ old('status', $jobFunction->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $jobFunction->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Job Function
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
