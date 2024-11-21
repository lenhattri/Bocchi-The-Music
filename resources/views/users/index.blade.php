@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Users') }}</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">{{ __('Add User') }}</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Admin') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? __('Yes') : __('No') }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">{{ __('View') }}</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
