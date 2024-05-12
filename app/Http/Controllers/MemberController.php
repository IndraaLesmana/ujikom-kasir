<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::orderBy('id', 'desc')->first();

        if (!$member) {
            $format = 'MBR001';
        } else {
            $urut = substr($member->kode_member, 3);
            $tambah = $urut + 1;
            $format = 'MBR' . str_pad($tambah, 3, '0', STR_PAD_LEFT);
        }

        $data = [
            'title' => 'Member',
            'members' => Member::get(),
            'kd_member' => $format
        ];

        if (auth()->user()->role == 'Petugas') {
            return view('petugas.member', $data,);
        } else {
            return view('admin.member', $data,);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required'
        ]);

        Member::create([
            'kode_member' => $request->kd_member,
            'nama' => $request->nama,
            'no_telp' => $request->telp,
            'alamat' => $request->alamat,
            'diskon' => 5
        ]);

        if (auth()->user()->role == 'Petugas') {
            return redirect('petugas/member');
        } else {
            return redirect('admin/member');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'diskon' => 'required'
        ]);

        $member = Member::where('id', $id)->first();
        $member->update([
            'nama' => $request->nama,
            'no_telp' => $request->telp,
            'alamat' => $request->alamat,
            'diskon' => $request->diskon
        ]);

        return redirect('admin/member')->with('success', 'Data member berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::where('id', $id)->first();

        $member->delete();

        return redirect('admin/member')->with('success', 'Data member berhasil dihapus');
    }
}
