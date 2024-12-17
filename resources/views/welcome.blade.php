<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        nav {
            background: #0056b3;
            padding: 10px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000; /* Ensure it stays above other content */
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        nav a:hover {
            background: #007bff;
        }
        .container {
            max-width: 800px;
            margin: 80px auto 20px; /* Add margin-top to account for fixed navbar */
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #007bff;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            padding: 10px;
            background: #e9ecef;
            border-radius: 5px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to the Management System</h1>
</header>

<nav>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="login">Login</a></li>
    </ul>
</nav>

<div class="container">

        <li><strong>Admin:</strong> 
            <ul>
                <li>Role: Manage user profiles, user creation, password management, role management, manage request form templates.</li>
                <li>Dashboard: Users, forms.</li>
            </ul>
        </li>
        <li><strong>Super Admin:</strong> 
            <ul>
                <li>Role: Register companies and assign admin users.</li>
                <li>Dashboard: Companies, admin-users </li>
            </ul>
        </li>
    </ul>
</div>

<footer>
    &copy; 2024  cocompanies Management System. All Rights Reserved.
</footer>

</body>
</html>