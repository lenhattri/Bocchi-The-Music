@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Add New Music Style') }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('music_styles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('Name') }}:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('Enter the name of the music style') }}" required>
        </div>
        <div class="form-group">
            <label for="description">{{ __('Description') }}:</label>
            <textarea name="description" id="description" class="form-control" placeholder="{{ __('Enter a description for the music style') }}">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">{{ __('Add Music Style') }}</button>
        <a href="{{ route('music_styles.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </form>
</div>
@endsection
