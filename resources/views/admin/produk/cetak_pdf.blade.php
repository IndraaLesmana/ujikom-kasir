<!DOCTYPE html>
<html>

<head>
    <title>PDF Produk</title>
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
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($produk as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p->nama_produk }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ $p->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
