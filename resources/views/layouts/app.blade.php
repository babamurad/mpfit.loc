<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Marketplace App')</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 960px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1, h2, h3 { color: #0056b3; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: #007bff; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { display: inline-block; padding: 8px 12px; margin-right: 5px; border-radius: 4px; text-decoration: none; color: #fff; background-color: #007bff; border: none; cursor: pointer; }
        .btn-primary { background-color: #007bff; }
        .btn-success { background-color: #28a745; }
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-danger { background-color: #dc3545; }
        .btn-info { background-color: #17a2b8; }
        .btn:hover { opacity: 0.9; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .form-actions { margin-top: 20px; }
        .pagination { margin-top: 20px; display: flex; justify-content: center; list-style: none; padding: 0; }
        .pagination li { margin: 0 5px; }
        .pagination li a, .pagination li span { display: block; padding: 8px 12px; text-decoration: none; border: 1px solid #007bff; color: #007bff; border-radius: 4px; }
        .pagination li.active span { background-color: #007bff; color: white; }
        .pagination li a:hover { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="{{ route('products.index') }}">Товары</a>
            <a href="{{ route('orders.index') }}">Заказы</a>
        </nav>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>