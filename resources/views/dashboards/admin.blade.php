@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Display Admin Name -->
    <div class="col-md-12 mb-3">
        <div class="card text-bg-info">
            <div class="card-body">
                <h5 class="card-title">Welcome, {{ Auth::user()->full_name }}</h5>
            </div>
        </div>
    </div>

    <!-- Display Company Name -->
    <div class="col-md-6 col-lg-4">
        @if(Auth::user()->company)
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Your Company</h5>
                    <p class="card-text">{{ Auth::user()->company->company_name }}</p>
                </div>
            </div>
        @else
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Your Company</h5>
                    <p class="card-text">No company assigned</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Total Users in Company -->
    <div class="col-md-6 col-lg-4">
        <div class="card text-bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Users in Company</h5>
                <p class="card-text">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h2>Manage Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    <!-- Option to create a company can be enabled if needed -->
    <!-- <a href="{{ route('companies.create') }}" class="btn btn-secondary">Create Company</a> -->
    
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Delete button (assuming functionality will be added later) -->
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection