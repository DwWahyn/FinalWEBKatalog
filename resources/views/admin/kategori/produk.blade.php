@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Produk dalam Kategori: {{ $kategori->nama }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($kategori->produks as $produk)
            <div class="bg-white shadow rounded-xl p-4">
                <h3 class="text-lg font-semibold text-teal-700">{{ $produk->nama }}</h3>
                <p class="text-gray-600">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <p class="text-gray-500">Stok: {{ $produk->stok }}</p>
            </div>
        @empty
            <p class="col-span-full text-gray-500">Tidak ada produk pada kategori ini.</p>
        @endforelse
    </div>
@endsection
