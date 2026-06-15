@extends('layouts.admin')

@section('adminContent')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Blog Comment List Table -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Blog Comment</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog Comment</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="container-fluid hover-none">
          <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card shadow-sm">
                  <div class="card-header">
                      <div class="align-items-center">
                        <h4>All Blogs Comments</h4>
                      </div>
                  </div>
                  <div class="card-body">
                      @if(count($blogcomment) > 0)
                          <div class="table-responsive">
                          <table class="table table-striped table-bordered first">
                              <thead>
                                  <tr>
                                      <th scope="col" class="text-center">#</th>
                                      <th scope="col" class="text-center">Post</th>
                                      <th scope="col" class="text-center">User Name</th>
                                      <th scope="col" class="text-center">User Comment</th>
                                      <th scope="col" class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($blogcomment as $values)
                                  <tr id="item-row-{{$values->id}}">
                                      <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                      <td class="text-center"><a href="#" >{{ strlen($values->blog->title) > 30 ? ucfirst(substr($values->blog->title, 0, 30)) . '...' : ucfirst($values->blog->title) }}</a></td>
                                      <td class="text-center">{{ucFirst($values->user->name)}}</td>
                                      <td class="text-center">{{$values->comment}}</td>
                                      <td class="text-center">
                                          <div class="d-flex gap-2 justify-content-center">
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

@endsection

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
    }).then(function (result) {
        if (result.isConfirmed) {
            var url = "{{ route('admin.blog-comments.destroy', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Blog comment has been deleted successfully.",
                            icon: "success"
                        }).then(() => {
                            $('#item-row-' + id).remove();
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: data.message,
                            icon: "error"
                        });
                    }
                },
                error: function (error) {
                    Swal.fire({
                        title: "Error",
                        text: "Failed to delete blogcomment.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

</script>
