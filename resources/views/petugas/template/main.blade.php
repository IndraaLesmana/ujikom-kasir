<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <script src="{{ asset('jquery/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetalert.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dataTable/css/dataTable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .photo {
            /* display: inline-block; */
            height: 30px;
            width: 30px;
            border-radius: 50%;
            vertical-align: middle;
            overflow: hidden;
            background-color: white
        }
    </style>
</head>

<body>
    <?php
    if(session()->has('success')) {
        ?>
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session()->get('success') }}",
            icon: "success"
        });
    </script>
    <?php
    }
    ?>
    <?php
    if(session()->has('error')) {
        ?>
    <script>
        Swal.fire({
            title: "Opss...",
            text: "{{ session()->get('error') }}",
            icon: "error"
        });
    </script>
    <?php
    }
    ?>
    @include('petugas.template.navbar')

    @yield('content')


    <script>
        $('.hapusData').click(function(event) {
            var idBarang = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapusData' + idBarang).submit();
                }
            });
        });
    </script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dataTable/js/dataTable.js') }}"></script>
    <script src="{{ asset('dataTable/js/dataTable.bootstrap.js') }}"></script>
    <script>
        new DataTable('#table');
    </script>
</body>

</html>
