<?php

use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\DetailPenjualan;
use App\Models\Member;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('login');
    Route::post('/proses-login', [UserController::class, 'proses_login'])->name('proses_login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            $rows = Produk::where('stok', '<=', 3)->get();
            $data = [
                'title' => 'Dashboard',
                'count' => $rows->count(),
                'produk' => Produk::count(),
                'stok' => Produk::sum('stok'),
                'member' => Member::count(),
                'terjual' => DetailPenjualan::count()
            ];

            return view('admin.index', $data);
        })->name('admin.dashboard');

        Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk');
        Route::post('/produk', [ProdukController::class, 'store'])->name('admin.tambahProduk');
        Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.hapusProduk');
        Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('admin.updateProduk');


        Route::delete('/hapus_data/{id}', [PenjualanController::class, 'destroy'])->name('admin.hapusData');
        Route::post('/stok/{id}', [ProdukController::class, 'tambahStok'])->name('tambah_stok');
        Route::post('/cari_produk', [ProdukController::class, 'cari_produk'])->name('cari_produk');
        Route::get('/jual', [PenjualanController::class, 'jual'])->name('jual');
        Route::get('/cetak_produk', [ProdukController::class, 'cetak_produk'])->name('cetak_produk');
        Route::get('/cetak_laporan', [DetailPenjualanController::class, 'cetak_laporan'])->name('cetak_laporan');
        Route::post('/cari_member', [DetailPenjualanController::class, 'getMember'])->name('cari_member');
        Route::post('/updateHarga', [PenjualanController::class, 'updateHarga'])->name('updateHarga');
        Route::get('/export_excel_produk', [ProdukController::class, 'export'])->name('export_excel_produk');
        Route::get('/export_excel_laporan', [DetailPenjualanController::class, 'export'])->name('export_excel_laporan');

        Route::get('/member', [MemberController::class, 'index'])->name('admin.member');
        Route::post('/member', [MemberController::class, 'store'])->name('admin.tambahMember');
        Route::delete('/member/{id}', [MemberController::class, 'destroy'])->name('admin.hapusMember');
        Route::put('/member/{id}', [MemberController::class, 'update'])->name('admin.updateMember');

        Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas');
        Route::post('/petugas', [PetugasController::class, 'store'])->name('admin.tambahPetugas');
        Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('admin.hapusPetugas');

        Route::get('/laporan', [DetailPenjualanController::class, 'index'])->name('admin.laporan');
    });

    Route::prefix('petugas')->group(function () {
        Route::get('/', [PenjualanController::class, 'index'])->name('petugas.transaksi');
        Route::get('/member', [MemberController::class, 'index'])->name('petugas.member');

        Route::post('/tambah-data', [DetailPenjualanController::class, 'store'])->name('tambah_data');
    });
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
