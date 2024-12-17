@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inventory List</h1>
    <a href="{{ route('inventories.create') }}" class="btn btn-primary mb-3">Add New Inventory</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Stock In Date</th>
                <th>Stock Out Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->item_name }}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td>{{ $inventory->description }}</td>
                    <td>{{ $inventory->stock_in_date }}</td>
                    <td>{{ $inventory->stock_out_date }}</td>
                    <td>
                        <!-- Update route to use 'inventory_id' -->
                        <a href="{{ route('inventories.edit', $inventory->inventory_id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('inventories.destroy', $inventory->inventory_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
