<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Ulfamart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts & Bootstrap --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }

        .sidebar {
            height: 100vh;
            width: 240px;
            position: fixed;
            background-color: #1b5e20;
            color: white;
            padding-top: 30px;
            overflow-y: auto;
        }

        .sidebar h4 {
            font-weight: bold;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 14px 24px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #2e7d32;
        }

        .sidebar .submenu-title {
            font-size: 0.85rem;
            padding: 10px 24px 0;
            opacity: 0.8;
            text-transform: uppercase;
        }

        .main-content {
            margin-left: 240px;
            padding: 40px;
        }

        .card-box {
            border-radius: 12px;
            padding: 25px;
            color: white;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card-box:hover {
            transform: translateY(-5px);
        }

        .bg-card-green {
            background: linear-gradient(135deg, #66bb6a, #388e3c);
        }

        .bg-card-blue {
            background: linear-gradient(135deg, #42a5f5, #1565c0);
        }

        .bg-card-red {
            background: linear-gradient(135deg, #ef5350, #c62828);
        }

        .card-box i {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .card-box h5 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .sidebar {
                display: none;
            }
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h4 class="text-center mb-4">Ulfamart Admin</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-house me-2"></i> Dashboard
        </a>

        {{-- Produk --}}
        <a href="{{ route('admin.produk.index') }}" class="{{ request()->is('admin/produk') ? 'active' : '' }}">
            <i class="fas fa-box me-2"></i> Daftar Produk
        </a>
        <a href="{{ route('admin.produk.create') }}" class="{{ request()->is('admin/produk/create') ? 'active' : '' }}">
            <i class="fas fa-plus me-2"></i> Tambah Produk
        </a>

        {{-- Kategori --}}
        <a href="{{ route('admin.kategori.index') }}" class="{{ request()->is('admin/kategori') ? 'active' : '' }}">
            <i class="fas fa-tags me-2"></i> Daftar Kategori
        </a>
        <a href="{{ route('admin.kategori.create') }}" class="{{ request()->is('admin/kategori/create') ? 'active' : '' }}">
            <i class="fas fa-plus me-2"></i> Tambah Kategori
        </a>

        {{-- Manajemen Stok --}}
        <a href="{{ route('admin.stok.index') }}" class="{{ request()->is('admin/stok') ? 'active' : '' }}">
            <i class="fas fa-boxes-stacked me-2"></i> Manajemen Stok
        </a>
        <a href="{{ route('admin.stok.low') }}" class="{{ request()->is('admin/stok/low') ? 'active' : '' }}">
            <i class="fas fa-triangle-exclamation me-2"></i> Stok Rendah
        </a>
        <a href="{{ route('admin.laporan.index') }}" class="{{ request()->is('admin/laporan') ? 'active' : '' }}">
            <i class="fas fa-file-alt me-2"></i> Laporan Produk
        </a>



        {{-- Logout --}}
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        @yield('content')
    </div>
     @yield('scripts')

</body>

</html>