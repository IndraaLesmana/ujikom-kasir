<nav class="navbar navbar-expand-lg navbar-dark bg-primary print-none shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">KASIR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('petugas') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('petugas.transaksi') }}">Transaksi Jual</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('petugas.member') }}"
                        class="nav-link {{ Request::is('petugas/member') ? 'active' : '' }}">Member</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="photo rounded-circle" src="{{ asset('storage/image/user.png') }}">
                        <span class="me-2 d-none d-lg-inline text-gray-600 small ms-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="index.php?page=user"><i
                                    class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" onclick="logout()" id="logout">
                                @csrf
                                <button class="dropdown-item" type="button"><i
                                        class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

<script>
    function logout() {
        Swal.fire({
            title: "Are you sure?",
            text: "Untuk melakukan logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, logout it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#logout').submit();
            }
        });
    }
</script>
