<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function stokBarang()
    {
        return DB::table('produks')
            ->select('produks.*', 'produks.id')
            ->where('produks.stok', '<=', 3)
            ->get();
    }


    public static function cariBarang($cari)
    {
        return DB::table('produks')
            ->select('produks.*')
            ->where('produks.kode_produk', 'like', '%' . $cari . '%')
            ->orWhere('produks.nama_produk', 'like', '%' . $cari . '%')
            ->get();
    }
}
