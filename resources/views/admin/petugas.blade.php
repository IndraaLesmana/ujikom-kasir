@extends('admin.template.main')


@section('content')
    <div class="p-4">
        <h3 class="fw-semibold" style="color: #566a7f">Data Petugas</h3>

        <div class="mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPetugas"><i class="fa fa-plus"></i>
                Tambah Petugas</button>

            <div class="bg-white mt-4 rounded-1 shadow-sm">
                <div class="table-responsive p-4">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petugas as $tugas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $tugas->name }}</td>
                                    <td class="text-center">{{ $tugas->email }}</td>
                                    <td class="text-center">{{ $tugas->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.hapusPetugas', $tugas->id) }}" method="post"
                                            id="hapusData{{ $tugas->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-id="{{ $tugas->id }}"
                                                class="btn btn-danger hapusData"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah petugas --}}
    <div class="modal fade" id="tambahPetugas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title fs-5">Tambah Petugas</h3>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.tambahPetugas') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label>Nama</label>
                            </div>
                            <div class="col">
                                <input type="text" name="nama" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Email</label>
                            </div>
                            <div class="col">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label>Password</label>
                            </div>
                            <div class="col">
                                <input type="password" name="pw" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Tambah Data</button>
                            <button class="btn" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
