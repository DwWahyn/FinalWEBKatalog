@extends('layouts.admin')

@section('content')
<div class="mb-4 p-4 bg-white rounded shadow-sm">
    <h3 class="fw-bold mb-1">Dashboard Admin</h3>
    <p class="text-muted mb-1">Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>
    <small class="text-muted">Gunakan menu di samping untuk mengelola produk, kategori, stok, dan laporan.</small>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card text-white bg-success p-4 text-center shadow rounded card-hover">
            <i class="fas fa-box fa-2x mb-2"></i>
            <h5>Total Produk</h5>
            <h2>{{ $totalProduk }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-primary p-4 text-center shadow rounded card-hover">
            <i class="fas fa-tags fa-2x mb-2"></i>
            <h5>Kategori</h5>
            <h2>{{ $totalKategori }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger p-4 text-center shadow rounded card-hover">
            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
            <h5>Stok Rendah</h5>
            <h2>{{ $stokRendah }}</h2>
        </div>
    </div>
</div>

<!-- Grafik -->
<div class="card mt-5 p-4">
    <h5 class="mb-3">
        <i class="fas fa-chart-bar me-2"></i>Jumlah Produk per Kategori
    </h5>
    <div style="height: 300px;">
        <canvas id="produkChart"></canvas>
    </div>
</div>

<!-- Inject data -->
<script>
    window.chartLabels = <?php echo json_encode($labels); ?>;
    window.chartData = <?php echo json_encode($data); ?>;
</script>



<!-- Chart.js & External Logic -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard-chart.js') }}"></script>

<!-- Animasi Hover -->
<style>
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .card-hover:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
