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

        <!-- Thanh tua -->
        <div class="seek-bar">
            <div class="seek-bar-progress"></div>
        </div>
        <!-- Hiển thị thời lượng -->
        <div class="duration">
            <span id="current-time">0:00</span> / <span id="total-duration">0:00</span>
        </div>

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

<!-- JavaScript -->
<!-- JavaScript -->
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

    // Cập nhật thanh tua và hiển thị thời lượng
    function updateSeekBar() {
        const currentTime = audio.currentTime;
        const duration = audio.duration;

        if (isNaN(duration)) return;

        // Tính phần trăm
        const progressPercent = (currentTime / duration) * 100;
        $('.seek-bar-progress').css('width', progressPercent + '%');

        // Cập nhật thời gian
        $('#current-time').text(formatTime(currentTime));
        $('#total-duration').text(formatTime(duration));
    }

    function formatTime(time) {
        if (isNaN(time)) {
            return '0:00';
        }
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        return minutes + ':' + (seconds < 10 ? '0' + seconds : seconds);
    }

    // Cập nhật thanh tua khi thời gian thay đổi
    audio.addEventListener('timeupdate', updateSeekBar);

    // Đặt tổng thời lượng khi metadata được tải
    audio.addEventListener('loadedmetadata', function() {
        $('#total-duration').text(formatTime(audio.duration));
    });

    // Biến để kiểm soát việc kéo
    let isSeeking = false;

    // Bắt đầu kéo
    $('.seek-bar').on('mousedown touchstart', function(e) {
        isSeeking = true;
        updateSeekPosition(e);
    });

    // Kéo
    $(document).on('mousemove touchmove', function(e) {
        if (isSeeking) {
            updateSeekPosition(e);
        }
    });

    // Kết thúc kéo
    $(document).on('mouseup touchend', function() {
        if (isSeeking) {
            isSeeking = false;
        }
    });

    function updateSeekPosition(e) {
        const seekBar = $('.seek-bar');
        const offset = seekBar.offset();
        const width = seekBar.width();
        let x;

        if (e.type.startsWith('touch')) {
            x = e.originalEvent.touches[0].pageX - offset.left;
        } else {
            x = e.pageX - offset.left;
        }

        // Giới hạn x trong khoảng [0, width]
        x = Math.max(0, Math.min(x, width));

        const duration = audio.duration;
        if (isNaN(duration)) return;

        const percent = x / width;
        const newTime = percent * duration;
        console.log("New time: ", newTime);
        console.log("Duration: ",duration);
        console.log("Current time: ", audio.currentTime);
        if (!isNaN(duration)) {
            audio.currentTime = newTime;
        }
        console.log("Current time 2: ", audio.currentTime);
       

        // Cập nhật thanh tua
        $('.seek-bar-progress').css('width', percent * 100 + '%');
    }
});
</script>

@endsection
