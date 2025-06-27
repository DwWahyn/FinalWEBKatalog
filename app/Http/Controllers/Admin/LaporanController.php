<?php

namespace App\Http\Controllers\Admin;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Produk::with('kategori');

        // Filter berdasarkan nama produk
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Ambil data yang sudah difilter
        $produks = $query->get();

        // Data tambahan untuk laporan
        $totalProduk = $produks->count();
        $totalStok = $produks->sum('stok');
        $kategoriList = Kategori::all();

        return view('admin.laporan.index', compact(
            'produks',
            'totalProduk',
            'totalStok',
            'kategoriList'
        ));
        
    }
    public function exportExcel()
{
    return Excel::download(new ProdukExport, 'laporan-produk.xlsx');
}
public function exportWord()
{
    $produk = Produk::with('kategori')->get();

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    $section->addText('Laporan Produk', ['bold' => true, 'size' => 16]);
    $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999']);

    $table->addRow();
    $table->addCell()->addText('Nama Produk');
    $table->addCell()->addText('Kategori');
    $table->addCell()->addText('Stok');
    $table->addCell()->addText('Harga');

    foreach ($produk as $p) {
        $table->addRow();
        $table->addCell()->addText($p->nama);
        $table->addCell()->addText($p->kategori->nama ?? '-');
        $table->addCell()->addText($p->stok);
        $table->addCell()->addText('Rp' . number_format($p->harga, 0, ',', '.'));
    }

    $tempFile = tempnam(sys_get_temp_dir(), 'word');
    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($tempFile);

    return response()->download($tempFile, 'laporan-produk.docx')->deleteFileAfterSend(true);
}
}
