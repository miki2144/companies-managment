@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-md-6 col-lg-4">
        <div class="card text-bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Companies</h5>
                <p class="card-text">{{ $totalCompanies }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card text-bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Admins</h5>
                <p class="card-text">{{ $totalAdmins }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card text-bg-danger">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="mt-4">
    <h2>Recent Companies</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Admin</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentCompanies as $company)
                <tr>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->admin->full_name ?? 'N/A' }}</td>
                    <td>{{ $company->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> -->
</div>
@endsection