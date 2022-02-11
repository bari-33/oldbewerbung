<html>
<head>
    <meta charset="utf-8" />
    <title>Bewerbung.one</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bewerbung.one" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{!! asset('public/img/logo/logo.png') !!}">

    <!-- Plugins css -->
    <link href="{!! asset('public/theme/assets/libs/flatpickr/flatpickr.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{!! asset('public/theme/assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/icons.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/app.min.css') !!}" rel="stylesheet" type="text/css" />

    <style>
        .bg-bdy{
            background: url('{!! asset('public/img/logo/login-bg-01.png') !!}') center top no-repeat;
        }
    </style>
</head>
<body>
<body class="bg-bdy" style="margin: 0 auto">

<div class="container-fluid">

    <h2 class="text-center logo mt-2 mb-3">
        <a href="#">
            <img src="{{url('public/img/logo/logo.png')}}" alt="">
        </a>

    </h2><!--/Logo_Bar-->

</div>

<div class="container">
    <div class="row">
        <div class="offset-lg-4 col-lg-5 col-xl-5 offset-md-3">
            <div class="card" style="border-radius: 10px;box-shadow: 0px 8px 6px 1px #7e57c2b5;">
                <div style="height: 200px;background: url('{{url('public/theme/assets/images/background-2.jpg')}}') no-repeat;background-position: -157px -263px;border-radius: 10px 10px 0px 0px;text-align: left;color: white;">
                    <h2 style="color: white;padding-top: 14%;padding-left: 14%;font-size: 224%;">Hallo {{$order->user->name}} !</h2>
                    <p style="padding-left: 14%;font-size: 153%;">Danke für dein Vertrauen</p>
                </div>
                <div class="card-body" style="text-align: center;">
                    <p class="card-title" style="margin-top: 3%;margin-bottom: 4%;">Ihr Passwort lautet :
                        <span style="font-weight: 600;color: black;">{{$password}}</span>
                    </p>
                    <p class="card-text" style="margin-bottom: 1%;">
                        Wir haben Ihnen die Zugangsdaten per E-Mail zugesandt:
                    </p>
                    <p style="margin-bottom: 10%;color: black;">{{$order->user->email}}</p>
                    <a href="{{url('orders/current/'.$order->id)}}" class="btn btn-primary waves-effect waves-light" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">Upload Dokumente jetzt</a>
                    <p style="margin-top: 3%;">Laden Sie jetzt Ihre Dokumente hoch und fügen Sie die erforderlichen Daten hinzu.</p>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
