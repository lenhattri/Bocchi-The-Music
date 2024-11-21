@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Song Details') }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>{{ $song->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>{{ __('Artist') }}:</strong> {{ $song->artist }}</p>
            <p><strong>{{ __('Album') }}:</strong> {{ $song->album->album_name ?? __('Unknown Album') }}</p>
            <p><strong>{{ __('Year') }}:</strong> {{ $song->year }}</p>
            <p><strong>{{ __('Music Style') }}:</strong> {{ $song->musicStyle->name ?? __('Unknown Style') }}</p>
            <p><strong>{{ __('Posted By') }}:</strong> {{ $song->user->name ?? __('Unknown') }}</p>

            @if ($song->image)
                <p><strong>{{ __('Cover Image') }}:</strong></p>
                <img src="{{ asset($song->image) }}" alt="{{ $song->title }}" class="img-fluid" style="max-width: 300px;">
            @endif

            @if ($song->music_file)
                <p><strong>{{ __('Listen') }}:</strong></p>
                <audio controls>
                    <source src="{{ asset($song->music_file) }}" type="audio/mpeg">
                    {{ __('Your browser does not support the audio element.') }}
                </audio>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('songs.index') }}" class="btn btn-secondary">{{ __('Back to Songs') }}</a>
            <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-primary">{{ __('Edit Song') }}</a>
            <form action="{{ route('songs.destroy', $song->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete Song') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
