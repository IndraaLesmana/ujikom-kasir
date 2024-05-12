<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\DetailPenjualan;
use App\Models\Member;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::get();
        $title = 'Transaksi Penjualan';
        $produk = Produk::get();
        $totalHarga = $penjualan->sum('total');
        $members = Member::get();
        $penjualans = Penjualan::dataPenjualan();


        //buat no nota
        // $kodenota = DetailPenjualan::max('no_nota');
        $urutan = rand(1, 999);

        $huruf = "AD";
        $tgl = date("jnyGi");

        $noNota = $huruf . $tgl . sprintf("%03s", $urutan);
        $produks = $rows = Produk::where('stok', '>=', 1)->get();;


        return view('petugas.index', compact('penjualan', 'title', 'produk', 'produks', 'penjualans', 'totalHarga', 'members', 'noNota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function jual(Request $request)
    {
        if (!empty($request->query('jual'))) {
            $id = $request->query('id');

            $produk = Produk::where('kode_produk', $id)->first();
            $penjualan = Penjualan::where('kode_produk', $id)->first();
            if ($penjualan == null) {
                if ($produk->stok > 0) {
                    $jumlah = 1;
                    $total = $produk->harga;

                    Penjualan::tambahPenjualan($id, $jumlah, $total);

                    return redirect('/petugas');
                } else {
                    return redirect('/petugas');
                }
            } else {
                if ($penjualan->jumlah >= $produk->stok) {
                    return redirect('/petugas')->with('error', 'Jumlah melebihi stok yang tersedia!');
                } else {
                    if ($produk->stok > 0) {
                        $jumlah = 1;
                        $total = $produk->harga;

                        Penjualan::tambahPenjualan($id, $jumlah, $total);

                        return redirect('/petugas');
                    } else {
                        return redirect('/petugas');
                    }
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenjualanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function updateHarga(Request $request)
    {
        $penjualan = Penjualan::find($request->penjualan_id);


        $penjualan->jumlah = $request->jumlah;
        $penjualan->total = $request->jumlah * $penjualan->harga; // Misalnya harga ada dalam tabel Penjualan
        $penjualan->save();

        $totalHarga = Penjualan::sum('total');

        return response()->json(
            [
                'success' => true,
                'penjualan' => $penjualan, // Mengirim objek penjualan yang telah diperbarui
                'totalHarga' => $totalHarga,
            ],
            200,
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();

        $penjualan->delete();

        return redirect('/petugas')->with('success', 'Data berhasil dihapus');
    }
}
