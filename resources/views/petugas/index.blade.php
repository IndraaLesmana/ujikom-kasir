@extends('petugas/template/main')

@section('content')
    <main class="p-3" id="print">
        <div class="container-fluid py-2 print-none">
            <h2 class="pb-3" style="color: #566a7f;">Transaksi Penjualan</h2>
            <div class="row">
                <div class="col-4">
                    <div class="card card-primary mb-3">
                        <div class="card-header bg-primary text-white">
                            <h5>
                                <i class="fa fa-search"></i>
                                <p class="d-inline">Cari Barang</p>
                            </h5>
                        </div>
                        <div class="p-3">
                            <input type="text" id="cari" name="cari" list="data" class="form-control"
                                placeholder="Pilih barang">
                            <datalist id="data">
                                @foreach ($produks as $p)
                                    <option value="<?= $p->kode_produk ?>"><?= $p->nama_produk ?></option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-primary mb-3">
                        <div class="card-header bg-primary text-white">
                            <h5>
                                <i class="fa fa-list"></i>
                                <p class="d-inline">Hasil Pencarian</p>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="hasil_cari"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary pb-5">
                <div class="card-header bg-primary text-white">
                    <h5>
                        <i class="fa fa-shopping-cart"></i>
                        <p class="d-inline">Kasir</p>
                    </h5>
                </div>
                <div class="p-4">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="float: left; width:100%;">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualans as $penjualan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $penjualan->nama_produk }}</td>
                                        <td class="text-center">{{ $penjualan->harga }}</td>
                                        <td class="text-center">{{ $penjualan->stok }}</td>
                                        <td class="d-flex justify-content-center">
                                            <input type="number" name="qty" style="width: 80px"
                                                class="form-control input-number" value="{{ $penjualan->jumlah }}"
                                                data-penjualan-id="{{ $penjualan->id }}"
                                                data-kode-brg="{{ $penjualan->kode_produk }}"
                                                data-harga="{{ $penjualan->harga }}" data-target="#qty{{ $penjualan->id }}"
                                                data-jml="#jml{{ $penjualan->id }}">
                                        </td>
                                        <td class="text-center"><span
                                                class="total">Rp.{{ number_format($penjualan->jumlah * $penjualan->harga) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.hapusData', $penjualan->id) }}" method="post"
                                                id="hapusData{{ $penjualan->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger hapusData" data-id="{{ $penjualan->id }}"
                                                    type="button">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="bg-primary text-white rounded-1">
                        <h1 id="total-harga" class="p-3">
                            Rp.{{ number_format($totalHarga) }}
                        </h1>
                        <input type="hidden" id="total" value="{{ $totalHarga }}">
                        <input type="hidden" name="totalSetelahDiskon" id="totalSetelahDiskon" class="form-control"
                            readonly="readonly">
                    </div>
                    <div class="mt-4">
                        @foreach ($produk as $p)
                            <input type="hidden" class="form-control form-control-sm bg-white stok"
                                id="stok{{ $p->kode_produk }}" value="{{ $p->stok }}" readonly>
                        @endforeach
                        <form action="{{ route('tambah_data') }}" method="post">
                            @csrf
                            @foreach ($penjualans as $penjualan)
                                <input type="hidden" class="form-control form-control-sm bg-white" name="id[]"
                                    value="{{ $penjualan->kode_produk }}" readonly>
                                <input type="hidden" name="jumlah[]" id="jml{{ $penjualan->id }}"
                                    value="{{ $penjualan->jumlah }}">
                            @endforeach
                            <input type="hidden" name="total" id="totalDanDiskon" value="{{ $totalHarga }}">
                            <input type="hidden" id="totalQty" name="jml">
                            <input type="hidden" name="nota" value="{{ $noNota }}">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Member</label>
                                    <input type="text" list="member" name="member" class="form-control"
                                        placeholder="Pilih Member" id="pilihMember">
                                    <datalist id="member">
                                        @foreach ($members as $member)
                                            <option data-diskon="{{ $member->diskon }}"
                                                value="{{ $member->kode_member }}">{{ $member->nama }}</option>
                                        @endforeach
                                    </datalist>
                                </div>

                                <div class="col-md inputDiskon">
                                    <label class="form-label">Diskon</label>
                                    <input type="text" name="diskon" id="diskon" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Bayar</label>
                                    <input type="number" name="bayar" id="bayar" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Pembayaran kurang dari total harga.
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Kembali</label>
                                    <input type="number" name="kembali" id="kembali" class="form-control" required>
                                </div>
                            </div>
                            <div class="pt-3" id="printButton">
                                <button type="submit" class="btn btn-secondary float-end" onclick="window.print()"><i
                                        class="fa fa-print"></i> Cetak
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-none pt-5 px-4 print-show">
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <h1 style="font-size:50px;font-weight:700;">MEKASIR</h1>
                    <h5 class="mb-0">Cikambuy Tengah</h5>
                    <h5 class="mb-2">Tel : 0988237423</h5>
                </div>
                <div class="col-7">
                    <h5 class="mb-0" style="text-transform: uppercase;">INVOICE : {{ $noNota }}</h5>
                    <h5 class="mb-0" style="text-transform: uppercase;">KASIR : {{ Auth::user()->role }}</h5>
                </div>
                <div class="col-5">
                    <h5 class="mb-0" style="text-transform: uppercase;">TANGGAL : {{ date('d-m-Y') }}</h5>
                    <h5 class="mb-0" style="text-transform: uppercase;">PUKUL : <span id="jam"></span></h5>
                </div>
                <div class="col-12 bg-secondary border my-3"></div>
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-1 text-center">
                            <h5 style="font-weight:700;">QTY</h5>
                        </div>
                        <div class="col">
                            <h5 style="font-weight:700;">PRODUK</h5>
                        </div>
                        <div class="col text-center">
                            <h5 style="font-weight:700;">HARGA</h5>
                        </div>
                        <div class="col text-end">
                            <h5 style="font-weight:700;">SUBTOTAL</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    @foreach ($penjualans as $penjualan)
                        <div class="row">
                            <div class="col-1 text-center">
                                <h4 id="qty{{ $penjualan->id }}">{{ $penjualan->jumlah }}</h4>
                            </div>
                            <div class="col">
                                <h4>{{ $penjualan->nama_produk }}</h4>
                            </div>
                            <div class="col text-center">
                                <h4>Rp.{{ number_format($penjualan->harga) }}</h4>
                            </div>
                            <div class="col text-end">
                                <h4 id="subtotal{{ $penjualan->id }}">Rp.{{ number_format($penjualan->total) }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 bg-secondary border my-3"></div>
                <div class="col-12">
                    <div class="row" id="cekMember">
                        <div class="col">
                            <h4>Total Belanja</h4>
                            <h4>Bayar</h4>
                            <h4>Kembalian</h4>
                        </div>
                        <div class="col text-end">
                            <h4><span id="totalBelanja">Rp.{{ number_format($totalHarga) }}</span></h4>
                            <h4><span id="pembayaran"></span></h4>
                            <h4><span id="kembalian"></span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-12 bg-secondary border my-3"></div>
                <div class="col-12 text-center">
                    <h3>* Terima Kasih Telah Berbelanja Di Toko Kami *</h3>
                </div>
            </div>
        </div>
    </main>


    <script>
        $(document).ready(function() {
            $("#pilihMember").change(function() {
                var member = $(this).val();
                if (member == '') {
                    $('#diskon').val('')
                }
                var cekMember = $('#cekMember');
                if (member === '') {
                    cekMember.html(`
                <div class="col">
                    <h4>Total Belanja</h4>
                    <h4>Bayar</h4>
                    <h4>Kembalian</h4>
                </div>
                <div class="col text-end">
                    <h4><span id="totalBelanja">Rp.{{ number_format($totalHarga) }}</span></h4>
                    <h4><span id="pembayaran"></span></h4>
                    <h4><span id="kembalian"></span></h4>
                </div>`);
                } else {

                    if (member) {
                        cekMember.html(`
                <div class="col">
                    <h4>Total Belanja</h4>
                    <h4>Diskon</h4>
                    <h4>Total</h4>
                    <h4>Bayar</h4>
                    <h4>Kembalian</h4>
                </div>
                <div class="col text-end">
                    <h4><span id="totalBelanja">Rp.{{ number_format($totalHarga) }}</span></h4>
                    <h4><span id="dapatDiskon"></span></h4>
                    <h4><span id="totalDiskon"></span></h4>
                    <h4><span id="pembayaran"></span></h4>
                    <h4><span id="kembalian"></span></h4>
                </div>`);
                    }
                }
            });
        });


        // validasi stok jumlah
        $('input[name="qty"]').on('input', function() {
            var newValue = $(this).val();
            var kodeBrg = $(this).data('kode-brg');
            var stok = parseInt($('#stok' + kodeBrg).val());

            if (newValue > stok) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Jumlah melebihi stok yang tersedia!",
                });
                $(this).val(stok);
            }
        });

        // data jumlah di table ke input
        $('input[name="qty"]').on('change', function() {
            // Mendapatkan nilai baru dari input jumlah (qty)
            var newValue = $(this).val();

            // Mendapatkan data yang terkait dari atribut data
            var penjualanId = $(this).data('penjualan-id');
            var targetInput = $(this).data('jml');

            // Memperbarui nilai dari input jumlah (jml)
            $(targetInput).val(newValue);
        });

        // stok di print
        function handleInputChange(input) {
            var targetId = $(input).data('target');
            var targetElement = $(targetId);
            targetElement.text(input.value);
        }

        var inputs = $('input[data-target]');

        inputs.each(function() {
            $(this).on('input', function() {
                handleInputChange(this);
            });

            handleInputChange(this);
        });

        // menyatukan semua jumlah barang
        $(document).ready(function() {
            $('input.input-number').on('change', function() {
                var totalQty = 0;
                $('input.input-number').each(function() {
                    totalQty += parseFloat($(this).val()) || 0;
                });
                $('#totalQty').val(totalQty);
                $('#qty').val(totalQty)
            }).change();
        });

        // jam
        timer();

        function timer() {
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            document.getElementById('jam').innerHTML = time;
        }

        //print
        $(document).ready(function() {
            $('#printButton').hide();

            $('#bayar').change(function() {
                if ($('#kembali').val() === "") {
                    $('#printButton').hide();
                } else if ($('#total').val() === "0") {
                    $('#printButton').hide();
                } else {
                    $('#printButton').show();
                }

                if ($('#bayar').val() === "") {
                    $('#kembali').val("");

                }
            });
        });

        // validasi kembalian
        $(document).ready(function() {
            $('#kembali').on('input', function() {
                if ($(this).val() === "") {
                    $(this).prop('required', true);
                    $(this).prop('readonly', false);
                } else {
                    $(this).prop('required', false);
                    $(this).prop('readonly', true);
                }
            });
        });


        //cari barang
        $(document).ready(function() {
            $("#cari").change(function() {
                var keyword = $(this).val(); // Ambil nilai yang dipilih dari dropdown
                $.ajax({
                    type: "POST",
                    url: "{{ route('cari_produk') }}?cari_barang=yes", // Menggunakan rute Laravel dengan query string
                    data: {
                        "_token": "{{ csrf_token() }}", // Token CSRF
                        "keyword": keyword, // Data pencarian
                    },
                    beforeSend: function() {
                        $("#hasil_cari").hide();
                    },
                    success: function(html) {
                        $("#hasil_cari").show();
                        $("#hasil_cari").html(html);
                    }
                });
            });
        });


        // update otomatis harga
        $(document).ready(function() {
            // Fungsi untuk menangani perubahan input number
            function handleInputNumberChange(inputElement) {
                var jumlah = $(inputElement).val();
                var penjualan_id = $(inputElement).data('penjualan-id');
                var harga = $(this).data('harga');
                var stok = parseInt($('.stok').val());

                // Validasi jumlah
                if (jumlah == '') {
                    return;
                }
                if (jumlah < 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jumlah tidak boleh kurang dari 1'
                    });
                    $(inputElement).val(1);
                    return;
                } else if (jumlah >= 1000) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jumlah tidak boleh lebih dari 1000'
                    });
                    $(inputElement).val(stok);
                    return;
                }


                $.ajax({
                    url: "{{ route('updateHarga') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        jumlah: jumlah,
                        penjualan_id: penjualan_id
                    },
                    success: function(response) {
                        if (response.success) {
                            // Mengambil total harga dari respons
                            var totalHarga = response.totalHarga;

                            // Memperbarui tampilan jumlah dan total pada halaman tanpa memuat ulang
                            $(inputElement).closest('tr').find('.total').text("Rp." + response
                                .penjualan
                                .total.toLocaleString());
                            $('#subtotal' + penjualan_id).text("Rp." + response.penjualan
                                .total.toLocaleString());
                            // Memperbarui total harga pada elemen HTML
                            $('#total-harga').text('Rp.' + number_format(totalHarga));
                            $('#total').val(totalHarga);
                            $('#totalBelanja').text('Rp.' + number_format(totalHarga));
                            $('#totalDanDiskon').val(totalHarga);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            }
            // Tambahkan event listener pada setiap input number yang baru ditambahkan
            $(document).on('input', '.input-number', function() {
                handleInputNumberChange(this);
            });
        });



        // diskon
        $(document).ready(function() {
            var diskon;

            $('#pilihMember').on('change', function() {
                var selectedOption = $('option[value="' + $(this).val() + '"]');
                diskon = selectedOption.data('diskon');
            });

            $('#bayar').on('input', function() {
                var totalHarga = parseFloat($('#total').val());
                var amountPaid = parseFloat($(this).val());
                var selectedMember = $('#pilihMember').val();

                // Cek jika total harga melebihi 50000 dan member dipilih
                if (totalHarga > 50000 && selectedMember) {
                    var totalSetelahDiskon = totalHarga * (1 - diskon / 100);

                    // Tampilkan diskon dan total setelah diskon
                    $('#diskon').val(diskon);
                    $('#dapatDiskon').text(diskon + '%');

                    // Update harga yang ditampilkan menjadi harga yang sudah didiskon
                    $('#total-harga').html("Rp." + number_format(totalSetelahDiskon));
                    $('#totalSetelahDiskon').val(totalSetelahDiskon);
                    $('#totalDiskon').text('Rp.' + totalSetelahDiskon.toLocaleString());
                    $('#totalDanDiskon').val(totalSetelahDiskon);

                    // Bayar sesuai dengan total setelah diskon
                    totalHarga = totalSetelahDiskon;
                } else {
                    $('#total-harga').html("Rp." + number_format(totalHarga));
                    $('#totalDanDiskon').val(totalHarga);
                }

                // Hitung kembalian
                var change = amountPaid - totalHarga;
                if (change >= 0) {
                    $('#kembali').val(change);
                    $('#bayar').removeClass('is-invalid');
                } else if ($('#bayar').val() == '') {
                    $('#bayar').removeClass('is-invalid');

                } else {
                    $('#kembali').val('');
                    $('#bayar').addClass('is-invalid');
                }

                $('#pembayaran').text('Rp.' + amountPaid.toLocaleString())
                $('#kembalian').text('Rp.' + change.toLocaleString())
            });

            $('#pilihMember').change(function() {
                // Panggil event handler input bayar untuk memperbarui diskon dan total setelah diskon
                $('#bayar').trigger('input');
            });
        });

        function number_format(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection
