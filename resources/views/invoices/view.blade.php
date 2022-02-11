<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bewerbung.one" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{!! asset('public/img/logo/logo.png') !!}">
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="{!! asset('public/theme/assets/libs/flatpickr/flatpickr.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{!! asset('public/theme/assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/icons.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/app.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/css/orders.css')}}" rel="stylesheet" />
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
        .vl {

          display: flex;
            flex-direction: row-reverse;

        }
        .v2 {
         margin-top: 50px;

         padding: 40px 0px 40px 70px;
         text-align: left;
         font-size: 50px;
        font-family:  'Open Sans', sans-serif;
        }
        .box{
            width: 40%;
            height: 40px;
            background-color: black;
            display:flex;

            display: grid;
            place-items: center;


        }
        .box>p{
            margin-top: 8px;
            font-size: 20px;
            color: #CFB53B;
        }
        .v10{
            width: 50%;
            height: 450px;

            position:absolute;
          border-left: 1px solid ;

          left: 45%;
          margin-top: 70px;
        }
        .abc>p{
            font-size: 20px;
        }
        </style>
</head>
<body >

    <div class="v10">
        <div class="vl">

            <div>
        <h3>#45468</h3>
        <p>19.06.19 15:57</p>
            </div>
        </div>

        <div >
        <h3 class="ml-5">RECHNUNG AN</h3>
        <hr class="ml-5 " style="height:1px;width:20%; ">
        </div>

        <div class="abc">
         <p class="ml-5 " >Nikkie Johnsen</p>
         <p class="ml-5">Hauptstrabe 123</p>
         <p class="ml-5">65432 Berlin</p>
         <br>
         <br>
         <br>
         <p class="ml-5 " >Nikk.Johnsen@gmail.com</p>
         <p class="ml-5">+4917665258972</p>
        </div>


        </div>


        </div>
    <div class="higth" style="background-color: #3b3f77;padding: 10px 0px 10px 0px ;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
            <h2 class="text-uppercase logo ml-5 mt-5">
                <a href="">
                    <img src="{{url('public/img/logo/logo.png')}}" alt="">
                </a>
            </h2><!--/Logo_Bar-->
            </div>
        </div>
        </div>

        <hr class="ml-5 mb-5" style="float: left;height:1px;width:20%;color:gray;background-color:gray ">
</div>

    <p class="v2">RECHNUNG</p>
    <div class="box">

        <P >
         <span  style="color: #FFFEFA">  STATUS </span> Zahlung  ausstehend
        </P>
    </div>
    <div class="container mt-3">
        <h3>Bestellnummer</h3>
        <p class="">RE 35468</p>
    </div>
    <br>
    <div class="container">
    <hr class="" style="height:1px;width:100%;border:2px;color :gray;background-color:gray ">

    <table class="table">
        <thead>
          <tr>
            <th>Nr</th>
            <th>Produkt</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

            <th>Preis</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Bewerbungspaket Young <br>Englisch</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>


            <td>135,00</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Bewerbungsdesign<br>Englisch</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td>15,00</td>
          </tr>
          <tr>
            <td>3</td>
            <td>website<br>Englisch</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td>july@example.com</td>
          </tr>
        </tbody>
      </table>
      <div style="display: flex; flex-direction: row-reverse;">
      <div>
      <span>Zwischensumme : </span>
      <span>2340</span><br>
      <span>19% umsatzsteuer : </span>
      <span>47</span>
      </div>


      </div>

      <div style="display: flex; justify-content:space-between;margin-top:5px;">
        <h3>Vielen Dank!</h3>
        <button class="btn-primary btn-lg mb-5">Gesamt: 23000</button>
    </div>
 </div>

 <div style="width: 100vw;background-color:#FFFEFA;display:flex;">

<div style="width: 50%;background-color:#FFFEFA;">
dd
</div>

<div style="width: 50%;background-color:#FFFEFA;">
ff

</div>





</div>
</body>
</html>
