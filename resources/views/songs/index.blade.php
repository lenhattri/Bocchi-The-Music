@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Songs List') }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('songs.create') }}" class="btn btn-primary mb-3">{{ __('Add New Song') }}</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Artist') }}</th>
                <th>{{ __('Posted By') }}</th>
                <th>{{ __('Plays') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($songs as $song)
                <tr>
                    <td>{{ $song->id }}</td>
                    <td>{{ $song->title }}</td>
                    <td>{{ $song->artist }}</td>
                    <td>{{ $song->user->name }}</td> 
                    <td>{{ $song->plays }}</td> 
                    <td>
                        <a href="{{ route('songs.show', $song) }}" class="btn btn-info">{{ __('View') }}</a>
                        <a href="{{ route('songs.edit', $song) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                        <form action="{{ route('songs.destroy', $song) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
