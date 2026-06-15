@extends('layouts.admin')


@section('adminContent')
<div class="container">
    <h2 class="mb-3">Edit News</h2>

    <form action="{{ route('admin.events.update',$event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}">
        </div>

        <div class="mb-2">
            <label>Sub Title</label>
            <input type="text" name="sub_title" class="form-control" value="{{ $event->sub_title }}">
        </div>

        <div class="mb-2">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ $event->date }}">
        </div>

        <div class="mb-2">
            <label>Time</label>
            <input type="time" name="time" class="form-control" value="{{ $event->time }}">
        </div>

        <div class="mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $event->description }}</textarea>
        </div>

        <div class="mb-2">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $event->address }}</textarea>
        </div>

        <div class="mb-2">
            <label>Contact Numbers</label>
            <input type="text" name="contact_numbers" class="form-control" value="{{ $event->contact_numbers }}">
        </div>

        <div class="mb-2">
    <label>Event Image</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($event->image)
        <img src="{{ asset($event->image) }}" width="120" class="mt-2">
    @endif
</div>

        <div class="mb-2">
            <label>Amman Alangaram</label>
            <input type="text" name="alangaram_by" class="form-control" value="{{ $event->alangaram_by }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
