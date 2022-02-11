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
            <h4 class="page-title">Meine Aufgaben</h4>
        </div>
    </div>
</div>


<!-- end row -->



<!-- Table with panel -->



<div class="row">

    <div class="col-xl-12">
        <div class="card-box">
            <h4 class="header-title mb-3">Meine Aufgaben</h4>
            <div class="todoapp">
                <div class="row">
                    <div class="col">
                        <h5 id="todo-message"><span id="todo-remaining">1</span> von <span id="todo-total">{{$order_count}}</span> übrig</h5>
                    </div>
                    <div class="col-auto">
                        <a class="float-right btn btn-light btn-xs waves-effect waves-light" id="btn-archive">Erledigen</a>
                    </div>
                </div>


                <div class="list-group list-group-flush" style="height: 365px;max-height: 365px; overflow-y: scroll; width: auto">
                    @foreach($orders as $order)

                    <a class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="checkbox checkbox-primary checkbox-single">
                                    <input type="checkbox" id="singleCheckbox2" value="option2"  @if($order->order_status==4) checked @endif aria-label="Single checkbox Two">
                                    <label style="padding-left: 20px">{{$order->product}}</label>
                                </div>
                               @if ($order->express!=0) <p><span class="badge badge-success">24h</span>
                                </p> @endif
                            </div>
                            <small class="mb-1 ml-4 text-muted"> @if($order->product_language=='English')<span class="badge badge-primary">@endif
                                    @if($order->product_language=='German')<span class="badge badge-info">@endif
                                        @if($order->product_language=='French')<span class="badge badge-danger">@endif
                                            @if($order->product_language=='Spanish')<span class="badge badge-secondary">@endif
                                                {{$order->product_language}}</span> <span style="text-align:right ; float: right">{{ \Carbon\Carbon::parse($order->completion_date)->format('d/m/Y')}}</span></small>

                        </a>

                        @endforeach
                    </div><!-- .todoapp -->
        </div> <!-- end card-box-->
    </div> <!-- end col -->
    </div>

    <!-- CHAT -->
{{--   <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title mb-3">Chat</h4>

            <div class="chat-conversation">
                <ul class="conversation-list slimscroll" style="max-height: 350px;">
                    <li class="clearfix">
                        <div class="chat-avatar">
                            <img src="{{url('public/theme/assets/images/users/user-5.jpg')}}" alt="male">
                            <i>10:00</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>John Deo</i>
                                <p>
                                    Hello!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix odd">
                        <div class="chat-avatar">
                            <img src="{{url('public/theme/assets/images/users/user-2.jpg')}}" alt="Female">
                            <i>10:01</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>Geneva</i>
                                <p>
                                    Hi, How are you? What about our next meeting?
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="chat-avatar">
                            <img src="{{url('public/theme/assets/images/users/user-2.jpg')}}" alt="male">
                            <i>10:01</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>John Deo</i>
                                <p>
                                    Yeah everything is fine
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix odd">
                        <div class="chat-avatar">
                            <img src="{{url('public/theme/assets/images/users/user-2.jpg')}}" alt="male">
                            <i>10:02</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>Geneva</i>
                                <p>
                                    Wow that's great
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control chat-input" placeholder="Enter your text">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-danger chat-send btn-block waves-effect waves-light">Send</button>
                    </div>
                </div>
            </div> <!-- .chat-conversation -->
        </div> <!-- end card-box-->
    </div> <!-- end col-->


    <!-- INBOX -->
    <div class="col-xl-4">
        <div class="card-box" style="background-color: black;height:480px">
            <div style="margin-bottom: 20px;border-bottom: 1px solid grey;padding-bottom: 18px;text-align: right">
                <h4 class="header-title mb-3" style="color: white;display: inline-block;" >Inbox</h4>
                <img src="{{url('public/img/profiles/'.$employee->userdetail->profile_picture)}}" class="rounded-circle" alt="" style="width:18%;">

            </div>
            <div class="inbox-widget slimscroll" style="max-height: 404px;">
                @foreach($orders as $order)
                <div class="inbox-item" style="border:0">
                    <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$order->user->userdetail->profile_picture)}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author" style="color:white; margin-top: 4%">{{$order->user->name}}</p>
                    <p class="inbox-item-date" style="font-size: 140%"><span class="badge badge-secondary">1</span>
                    </p>
                </div>
                    @endforeach


            </div> <!-- end inbox-widget -->

        </div> <!-- end card-box-->
    </div> <!-- end col -->
--}}
<!-- Todos app -->
</div> <!-- end row -->


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
