@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Album Details') }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>{{ $album->album_name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>{{ __('Release Date') }}:</strong> {{ $album->release_date ?? __('No Date') }}</p>
            <p><strong>{{ __('Created By') }}:</strong> {{ $album->user->name ?? __('Unknown') }}</p>

            <hr>
            <h4>{{ __('Songs in this Album') }}</h4>
            @if ($album->songs->isEmpty())
                <p>{{ __('No songs available in this album.') }}</p>
            @else
                <ul>
                    @foreach ($album->songs as $song)
                        <li>
                            <a href="{{ route('songs.show', $song->id) }}">{{ $song->title }}</a> - {{ $song->artist }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">{{ __('Back to Albums') }}</a>
    </div>
</div>
@endsection
