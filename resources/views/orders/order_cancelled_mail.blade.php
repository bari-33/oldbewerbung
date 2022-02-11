<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

<!-- Mirrored from coderthemes.com/ubold/layouts/purple/email-templates-billing.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Aug 2019 05:53:48 GMT -->
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Bewerbung.One</title>

</head>

<body>
<div>
    <h1 align="center">Deine Bestellung wurde storniert.</h1>
</div>
<div>
    <p>Hallo {{$account_data['user']}}, </p>
    <p>Soeben haben wir Deine Bestellung <b>{{$account_data['order_id']}}</b> storniert.</p>
</div>


<div>
    <div>
        <div>
            <h3>STATUS : Bestellung storniert</h3>
        </div>
        {{--ROW WITH THREE COLUMNS --}}
        <div>
            {{--COLUMN 1 --}}
            <div>
                <p>Bestellnummer</p>
                <p>{{$account_data['order_id']}}</p>
            </div>
            {{--COLUMN 2 --}}
            <div>
                <p>Bestelldatum</p>
                <p>{{$account_data['date']}}</p>
            </div>

            {{--COLUMN 3 --}}
            <div>
                <p>Fertigstellung</p>
                <p>{{$account_data['finishing_date']}}</p>
            </div>
        </div>

    </div>
</div>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Product</th>
        <th>Preis</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>{{ $account_data['product_name'] }}
            <br>
            {{ $account_data['product_language'] }}
        </td>
        <td>{{ $account_data['product_price'] }} €</td>
    </tr>

    <tr>
        <td>2</td>
        <td>{{ $account_data['design_name'] }}
            <br>
            {{ $account_data['design_category'] }}
        </td>
        <td>{{ $account_data['design_price'] }} €</td>
    </tr>

    <tr>
        <td>3</td>
        <td>{{ $account_data['website_name'] }}
            <br>
            {{ $account_data['website_category'] }}
        </td>
        <td>{{ $account_data['website_price'] }} €</td>
    </tr>
    @if($account_data['express']!=0)
        <tr>
            <td>3</td>
            <td>Express
                <br>
                Express Processing 24h
            </td>
            <td>{{ $account_data['express'] }} €</td>
        </tr>
    @endif

    <tr>
        <td></td>
        <td>Subtotal: {{ $account_data['total_price'] }} € </td>
        <td>19% VAT: {{ $account_data['tax'] }} €</td>
    </tr>
    <tr>
        <td>Total Balance: {{ $account_data['total_price'] }} €</td>
    </tr>

    </tbody>
</table>


<div>
    <h1 align="center">Hast du weitere Fragen?</h1>
    <h2 align="center">Gerne helfen Dir weiter!</h2>
    <p style="text-align: center">(Mo. - Fr. 09.00 bis 18.00 Uhr | Sa. 10.00 bis 16.00 Uhr)</p>
</div>

<div>

    <div>
        <h4>Telefon</h4>
        <p>+494033489549</p>
    </div>

    <div>
        <h4>E-Mail</h4>
        <p>info@bewerbung.one</p>
    </div>

</div>

<div>
    <p>Graviando oHG | Sonninstraße 6, 20097 Hamburg | Amtsgericht Hamburg HRA 123458 |
        Geschäftsführer: Korado Islangiriev, Aslan Magomadov | USt-ID: DE319824375</p>
</div>


    <div>Copyright © 2019 Graviando, All rights reserved.</div>



</body>

<!-- Mirrored from coderthemes.com/ubold/layouts/purple/email-templates-billing.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Aug 2019 05:53:48 GMT -->
</html>
