<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $stokRendah = Produk::where('stok', '<', 10)->count();

        $kategori = Kategori::withCount('produks')->get();
        $labels = $kategori->pluck('nama'); 
        $data = $kategori->pluck('produks_count');

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalKategori',
            'stokRendah',
            'labels',
            'data'
        ));
    }



    // return view('admin.dashboard', compact('totalProduk', 'totalKategori', 'stokRendah'));
}
