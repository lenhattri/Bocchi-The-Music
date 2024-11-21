<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Lofi Music World') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<header class="header">
    <nav class="navbar container">
        <a class="navbar-brand" href="#">{{ __('Bocchi the Music') }}</a>
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn">{{ __('Login') }}</a>
            <a href="{{ route('register') }}" class="btn">{{ __('Register') }}</a>
        </div>
    </nav>
</header>

<main class="main-content">
    <div class="anime-image">
        <img src="https://4kwallpapers.com/images/walls/thumbs_3t/14893.jpg" alt="{{ __('Lofi Anime') }}" />
    </div>
    <h1>{{ __('Welcome to') }} <b id="title-brand">{{ __('Bocchi the Music') }}</b></h1>
    <p>{{ __('Discover sweet melodies, relax, and immerse yourself in the world of gentle music. Start your music journey today!') }}</p>
    <a href="{{ route('home') }}" class="btn explore-button">{{ __('Explore Now') }}</a>
</main>

<footer>
    <p>&copy; 2024 {{ __('Bocchi The Music') }}. {{ __('All rights reserved.') }} | <a href="#">{{ __('Privacy Policy') }}</a> | <a href="#">{{ __('Terms of Service') }}</a></p>
</footer>

</body>
</html>
