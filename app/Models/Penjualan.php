<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function tambahPenjualan($id, $jumlah, $total)
    {
        // Cari penjualan berdasarkan ID
        $penjualan = Penjualan::where('kode_produk', $id)->first();

        if ($penjualan) {
            // Jika sudah ada, tambahkan jumlah dan totalnya
            $penjualan->jumlah += $jumlah;
            $penjualan->total += $total;
            $penjualan->save();
        } else {
            // Jika belum ada, buat entri baru di tabel penjualan
            Penjualan::create([
                'kode_produk' => $id,
                'harga' => $total,
                'jumlah' => $jumlah,
                'total' => $total,
            ]);
        }
    }

    public static function dataPenjualan()
    {
        return DB::table('penjualans')
            ->select('penjualans.*', 'produks.kode_produk', 'produks.nama_produk', 'produks.stok')
            ->leftJoin('produks', 'produks.kode_produk', '=', 'penjualans.kode_produk')
            ->orderBy('penjualans.id')
            ->get();
    }
}
