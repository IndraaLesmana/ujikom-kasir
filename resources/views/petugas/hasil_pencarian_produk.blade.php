<table class="table table-striped" width="100%">
    <tr>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    <tr>
        @foreach ($hasil as $h)
            <td>{{ $h->kode_produk }}</td>
            <td>{{ $h->nama_produk }}</td>
            <td>{{ $h->harga }}</td>
            <td>
                <a href="{{ route('jual') }}?jual=jual&id={{ $h->kode_produk }}" class="btn btn-success">
                    <i class="fa fa-shopping-cart"></i>
                </a>
            </td>
        @endforeach
    </tr>

</table>
