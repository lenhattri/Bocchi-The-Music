@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Add User') }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="is_admin">{{ __('Admin') }}</label>
            <select name="is_admin" id="is_admin" class="form-control">
                <option value="0">{{ __('No') }}</option>
                <option value="1">{{ __('Yes') }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">{{ __('Create User') }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Back to Users') }}</a>
    </form>
</div>
@endsection
