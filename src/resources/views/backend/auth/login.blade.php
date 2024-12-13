<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ env('APP_URL') }}">
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('backend/img/logo.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/bootstrap-icons/bootstrap-icons.css') }}?v={{ time() }}"
        rel="stylesheet">
    <link href="{{ asset('backend/vendor/boxicons/css/boxicons.min.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/quill/quill.snow.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/quill/quill.bubble.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/remixicon/remixicon.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/simple-datatables/style.css') }}?v={{ time() }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('backend/css/style.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom.css') }}?v={{ time() }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-4">
                                        <h5 class="card-title text-center pb-0 fs-4">Đăng nhập</h5>
                                    </div>

                                    <form class="row g-3" method="POST" action="{{ route('auth.login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-outline has-validation mb-3">
                                                <input type="text"
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    name="email" id="email" placeholder="email"
                                                    value="{{ old('email') }}">
                                                <label for="email" class="form-label">Email</label>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-outline has-validation">
                                                <input type="password"
                                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                    name="password" id="password" value=""
                                                    placeholder="Mật khẩu">
                                                <label for="password" class="form-label">Mật khẩu</label>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="col-12">
                                            <a href="#">Quên mật khẩu?</a>
                                        </div> --}}
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('backend/vendor/apexcharts/apexcharts.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('backend/vendor/chart.js/chart.umd.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('backend/vendor/echarts/echarts.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('backend/vendor/quill/quill.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('backend/vendor/simple-datatables/simple-datatables.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('backend/vendor/php-email-form/validate.js') }}?v={{ time() }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('backend/js/main.js') }}?v={{ time() }}"></script>

</body>

</html>
