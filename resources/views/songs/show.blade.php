<!-- resources/views/songs/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Song Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $song->title }}</h5>
            <p class="card-text">Artist: {{ $song->artist }}</p>
            <a href="{{ route('songs.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
