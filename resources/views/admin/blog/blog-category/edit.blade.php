@extends('layouts.admin')

@section('adminContent')
      <!-- Main Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <section class="section">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                     <h2 class="pageheader-title">Blog Category</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.blog-category.index') }}" class="breadcrumb-link">Blog-category</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Edit Blog Category</h3>
                  </div>
                  <div class="card-body">
                    <div id="resultMessage" style="font-size:18px;color:red;"></div>
                    <form id="updateitem" action="{{route('admin.blog-category.update', $category->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                            <label>Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{$category->name}}" onkeyup="checkname(event.target.value)">
                        </div>

                        <input type="hidden" class="form-control" name="id" id="id" value="{{$category->id}}"/>

                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4 mb-4">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$category->status == 1 ? 'selected' : ''}} value="1">Active</option>
                              <option {{$category->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submmit" id="submitbtn" class="btn btn-primary">Update</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
      </div>


<script>

      function checkname(processedValue) {
          var name = document.getElementById('name').value;
          var id = document.getElementById('id').value;
          console.log(id);
          
          if (name !== '') {
              $.ajax({
                  type: 'GET',
                  url: "{{ route('admin.blog-category.check-name') }}", 
                  data: { name: name, id: id },
                  dataType: 'json',
                  success: function(response) { 
                      displayMessage(response.message);
                  }
              });
          } else {
              displayMessage('');
          }
      }

      function displayMessage(message) {
        $('#resultMessage').text(message);
        if (message == "Name is already in the database.") {
            $('#submitbtn').prop('disabled', true);
        } else {
            $('#submitbtn').prop('disabled', false);
        }
      }

  </script>

  <script>

      $(document).ready(function ($) {

        $.validator.addMethod("customName", function(value, element) {
            return this.optional(element) || /^[^\s][\s\S]{0,249}$/.test(value);
        }, "Please enter a valid name. Spaces are allowed only within the name, and it should not exceed 250 characters.");

        // Update the validation rules for the form
        $("#updateitem").validate({
            rules: {
                name: {
                    required: true,
                    customName: true
                },

                status: {
                    required: true
                },
                
            },
            messages: {
                name: {
                    required: "Please enter a name",
                    customName: "Please enter a valid name. No leading spaces are allowed, and the name must not exceed 250 characters."
                },
                status: {
                    required: "Please select a status."
                }
            },
            errorClass: "error", // Bootstrap class for styling errors
            errorPlacement: function (error, element) {
                if (element.is("input")) {
                    error.insertAfter(element); // Place error directly after the input field
                } 
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
      });

      // Show validation errors using SweetAlert
      @if ($errors->any())
          var errorMessage = '';
          @foreach ($errors->all() as $error)
              errorMessage += "{{ $error }}\n";
          @endforeach
            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                text: errorMessage,
            });
      @endif


</script>

@endsection
