<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rows = Produk::where('stok', '<=', 3)->get();
        $produk = Produk::orderBy('id', 'desc')->first();
        if (!$produk) {
            $format = 'BRG001';
        } else {
            $urut = substr($produk->kode_produk, 3);
            $tambah = $urut + 1;
            $format = 'BRG' . str_pad($tambah, 3, '0', STR_PAD_LEFT);
        }

        $stok = $request->query('stok');
        if ($stok == 'yes') {
            $produks = Produk::stokBarang();
        } else {
            $produks = Produk::get();
        }

        $data = [
            'title' => 'Produk',
            'kd_produk' => $format,
            'produks' => $produks,
            'count' => $rows->count()
        ];

        return view('admin.produk', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahStok(Request $request, $id)
    {
        $this->validate($request, [
            'restok' => 'required',
        ]);

        $stokBarang = Produk::where('id', $id)->first();

        $stok = $stokBarang->stok + $request->restok;

        $stokBarang->update([
            'stok' => $stok,
        ]);

        return redirect('admin/produk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        Produk::create([
            'kode_produk' => $request->kd_produk,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);

        return redirect('admin/produk')->with('success', 'Data produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function cari_produk(Request $request)
    {
        if (!empty($request->query('cari_barang'))) {
            $cari = trim(strip_tags($request->input('keyword')));
            if ($cari == '') {
            } else {
                $hasil = Produk::cariBarang($cari);
                return view('petugas.hasil_pencarian_produk', compact('hasil'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function cetak_produk()
    {
        $produk = Produk::get();
        $pdf = FacadePdf::loadview('admin.produk.cetak_pdf', ['produk' => $produk]);
        return $pdf->download('laporan-produk.pdf');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        $produk = Produk::where('id', $id)->first();

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);

        return redirect('admin/produk')->with('success', 'Data produk berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::where('id', $id)->first();
        // dd($produk);

        $produk->delete();

        return redirect('admin/produk')->with('error', 'Data produk berhasil dihapus');
    }
    public function export()
    {
        $produks = Produk::orderBy('created_at', 'asc')->get();

        return response()->json($produks);
    }
}
