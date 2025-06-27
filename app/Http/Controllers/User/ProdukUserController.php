<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query produk beserta relasi kategori
        $query = Produk::with('kategori');

        // Filter berdasarkan pencarian nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori (jika ada)
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Ambil hasil pencarian
        $produks = $query->get();

        // Ambil semua kategori untuk dropdown filter
        $kategoris = Kategori::all();

        // Kirim ke view
        return view('user.produk.index', compact('produks', 'kategoris'));
    }
}
