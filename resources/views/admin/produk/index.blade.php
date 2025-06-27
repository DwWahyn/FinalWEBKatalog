@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Produk</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.produk.create') }}" class="btn btn-success mb-3">+ Tambah Produk</a>

    <table class="table table-bordered">
        <thead class="table-success">
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $produk->nama }}</td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->kategori->nama ?? '-' }}</td>
                    <td>
                        @if($produk->gambar)
                            <img src="{{ asset('gambar_produk/' . $produk->gambar) }}" width="50" alt="Gambar Produk">
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
