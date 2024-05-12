<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Requests\UpdateDetailPenjualanRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Laporan',
            'laporan' => DetailPenjualan::get()
        ];

        return view('admin.laporan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getMember(Request $request)
    {
        $kodeMember = $request->input('kode_member');

        return redirect('/petugas', $kodeMember);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bayar' => 'required',
            'kembali' => 'required',
        ]);

        DetailPenjualan::create([
            'no_nota' => $request->nota,
            'id_member' => $request->member,
            'diskon' => $request->diskon,
            'jumlah' => $request->jml,
            'subtotal' => $request->total,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembali,
        ]);

        $jumlah_dipilih = count($request->id);

        for ($x = 0; $x < $jumlah_dipilih; $x++) {
            $produk = Produk::where('kode_produk', $request->id[$x])->first();
            // dd($request->jumlah[$x]);
            if ($produk) {
                $produk->stok -= $request->jumlah[$x];
                $produk->save();
            }
        }

        DB::table('penjualans')->delete();

        return redirect('/petugas');
    }

    /**
     * Display the specified resource.
     */
    public function cetak_laporan()
    {
        $laporan = DetailPenjualan::get();
        $pdf = FacadePdf::loadview('admin.laporan.cetak_pdf', ['laporan' => $laporan]);
        return $pdf->download('laporan-laporan.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPenjualan $detailPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailPenjualanRequest $request, DetailPenjualan $detailPenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPenjualan $detailPenjualan)
    {
        //
    }
    public function export()
    {
        $laporan = DetailPenjualan::orderBy('created_at', 'asc')->get();

        return response()->json($laporan);
    }
}

