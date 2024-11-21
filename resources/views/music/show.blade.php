@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Bài hát hiện tại -->
    <div class="music-player mt-4">
        <img src="{{ asset($currentSong->image) }}" alt="{{ $currentSong->title }}" class="album-art">
        <h3>{{ $currentSong->title }}</h3>
        <p>{{ $currentSong->artist }}</p>

        <div class="controls">
            <button id="play-pause"><i class="fa-solid fa-play"></i></button>
        </div>
        <input type="range" id="seek-bar" value="0" step="1">
        <audio id="audio" src="{{ asset($currentSong->music_file) }}"></audio>
    </div>

    <!-- Gợi ý bài hát -->
    <div class="suggested-songs mt-5">
        <h4>{{ __('You might also like') }}</h4>
        <div class="suggested-list">
            @foreach($topSongs as $entry)
            <div class="suggested-song">
                <img src="{{ asset($entry['song']->image) }}" alt="{{ $entry['song']->title }}" class="suggested-album-art">
                <div class="suggested-info">
                    <h5>{{ $entry['song']->title }}</h5>
                    <p>{{ $entry['song']->artist }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const audio = $('#audio')[0];
        const albumArt = $('.album-art');
        let isPlaying = false;
        let rotation = 0;
        let interval;

        function startRotation() {
            interval = setInterval(() => {
                rotation += 1;
                albumArt.css('transform', `rotate(${rotation}deg)`);
            }, 30);
        }

        function stopRotation() {
            clearInterval(interval);
        }

        $('#play-pause').click(function() {
            if (isPlaying) {
                audio.pause();
                stopRotation();
                $(this).html('<i class="fa-solid fa-play"></i>');
            } else {
                audio.play();
                startRotation();
                $(this).html('<i class="fa-solid fa-pause"></i>');
            }
            isPlaying = !isPlaying;
        });

        $('#seek-bar').on('input', function() {
            audio.currentTime = $(this).val();
        });

        audio.addEventListener('timeupdate', function() {
            $('#seek-bar').val(audio.currentTime);
        });

        audio.addEventListener('loadedmetadata', function() {
            $('#seek-bar').attr('max', audio.duration);
        });
    });
</script>
@endsection
