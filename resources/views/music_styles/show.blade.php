@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Music Style Details') }}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $musicStyle->name }}</h5>
            <p class="card-text">{{ $musicStyle->description }}</p>
            <a href="{{ route('music_styles.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>
    </div>
</div>
@endsection
