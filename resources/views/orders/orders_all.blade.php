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
                <h4 class="page-title">Orders</h4>
            </div>
        </div>
    </div>

    <!-- end row -->



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
                                <th>id</th>
                                <th>Product</th>
                                <th>Total Price</th>
                                <th>Express</th>
                                <th>Completion Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->product}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>
                                        {{$order->express_status}}
                                    </td>
                                    <td>
                                        {{$order->completion_date}}
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

    </script>
@endsection