@extends('layouts.admin')

@section('adminContent')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Course Banners</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Course Banners</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="container-fluid hover-none">
        @if (Session::has('messageType') && Session::has('message'))
        <div class="alert alert-{{ Session::get('messageType') }}" id="message-alert">
            {{ Session::get('message') }}
        </div>
    
        <script>
            // Hide the alert after 1 second (1000 milliseconds)
            setTimeout(function() {
                document.getElementById('message-alert').style.display = 'none';
            }, 1000); // 1000ms = 1 second
        </script>
    @endif

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All Banners</h5>
                       
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Name</th> 
                                        <th>Banner Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @php
                                    $courses = [
                                        1 => 'Java Selenium',
                                        2 => 'Data Science',
                                        3 => 'Data Analytics',
                                        4 => 'AWS',
                                        5 => 'AI',
                                        6 => 'Java Full Stack',
                                        7 => 'Python Full Stack',
                                        8 => 'Oracle',
                                        9 => 'Digital Marketing',
                                        10 => 'Mobile Development'
                                    ];
                                @endphp
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr id="banner-row-{{ $banner->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $courses[$banner->course_id] ?? 'N/A' }}</td>
                                            <td>
                                                @if($banner->banner && File::exists(public_path('uploads/course-banner/' . basename($banner->banner))))
                                                    <img loading="lazy" src="{{ asset('uploads/course-banner/' . basename($banner->banner)) }}" alt="Course Banner" style="width: 100px; height: auto; border-radius: 8px; object-fit: cover;">
                                                @else
                                                    <img loading="lazy" src="{{ asset('images/default-banner.png') }}" alt="Default Banner" style="width: 100px; height: auto; border-radius: 8px; object-fit: cover;">
                                                @endif
                                            </td>
                                            
                                            
                                            
                                            
                                            <td>
                                                <div class="toggle-switch">
                                                    <input type="checkbox" 
                                                           class="toggle-input" 
                                                           id="toggle-{{ $banner->id }}"
                                                           {{ $banner->status ? 'checked' : '' }}
                                                           onchange="statusChange({{ $banner->id }})">
                                                    <label class="toggle-label" for="toggle-{{ $banner->id }}"></label>
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.course-banners.edit', $banner->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm" 
                                                            onclick="deleteBanner({{ $banner->id }})">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No banners found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var bannerUpdateStatusUrl = "{{ route('admin.course-banners.update-status') }}";
    var csrfToken = "{{ csrf_token() }}";


function statusChange(id) {
    var isChecked = $('#toggle-' + id).prop('checked');
    var newStatus = isChecked ? 1 : 0;

    $.ajax({
        url: bannerUpdateStatusUrl,
        type: 'POST', 
        data: {
            _token: csrfToken,
            id: id,
            status: newStatus
        },
        success: function(response) {
            if(response.status === 'success') {
                Swal.fire({
                    title: 'Success',
                    text: 'Banner status updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to update status',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                });
                $('#toggle-' + id).prop('checked', !isChecked);
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'An error occurred while updating status',
                showConfirmButton: false,
                timer: 1500
            });
            $('#toggle-' + id).prop('checked', !isChecked);
        }
    });
}

function deleteBanner(id) {
    if (confirm("Are you sure you want to delete this banner?")) {
        $.ajax({
            url: '/admin/course-banners/' + id,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    }
}


</script>

@endsection

