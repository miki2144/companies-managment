@extends('layouts.finance')

<style>
    /* Professional table design */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #ddd; /* Light border for each cell */
    }

    .table th {
        background-color: rgb(30, 126, 221);
        color: white;
        font-weight: bold;
    }

    /* Hover effect for rows */
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1); /* Light blue on hover */
        cursor: pointer;
    }

    /* Striped rows with alternating background */
    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Light grey for odd rows */
    }

    /* Table border */
    .table-bordered {
        border: 2px solid #ddd;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #ddd;
    }

    /* Optional: Add shadow to table for a more professional look */
    .table-container {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
    }
</style>

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Finance Dashboard</h2>
        <h3 class="mb-3">Company: {{ $company->name }}</h3>

        <h4 class="mb-3">Users in the Company</h4>

        <div class="table-container">
            <!-- Add Bootstrap table classes for better design -->
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
