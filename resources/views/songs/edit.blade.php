@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($song) ? __('Edit Song') : __('Add New Song') }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ isset($song) ? route('songs.update', $song) : route('songs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($song))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="title">{{ __('Title') }}:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $song->title ?? '') }}">
        </div>
        
        <div class="form-group">
            <label for="artist">{{ __('Artist') }}:</label>
            <input type="text" name="artist" id="artist" class="form-control" value="{{ old('artist', $song->artist ?? '') }}">
        </div>

        <div class="form-group">
            <label for="album">{{ __('Album') }}:</label>
            <input type="text" name="album" id="album" class="form-control" value="{{ old('album', $song->album ?? '') }}">
        </div>

        <div class="form-group">
            <label for="year">{{ __('Year') }}:</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $song->year ?? '') }}">
        </div>

        <div class="form-group">
            <label for="image">{{ __('Image') }}:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="music_file">{{ __('Music File (MP3)') }}:</label>
            <input type="file" name="music_file" id="music_file" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ isset($song) ? __('Update Song') : __('Add Song') }}</button>
    </form>
</div>
@endsection
