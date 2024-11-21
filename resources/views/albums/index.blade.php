@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Albums') }}</h1>

    <a href="{{ route('albums.create') }}" class="btn btn-success mb-3">{{ __('Add Album') }}</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($albums->isEmpty())
        <p>{{ __('No albums available.') }}</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('Album Name') }}</th>
                    <th>{{ __('Release Date') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $album)
                    <tr>
                        <td>
                            <a href="{{ route('albums.show', $album->id) }}">
                                {{ $album->album_name }}
                            </a>
                        </td>
                        <td>{{ $album->release_date ?? __('No Date') }}</td>
                        <td>
                            <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">{{ __('View') }}</a>
                            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                            <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
