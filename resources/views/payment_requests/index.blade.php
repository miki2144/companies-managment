@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Payment Requests</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('payment.requests.create') }}" class="btn btn-primary">Create Payment Request</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentRequests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->user ? $request->user->name : 'N/A' }}</td> <!-- Safely check for user -->
                    <td>{{ $request->amount }}</td>
                    <td>{{ $request->description }}</td>
                    <td>{{ $request->status }}</td>
                    <td>
                        <form action="{{ route('payment.requests.approve', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('payment.requests.reject', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection