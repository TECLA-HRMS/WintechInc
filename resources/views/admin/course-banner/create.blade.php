@extends('layouts.admin')

@section('adminContent')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Add Course Banner</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.course-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Select Course</label>
                    <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                        <option value="" selected disabled>Select a Course</option>
                        @foreach ([1 => 'javaselenium', 2 => 'data science', 3 => 'data analytics', 4 => 'aws', 5 => 'AI', 6 => 'javafullstack', 7 => 'pythonfullstack', 8 => 'oracle', 9 => 'digitalmarketing', 10 => 'mobiledevelopment'] as $id => $course)  
                            <option value="{{ $id }}">{{ $course }}</option>
                        @endforeach
                    </select>
                    @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror" onchange="previewImage(event)">
                    @error('banner') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <img loading="lazy" id="preview" class="mt-2" style="max-width: 200px; display: none;">
                </div>

                <div class="mb-3">
                    <label class="form-label">PDF File</label>
                    <input type="file" name="pdf" class="form-control @error('pdf') is-invalid @enderror" accept="application/pdf">
                    @error('pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection
