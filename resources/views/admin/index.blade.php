@extends('admin.template.main')

@section('content')
    <div class="p-4" id="print">
        <h3 class="fw-semibold" style="color:#566a7f;">Dashboard</h3>
        <div class="row mt-3">
            @if ($count > 0)
                <div class='alert alert-warning'>
                    <span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>{{ $count }}</span>
                    barang yang stoknya sudah kurang dari 3 items. silahkan update stok !!
                    <span class='pull-right'><a href='{{ route('admin.produk') }}?stok=yes'>Tabel Barang <i
                                class='fa fa-angle-double-right'></i></a></span>
                </div>
            @endif
            <div class="col-3">
                <div class="bg-white rounded-3 p-3 shadow-sm" style="color: #566a7f;">
                    <div class="d-flex gap-2 align-items-center" style="font-size: 22px">
                        <i class="fa fa-user"></i>
                        <div class="fw-bold">Member</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center" style="height: 100px">
                        <h3>{{ $member }}</h3>
                    </div>
                    <hr class="m-0">
                    <div class="mt-3">
                        <a href="/admin/member">
                            Tabel Member
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="bg-white rounded-3 p-3 shadow-sm" style="color: #566a7f;">
                    <div class="d-flex gap-2 align-items-center" style="font-size: 22px">
                        <i class="fa fa-cubes"></i>
                        <div class="fw-bold">Barang</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center" style="height: 100px">
                        <h3>{{ $produk }}</h3>
                    </div>
                    <hr class="m-0">
                    <div class="mt-3">
                        <a href="/admin/produk">
                            Tabel Barang
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="bg-white rounded-3 p-3 shadow-sm" style="color: #566a7f;">
                    <div class="d-flex gap-2 align-items-center" style="font-size: 22px">
                        <i class="fas fa-chart-bar"></i>
                        <div class="fw-bold">Stok Barang</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center" style="height: 100px">
                        <h3>{{ $stok }}</h3>
                    </div>
                    <hr class="m-0">
                    <div class="mt-3">
                        <a href="/admin/produk">
                            Tabel Barang
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="bg-white rounded-3 p-3 shadow-sm" style="color: #566a7f;">
                    <div class="d-flex gap-2 align-items-center" style="font-size: 22px">
                        <i class="fas fa-upload"></i>
                        <div class="fw-bold">Terjual</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center" style="height: 100px">
                        <h3>{{ $terjual }}</h3>
                    </div>
                    <hr class="m-0">
                    <div class="mt-3">
                        <a href="/admin/laporan">
                            Tabel Laporan
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
