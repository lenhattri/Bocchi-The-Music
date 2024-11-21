@extends('layouts.app')

@section('title', __('Admin Dashboard'))

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>{{ __('Admin Dashboard') }}</h1>
        <p>{{ __('Welcome to admin dashboard.') }}</p>
    </div>
    <div class="dashboard-content">
        <div class="card">
            <h2>{{ __('Manage Songs') }}</h2>
            <p>{{ __('Add, edit, and remove songs from your music library.') }}</p>
            <a href="{{ route('songs.index') }}" class="button">{{ __('View Songs') }}</a>
        </div>
        <div class="card">
            <h2>{{ __('Manage Albums') }}</h2>
            <p>{{ __('Organize your albums and create collections.') }}</p>
            <a href="{{ route('albums.index') }}" class="button">{{ __('View Albums') }}</a>
        </div>
        <div class="card">
            <h2>{{ __('Manage Music Styles') }}</h2>
            <p>{{ __('Customize music styles and genres.') }}</p>
            <a href="{{ route('music_styles.index') }}" class="button">{{ __('View Styles') }}</a>
        </div>
        <div class="card">
            <h2>{{ __('Manage Users') }}</h2>
            <p>{{ __('Add, edit, and manage registered users.') }}</p>
            <a href="{{ route('users.index') }}" class="button">{{ __('View Users') }}</a>
        </div>
    </div>
</div>
@endsection
