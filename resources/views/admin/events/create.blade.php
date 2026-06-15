@extends('layouts.admin')


@section('adminContent')
<div class="container">
    <h2 class="mb-3">Add News</h2>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-2">
            <label>Sub Title</label>
            <input type="text" name="sub_title" class="form-control">
        </div>

        <div class="mb-2">
            <label>Date</label>
            <input type="date" name="date" class="form-control">
        </div>

        <div class="mb-2">
            <label>Time</label>
            <input type="time" name="time" class="form-control">
        </div>

        <div class="mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-2">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <div class="mb-2">
            <label>Contact Numbers (comma separated)</label>
            <input type="text" name="contact_numbers" class="form-control">
        </div>

       <div class="mb-2">
    <label>Event Image <span class="text-muted">(jpeg, jpg, png, gif, webp)</span></label>
    <input type="file" name="image" class="form-control" accept=".jpeg,.jpg,.png,.gif,.webp" required>
    <small class="form-text text-muted">Only image files are allowed.</small>
</div>


        <div class="mb-2">
            <label>Amman Alangaram</label>
            <input type="text" name="alangaram_by" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
