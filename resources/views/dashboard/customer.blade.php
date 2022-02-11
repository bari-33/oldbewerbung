@extends('layouts.app')
@section('css')

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
            <h4 class="page-title">Welcome {{Auth::user()->name}}</h4>
        </div>
    </div>
</div>


<!-- end row -->



<!-- Table with panel -->


<!-- Table with panel -->

<div class="row">
    <div class="col-12">
        <!-- Portlet card -->
        <div class="card">
            <div class="card-body">
                <div class="card-widgets">
                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                    <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                </div>
                <h4 class="header-title mb-0">Orders</h4>

                <div id="cardCollpase4" class="collapse pt-3 show">
                    <div class="table-responsive">
                        <table class="table table-centered table-borderless mb-0">
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


</div>



@endsection
