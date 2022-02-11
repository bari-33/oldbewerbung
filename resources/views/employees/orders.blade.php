@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    </style>

@endsection
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                {{-- <div class="page-title-right">
                     <form class="form-inline">
                         <div class="form-group">
                             <div class="input-group input-group-sm">
                                 <input type="text" class="form-control shadow border-white" id="dash-daterange">
                                 <div class="input-group-append">
                                                             <span class="input-group-text bg-primary border-primary text-white">
                                                                 <i class="mdi mdi-calendar-range font-13"></i>
                                                             </span>
                                 </div>
                             </div>
                         </div>
                         <a href="javascript: void(0);" class="btn btn-primary btn-sm ml-2 font-14">
                             <i class="mdi mdi-autorenew"></i>
                         </a>
                         <a href="javascript: void(0);" class="btn btn-primary btn-sm ml-1 font-14">
                             <i class="mdi mdi-filter-variant"></i>
                         </a>
                     </form>
                 </div>--}}
                <h4 class="page-title">Meine Bestellungen</h4>
            </div>
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
                <table id="designtable" class="table mb-0" style="color: #000;">

                    <!--Table head-->
                    <thead>
                    <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" id="checkbox">
                            <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                        </th>
                        <th class="th-lg">
                            <a>ID
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>
                        <th class="th-lg" style="width:22%">
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
                        {{-- @if($trash==false) --}}
                        <th class="th-lg">
                            <a href="">Aktion
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <div class="checkbox checkbox-primary checkbox-single">
                                    <input type="checkbox" id="singleCheckbox2" value="option2" aria-label="Single checkbox Two">
                                    <label></label>
                                </div>
                            </td>
                            <td><a href="{{url('employees/editOrder/'.$order->id)}}" class="text-body font-weight-bold">{{$order->id}}</a> </td>
                            <td>
                                <div>
                                    @foreach($order->employees as $employee)
                                        <img src="{{ url('public/img/profiles/'.$employee->profile_picture) }}" style="width:20%;" alt="user-image" class="rounded-circle">

                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <p>{{$order->pdetail->product_title}}</p>
                                <p>
                                    @if($order->product_language=='English')<span class="badge badge-primary">@endif
                                        @if($order->product_language=='German')<span class="badge badge-info">@endif
                                            @if($order->product_language=='French')<span class="badge badge-danger">@endif
                                                @if($order->product_language=='Spanish')<span class="badge badge-secondary">@endif
                                                    {{$order->product_language}}</span>

                                </p>
                            </td>
                            <td>
                                @if($order->order_status==1||$order->order_status==3)
                                    <div class="alert alert-warning" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}</div>
                                @elseif($order->order_status==2)
                                    <div class="alert alert-success" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}</div>
                                @elseif($order->order_status==-1)
                                    <div class="alert alert-danger" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}</div>
                                @elseif($order->order_status==-2)
                                    <div class="alert alert-dark" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}</div>
                                @elseif($order->order_status==4)
                                    <div class="alert alert-primary" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}</div>

                                @endif
                            </td>

                            <td>
                                {{$order->total_price}} €
                            </td>
                            <td>
                                @if($order->payment_status==0)
                                    <span class="badge badge-danger">Unpaid</span>
                                @endif
                                @if($order->payment_status==1)
                                    <span class="badge badge-success">paid</span>
                                @endif
                            </td>
                            <td>
                                @if($order->order_status==0)
                                    <p><span class="badge badge-danger" style="border-radius: 20px;padding: 10%"><i class="ti-close"></i></span></p>
                                @else
                                    <p><span class="badge badge-success" style="border-radius: 20px;padding: 10%"><i class="ti-check"></i>
                                        </span></p>
                                @endif
                            </td>
                            <td>
                                <p>
                                    @if($order->express=='0,00')<span class="badge badge-secondary">
                                    @else<span class="badge badge-success">@endif
                                            24h</span>

                                </p>
                            </td>

                            <td>
                                @if($order->order_status==1||$order->order_status==0)
                                    <a href="{{url('employees/inProcess/'.$order->id)}}"> <button type="button" class="btn btn-sm btn-light"><i class="fe-more-horizontal"></i></button></a>
                                @elseif($order->order_status==2||$order->order_status==3)
                                    <a href="{{url('employees/completed/'.$order->id)}}">  <button type="button" class="btn btn-sm btn-light"><i class="ti-check"></i></button></a>
                                @endif
                                <button type="button" class="btn btn-sm btn-light invoiceDownload" id="invoiceDownload" data-id="{{$order->id}}"><i class="fe-file-text"></i></button>
                                <button type="button" id="uploadDocuments" data-id="{{$order->id}}" class="uploadDocuments btn btn-sm @if($order->finisheddocuments()->count()==0) btn-light @else btn-primary @endif" ><i class="fe-upload"></i></button>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    <!--Table body-->
                </table>
                <!--Table-->
            </div>

        </div>

    </div>
    <!-- Table with panel -->
@endsection

@section('quill_js')

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
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
            $('.invoiceDownload').on('click', function (e) {
                e.preventDefault();
                window.open('{{url('invoices/pdf').'/'}}'+$(this).attr('data-id'), '_blank');

            });

            $('.uploadDocuments').on('click', function (e) {
                e.preventDefault();
                window.open('{{url('employees/editOrder').'/'}}'+$(this).attr('data-id'), '_blank');

            });
        });
    </script>
@endsection
