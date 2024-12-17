<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4; /* Set the background color for the whole page */
        }

        .d-flex {
            display: flex;
            height: 100vh; /* Full height */
        }

        .sidebar {
            width: 250px;
            background-color: #343a40; /* Dark background for sidebar */
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: width 0.3s; /* Smooth transition */
        }

        .sidebar h3 {
            margin-top: 0;
            font-size: 24px;
            color: #ffffff; /* Sidebar title color */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ffffff; /* Link color */
            font-size: 18px;
            padding: 10px;
            display: block;
            border-radius: 4px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth background change */
        }

        .sidebar ul li a:hover {
            background-color: #495057; /* Darker on hover */
        }

        .roles h4 {
            margin: 0;
            font-size: 18px; /* Font size for roles */
            color: #ffffff; /* Text color */
        }

        /* Logout Button Styles */
        .logout-button {
            margin-top: 20px;
            text-align: center;
        }

        .logout-button form {
            display: inline; /* Inline form for button */
        }

        .logout-button button {
            background-color: #dc3545; /* Bootstrap danger color */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .logout-button button:hover {
            background-color: #c82333; /* Darker red on hover */
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto; /* Scrollable if content overflows */
        }

        .content h2 {
            margin-top: 0;
            color: #333; /* Main title color */
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .d-flex {
                flex-direction: column;
            }
            .sidebar {
                width: 100%; /* Full width on smaller screens */
                height: auto; /* Auto height */
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Finance Dashboard</h3>
            <ul class="nav">
                
            <li><a href="{{ route('payrolls.index') }}">Payroll</a></li>
            <li><a href="{{ route('inventories.index') }}">Inventories</a></li>
            <li><a href="{{ route('budgets.index') }}">Budget Forecasting</a></li>
                <li><a href="{{ route('archived.index') }}">Archived Documents</a></li>                <li><a href="{{ route('leave.requests.index') }}">Leave Requests</a></li>
                <li><a href="{{ route('payment.requests.index') }}">Payment Requests</a></li>
                <li><a href="{{ route('purchase.requests.index') }}">Purchase Requests</a></li>
                <li><a href="{{ route('plans.index') }}">Plans </a></li>
                <li><a href="{{ route('reports.index') }}">Reports</a></li>                
                <li><a href="{{ route('payment.requests.review') }}">Review Payment Requests</a></li>
                <!-- <li><a href="{{ route('requests.approval') }}">Send Requests and Payroll for Approval</a></li> -->
            </ul>

            <!-- Logout Button -->
            <div class="logout-button">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
