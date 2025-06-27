@extends('layouts.user')

@section('content')

{{-- HERO SECTION --}}
<div class="mt-8 mb-10 px-4">
    <div class="bg-gradient-to-r from-green-600 to-lime-500 text-white rounded-3xl shadow-xl p-10 text-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl -z-10"></div>
        <div class="flex flex-col items-center justify-center space-y-2">
            <div class="flex items-center justify-center gap-3 text-4xl md:text-5xl font-extrabold drop-shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.6 16M7 13l1.5 3M17 13l1.5 3M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                </svg>
                <span>E-Katalog <span class="underline">Ulfamart</span></span>
            </div>
            <p class="text-green-100 md:text-md text-sm">Temukan produk terbaik dengan harga bersahabat hanya di <strong>Ulfamart</strong></p>
        </div>
    </div>
</div>

{{-- FILTER & SEARCH --}}
<div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-10 px-4">
    <form method="GET" action="{{ route('user.dashboard') }}" class="flex w-full md:w-2/3">
        <input type="text" name="cari" value="{{ request('cari') }}" 
               placeholder="🔍 Cari produk (contoh: Aqua, Mie, Susu...)"
               class="w-full px-5 py-3 border border-gray-300 rounded-l-full focus:ring focus:ring-green-400 outline-none shadow-sm text-sm">
        <button type="submit" class="bg-green-600 text-white px-5 py-3 rounded-r-full hover:bg-green-700 transition text-sm">
            Cari
        </button>
    </form>

    <form method="GET" action="{{ route('user.dashboard') }}" class="w-full md:w-1/3">
        <select name="kategori" onchange="this.form.submit()"
                class="w-full px-4 py-3 border border-gray-300 rounded-full focus:ring focus:ring-green-400 shadow-sm outline-none text-sm">
            <option value="">📂 Semua Kategori</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                    {{ ucfirst($kategori->nama) }}
                </option>
            @endforeach
        </select>
    </form>
</div>

{{-- HASIL PENCARIAN (optional) --}}
@if(request('cari') || request('kategori'))
    <div class="text-center text-sm text-gray-600 mb-6">
        Menampilkan hasil untuk:
        @if(request('cari'))
            <span class="font-medium">"{{ request('cari') }}"</span>
        @endif
        @if(request('kategori'))
            <span class="ml-2">Kategori: <strong>{{ $kategoris->find(request('kategori'))->nama ?? '-' }}</strong></span>
        @endif
    </div>
@endif

{{-- PRODUK --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4">
    @forelse ($produks as $produk)
        <div class="relative bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-xl hover:scale-[1.02] transition duration-300 overflow-hidden group">
            @php $gambarPath = public_path('gambar_produk/' . $produk->gambar); @endphp
            @if($produk->gambar && file_exists($gambarPath))
                <img src="{{ asset('gambar_produk/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="w-full h-48 object-cover">
            @else
                <img src="https://via.placeholder.com/300x200?text=No+Image" alt="Tidak ada gambar" class="w-full h-48 object-cover">
            @endif

            @if($produk->stok == 0)
                <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded">Stok Habis</span>
            @elseif($loop->iteration <= 4)
                <span class="absolute top-2 left-2 bg-yellow-400 text-black text-xs font-semibold px-2 py-1 rounded">🔥 Baru</span>
            @endif

            <div class="p-4">
                <h5 class="text-lg font-semibold mb-1 text-gray-800 truncate">{{ $produk->nama }}</h5>
                <p class="text-green-600 font-bold text-md mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <div class="text-sm text-gray-600 space-y-1">
                    <p>📦 Stok: <span class="font-medium">{{ $produk->stok }}</span></p>
                    <p>🏷️ Kategori: <span class="font-medium">{{ $produk->kategori->nama ?? '-' }}</span></p>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500 col-span-full">Produk tidak ditemukan.</p>
    @endforelse
</div>

{{-- PAGINATION (optional) --}}
{{-- <div class="mt-8 px-4">
    {{ $produks->links() }}
</div> --}}
@endsection
