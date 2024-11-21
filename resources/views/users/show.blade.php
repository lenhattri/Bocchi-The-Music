@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('User Details') }}</h1>
    <div class="card">
        <div class="card-header">
            <h3>{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
            <p><strong>{{ __('Admin') }}:</strong> {{ $user->is_admin ? __('Yes') : __('No') }}</p>
            <p><strong>{{ __('Created At') }}:</strong> {{ $user->created_at->format('Y-m-d H:i:s') }}</p>
            <p><strong>{{ __('Updated At') }}:</strong> {{ $user->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Back to Users') }}</a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">{{ __('Edit User') }}</a>
        </div>
    </div>
</div>
@endsection
