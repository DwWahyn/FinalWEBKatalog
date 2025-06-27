<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $produks = Produk::with('kategori')->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_produk'), $filename);
            $data['gambar'] = $filename; // hanya nama file
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_produk'), $filename);
            $data['gambar'] = $filename; // hanya nama file
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function show(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $produk = Produk::with('kategori')->findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    public function stokIndex()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $produks = Produk::all();
        return view('admin.stok.index', compact('produks'));
    }

    public function updateStok(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin');
        }

        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->stok = $request->stok;
        $produk->save();

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil diperbarui.');
    }
}
