@extends('dashboard.layout')

@section('container')
    @if(session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/dashboard/manage/create" class="btn btn-primary mb-3">Upload New Video</a>

    <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }} </td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="/dashboard/manage/{{ $post->id }}" class="badge bg-primary" style="text-decoration:none">View</span></a>
                            <a href="/dashboard/manage/{{ $post->id }}/edit" class="badge bg-warning" style="text-decoration:none">Edit</span></a>
                            <form action="/dashboard/manage/{{ $post->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  
@endsection