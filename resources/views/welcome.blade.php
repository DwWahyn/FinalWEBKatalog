<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang | E-Katalog Ulfamart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .btn-green {
            background-color: #198754;
            color: white;
        }
        .btn-green:hover {
            background-color: #157347;
        }
    </style>
</head>
<body>

    <div class="welcome-card">
        <h2 class="mb-3 text-success">Selamat Datang di Ulfamart</h2>
        <p class="text-muted mb-4">Platform E-Katalog resmi untuk melihat produk dan informasi lainnya.</p>
        <div class="d-grid gap-2">
            <a href="{{ route('login') }}" class="btn btn-green btn-lg">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg">Register</a>
        </div>
    </div>

</body>
</html>
