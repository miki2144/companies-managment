<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Admin</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.create-admin') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Admin Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="company_id">Assign to Company</label>
            <select name="company_id" class="form-control" required>
                <option value="">Select a Company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->company_id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Admin</button>
    </form>
</div>
@endsection -->
