@extends('dashboard.layout')

@section('container')
    <div style="text-align: center">
        <h1>{{ $post->title }}</h1>
        <video width="320" height="240" id="video" name="video" autoplay controls>
        <source src="{{asset('storage/' . $post->video)}}" type="video/mp4">
        Your browser does not support the video tag.
        </video>
    </div>
@endsection