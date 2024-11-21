@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Add Album') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('albums.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="album_name">{{ __('Album Name') }}</label>
            <input type="text" name="album_name" id="album_name" class="form-control" value="{{ old('album_name') }}" required>
        </div>

        <div class="form-group">
            <label for="release_date">{{ __('Release Date') }}</label>
            <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date') }}">
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ __('Add Album') }}</button>
    </form>
</div>
@endsection
