<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Produk::with('kategori')->get()->map(function ($produk) {
            return [
                'Nama Produk' => $produk->nama,
                'Kategori' => $produk->kategori->nama ?? '-',
                'Stok' => $produk->stok,
                'Harga' => $produk->harga,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kategori',
            'Stok',
            'Harga',
        ];
    }
}
