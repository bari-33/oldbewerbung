<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/ubold/layouts/purple/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Aug 2019 05:52:12 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Bewerbung.one</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{!! asset('public/img/logo/logo.png') !!}">

        <!-- App css -->
        <link  href="{!! asset('public/theme/assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('public/theme/assets/css/icons.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('public/theme/assets/css/app.min.css') !!}" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <a href="{{url('login')}}">
                                        <span><img src="{!! asset('public/img/logo/logo.png') !!}" alt="" style="width:67%;"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your email address to reset password.</p>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">{{ __('E-Mail Address') }}</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="emailaddress" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                       {{-- <a class="btn btn-link" href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                        --}}
                                    </div>

                                </form>



                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                     {{--   <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="pages-recoverpw.html" class="text-white-50 ml-1">Forgot your password?</a></p>
                                <p class="text-white-50">Don't have an account? <a href="pages-register.html" class="text-white ml-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div> --}}
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->



        <!-- Vendor js -->
        <script  src="{!! asset('public/theme/assets/js/vendor.min.js') !!}"></script>

        <!-- App js -->
        <script src="{!! asset('public/theme/assets/js/app.min.js') !!}"></script>

    </body>

<!-- Mirrored from coderthemes.com/ubold/layouts/purple/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Aug 2019 05:52:12 GMT -->
</html>
