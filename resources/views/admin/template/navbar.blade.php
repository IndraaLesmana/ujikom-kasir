<nav class="navbar navbar-expand-lg navbar-dark bg-white rounded-2 shadow-sm print-none"
    style="margin:15px 25px 0px 25px;">
    <div class="container-fluid justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img class="photo rounded-circle" src="{{ asset('storage/image/user.png') }}">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="index.php?page=user"><i
                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" id="logout" onclick="logout()">
                            @csrf
                            <button class="dropdown-item" type="button"><i
                                    class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
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
