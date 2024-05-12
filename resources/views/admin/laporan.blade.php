@extends('admin.template.main')


@section('content')
    <div class="p-4 print-none">
        <h3 class="fw-semibold" style="color: #566a7f">Data Laporan</h3>

        <div class="mt-3">
            <a href="{{ route('cetak_laporan') }}" class="btn btn-danger" onclick="window.print()"><i class="fa fa-print"></i>
                EXPORT TO PDF</a>
                <button id="export-btn" class="btn btn-success"><i class="fa fa-print"></i> EXPORT TO EXEL</button>

            <div class="bg-white mt-4 rounded-1 shadow-sm">
                <div class="table-responsive p-4">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Nota</th>
                                <th>Kode Member</th>
                                <th>Diskon</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Bayar</th>
                                <th>Kembali</th>
                                <th>Tanggal Input</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $lapor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $lapor->no_nota }}</td>
                                    <td class="text-center">{{ $lapor->id_member }}</td>
                                    <td class="text-center">{{ $lapor->diskon }}</td>
                                    <td class="text-center">{{ $lapor->jumlah }}</td>
                                    <td class="text-center">{{ $lapor->subtotal }}</td>
                                    <td class="text-center">{{ $lapor->bayar }}</td>
                                    <td class="text-center">{{ $lapor->kembalian }}</td>
                                    <td class="text-center">{{ $lapor->created_at }}</td>
                                </tr>
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
                        <th>No Nota</th>
                        <th>Kode Member</th>
                        <th>Diskon</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Bayar</th>
                        <th>Kembali</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $l)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $l->no_nota }}</td>
                            <td>{{ $l->id_member }}</td>
                            <td>{{ $l->diskon }}</td>
                            <td>{{ $l->jumlah }}</td>
                            <td>{{ $l->subtotal }}</td>
                            <td>{{ $l->bayar }}</td>
                            <td>{{ $l->kembalian }}</td>
                            <td>{{ $l->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function getDataAndExportToExcel() {
            fetch('{{ route('export_excel_laporan') }}')
                .then(response => response.json())
                .then(data => {
                    const excelData = [
                        ['No.', 'NO NOTA', 'KODE MEMBER', 'DISKON', 'JUMLAH', 'SUBTOTAL', 'BAYAR', 'KEMABLIAN', 'TGL INPUT']
                    ];
                    let rowNumber = 1; // urutkan dari 1

                    data.forEach(row => {
                        const tanggalInput = row.created_at.split('T')[0];
                        excelData.push([
                            rowNumber++,
                            row.no_nota,
                            row.id_member,
                            row.diskon,
                            row.jumlah,
                            row.subtotal,
                            row.bayar,
                            row.kembalian,
                            tanggalInput
                        ]);
                    });

                    const ws = XLSX.utils.aoa_to_sheet(excelData);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
                    XLSX.writeFile(wb, 'data_laporan.xlsx');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        document.getElementById('export-btn').addEventListener('click', getDataAndExportToExcel);
    </script>
@endsection
