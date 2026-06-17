@extends('layouts.admin')

@section('adminContent')
<div class="container pt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">All News</h2>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Add News</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered first">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Title</th>
                <th>Date</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                  <td>{{ $loop->iteration }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ \Carbon\Carbon::parse($event->date)->format('d-m-y') }}</td>

                <td>
                    @if($event->image)
                        <img loading="lazy" src="{{ asset($event->image) }}" width="80">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.events.edit',$event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('admin.events.delete',$event->id) }}" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4 d-flex justify-content-end">
    {{ $events->links('pagination::bootstrap-5') }}
</div>
@endsection

