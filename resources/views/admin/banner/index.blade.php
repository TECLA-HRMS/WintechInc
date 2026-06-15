@extends('layouts.admin')

@section('adminContent')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Banners</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Banners</li>
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
                        <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">Create New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Banner Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr id="banner-row-{{ $banner->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset($banner->banner) }}" 
                                                     alt="Banner Image" 
                                                     style="width: 100px;">
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
                                                    <a href="{{ route('admin.banner.edit', $banner->id) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteBanner({{ $banner->id }})">
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
    var bannerUpdateStatusUrl = "{{ route('admin.banner.update-status') }}";
    var csrfToken = "{{ csrf_token() }}";
</script>
<script>

function statusChange(id) {
    var isChecked = $('#toggle-' + id).prop('checked');
    var newStatus = isChecked ? 1 : 0;

    $.ajax({
        url: bannerUpdateStatusUrl,  // Update with banner URL
        type: 'POST', 
        data: {
            _token: csrfToken, // CSRF token
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
    Swal.fire({
        title: "Are you sure you want to delete this banner?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        allowOutsideClick: false,
    }).then(function(result) {
        if (result.isConfirmed) {
            $.ajax({
                url: `/banner/${id}`,  // Ensure this matches your route
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Deleted!', 'Banner deleted successfully.', 'success');
                    $(`#banner-row-${id}`).remove(); // Remove the banner row from the DOM
                },
                error: function(xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong!', 'error');
                }
            });
        }
    });
}

</script>



@endsection