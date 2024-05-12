<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Petugas',
            'petugas' => User::cekPetugas()
        ];

        return view('admin.petugas', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'pw' => 'required'
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->pw,
            'role' => 'Petugas'
        ]);

        return redirect('admin/petugas')->with('success', 'Data petugas berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $petugas = User::where('id', $id)->first();

        $petugas->delete();
        return redirect('admin/petugas')->with('success', 'Data petugas berhasil dihapus');
    }
}
