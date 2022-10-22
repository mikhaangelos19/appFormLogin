@extends('dashboard.layout')

@section('container')
    <form method="post" action="/dashboard/manage" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <label for="video" class="form-label mb-3">Upload Video</label>    
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter the title here">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="input-group mb-3">
            <input type="file" class="form-control @error('video') is-invalid @enderror" id="video" name="video">
            @error('video')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            
        </div>
        <button class="btn btn-outline-secondary" type="submit" id="uploadButton" form="uploadForm">Upload</button>
    </form>
@endsection