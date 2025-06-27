@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">Produk dengan Stok Rendah</h3>

    <div class="card">
        <div class="card-body">
            @if($produks->count() > 0)
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Stok Saat Ini</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                    <tr>
                        <td>{{ $produk->nama }}</td>
                        <td>
                            @if ($produk->stok == 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif ($produk->stok < 5)
                                <span class="badge bg-warning text-dark">{{ $produk->stok }} (Segera Restok)</span>
                            @else
                                <span class="badge bg-info text-dark">{{ $produk->stok }} (Rendah)</span>
                            @endif
                        </td>
                        <td>{{ $produk->kategori->nama ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-success text-center">
                Semua stok aman. Tidak ada produk dengan stok rendah.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
