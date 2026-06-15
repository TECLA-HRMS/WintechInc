@extends('layouts.admin')


@section('adminContent')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Category: {{ $category->name }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name *</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $category->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input type="file" 
                           class="form-control @error('cover_image') is-invalid @enderror" 
                           id="cover_image" 
                           name="cover_image" 
                           accept="image/*">
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Leave empty to keep current image</small>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $category->cover_image) }}" 
                             alt="{{ $category->name }}" 
                             width="120" 
                             class="img-thumbnail">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Category
                </button>
            </form>
        </div>
    </div>
</div>
@endsection