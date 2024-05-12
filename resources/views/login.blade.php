<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/fontawesome.min.css') }}">
    <style>
        body {
            background-color: rgb(38, 137, 236)
        }

        .icon {
            position: relative;
            top: 6px;
            margin: 0 9px;
            max-width: max-content;
        }
    </style>
</head>

<body>

    <section class="d-flex justify-content-center align-items-center" style="height: 100dvh">
        <div class="bg-white px-5 rounded-4 pt-4" style="padding-bottom:64px;">
            <div class="d-flex justify-content-center pb-2">
                <img src="{{ asset('storage/image/mage.png') }}" width="250px" height="200px">
            </div>
            <div class="w-100">
    <?php
    if(session()->has('error')) {
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}
    </div>
    <?php
    }
    ?>
                <?php
    if(session()->has('success')) {
    ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                </div>
                <?php
    }
    ?>

                <form action="{{ route('proses_login') }}" method="post">
                    @csrf
                    <div class="position-relative">
                        <input type="email" name="email" placeholder="Email" class="form-control"
                            style="padding:5px 30px;">
                        <p class="icon position-absolute" style="top:50%;transform:translateY(-50%);">
                            <i class="fa fa-envelope"></i>
                        </p>
                    </div>
                    <div class="position-relative py-4">
                        <input type="password" name="password" placeholder="Password" class="form-control"
                            style="padding:5px 30px;" required>
                        <p class="icon position-absolute" style="top:50%;transform:translateY(-50%);">
                            <i class="fa fa-user"></i>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </section>



</body>

</html>
