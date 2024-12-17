@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchase Requests</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('purchase.requests.create') }}" class="btn btn-primary">Create Purchase Request</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Estimated Cost</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseRequests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->item_name }}</td>
                    <td>{{ $request->quantity }}</td>
                    <td>{{ $request->estimated_cost }}</td>
                    <td>{{ $request->status }}</td>
                    <td>
                        <form action="{{ route('purchase.requests.approve', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('purchase.requests.reject', $request->id) }}" method="POST" style="display:inline;">
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