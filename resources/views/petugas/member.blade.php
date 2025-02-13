@extends('petugas.template.main')

@section('content')
    <div class="p-4">
        <h3 class="fw-semibold" style="color:#566a7f;">Data Member</h3>
        <div class="mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMember"><i class="fa fa-plus"></i>
                Tambah Member</button>

            <div class="card mt-4 rounded-1 shadow-sm">
                <div class="table-responsive p-4">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Member</th>
                                <th>Nama</th>
                                <th>No Telephone</th>
                                <th>Alamat</th>
                                <th>Diskon</th>
                                <th>Tanggal Input</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $member->kode_member }}</td>
                                    <td class="text-center">{{ $member->nama }}</td>
                                    <td>{{ $member->no_telp }}</td>
                                    <td class="text-center">{{ $member->alamat }}</td>
                                    <td class="text-center">{{ $member->diskon }}%</td>
                                    <td class="text-center">{{ $member->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah member --}}'
    <div class="modal fade" id="tambahMember">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title fs-5">Tambah Member</h3>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.tambahMember') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label>Kode Member</label>
                            </div>
                            <div class="col">
                                <input type="text" name="kd_member" value="{{ $kd_member }}" class="form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label>Nama</label>
                            </div>
                            <div class="col">
                                <input type="text" name="nama" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>No Telephone</label>
                            </div>
                            <div class="col">
                                <input type="number" name="telp" class="form-control">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label>Alamat</label>
                            </div>
                            <div class="col">
                                <textarea name="alamat" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                                Data</button>
                            <button class="btn" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
