<!DOCTYPE html>
<html>

<head>
    <title>PDF Laporan</title>
</head>

<body>
    <style type="text/css">
        table {
            font-family: 'Arial';
        }

        .striped-table {
            border-collapse: collapse;
            width: 100%;
        }

        .striped-table th,
        .striped-table td {
            border: 1px solid #dddddd;  
            padding: 8px;
            text-align: center;
        }

        .striped-table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
    </style>

    <table class="striped-table">
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
            @php
                $no = 1;
            @endphp
            @foreach ($laporan as $l)
                <tr>
                    <td>{{ $no++ }}</td>
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

</body>

</html>
