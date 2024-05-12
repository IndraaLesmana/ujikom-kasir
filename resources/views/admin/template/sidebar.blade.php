<aside class="bg-white position-fixed shadow-sm" style="width:260px;top:0;bottom:0;">
    <div style="height:64px;" class="d-flex align-items-center px-5">
        <a href="" class="fs-4 fw-bold" style="color:#566a7f;">
            Aplikas Kasir
        </a>
    </div>
    <ul class="ps-0 d-flex flex-column" style="gap:2px;">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="links {{ Request::is('admin') ? 'active' : '' }} d-flex align-items-center mx-3 rounded-2"
                style="gap:10px;padding:10px 16px;">
                <i class="fa fa-home"></i>
                <div class="fw-semibold">Dashboard</div>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.produk') }}"
                class="links {{ Request::is('admin/produk') ? 'active' : '' }} d-flex align-items-center mx-3 rounded-2"
                style="gap:10px;padding:10px 16px;">
                <i class="fa fa-box"></i>
                <div class="fw-semibold">Produk</div>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.member') }}"
                class="links {{ Request::is('admin/member') ? 'active' : '' }} d-flex align-items-center mx-3 rounded-2"
                style="gap:10px;padding:10px 16px;">
                <i class="fa fa-user-alt"></i>
                <div class="fw-semibold">Member</div>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.petugas') }}"
                class="links {{ Request::is('admin/petugas') ? 'active' : '' }} d-flex align-items-center mx-3 rounded-2"
                style="gap:10px;padding:10px 16px;">
                <i class="fa fa-user"></i>
                <div class="fw-semibold">Petugas</div>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.laporan') }}"
                class="links {{ Request::is('admin/laporan') ? 'active' : '' }} d-flex align-items-center mx-3 rounded-2"
                style="gap:10px;padding:10px 16px;">
                <i class="fa fa-file-alt"></i>
                <div class="fw-semibold">Laporan</div>
            </a>
        </li>
    </ul>
</aside>
