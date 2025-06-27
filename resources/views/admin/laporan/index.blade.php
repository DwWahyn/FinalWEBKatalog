@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">Laporan Produk</h3>

    {{-- TOMBOL EXPORT --}}
    <!-- <a href="{{ route('admin.laporan.export.excel') }}" class="btn btn-primary mb-3">
        Export ke Excel
    </a> -->
    <div class="mb-3 d-flex gap-2">
    <a href="{{ route('admin.laporan.export.excel') }}" class="btn btn-success">Export ke Excel</a>
    <a href="{{ route('admin.laporan.export.word') }}" class="btn btn-primary">Export ke Word</a>
</div>


    {{-- FILTER --}}
    <form method="GET" class="row mb-4">
        <div class="col-md-4 mb-2">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Produk..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4 mb-2">
            <select name="kategori_id" class="form-control">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList ?? [] as $kategori)
                    @if ($kategori && is_object($kategori))
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <button class="btn btn-success w-100" type="submit">Tampilkan</button>
        </div>
    </form>

    {{-- RINGKASAN --}}
    <div class="mb-3">
        <strong>Total Produk:</strong> {{ $totalProduk ?? 0 }} |
        <strong>Total Stok:</strong> {{ $totalStok ?? 0 }} |
        <strong>Waktu Cetak:</strong> {{ now()->format('d M Y H:i') }}
    </div>

    {{-- TABEL --}}
    <div class="card">
        <div class="card-body">
            @if(isset($produks) && $produks->count())
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $index => $produk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->kategori->nama ?? '-' }}</td>
                        <td>
                            @if ($produk->stok == 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif ($produk->stok < 5)
                                <span class="badge bg-warning text-dark">{{ $produk->stok }} (Segera Restok)</span>
                            @else
                                <span class="badge bg-info text-dark">{{ $produk->stok }}</span>
                            @endif
                        </td>
                        <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info">Tidak ada produk ditemukan.</div>
            @endif
        </div>
    </div>

    {{-- CHART --}}
    @if(isset($produks) && $produks->count())
        <canvas id="stokChart" height="100" class="mt-4"></canvas>
    @else
        <div id="chartMessage" class="alert alert-warning mt-4">Tidak ada data untuk ditampilkan dalam chart.</div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = {!! json_encode($produks->pluck('nama') ?? []) !!};
        const data = {!! json_encode($produks->pluck('stok') ?? []) !!};

        const canvas = document.getElementById('stokChart');

        if (labels.length > 0 && data.length > 0) {
            renderChart(labels, data);
        }
    });

    function renderChart(labels, data) {
        const ctx = document.getElementById('stokChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stok Produk',
                    data: data,
                    backgroundColor: '#66bb6a'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    }
</script>
@endsection
