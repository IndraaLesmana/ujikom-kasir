@extends('admin.template.main')

@section('content')
    <div class="p-4 print-none">
        <h3 class="fw-semibold" style="color:#566a7f;">Data Produk</h3>
        <div class="mt-3">
            @if ($count > 0)
                <div class='alert alert-warning'>
                    <span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>{{ $count }}</span>
                    barang yang Stok tersisa sudah kurang dari 3 items. silahkan update stok !!
                    <span class='pull-right'><a href='{{ route('admin.produk') }}?stok=yes'>Cek Barang <i
                                class='fa fa-angle-double-right'></i></a></span>
                </div>
            @endif
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProduk"><i class="fa fa-plus"></i>
                Tambah Produk</button>
            <a href="{{ route('admin.produk') }}?stok=yes" class="btn btn-warning text-white"><i class="fa fa-list"></i>
                Sortir
                Stok</a>
            <a href="{{ route('admin.produk') }}" class="btn btn-info text-white">Refresh Data</a>
            <a href="{{ route('cetak_produk') }}" class="btn btn-danger" onclick="window.print()"><i
                    class="fa fa-print"></i> EXPORT TO PDF</a>
            <button id="export-btn" class="btn btn-success"><i class="fa fa-print"></i> EXPORT TO EXEL</button>

            <div class="bg-white mt-4 rounded-1 shadow-sm">
                <div class="table-responsive p-4">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produks as $produk)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $produk->kode_produk }}</td>
                                    <td class="text-center">{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->stok }}</td>
                                    <td>{{ $produk->harga }}</td>
                                    <td class="text-center">{{ $produk->created_at }}</td>
                                    @if ($produk->stok < 3)
                                        <td>
                                            <form action="{{ route('tambah_stok', $produk->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                <input type="number" name="restok" class="form-control mb-2">
                                                <button type="submit" class="btn btn-primary btn-sm">Restok</button>
                                            </form>
                                            <form action="{{ route('admin.hapusProduk', $produk->id) }}" method="post"
                                                class="d-inline" id="hapusData{{ $produk->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-id="{{ $produk->id }}"
                                                    class="btn btn-danger btn-sm hapusData">Hapus</button>
                                            </form>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <button class="btn btn-warning" data-bs-target="#editProduk{{ $produk->id }}"
                                                data-bs-toggle="modal"><i class="fa fa-pencil-alt"></i></button>
                                            <form action="{{ route('admin.hapusProduk', $produk->id) }}" method="post"
                                                class="d-inline" id="hapusData{{ $produk->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-id="{{ $produk->id }}"
                                                    class="btn btn-danger hapusData"><i class="fa fa-trash"></i></button>
                                                {{-- <a href="{{ $produk->id }}" class="btn btn-danger btn-sm">Hapus</a> --}}
                                            </form>
                                        </td>
                                    @endif
                                </tr>


                                {{-- modal edit produk --}}
                                <div class="modal fade" id="editProduk{{ $produk->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h3 class="modal-title fs-5">Edit Produk</h3>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.updateProduk', $produk->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <label class="">Kode Produk</label>
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" value="{{ $produk->kode_produk }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <label class="">Nama Produk</label>
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" name="nama_produk"
                                                                value="{{ $produk->nama_produk }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="">Harga</label>
                                                        </div>
                                                        <div class="col">
                                                            <input type="number" name="harga"
                                                                value="{{ $produk->harga }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col">
                                                            <label class="">Stok</label>
                                                        </div>
                                                        <div class="col">
                                                            <input type="number" name="stok"
                                                                value="{{ $produk->stok }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Data</button>
                                                        <button class="btn" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none print-show">
        <div class="p-4">
            <table border="1" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->kode_produk }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->harga }}</td>
                            <td>{{ $produk->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- modal tambah produk --}}
    <div class="modal fade" id="tambahProduk">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5">Tambah Produk</h1>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.tambahProduk') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="">Kode Produk</label>
                            </div>
                            <div class="col">
                                <input type="text" name="kd_produk" value="{{ $kd_produk }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="">Nama Produk</label>
                            </div>
                            <div class="col">
                                <input type="text" name="nama_produk" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="">Harga</label>
                            </div>
                            <div class="col">
                                <input type="number" name="harga" class="form-control">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label class="">Stok</label>
                            </div>
                            <div class="col">
                                <input type="number" name="stok" class="form-control">
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

    <script>
        function getDataAndExportToExcel() {
            fetch('{{ route('export_excel_produk') }}')
                .then(response => response.json())
                .then(data => {
                    const excelData = [
                        ['No.', 'KODE PRODUK', 'NAMA PRODUK', 'STOK', 'HARGA', 'TGL INPUT']
                    ];
                    let rowNumber = 1; // urutkan dari 1

                    data.forEach(row => {
                        const tanggalInput = row.created_at.split('T')[0];
                        excelData.push([
                            rowNumber++,
                            row.kode_produk,
                            row.nama_produk,
                            row.stok,
                            row.harga,
                            tanggalInput
                        ]);
                    });

                    const ws = XLSX.utils.aoa_to_sheet(excelData);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
                    XLSX.writeFile(wb, 'data_barang.xlsx');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        document.getElementById('export-btn').addEventListener('click', getDataAndExportToExcel);
    </script>
@endsection
