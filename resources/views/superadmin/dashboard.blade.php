@extends('superadmin.layout')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="container">
    <h1 class="my-4">Super Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Companies</h5>
                    <p class="card-text">{{ $totalCompanies }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection