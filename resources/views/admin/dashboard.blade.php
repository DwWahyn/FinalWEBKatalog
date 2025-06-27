@extends('layouts.admin')

@section('content')
    <div class="mb-4 p-4 bg-white rounded shadow-sm">
        <h3 class="fw-bold mb-1">Dashboard Admin</h3>
        <p class="text-muted mb-1">Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>
        <small class="text-muted">Gunakan menu di samping untuk mengelola produk, kategori, stok, dan laporan.</small>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-white bg-success p-4 text-center shadow rounded">
                <i class="fas fa-box fa-2x mb-2"></i>
                <h5>Total Produk</h5>
                <h2>{{ $totalProduk }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary p-4 text-center shadow rounded">
                <i class="fas fa-tags fa-2x mb-2"></i>
                <h5>Kategori</h5>
                <h2>{{ $totalKategori }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger p-4 text-center shadow rounded">
                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                <h5>Stok Rendah</h5>
                <h2>{{ $stokRendah }}</h2>
            </div>
        </div>
    </div>
@endsection
