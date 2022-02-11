<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/ubold/layouts/purple/pages-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Aug 2019 05:52:12 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Bewerbung.one</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Bewerbung.one" name="description" />
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
                                    <a href="{{url('/')}}">
                                        <span><img src="{!! asset('public/img/logo/logo.png') !!}" alt="" style="width:67%;"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less than a minute</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">User Name</label>
                                        <input class="form-control @error('username') is-invalid @enderror" type="text" id="username" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fullname">{{ __('Name') }}</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" placeholder="Enter your name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">{{ __('E-Mail Address') }}</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" placeholder="Enter your password" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" placeholder="Re-Enter your password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label for="role">User Role</label>
                                        <select id="role" class="form-control" name="role" required>
                                            @foreach($roles as $id => $role)

                                                <option value="{{$id}}">{{$role}}</option>
                                                    @endforeach
                                        </select>

                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                              <strong>{{ $errors->first('role') }}</strong>
                                          </span>
                                        @endif

                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" type="submit"> Sign Up </button>
                                    </div>

                                </form>


                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="{{route('login')}}" class="text-white ml-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2015 - 2019 &copy; Bewerbung.one
        </footer>

        <!-- Vendor js -->
        <script  src="{!! asset('public/theme/assets/js/vendor.min.js') !!}"></script>

        <!-- App js -->
        <script src="{!! asset('public/theme/assets/js/app.min.js') !!}"></script>

    </body>

<!-- Mirrored from coderthemes.com/ubold/layouts/purple/pages-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Aug 2019 05:52:12 GMT -->
</html>