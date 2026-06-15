@extends('layouts.admin')

@section('adminContent')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create Slider</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.banner.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          id="sliderForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Banner</label>
                            <input type="file" 
                                   class="form-control @error('banner') is-invalid @enderror" 
                                   name="banner"
                                   onchange="previewImage(event)">
                            @error('banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="preview" class="mt-2" style="max-width: 200px; display: none;">
                        </div>

                      
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(event.target.files[0]);
}

$(document).ready(function() {
    $('#sliderForm').validate({
        rules: {
            banner: {
                required: true,
                accept: "image/*"
            },
          
        },
        messages: {
            banner: {
                required: "Please select a banner image",
                accept: "Please select a valid image file"
            },
           
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>

@endsection

