<style>
    .sidebar {
    width: 250px; /* Set a fixed width for the sidebar */
    background-color: #f8f9fa; /* Light background color */
    padding: 20px; /* Padding for the sidebar */
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    position: fixed; /* Fix position on the left */
    height: 100%; /* Full height */
}

.sidebar h3 {
    font-size: 1.5em; /* Font size for the header */
    margin-bottom: 20px; /* Space below the header */
}

.sidebar ul {
    list-style-type: none; /* Remove default list styles */
    padding: 0; /* Remove default padding */
}

.sidebar ul li {
    margin-bottom: 10px; /* Space between list items */
}

.sidebar ul li a {
    text-decoration: none; /* Remove underline from links */
    color: #007bff; /* Link color */
    font-weight: bold; /* Bold links */
    transition: color 0.3s; /* Smooth color transition on hover */
}

.sidebar ul li a:hover {
    color: #0056b3; /* Darker color on hover */
}

.sidebar h4 {
    margin-top: 20px; /* Space above role section */
    font-size: 1.2em; /* Font size for subheader */
}

.logout-button {
    margin-top: 20px; /* Space above the logout button */
}

.logout-button button {
    background-color: #dc3545; /* Bootstrap danger color */
    color: white; /* Text color for the button */
    border: none; /* Remove button border */
    padding: 10px 15px; /* Padding for the button */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth transition */
}

.logout-button button:hover {
    background-color: #c82333; /* Darker red on hover */
}
</style>




<div class="sidebar">
    <h3>Manager Dashboard</h3>
    <ul>
        <li><a href="{{ route('manager.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('requests.index') }}">Requests</a></li>
        <li><a href="{{ route('plans.index') }}">Plans and Reports</a></li>
        <li><a href="{{ route('archived.index') }}">Archived Documents</a></li>
        <li><a href="{{ route('inventories.index') }}">Inventories</a></li>
        <li><a href="{{ route('budgets.index') }}">Forecasted Budgets</a></li>
    </ul>
    <h4>Roles</h4>
    <ul>
        <li><a href="{{ route('purchase.approval') }}">Approve Purchase Requests</a></li>
        <li><a href="{{ route('leave.approval') }}">Approve Leave Requests</a></li>
        <li><a href="{{ route('payment.approval') }}">Approve Payment Requests</a></li>
        <li><a href="{{ route('stockout.approval') }}">Approve Stock Out Requests</a></li>
    </ul>
    <div class="logout-button">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>