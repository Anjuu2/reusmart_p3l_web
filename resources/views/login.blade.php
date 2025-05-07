<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <style>
        body {
            font-family: 'Figtree', Arial, Helvetica, sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .background-animation {
            position: relative;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 1;
            transform: translate(-50%, -50%);
            object-fit: cover;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(111, 143, 70, 1);
            z-index: 2;
        }

        .bg-glass {
            background-color: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: saturate(150%) blur(30px);
            z-index: 3;
        }

        .content {
            position: relative;
            z-index: 4;
            color: white;
            text-align: center;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
</head>
<body class="antialiased">

<section class="background-animation">
    <video class="video-background" autoplay loop muted>
        <source src="{{asset("images/test.mp4")}}" type="video/mp4"> <!-- background video -->
        Your browser does not support the video tag.
    </video>

    <div class="bg-overlay"></div>
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 content">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="my-5 display-5 fw-bold">
                    Hadir Untuk Anda, Bersama Membangun Masa Depan Anda
                </h1>
            </div>
            <div class="col-lg-5 mb-5 mb-lg-0 position-relative ms-auto">
                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        <form class="form" action="{{url('/login')}}" method="POST">
                            @csrf
                            <div>
                                <h4 class="mb-3 fw-bold text-start">Selamat Datang</h4>
                            </div>

                            <div class="form-floating">
                                <input type="email" name="email" class="form-control mb-4" id="floatingInput" placeholder="Email" required />
                                <label for="floatingInput">Email</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" name="pass" class="form-control mb-4" id="floatingPassword" placeholder="Kata Sandi" required />
                                <label for="floatingPassword">Kata Sandi</label>
                            </div>

                            <button type="submit" style="width:100%;" class="btn btn-dark btn-block mb-2 mt-3">Login</button>
                            <div class="d-flex justify-content-center mt-2">
                                <a href="{{ url('register') }}" class="link-dark" style="font-size: 22px;">Buat Akun ReUseMart</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-C6RzsynM9kwDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>