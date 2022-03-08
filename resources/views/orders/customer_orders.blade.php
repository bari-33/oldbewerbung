@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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

    <!-- end row -->


    <!--    TRIAL DOCUMENTS MODAL ---->


    <div class="modal fade" id="trialDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Downloaden Trial Version</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <tbody id="trialcontent">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                    <div style="margin-left: 40%">
                        <button type="button" class="btn btn-success" data-dismiss="modal"  style="border-radius: 20px;">OK</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="finishedDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Downloaden Finsihed Version</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <tbody id="finishedcontent">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                    <div style="margin-left: 40%">
                        <button type="button" class="btn btn-success" data-dismiss="modal"  style="border-radius: 20px;">OK</button>
                    </div>

                </div>
            </div>
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
                        <table id="designtable" class="table table-centered mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th >
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Fertigstellug</th>
                                <th>Produkt</th>
                                <th>Preis</th>
                                <th>Bezahlt</th>
                                <th>Manufacturi</th>
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
                                <td><a href="{{url('orders/current/'.$order->id)}}" class="text-body font-weight-bold">{{$order->id}}</a> </td>
                                <td>
                                    @if($order->order_status==0)
                                    <div class="alert alert-secondary" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">On-Hold
                                    </div>
                                        @endif
                                        @if($order->order_status==2)
                                            <div class="alert alert-info" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">In Running
                                            </div>
                                        @endif
                                        @if($order->order_status==3)
                                            <div class="alert alert-warning" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">In check
                                            </div>
                                        @endif
                                        @if($order->order_status==4)
                                            <div class="alert alert-success" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Completed
                                            </div>
                                        @endif
                                        @if($order->order_status==-1)
                                            <div class="alert alert-primary" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Activated
                                            </div>
                                        @endif
                                        @if($order->order_status==1)
                                            <div class="alert alert-danger" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Cancled
                                            </div>
                                        @endif
                                </td>
                                <td>
                                    <div class="alert alert-secondary" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}</div>
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
                                    @if($order->payment_status==0)
                                        <span class="badge badge-danger">Unpaid</span>
                                    @endif
                                        @if($order->payment_status==1)
                                        <span class="badge badge-success">paid</span>
                                        @endif
                                </td>
                                <td>

                                    <a target="_blank" href="{{url('invoices/'.$order->id)}}"><button type="button" class="btn btn-sm btn-light" id="invoiceDownload" data-id="{{$order->id}}"><i class="fe-file-text"></i></button></a>
                                    @if ($order->order_status==-1)


                                    <button type="button" data-toggle="modal" data-target="#trialDocumentsModal" id="trialDocuments" data-id="{{$order->id}}" class="btn btn-sm btn-light" @if($order->trialdocuments()->count()==0) disabled @endif><i class="fe-upload"></i></button>
                                    <button type="button" data-toggle="modal" data-target="#finishedDocumentsModal" id="finishedDocuments" data-id="{{$order->id}}" class="btn btn-sm btn-primary" @if($order->finisheddocuments()->count()==0 || $order->payment_status==0) disabled @endif><i class="fe-upload"></i></button>
                                    @endif
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



            $('#trialDocuments').on('click',function () {
                id=$(this).attr('data-id');
                $.ajax({
                    type : 'get',
                    url  : 'getTrialDocuments/'+id,
                    success: function(res){
                        console.log(res);
                        var tsr='';
                        for(i=0;i<res.length;i++) {

                          tsr+= '<tr>'+
                                '<td><a href='+'"'+window.location.origin+'/bewerbung/public/files/trialdocuments/'+res[i].name+'" download="'+res[i].name+'">'+res[i].name+'</a></td>'
                                +'</tr>';

                        }
                             console.log(tsr);
                        $('#trialcontent').html(tsr);


                    },
                    error: function(res){
                        console.log('Failed');
                        console.log(res);
                    }
                });
            });

            $('#finishedDocuments').on('click',function () {
                id=$(this).attr('data-id');

                $.ajax({
                    type : 'get',
                    url  : 'getFinishedDocuments/'+id,
                    success: function(res){
                        var tsr='';
                        for(i=0;i<res.length;i++) {

                            tsr+= '<tr>'+
                                '<td><a href='+'"'+window.location.origin+'/bewerbung/public/files/finisheddocuments/'+res[i].name+'" download="'+res[i].name+'">'+res[i].name+'</a></td>'
                                +'</tr>';

                        }


                        $('#finishedcontent').html(tsr);

                    },
                    error: function(res){
                        console.log('Failed');
                        console.log(res);
                    }
                });
            });
        });

    </script>


@endsection
