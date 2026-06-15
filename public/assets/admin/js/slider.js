
function statusChange(id) {
    var isChecked = $('#toggle-' + id).prop('checked');
    var newStatus = isChecked ? 1 : 0;

    $.ajax({
        url: sliderUpdateStatusUrl,
        type: 'POST', // Changed from PUT to POST
        data: {
            _token: csrfToken, // Added inline CSRF token
            id: id,
            status: newStatus
        },
        success: function(response) {
            if(response.status === 'success') {
                Swal.fire({
                    title: 'Success',
                    text: 'Status updated successfully!',
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


function deleteSlider(id) {
    Swal.fire({
        title: "Are you sure you want to delete this slider?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        allowOutsideClick: false,
    }).then(function(result) {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/slider/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire('Deleted!', response.message, 'success');
                        $(`#slider-row-${id}`).remove();
                    } else {
                        Swal.fire('Error', 'Failed to delete slider', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                }
            });
        }
    });
}
