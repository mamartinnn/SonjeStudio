<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div class="bg-light p-3" style="width: 250px; min-height: 100vh;">
            <h4>Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link">Products</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">Users</a>
                </li>
            </ul>
        </div>

        <div class="p-4 w-100">
            @yield('content')
        </div>
    </div>
</body>
</html>
