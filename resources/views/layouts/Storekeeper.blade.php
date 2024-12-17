<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <h3>Storekeeper Dashboard</h3>
            <ul>
                <li><a href="{{ route('inventories.index') }}">Manage Inventories</a></li>
                <li><a href="{{ route('requests.index') }}">View Requests</a></li>
                <li><a href="{{ route('reports.index') }}">View Reports</a></li>
            </ul>
            <div class="logout-button">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <h1>Welcome, {{ $user->full_name }}</h1>
                <p>This is your Storekeeper Dashboard. You can manage inventories, view requests, and access reports.</p>

                <h3>Inventory List</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Stock In Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->item_name }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>{{ $inventory->stock_in_date }}</td>
                                <td>
                                    <a href="{{ route('inventories.edit', $inventory->inventory_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>