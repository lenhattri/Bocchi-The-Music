@extends('layouts.app')

@section('content')
<div class="container">
    <div class="music-player mt-4">
        <img src="{{ asset($song->image) }}" alt="{{ $song->title }}" class="album-art">
        <h3>{{ $song->title }}</h3>
        <p>{{ $song->artist }}</p>

        <div class="controls">
            <button id="play-pause"><i class="fa-solid fa-play"></i></button>
        </div>
        <input type="range" id="seek-bar" value="0" step="1">
        <audio id="audio" src="{{ asset($song->music_file) }}"></audio>
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
    