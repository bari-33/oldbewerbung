@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        .pagination>li>a,
        .pagination>li>span {
            border-radius: 50% !important;
            margin: 0 5px;
        }

        .hov:hover .image {
            opacity: 0.3;
            vertical-align:
        }

        .hov:hover .middle {
            opacity: 1;
        }

        #myDropdown {
            width: 250px !important;
        }

    </style>

@endsection
@section('content')



    <div class="row mb-4"
        style="padding-bottom: 0px;border-radius: 0px 0px 25px 25px;background-color: #323759;margin-left: -27px;margin-right: 0px;width: 104%;padding-left: 15px;padding-right: 15px;">
        <div class="col-md-4">
            <h4 class="page-title ml-2 mt-3" style="color: #FFF;">Bestellungen</h4>
        </div>
        <div class="offset-md-3 col-md-3 mt-3 text-right">
            <button class="btn btn-success" style="border-radius: 25px;border-color: white;"
                onclick="window.location='{{ url('orders') }}'">Bestellung erstellen</button>
        </div>
        <div class="col-md-2 mt-3 text-left">
            <input type="text" id="search" style="border-radius: 25px;border-color: white;" class="form-control"
                placeholder="Suchen" />
        </div>
        <div class="page-title-box">
            <div class="page-title-right">

            </div>
        </div>




        <div class="col-md-12 mb-2"
            style="background-color: #3b3f77;border-radius: 25px;border: 2px solid #3b3f77;padding: 10px 0px 10px 0px;">
            <center>

                <form action="{{ url('adminorders/search') }}" method="POST">
                    @csrf
                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;"
                        name="action" value="all" class="btn btn-primary">Alle | {{ session('all') }} </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;"
                        name="action" value="progress" class="btn btn-primary">In Bearbeitung | {{ session('progress') }}
                    </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;"
                        name="action" value="waiting" class="btn btn-primary">In Wartestellung | {{ session('waiting') }}
                    </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;"
                        name="action" value="completed" class="btn btn-primary">Fertig | {{ session('completed') }}
                    </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;"
                        name="action" value="cancelled" class="btn btn-primary">Storniert | {{ session('cancelled') }}
                    </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;"
                        name="action" value="deleted" class="btn btn-primary">Gelöscht | {{ session('deleted') }}
                    </button>

                    <div class="dropdown" style="display: inline;">
                        <button type="button" style="background-color: #3b3f77;border-radius: 25px;border-color: white;"
                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Letzte 30 Tage <i class="fa fa-chevron-down"></i>
                        </button>
                </form>
                <div class="dropdown-menu">
                    <form method="post" action="{{ url('adminorders/search') }}">
                        @csrf
                        @php $date = date('Y-m-d',strtotime('-30 days')); @endphp
                        <input type="hidden" name="action" value="custom_date">
                        <input type="hidden" id="date_from" required name="date_from" class="form-control"
                            placeholder="Van" style="margin-bottom: 10px" value="{{ $date }}">

                        <input type="hidden" id="date_to" required name="date_to" class="form-control"
                            style="margin-bottom: 10px" placeholder="Bis" value="{{ date('Y-m-d') }}">

                        <button type="submit" style="background-color: transparent;color: black;text-align: left;"
                            class="btn btn-block">Letzte 30 Tage</button>
                    </form>


                    <form method="post" action="{{ url('adminorders/search') }}">
                        @csrf
                        @php $date = date('Y-m-d',strtotime('-90 days')); @endphp
                        <input type="hidden" name="action" value="custom_date">
                        <input type="hidden" id="date_from" required name="date_from" class="form-control"
                            placeholder="Van" style="margin-bottom: 10px" value="{{ $date }}">

                        <input type="hidden" id="date_to" required name="date_to" class="form-control"
                            style="margin-bottom: 10px" placeholder="Bis" value="{{ date('Y-m-d') }}">

                        <button type="submit" style="background-color: transparent;color: black;text-align: left;"
                            class="btn btn-block">Letzte 90 Tage</button>
                    </form>



                    <form method="post" action="{{ url('adminorders/search') }}">
                        @csrf
                        @php $year = date('Y')-2; @endphp
                        <input type="hidden" name="action" value="custom_date">
                        <input type="hidden" id="date_from" required name="date_from" class="form-control"
                            placeholder="Van" style="margin-bottom: 10px" value="{{ $year }}-01-01">

                        <input type="hidden" id="date_to" required name="date_to" class="form-control"
                            style="margin-bottom: 10px" placeholder="Bis" value="{{ $year }}-12-31">

                        <button type="submit" style="background-color: transparent;color: black;text-align: left;"
                            class="btn btn-block">{{ date('Y') - 2 }}</button>
                    </form>

                    <form method="post" action="{{ url('adminorders/search') }}">
                        @csrf
                        @php $year = date('Y')-1; @endphp
                        <input type="hidden" name="action" value="custom_date">
                        <input type="hidden" id="date_from" required name="date_from" class="form-control"
                            placeholder="Van" style="margin-bottom: 10px" value="{{ $year }}-01-01">

                        <input type="hidden" id="date_to" required name="date_to" class="form-control"
                            style="margin-bottom: 10px" placeholder="Bis" value="{{ $year }}-12-31">

                        <button type="submit" style="background-color: transparent;color: black;text-align: left;"
                            class="btn btn-block">{{ date('Y') - 1 }}</button>
                    </form>

                    <hr>

                    <form method="post" action="{{ url('adminorders/search') }}">
                        @csrf
                        <input type="hidden" name="action" value="custom_date">
                        <input type="date" id="date_from" required name="date_from" class="form-control" placeholder="Van"
                            style="margin-bottom: 10px">

                        <input type="date" id="date_to" required name="date_to" class="form-control"
                            style="margin-bottom: 10px" placeholder="Bis">

                        <button type="submit" style="background-color: silver" class="btn btn-block">Senden</button>
                    </form>

                </div>

        </div>

        </form>
        </center>
    </div>
    </div>

    <!-- end row-->


    <!-- TABLE STARTS HERE -->

    <!-- Table with panel -->
    <div class="card card-cascade narrower">

        <!--Card image-->


        <!--/Card image-->

        <div class="px-4 pt-4 pb-4">

            <div class="table-wrapper">
                <!--Table-->
                <input type="hidden" id="order" name="check">
                <form action="{{ url('adminorders/deleteall') }}" method="POST">
                    @csrf
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" style="background-color: transparent;border: none;"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <button class="col-md-12 multiSelector"
                                style="border: none;background-color: rgb(255, 255, 255);" type="submit">Delete</button><br>
                            <button class="col-md-12 multiSelector" style="border: none;background-color: #fff;"
                                type="submit" formaction="{{ url('adminorders/paid') }}">Mark as paid</button><br>
                            <button class="col-md-12 multiSelector" style="border: none;background-color: #fff;"
                                type="submit" formaction="{{ url('adminorders/allinvoice') }}">Download all
                                Invoice</button>
                            <button class="col-md-12 multiSelector" style="border: none;background-color: #fff;"
                                type="submit" formaction="{{ url('adminorders/restore') }}">Restoring</button>


                        </div>
                    </div>
                    <table id="designtable" class="table mb-0" style="color: #000;margin-left:10px;">

                        <!--Table head-->
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="" id="allSelector">SelectAll</th>
                                <th class="th-lg">
                                    <a>ID
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg" style="width: 15%">
                                    <a href="">Mitarbeiter
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Produkt
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Fertigstellug
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Preis
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Bezahlt
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Daten
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Express
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                {{-- @if ($trash == false) --}}
                                <th class="th-lg">
                                    <a href="">Aktion
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <!--Table head-->

                        <!--Table body-->

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <input name="selector[]" class="checkbox" type="checkbox"
                                            value="{{ $order->id }}" />
                                    </td>
                                    <td><a href="{{ url('adminorders/' . $order->id . '/edit') }}"
                                            class="text-body font-weight-bold">{{ $order->id }}</a> </td>

                                    <td>

                                        <?php
                                $order_ids=array();

                                foreach ($dropdown as $key => $drop){
                                    $order_id_exploded=explode(",",$drop->order_id);
                                    $status_id_exploded=explode(",",$drop->assing_status);
                                    foreach ($order_id_exploded as $key => $value) {

                                        $order_ids[]=$value;


                                    }


                                }


                             if (in_array($order->id,$order_ids)) {

                                if (!empty($dropdown)){

                                 foreach ($dropdown as $key1 => $drop1){
                                    $order_id_exploded=explode(",",$drop1->order_id);
                                    $status_id_exploded=explode(",",$drop1->assing_status);
                                 foreach ($order_id_exploded as $key => $drop){
                                     if ($drop == $order->id) {

                                     ?>

                                        <div class="hov">
                                            <button onclick="dropimage({{ $order->id }})" class="dropdown-toggle"
                                                style="background-color: transparent;border: none;margin-left: 50%;margin-right: 50%;"
                                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <img src="{!! asset('public/img/profiles/' . $drop1->profile_picture) !!}" id="{{ $order->id }}"
                                                    alt="user-image" class="rounded-circle image" width="30px"
                                                    height="30px;" style="display: flex;">

                                            </button>
                                            <?php

                                    unset($dropdown->$key);
                                     }

                                    }
                                 }
                                }
                             }else {

                            ?>
                                            <div class="hov">
                                                <button onclick="dropimage({{ $order->id }})" class="dropdown-toggle"
                                                    style="background-color: transparent;border: none;margin-left: 50%;margin-right: 50%;"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <img src="{!! asset('public/img/profiles/user.png') !!}" id="{{ $order->id }}"
                                                        alt="user-image" class="rounded-circle image" width="30px"
                                                        height="30px;">
                                                </button>

                                                <?php
                             }

                                ?>

                                                <div class="dropdown">



                                                    <div class="dropdown-menu" id="myDropdown"
                                                        aria-labelledby="dropdownMenuButton">
                                                        @foreach ($employees as $key4 => $employe)
                                                            <?php
                                                                $order_id_exploded=explode(",",$employe->order_id);

                                                                foreach ($order_id_exploded as $key5 => $value) {

                                                            if($value==$order->id){

                                                                ?>
                                                            <a type="button"
                                                                onclick="down({{ $employe->id }},{{ $order->id }})"
                                                                id="demo">
                                                                <img src="{{ url('public/img/profiles/' . $employe->profile_picture) }}"
                                                                    style="width:20%;" alt="user-image"
                                                                    class="rounded-circle user">


                                                                @php
                                                                    echo $employe->name . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $employe->userdetail->deutch_language, $employe->userdetail->english_language, $employe->userdetail->spanish_language, $employe->userdetail->french_language, $employe->userdetail->web_language, $employe->userdetail->Graphic_language, $employe->userdetail->Media_language;

                                                                @endphp

                                                                <span type="button" class="float-right "
                                                                    onclick="unassing({{ $employe->id }},{{ $order->id }})"><i
                                                                        class="fa fa-times"
                                                                        style="color:red;font-size:18px"></i></span>
                                                            </a>
                                                            <br>
                                                            <?php

                                                                }
                                                            }

                                                                ?>
                                                        @endforeach
                                                        <?php

                                                        ?>
                                                        <input class="col-md-12" type="text" placeholder="Search.."
                                                            id="myInput"><br><br>

                                                        @foreach ($employees as $key4 => $employe)
                                                            <?php
                                                            $data=[];
                                                                $order_id_exploded=explode(",",$employe->order_id);

                                                                foreach ($order_id_exploded as $key5 => $value) {
                                                                  array_push($data, $value);
                                                                }


                                                                    if(in_array($order->id,$data)){


                                                                ?>


                                                            <?php
                                                           }else {

                                                           ?>
                                                            <a type="button"
                                                                onclick="down({{ $employe->id }},{{ $order->id }})"
                                                                id="demo">
                                                                <img src="{{ url('public/img/profiles/' . $employe->profile_picture) }}"
                                                                    style="width:20%;" alt="user-image"
                                                                    class="rounded-circle user">


                                                                @php
                                                                    echo $employe->name . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $employe->userdetail->deutch_language, $employe->userdetail->english_language, $employe->userdetail->spanish_language, $employe->userdetail->french_language, $employe->userdetail->web_language, $employe->userdetail->Graphic_language, $employe->userdetail->Media_language;

                                                                @endphp

                                                                <span type="button" class="float-right "
                                                                    onclick="unassing({{ $employe->id }},{{ $order->id }})"><i
                                                                        class="fa fa-times"
                                                                        style="color:red;font-size:18px"></i></span>



                                                            </a>
                                                            <br>
                                                            <?php
                                                           }
                                                        ?>
                                                        @endforeach
                                                        <?php
                                                        ?>


                                                    </div>
                                                </div>
                                            </div>

                                    </td>

                                    <td>
                                        <p>{{ $order->pdetail->product_title }}</p>
                                        <p>
                                            @if ($order->product_language == 'English')<span class="badge badge-primary">@endif
                                            @if ($order->product_language == 'German')<span class="badge badge-info">@endif
                                            @if ($order->product_language == 'French')<span class="badge badge-danger">@endif
                                            @if ($order->product_language == 'Spanish')<span class="badge badge-secondary">@endif
                                            {{ $order->product_language }}</span>

                                        </p>
                                    </td>
                                    <td>
                                        @if ($order->order_status == 1 || $order->order_status == 3)
                                            <div class="alert alert-warning" role="alert"
                                                style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                            </div>
                                        @elseif($order->order_status == 2)
                                            <div class="alert alert-success" role="alert"
                                                style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                            </div>
                                        @elseif($order->order_status == -1)
                                            <div class="alert alert-danger" role="alert"
                                                style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                            </div>
                                        @elseif($order->order_status == -2)
                                            <div class="alert alert-dark" role="alert"
                                                style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                            </div>
                                        @elseif($order->order_status == 4)
                                            <div class="alert alert-primary" role="alert"
                                                style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                            </div>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $order->total_price }} €
                                    </td>
                                    <td>
                                        @if ($order->payment_status == 0)
                                            <span class="badge badge-danger">Unpaid</span>
                                        @endif
                                        @if ($order->payment_status == 1)
                                            <span class="badge badge-success">paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->order_status == 0)

                                            <p><span class="badge badge-danger" style="border-radius: 20px;padding: 10%"><i
                                                        class="ti-close"></i></span></p>
                                        @else
                                            <p><span class="badge badge-success" style="border-radius: 20px;padding: 10%"><i
                                                        class="ti-check"></i>
                                                </span></p>
                                        @endif
                                    </td>
                                    <td>
                                        <p>
                                            @if ($order->express == '0,00')<span
                                                    class="badge badge-secondary">
                                                @else<span class="badge badge-success">@endif
                                            24h</span>

                                        </p>
                                    </td>

                                    <td>
                                        @if ($order->order_status == 1 || $order->order_status == 0)
                                            <a href="{{ url('adminorders/inProcess/' . $order->id) }}"><button
                                                    type="button" class="btn btn-sm btn-light"><i
                                                        class="fe-more-horizontal"></i></button></a>
                                        @elseif($order->order_status == 2 || $order->order_status == 3)
                                            <a href="{{ url('adminorders/completed/' . $order->id) }}"><button
                                                    type="button" class="btn btn-sm btn-light"><i
                                                        class="ti-check"></i></button></a>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-light invoiceDownload "
                                            id="invoiceDownload" data-id="{{ $order->id }}"><i
                                                class="fe-file-text"></i></button>
                                        <button type="button" id="uploadDocuments" data-id="{{ $order->id }}"
                                            class="btn btn-sm @if ($order->finisheddocuments()->count() == 0) btn-light @else btn-primary @endif"><i
                                                class="fe-upload"></i></button>

                                        <a href="{{ url('adminorders/deleteOrder', ['order' => $order->id]) }}"
                                            id="deleteOrder" data-id="{{ $order->id }}"
                                            class="delete-confirm btn btn-sm btn-danger"><i
                                                class="fa fa-trash"></i></a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                        <!--Table body-->
                    </table>
                </form>
                <!--Table-->
                </form>
            </div>

        </div>

    </div>
    <!-- Table with panel -->
@endsection

@section('quill_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        //  function dropimage(id) {
        //             $("#drop").val(id);

        //         }

        function down(id, order) {

            $.ajax({
                type: 'GET',
                url: 'dropupdate/' + id + '/' + order,
                success: function(data) {

                    location.reload();

                }
            });
        }

        function unassing(id, order) {

            $.ajax({
                type: 'GET',
                url: 'unassingemploy/' + id + '/' + order,
                success: function(data) {
                    location.reload();

                }
            });
        }
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#designtable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#designtable').DataTable();
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.invoiceDownload').on('click', function(e) {
                console.log("here");
                e.preventDefault();
                window.open('{{ url('invoices/pdf') . '/' }}' + $(this).attr('data-id'), '_blank');

            });
        });

        $('#uploadDocuments').on('click', function(e) {
            e.preventDefault();
            window.open('{{ url('adminorders/') . '/' }}' + $(this).attr('data-id') + '/edit', '_blank');

        });



        // $("#checkAll").click(function () {
        // 	 $('input:checkbox').not(this).prop('checked', this.checked);
        //  });
        $('.multiSelector').click(function(e) {
            $('#order').val($('.checkbox:checked').map(function() {
                return this.value;
            }).get().join(','));
            if ($('#order').val() == '') {
                alert('No row selected!');
                return false;
            }

        });
        $("#allSelector").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $("input#myInput").keyup(function() {
            var value = $(this).val();
            $("#myDropdown a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

        });
    </script>

@endsection
