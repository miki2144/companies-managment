@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add New Company</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Country</th>
                <th>City</th>
                <th>Contact Email</th>
                <th>Contact Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->country }}</td>
                    <td>{{ $company->city }}</td>
                    <td>{{ $company->contact_email }}</td>
                    <td>{{ $company->contact_phone }}</td>
                    <td>
                        <a href="{{ route('companies.edit', $company->company_id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('companies.destroy', $company->company_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection