<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thế Giới Âm Nhạc Lofi</title>



    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<header class="header">
    <nav class="navbar container">
        <a class="navbar-brand" href="#">Bocchi the Music</a>
        <div class="auth-buttons">
           
            <a href="{{ route('login') }}" class="btn">Đăng Nhập</a>
            <a href="{{ route('register') }}" class="btn">Đăng Ký</a>
        </div>
    </nav>
</header>

<main class="main-content">
    <div class="anime-image">
        <img src="https://4kwallpapers.com/images/walls/thumbs_3t/14893.jpg" alt="Lofi Anime" />
    </div>
    <h1>Chào mừng đến với <b id="title-brand">Bocchi the Music</b></h1>
    <p>Khám phá giai điệu ngọt ngào, thư giãn và hòa mình vào thế giới âm nhạc nhẹ nhàng. Bắt đầu hành trình âm nhạc của bạn ngay hôm nay!</p>
    <a href="{{route('home')}}" class="btn explore-button">Khám Phá Ngay</a>
</main>

<footer>
    <p>&copy; 2024 Bocchi The Music. All rights reserved. | <a href="#">Chính Sách Bảo Mật</a> | <a href="#">Điều Khoản Dịch Vụ</a></p>
</footer>

</body>
</html>
