<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 0;
            margin: 0;
        }
        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 60px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            background-color: rgba(255, 0, 13, 0.25); 
        }
        .sidebar a:hover {
            background-color: #0056b3; /* Hover color */
        }
        .sidebar.collapsed a {
            justify-content: center;
            font-size: 14px;
        }
        .sidebar .menu-icon {
            margin-right: 10px;
        }
        .sidebar.collapsed .menu-icon {
            margin-right: 0;
        }
        .avatar {
            width: 60px; /* Set the width of the avatar */
            height: 60px; /* Set the height of the avatar */
            border-radius: 50%; /* Make it circular */
            object-fit: cover; /* Ensure the image covers the area */
            margin-bottom: 10px; /* Space below the avatar */
        }
        .content {
            margin-left: 220px; /* Space for the sidebar */
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .content.collapsed {
            margin-left: 80px;
        }
        .toggle-sidebar-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
            cursor: pointer;
            font-size: 20px;
            color: #343a40;
        }
    </style>
</head>
<body>

<!-- Sidebar Toggle Button -->
<div class="toggle-sidebar-btn">
    <i class="fas fa-bars"></i>
</div>

<div class="sidebar">
    <h2 style="color: white; text-align: center;">
        <img src="path/to/your/avatar.jpg" alt="User Avatar" class="avatar">
    </h2>
    <a href="{{ route('users.create') }}" class="btn w-100">
        <i class="fas fa-user-plus menu-icon"></i>
        <span class="menu-text">Create User</span>
    </a>
    <a href="{{ route('users.index') }}" class="btn w-100">
        <i class="fas fa-users menu-icon"></i>
        <span class="menu-text">Show Users</span>
    </a>
    <a href="{{ route('profile.show') }}" class="btn w-100">
        <i class="fas fa-user menu-icon"></i>
        <span class="menu-text">Profile</span>
    </a>
    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="btn btn-danger" style="width: 100%; margin-top: 10px;">Logout</button>
    </form>
</div>

<div class="content">
    <div class="container">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif 

        @yield('content')
    </div>
</div>

<!-- JS for Sidebar Toggle -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.toggle-sidebar-btn').click(function () {
            $('.sidebar').toggleClass('collapsed');
            $('.content').toggleClass('collapsed');
        });
    });
</script>
</body>
</html>