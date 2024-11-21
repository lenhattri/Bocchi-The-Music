@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Music Styles') }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('music_styles.create') }}" class="btn btn-primary mb-3">{{ __('Add New Music Style') }}</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($musicStyles as $style)
                <tr>
                    <td>{{ $style->id }}</td>
                    <td>{{ $style->name }}</td>
                    <td>{{ $style->description }}</td>
                    <td>
                        <a href="{{ route('music_styles.show', $style) }}" class="btn btn-info">{{ __('View') }}</a>
                        <a href="{{ route('music_styles.edit', $style) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                        <form action="{{ route('music_styles.destroy', $style) }}" method="POST" style="display:inline;">
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
