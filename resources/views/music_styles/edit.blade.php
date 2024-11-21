@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Edit Music Style') }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('music_styles.update', $musicStyle->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('Name') }}:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $musicStyle->name) }}" required>
        </div>
        <div class="form-group">
            <label for="description">{{ __('Description') }}:</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $musicStyle->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Update Music Style') }}</button>
        <a href="{{ route('music_styles.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
</div>
@endsection
