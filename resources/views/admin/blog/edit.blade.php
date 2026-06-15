@extends('layouts.admin')

@section('adminContent')
<style>
    :root {
        --primary: #4f46e5; --primary-light: #eef2ff;
        --danger: #dc2626;  --danger-light: #fef2f2;
        --text-dark: #111827; --text-muted: #6b7280;
        --border: #e5e7eb;  --bg-light: #f9fafb;
    }
    .ec-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }

    .ec-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
    .ec-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .ec-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .ec-breadcrumb a { color: var(--primary); text-decoration: none; }

    .btn-back { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1.1rem; border: 1px solid var(--border); border-radius: 8px; background: #fff; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all .2s; }
    .btn-back:hover { background: var(--bg-light); color: var(--text-dark); }

    .form-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,.05); overflow: hidden;  }
    .form-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); background: var(--bg-light); display: flex; align-items: center; gap: 0.6rem; }
    .form-card-header h6 { margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); text-transform: uppercase; letter-spacing: 0.05em; }
    .card-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; background: var(--primary-light); color: var(--primary); }
    .form-card-body { padding: 1.75rem; }

    .field-label { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block; }
    .field-input { width: 100%; border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; padding: 0.5rem 0.875rem; color: var(--text-dark); background: #fff; outline: none; transition: border-color .2s, box-shadow .2s; }
    .field-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.1); }
    .field-input.is-invalid { border-color: var(--danger); }
    .field-input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,38,38,.1); }
    .field-error { font-size: 0.75rem; color: var(--danger); margin-top: 0.35rem; display: flex; align-items: center; gap: 0.3rem; }

    .form-card-footer { padding: 1.25rem 1.75rem; border-top: 1px solid var(--border); background: var(--bg-light); display: flex; align-items: center; gap: 0.75rem; }
    .btn-save { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.5rem; background: var(--primary); color: #fff; border: none; border-radius: 8px; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all .2s; }
    .btn-save:hover { background: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,.3); }
    .btn-cancel { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.25rem; background: #fff; color: var(--text-muted); border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all .2s; }
    .btn-cancel:hover { background: var(--bg-light); color: var(--text-dark); }
    
    .ck-editor__editable_inline { min-height: 250px !important; }
    
    .current-img-preview { max-width: 100%; max-height: 150px; border-radius: 8px; border: 1px solid var(--border); margin-bottom: 0.5rem; object-fit: cover; }
    .add-img-preview { max-height: 80px; border-radius: 6px; border: 1px solid var(--border); margin-right: 5px; margin-bottom: 5px; object-fit: cover; }
</style>

<div class="ec-page">

    <!-- Header -->
    <div class="ec-header">
        <div>
            <h1><i class="fa-solid fa-pen me-2" style="color:var(--primary)"></i>Edit Blog Post</h1>
            <div class="ec-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.blog.index') }}">Blog Posts</a>
                <span>/</span>
                <span>Edit</span>
            </div>
        </div>
        <a href="{{ route('admin.blog.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <div class="card-icon"><i class="fa-solid fa-pen"></i></div>
            <h6>Edit Post Details</h6>
        </div>

        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-card-body">

                <div class="row">
                    <div class="col-md-8">
                        <!-- Title -->
                        <div class="mb-4">
                            <label class="field-label">Title <span style="color:var(--danger)">*</span></label>
                            <input type="text" name="title" class="field-input {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title', $blog->title) }}" placeholder="Enter post title" required>
                            @error('title')
                                <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label class="field-label">Content <span style="color:var(--danger)">*</span></label>
                            <textarea id="content" name="content" class="field-input {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Excerpt -->
                        <div class="mb-4">
                            <label class="field-label">Excerpt <span style="color:var(--danger)">*</span></label>
                            <textarea name="excerpt" rows="3" class="field-input {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" placeholder="A short description..." required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Max 300 characters.</small>
                            @error('excerpt')
                                <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- Publish Date -->
                        <div class="mb-4">
                            <label class="field-label">Publish Date <span style="color:var(--danger)">*</span></label>
                            <input type="date" name="published_at" class="field-input {{ $errors->has('published_at') ? 'is-invalid' : '' }}" value="{{ old('published_at', $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d') : '') }}" required>
                            @error('published_at')
                                <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-4">
                            <label class="field-label">Featured Image</label>
                            @if($blog->featured_image)
                                <div class="mb-2">
                                    <img src="{{ asset($blog->featured_image) }}" alt="Featured Image" class="current-img-preview">
                                </div>
                            @endif
                            <input type="file" name="featured_image" class="field-input {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" accept="image/*">
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Leave empty to keep current image. Recommended size: 1200x630 pixels.</small>
                            @error('featured_image')
                                <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Additional Images -->
                        <div class="mb-4">
                            <label class="field-label">Additional Images</label>
                            @if($blog->additional_images)
                                <div class="mb-2">
                                    @foreach(json_decode($blog->additional_images, true) as $img)
                                        <img src="{{ asset($img) }}" alt="Additional Image" class="add-img-preview">
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" name="additional_images[]" class="field-input {{ $errors->has('additional_images') ? 'is-invalid' : '' }}" accept="image/*" multiple>
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Leave empty to keep current images. You can upload multiple images.</small>
                            @error('additional_images')
                                <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-card-footer">
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-check"></i> Update Post
                </button>
                <a href="{{ route('admin.blog.index') }}" class="btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
