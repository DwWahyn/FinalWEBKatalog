<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class StokController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return view('admin.stok.index', compact('produks'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update(['stok' => $request->stok]);

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil diperbarui.');
    }

    
    public function low()
    {
        $produks = Produk::with('kategori')
            ->where('stok', '<', 10)
            ->get();

        return view('admin.stok.low', compact('produks'));
    }
}
