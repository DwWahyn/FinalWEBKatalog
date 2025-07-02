@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold mb-6 text-center">🛍️ Katalog Produk</h2>
    <form action="{{ route('user.dashboard') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
        {{-- Input Pencarian --}}
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama produk..."
            class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded shadow-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
        <select
            name="kategori"
            onchange="this.form.submit()"
            class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded shadow-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                    {{ ucfirst($kategori->nama) }}
                </option>
            @endforeach
        </select>
    </form>

    @if($produks->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($produks as $produk)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
            @php
                $gambarPath = public_path('gambar_produk/' . $produk->gambar);
            @endphp

            {{-- Gambar Produk --}}
            <div class="h-60 w-full bg-white flex items-center justify-center p-2">
                <img
                    src="{{ $produk->gambar && file_exists($gambarPath) 
                        ? asset('gambar_produk/' . $produk->gambar) 
                        : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                    alt="{{ $produk->nama }}"
                    class="h-full w-full object-contain mx-auto"
                >
            </div>

            {{-- Info Produk --}}
            <div class="p-4">
                <h5 class="text-lg font-semibold mb-1 truncate">{{ $produk->nama }}</h5>
                <p class="text-green-700 font-bold mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600">Stok: {{ $produk->stok }}</p>
                <p class="text-sm text-gray-600">Kategori: {{ $produk->kategori->nama ?? '-' }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <p class="text-center text-gray-500 mt-10">🔍 Tidak ada produk yang ditemukan.</p>
    @endif
</div>
@endsection
