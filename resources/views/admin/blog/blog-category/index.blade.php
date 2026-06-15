@extends('layouts.admin')

@section('adminContent')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Blog Category List Table -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Blog Category</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog Category</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="container-fluid hover-none">
            @if (Session::has('messageType') && Session::has('message'))
                @if (Session::get('messageType') === 'success')
                    <div class="alert alert-success" id="success-alert">
                        {{ Session::get('message') }}
                    </div>
                @elseif (Session::get('messageType') === 'error')
                    <div class="alert alert-danger" id="error-alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
            @endif
            <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="d-flex justify-content-end align-items-center">
                          <a href="{{route('admin.blog-category.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Create New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($blogcategory) > 0)
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogcategory as $values)
                                    <tr id="item-row-{{$values->id}}">
                                        <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                        <td class="text-center">{{$values->name}}</td>
                                        <td scope="col" class="text-center">
                                            <div class="toggle-switch">
                                                <input class="toggle-input" id="toggle-{{$values->id}}" type="checkbox" {{ $values->status== 1 ? 'checked' : '' }} onchange="statusChange({{ $values->id }},'{{ $values->status }}')">
                                                <label class="toggle-label" for="toggle-{{$values->id}}"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('admin.blog-category.edit',  $values->id) }}" class="btn btn-primary rounded">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>

                                                <button class="btn btn-danger rounded" onclick="deleteItem('{{$values->id}}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
    
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        @else
                            <div>No Record Found</div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </section>

    </div>
    <!-- / Content -->

<script>
    // Automatically close the success message after 1 second
    setTimeout(function() {
        $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 1000);

    // Automatically close the error message after 1 second
    setTimeout(function() {
        $("#error-alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);

    function statusChange(id, oldStatus) {
        
        var isChecked = $('#toggle-' + id).prop('checked');
        var newStatus = isChecked ? 1 : 0;

        $.ajax({
            type: "PUT",
            url: "{{ route('admin.blog-category.change-status') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                status: newStatus // Send the new status instead of the old one
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Success', 'Status updated successfully!', 'success');
                } else {
                    Swal.fire('Error', 'Failed to update the status.', 'error');
                    // Revert the toggle state if update fails
                    $('#toggle-' + id).prop('checked', !isChecked);
                }
            },
            error: function() {
                Swal.fire('Error', 'An error occurred. Please try again later.', 'error');
                // Revert the toggle state if AJAX fails
                $('#toggle-' + id).prop('checked', !isChecked);
            }
        });
    }

    function deleteItem(id) {
        Swal.fire({
            title: "Are you sure you want to delete this item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            allowOutsideClick: false,
        }).then(function(result) {
            if (result.isConfirmed) {
                var url = "{{ route('admin.blog-category.destroy', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        // Check for the response status from the backend
                    if (data.status === 'error') {
                        Swal.fire({
                            title: "Error",
                            text: data.message,  // Display the error message from backend
                            icon: "error"
                        });
                    } else if (data.status === 'success') {
                        Swal.fire({
                            title: "Deleted!",
                            text: "blogcategory has been deleted successfully.",
                            icon: "success"
                        }).then(() => {
                            // Remove the table row if deletion was successful
                            $('#item-row-' + id).remove();
                        });
                    }
                    },
                    error: function (error) {
                        console.error("Error deleting blogcategory:", error);
                        Swal.fire({
                            title: "Error",
                            text: "Failed to delete blogcategory.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }
</script>
@endsection