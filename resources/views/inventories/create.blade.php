@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Inventory</h1>
    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" name="item_name" id="item_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="stock_in_date">Stock In Date</label>
            <input type="date" name="stock_in_date" id="stock_in_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="stock_out_date">Stock Out Date</label>
            <input type="date" name="stock_out_date" id="stock_out_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="managed_by">Managed By (User ID)</label>
            <input type="number" name="managed_by" id="managed_by" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add Inventory</button>
    </form>
</div>
@endsection
