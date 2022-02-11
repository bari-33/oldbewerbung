
<!doctype html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: Login ::</title>
    <link type="text/css" rel="stylesheet" href="{{asset('public/login_new/style.css')}}">
     <link rel="shortcut icon" href="{!! asset('public/img/logo/logo.png') !!}">
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" defer></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js" defer></script>
<![endif]-->
</head>
<body class="login">
    <form   method="POST" action="{{ route('login') }}" >
         @csrf
         <section class="login_block">
            <div class="row">
                <div class="col-sm-5">
                    <div class="loginSide">
                        <a href="javascript:void(0)">
                            <img src="{{asset('public/login_new/logo.png')}}" alt="Logo">
                        </a>
                        <div class="login-form">
                            <h3>Login</h3>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <svg viewBox="0 0 18 18"><path d="M8.643,11.497c-1.427,0-2.497-1.158-2.497-2.497c0-1.335,1.07-2.497,2.405-2.497 c1.123,0,2.18,0.753,2.494,1.838c0.002,0.006,0.002,0.015,0.002,0.023V9.68c0,0.006,0,0.015-0.002,0.021 C10.762,10.762,9.825,11.497,8.643,11.497z M9,1.87C5.079,1.87,1.87,5.079,1.87,9S5.079,16.13,9,16.13 c0.491,0,0.984-0.041,1.445-0.156c0.336-0.083,0.537-0.429,0.443-0.766l-0.037-0.13c-0.082-0.293-0.381-0.473-0.678-0.408 C9.804,14.753,9.422,14.791,9,14.791c-3.209,0-5.794-2.585-5.794-5.794S5.88,3.294,9.089,3.294c3.208,0,5.794,2.585,5.794,5.794 c0,1.066-0.355,2.134-0.889,3.025c-0.004,0.003-0.006,0.006-0.01,0.013c-0.041,0.05-0.393,0.439-0.975,0.439 c-0.266,0-0.447-0.178-0.447-0.178c-0.176-0.177-0.176-0.534-0.176-0.711V5.995c0-0.311-0.252-0.562-0.563-0.562h-0.158 c-0.34,0-0.619,0.275-0.619,0.618c0,0.065-0.076,0.104-0.127,0.062c-0.646-0.535-1.474-0.857-2.366-0.857 C6.503,5.256,4.81,6.949,4.81,9s1.693,3.744,3.744,3.744c0.884,0,1.714-0.313,2.37-0.836c0.051-0.039,0.123-0.01,0.127,0.056 c0.023,0.363,0.129,0.913,0.531,1.315c0.266,0.266,0.713,0.534,1.428,0.534c1.07,0,1.781-0.624,2.051-1.069 c0.711-1.07,1.068-2.405,1.068-3.744C16.129,5.079,12.92,1.87,9,1.87z"/></svg>
                                </span>
                                <input placeholder="E-mail" id="email" type="email" class="form-control" name="email" value="" required autofocus>


                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <svg viewBox="0 0 18 18"><path d="M13.821,15.261H4.175v-6.81h9.646V15.261z M5.84,5.646c0-1.604,1.415-2.907,3.157-2.907 c1.741,0,3.156,1.304,3.156,2.907v1.548H5.84V5.646z M14.111,7.2h-0.599V5.648c0-2.294-2.025-4.161-4.516-4.161 c-2.491,0-4.516,1.867-4.516,4.158v1.551H3.885c-0.589,0-1.068,0.442-1.068,0.984v7.348c0,0.542,0.479,0.984,1.068,0.984h10.229 c0.59,0,1.069-0.442,1.069-0.984V8.181C15.181,7.642,14.7,7.2,14.111,7.2z"/><path d="M8.997,14.326c0.376,0,0.679-0.279,0.679-0.626v-1.612c0-0.347-0.303-0.626-0.679-0.626 c-0.377,0-0.68,0.279-0.68,0.626V13.7C8.317,14.044,8.62,14.326,8.997,14.326z"/></svg>
                                </span>
                                <input placeholder="password" id="password" type="password" class="form-control" name="password" required>


                            </div>
                            <div class="form-group">
                                 <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                           <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>


                            </div>
                        </div>
                        <div class="loginContent text-center">
                            <p>Bist Du noch kein Kunde?</p>
                            <a href="{{ url('orders') }}">Jetzt Kunde werden</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="rightBlock">
                        <div class="contentSide">
                            <div class="innerSide">
                                <h2>Herzlich willkommen</h2>
                                <span class="h2">bei Bewerbung.one</span>
                                <span class="h5">Melde dich an, um auf Dein Konto zuzugreigen</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/Login_Block-->
    </form>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('public/login_new/custom.js')}}"></script>
</body>
</html>
