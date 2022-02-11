@extends('layouts.app')
@section('css')
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
 @endsection

@section('content')
          <div class="row mb-4" style="padding-bottom: 0px;border-radius: 0px 0px 25px 25px;background-color: #323759;margin-left: -27px;margin-right: 0px;width: 104%;padding-left: 15px;padding-right: 15px;">
        <div class="col-md-4">
            <h4 class="page-title ml-2 mt-3" style="color: #FFF;">Rechnungen</h4>
        </div>
        <div class="offset-md-3 col-md-3 mt-3 text-right" >
            <button class="btn btn-success" style="border-radius: 25px;border-color: white;" onclick="window.location='{{url('orders')}}'"><i class="fa fa-plus"></i> Rechnungen</button>
        </div>
        <div class="col-md-2 mt-3 text-left">
            <input type="text" id="search" style="border-radius: 25px;border-color: white;" class="form-control"   placeholder="Suchen" />
        </div>
        <div class="page-title-box">
            <div class="page-title-right">

            </div>
        </div>
        <div class="col-md-12 mb-2 mt-5" style="background-color: #3b3f77;border-radius: 25px;border: 2px solid #3b3f77;padding: 10px 0px 10px 0px;">
            <center>
                <form action="{{url('invoices/search')}}" method="POST">
                    @csrf

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="all" class="btn btn-primary">Alle | {{session('all')}} </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="progress" class="btn btn-primary">In Bearbeitung | {{  session('progress')}} </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="waiting" class="btn btn-primary">In Wartestellung | {{session('waiting')}} </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="completed" class="btn btn-primary">Fertig | {{session('completed')}} </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="cancelled" class="btn btn-primary">Storniert | {{session('cancelled')}} </button>

                    <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="deleted" class="btn btn-primary">Gelöscht | {{session('deleted')}} </button>

                    <div class="dropdown" style="display: inline;">
                      <button type="button" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Letzte 30 Tage <i class="fa fa-chevron-down"></i>
                      </button>
                      <div class="dropdown-menu">
                       <form method="post" action="{{url('invoices/search')}}">
                            @csrf
                            @php $date = date('Y-m-d',strtotime('-30 days')); @endphp
                            <input type="hidden" name="action" value="custom_date">
                             <input type="hidden" id="date_from" required name="date_from" class="form-control" placeholder="Van" style="margin-bottom: 10px" value="{{$date}}">

                             <input type="hidden" id="date_to" required name="date_to" class="form-control" style="margin-bottom: 10px" placeholder="Bis" value="{{date('Y-m-d')}}">

                             <button type="submit" style="background-color: transparent;color: black;text-align: left;" class="btn btn-block">Letzte 30 Tage</button>
                         </form>


                         <form method="post" action="{{url('invoices/search')}}">
                            @csrf
                            @php $date = date('Y-m-d',strtotime('-90 days')); @endphp
                            <input type="hidden" name="action" value="custom_date">
                             <input type="hidden" id="date_from" required name="date_from" class="form-control" placeholder="Van" style="margin-bottom: 10px" value="{{$date}}">

                             <input type="hidden" id="date_to" required name="date_to" class="form-control" style="margin-bottom: 10px" placeholder="Bis" value="{{date('Y-m-d')}}">

                             <button type="submit" style="background-color: transparent;color: black;text-align: left;" class="btn btn-block">Letzte 90 Tage</button>
                         </form>



                        <form method="post" action="{{url('invoices/search')}}">
                            @csrf
                            @php $year = date('Y')-2; @endphp
                            <input type="hidden" name="action" value="custom_date">
                             <input type="hidden" id="date_from" required name="date_from" class="form-control" placeholder="Van" style="margin-bottom: 10px" value="{{$year}}-01-01">

                             <input type="hidden" id="date_to" required name="date_to" class="form-control" style="margin-bottom: 10px" placeholder="Bis" value="{{$year}}-12-31">

                             <button type="submit" style="background-color: transparent;color: black;text-align: left;" class="btn btn-block">{{date('Y')-2}}</button>
                         </form>

                         <form method="post" action="{{url('invoices/search')}}">
                            @csrf
                            @php $year = date('Y')-1; @endphp
                            <input type="hidden" name="action" value="custom_date">
                             <input type="hidden" id="date_from" required name="date_from" class="form-control" placeholder="Van" style="margin-bottom: 10px" value="{{$year}}-01-01">

                             <input type="hidden" id="date_to" required name="date_to" class="form-control" style="margin-bottom: 10px" placeholder="Bis" value="{{$year}}-12-31">

                             <button type="submit" style="background-color: transparent;color: black;text-align: left;" class="btn btn-block">{{date('Y')-1}}</button>
                         </form>

                          <hr>

                         <form method="post" action="{{url('invoices/search')}}">
                            @csrf
                            <input type="hidden" name="action" value="custom_date">
                             <input type="date" id="date_from" required name="date_from" class="form-control" placeholder="Van" style="margin-bottom: 10px">

                             <input type="date" id="date_to" required name="date_to" class="form-control" style="margin-bottom: 10px" placeholder="Bis">

                             <button type="submit" style="background-color: silver" class="btn btn-block">Senden</button>
                         </form>

                      </div>

                    </div>

                </form>
            </center>
            </div>
        </div>
            </center>
        </div>
          </div>



<!-- Table with panel -->

<div class="row">
    <div class="col-12">
        <!-- Portlet card -->
        <div class="card card-cascade narrower">

            <!--Card image-->


            <!--/Card image-->

            <div class="px-4 pt-4 pb-4">

                <div class="table-wrapper">
                    <!--Table-->
                    <table id="designtable" class="table mb-0" style="color: #000;">

                    <thead class="thead-light">
                    <tr>
                        <th class="th-lg">
                            <input class="form-check-input" id="checkAll" type="checkbox" style="margin-left:0px;">
                            <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                        </th>
                        <th class="th-lg">
                            <a>ID
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>
                        <th class="th-lg">
                            <a>Name
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>
                        <th class="th-lg">
                            <a>Datum
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>
                        <th class="th-lg">
                            <a href="">Produkt
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>

                        <th class="th-lg">
                            <a href="">Preis
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>
                        <th class="th-lg">
                            <a href="">Status
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th>
                        <th class="th-lg">
                            <a href="">Bezahlt
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
                            <tbody>

                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-primary checkbox-single">
                                        <input type="checkbox" id="singleCheckbox2" value="option2" aria-label="Single checkbox Two">
                                        <label></label>
                                    </div>
                                </td>
                                <td><a href="{{url('adminorders/'.$order->id.'/edit')}}" class="text-body font-weight-bold">{{$order->id}}</a> </td>
                                  <td>
                                      @foreach ($ClientDetail as $client)
                                            <?php
                                            if ($client->order_id == $order->id) {
                                                echo $client->first_name." ".$client->last_name;

                                            }
                                            ?>
                                      @endforeach
                                  </td>
                                  <td>
                                    @if($order->order_status==1||$order->order_status==3)
                                    <div class="alert alert-warning" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y')}}</div>
                                    @elseif($order->order_status==2)
                                        <div class="alert alert-success" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y')}}</div>
                                    @elseif($order->order_status==-1)
                                        <div class="alert alert-danger" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y')}}</div>
                                    @elseif($order->order_status==-2)
                                        <div class="alert alert-dark" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y')}}</div>
                                    @elseif($order->order_status==4)
                                        <div class="alert alert-primary" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y')}}</div>

                                    @endif
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
                                    {{$order->total_price}} €
                                </td>
                                <td>

                                </td>
                                <td>
                                    @if($order->payment_status==0)
                                    <span class="badge badge-danger">Unpaid</span>
                                @endif
                                @if($order->payment_status==1)
                                    <span class="badge badge-success">paid</span>
                                @endif
                                </td>
                                <td><button onclick="window.location='{{url('invoices/'.$order->id)}}'" class=""><i class="fa fa-refresh"></i></button>
                                    <button onclick="window.location='{{url('invoices/'.$order->id)}}'" class=""><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-sm btn-light invoiceDownload " id="invoiceDownload" data-id="{{$order->id}}"><i class="fa fa-download"></i></button>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- .table-responsive -->
                </div> <!-- end collapse-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->




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

            $('.invoiceDownload').on('click', function (e) {
                e.preventDefault();
                window.open('{{url('invoices/pdf').'/'}}'+$(this).attr('data-id'), '_blank');

            });
            $("#checkAll").click(function () {
    		 $('input:checkbox').not(this).prop('checked', this.checked);
		 });
    </script>
@endsection
