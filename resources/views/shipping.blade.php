<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping | Javazon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.min.css') }}">
    <style>
        body { background: #fafbfc; }
        .shipping-container {
            margin: 40px auto;
            max-width: 900px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 16px rgba(0,0,0,0.04);
            padding: 36px 24px;
        }
    </style>
</head>
<body>
    <div class="shipping-container">
        @yield('content')
    </div>
</body>
</html>
