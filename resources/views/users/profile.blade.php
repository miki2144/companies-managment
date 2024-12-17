@extends('layouts.app') <!-- Adjust according to your layout -->

@section('title', 'Profile')

@section('content')
<div class="container">
    <h1>User Profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->full_name }}</h5>
            <p class="card-text"><strong>Username:</strong> {{ $user->username }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p class="card-text"><strong>Company:</strong> {{ $user->company ? $user->company->name : 'No Company Assigned' }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users</a>
        </div>
    </div>
</div>
@endsection