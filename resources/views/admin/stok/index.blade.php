@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4 fw-bold">Manajemen Stok</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th>Nama Produk</th>
                    <th>Stok Saat Ini</th>
                    <th>Update Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $produk)
                <tr>
                    <td>{{ $produk->nama }}</td>
                    <td class="text-center">{{ $produk->stok }}</td>
                    <td>
                        <form action="{{ route('admin.stok.update', $produk->id) }}" method="POST" class="d-flex">
                            @csrf
                            @method('PUT')
                            <input type="number" name="stok" value="{{ $produk->stok }}" min="0" class="form-control me-2" required>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($produks->isEmpty())
                <tr>
                    <td colspan="3" class="text-center text-muted">Tidak ada produk tersedia.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
