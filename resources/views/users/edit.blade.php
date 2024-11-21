@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Edit User') }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" class="form-control">
            <small>{{ __('Leave blank if you do not want to change the password.') }}</small>
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <label for="is_admin">{{ __('Admin') }}</label>
            <select name="is_admin" id="is_admin" class="form-control">
                <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">{{ __('Update User') }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Back to Users') }}</a>
    </form>
</div>
@endsection
