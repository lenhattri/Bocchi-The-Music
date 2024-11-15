@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <!-- Danh sách bài hát -->
            <div class="songs-list-container">
                <h2 class="songs-list-title">Danh sách bài hát</h2>
                
                <!-- Danh sách bài hát -->
                <div class="songs-list">
                    @foreach($songs as $song)
                        <a href="{{ url('/music', $song->id) }}" class="music-card">
                            <div class="music-card-body">
                                <img src="{{ asset($song->image) }}" alt="{{ $song->title }}" class="music-card-image">
                                <div class="music-card-content">
                                    <h5 class="music-card-title">{{ $song->title }}</h5>
                                    <p class="music-card-artist">{{ $song->artist }}</p>
                                    <p class="music-card-plays">Lượt nghe: {{ $song->plays }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
