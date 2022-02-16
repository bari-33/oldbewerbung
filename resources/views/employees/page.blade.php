@extends('layouts.app')
@section('css')
    <meta name="_token" content="{{csrf_token()}}" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">

        .card_bg{
            background-color: #f8ceec;
            background-image: linear-gradient(315deg, #9e9bd0 0%, #595592 74%);
            color: white;
        }

        .card_bg_color{
            color: white !important;
        }

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
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>


<div class="row">



<div class="col-md-6 col-xl-6">
        <div class="card-box card_bg">
            <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h4 class="mt-0 font-16 card_bg_color">BESTELLUNGEN</h4>
            <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$order_count}} </span> <i class="ti-shopping-cart card_bg_color" style="float: right"></i></h2>
            <p class="mb-0 card_bg_color">
                @if($order_p > 0)
                <span style="background-color: #50a5e8;padding: 3px;">{{$order_p}}%</span>
                @elseif($order_p < 0)
                <span style="background-color: #e25757;padding: 3px;">{{$order_p}}%</span>
                @elseif($order_p==0)
                <span style="background-color: #eaa20e;padding: 3px;">{{$order_p}}%</span>
                @endif  vom Vormonat</p>
        </div>
    </div>


    <div class="col-md-6 col-xl-6">
        <div class="card-box card_bg">
            <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h4 class="mt-0 font-16 card_bg_color">EINNAHMEN</h4>
            <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$revenue}} </span> <span class="card_bg_color">&#x20AC;</span> <i class="fe-bar-chart" style="float: right;color:white"></i></h2>
            <p class="mb-0 card_bg_color">

                @if($order_r > 0)
                <span style="background-color: #50a5e8;padding: 3px;">{{$order_r}}%</span>
                @elseif($order_r < 0)
                <span style="background-color: #e25757;padding: 3px;">{{$order_r}}%</span>
                @elseif($order_r==0)
                <span style="background-color: #eaa20e;padding: 3px;">{{$order_r}}%</span>
                @endif vom Vormonat</p>
        </div>
    </div>


</div>
<!-- end row -->



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
                <h4 class="header-title mb-0">Bestellungen</h4>

              {{--  <div id="cardCollpase4" class="collapse pt-3 show">
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


</div>--}}


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
                                {{-- <th class="th-lg">
                                    <a href="">Preis
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th>
                                <th class="th-lg">
                                    <a href="">Bezahlt
                                        <i class="fas fa-sort ml-1"></i>
                                    </a>
                                </th> --}}
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
                                {{-- @endif --}}
                            </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>
                            @foreach($orders1 as $order)
                            <?php
                            $data = explode(',', $order->user_id);
                            foreach ($data as $key => $value) {


                            ?>
                            @if ($value==$employee->id)


                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-primary checkbox-single">
                                            <input type="checkbox" id="singleCheckbox2" value="option2" aria-label="Single checkbox Two">
                                            <label></label>
                                        </div>
                                    </td>
                                    <td><a href="{{url('employees/editOrder/'.$order->id)}}" class="text-body font-weight-bold">{{$order->id}}</a> </td>
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

                                    {{-- <td>
                                        {{$order->total_price}} €
                                    </td>
                                    <td>
                                        @if($order->payment_status==0)
                                            <span class="badge badge-danger">Unpaid</span>
                                        @endif
                                        @if($order->payment_status==1)
                                            <span class="badge badge-success">paid</span>
                                        @endif
                                    </td> --}}
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
                                            <a href="{{url('employees/inProcess/'.$order->id)}}"><button type="button" class="btn btn-sm btn-light"><i class="fe-more-horizontal"></i></button></a>
                                        @elseif($order->order_status==2||$order->order_status==3)
                                            <a href="{{url('employees/completed/'.$order->id)}}">  <button type="button" class="btn btn-sm btn-light"><i class="ti-check"></i></button></a>
                                        @endif
                                        {{-- <button type="button" class="invoiceDownload btn btn-sm btn-light" id="invoiceDownload" data-id="{{$order->id}}"><i class="fe-file-text"></i></button> --}}
                                        <button type="button" id="uploadDocuments" data-id="{{$order->id}}" class="uploadDocuments btn btn-sm @if($order->finisheddocuments()->count()==0) btn-light @else btn-primary @endif" ><i class="fe-upload"></i></button>

                                    </td>

                                </tr>
                                @endif
                                <?php
                            }
                                ?>
                            @endforeach
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>

                </div>
<div class="row">

    <div class="col-xl-4">
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
                                    <label style="width: 75px;padding-left: 20px">{{$order->product}}</label>
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
   <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title mb-3">Chat</h4>

            <div class="chat-conversation">
                <ul class="conversation-list slimscroll" style="max-height: 350px;">

                </ul>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control chat-input" placeholder="Enter your text">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-danger chat-send btn-block waves-effect waves-light" disabled>Send</button>
                    </div>
                </div>
            </div> <!-- .chat-conversation -->
        </div> <!-- end card-box-->
    </div> <!-- end col-->


    <!-- INBOX -->
    <div class="col-xl-4">
        <div class="card-box" style="background-color: white;height:480px">
            <div style="margin-bottom: 20px;border-bottom: 1px solid grey;padding-bottom: 18px;text-align: right">
                <h4 class="header-title mb-3" style="color: black;display: inline-block;" >Inbox</h4>
                <img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt="" style="width:18%;">

            </div>
            <div class="inbox-widget slimscroll" style="max-height: 404px;">
                <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$admin->id}}">
                    <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$admin->profile_picture)}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author" style="color:black; margin-top: 4%">{{$admin->name}}</p>
                    <p class="inbox-item-date" id="inbox-item-date{{$admin->id}}" style="font-size: 140%"><span style="display: none"  class="badge badge-success" id="inbox-item-count{{$admin->id}}">{{$count}}</span>
                    </p>
                </div>
                @foreach($contacts as $contact)
                <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$contact->id}}">
                    <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$contact->profile_picture)}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author" style="color:black; margin-top: 4%">{{$contact->name}}</p>
                    <p class="inbox-item-date" id="inbox-item-date{{$contact->id}}" style="font-size: 140%"><span style="display: none" class="badge badge-success" id="inbox-item-count{{$contact->id}}">{{$contact->count}}</span>
                    </p>
                </div>
                    @endforeach
                @foreach($chat_requests as $chat)
                <div class="inbox-item accept" style="border:0;cursor: pointer" data-id="{{$chat->from}}" data-order="{{$chat->order}}">
                    <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$chat->profile_picture)}}" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author" style="color:black; margin-top: 4%">Chat Request</p>
                    <p class="inbox-item-date" id="inbox-item-date{{$chat->from}}" style="font-size: 140%"><span class="badge badge-secondary"><button class="btn btn-default">Accept</button></span>
                        </p>
                    </div>
                    @endforeach

            </div> <!-- end inbox-widget -->

        </div> <!-- end card-box-->
    </div> <!-- end col -->

<!-- Todos app -->
</div> <!-- end row -->
            </div>
        </div>
    </div>
</div>


@endsection


                @section('quill_js')


                    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
                    <script>

                        // Enable pusher logging - don't include this in production
                        //Pusher.logToConsole = true;

                        var pusher = new Pusher('d7767093b596500eb0a2', {
                            cluster: 'mt1',
                            forceTLS: true
                        });

                        var channel = pusher.subscribe('my-channel'+{{Auth::user()->id}});
                        channel.bind('my-event', function(data) {
                            console.log(data);
                            var date=new Date();
                            var time=date.getHours()+':'+date.getMinutes();
                            if(id!=null && (id === data.from)) {

                                $('.conversation-list').append(
                                    ' <li class="clearfix odd">\n' +
                                    '                        <div class="chat-avatar">\n' +
                                    '                            <img src="{{url('public/img/profiles/')}}' + '/' + data.profile_picture + '" alt="male">\n' +
                                    '                            <i>' + time + '</i>\n' +
                                    '                        </div>\n' +
                                    '                        <div class="conversation-text">\n' +
                                    '                            <div class="ctext-wrap">\n' +
                                    '                                <i>' + data.name + '</i>\n' +
                                    '                                <p>\n' +
                                    data.message +
                                    '                                </p>\n' +
                                    '                            </div>\n' +
                                    '                        </div>\n' +
                                    '                    </li>'
                                );

                                jQuery.ajax({
                                    url: "{{ url('/chat/readreceipt/') }}",
                                    method: 'post',
                                    data: {
                                        id: data.id,
                                    },
                                    success: function (result) {

                                        console.log(result);

                                    }
                                });

                                $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);

                            }
                            else {

                                //incrementing the message count
                                var msg_count = parseInt($('#inbox-item-count' + data.from).text());
                                msg_count++;
                                $('#inbox-item-count' + data.from).text(msg_count);
                                $('#inbox-item-count' + data.from).show();

                            }




                        });


                        var channel = pusher.subscribe('my-channel-request');
                        channel.bind('my-event', function(data) {
                            $('.inbox-widget').append(
                           ' <div class="inbox-item accept" style="border:0;cursor: pointer" data-id="'+data.from+'" data-order="'+data.order+'">'+
                                '<div class="inbox-item-img"><img src="{{url('public/img/profiles/profile.png')}}" class="rounded-circle" alt=""></div>'+
                               '<p class="inbox-item-author" style="color:white; margin-top: 4%">Chat Request</p>'+
                            '<p class="inbox-item-date" id="inbox-item-date{{$admin->id}}" style="font-size: 140%"><span class="badge badge-secondary"><button class="btn btn-default">Accept</button></span>'+
                            '</p>'+
                            '</div>'
                            );
                            $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);

                        });
                    </script>
                    {{--CHAT LOGIC HERE--}}
                    <script>
                       var id;
                       // $('.chat-input').scrollTop($('.feed')[0].scrollHeight);
                        jQuery('.chat-send').click(function (e) {

                            var date=new Date();
                            var time=date.getHours()+':'+date.getMinutes();
                            var message=$('.chat-input').val();
                            $('.chat-input').val('');

                            $('.conversation-list').append(' <li class="clearfix">\n' +
                               '                        <div class="chat-avatar">\n' +
                               '                            <img src="{{url('public/img/profiles/'.Auth::user()->profile_picture)}}" alt="male">\n' +
                               '                            <i>'+time+'</i>\n' +
                               '                        </div>\n' +
                               '                        <div class="conversation-text">\n' +
                               '                            <div class="ctext-wrap">\n' +
                               '                                <i>{{Auth::user()->name}}</i>\n' +
                               '                                <p>\n' +
                                                                  message +
                               '                                </p>\n' +
                               '                            </div>\n' +
                               '                        </div>\n' +
                               '                    </li>');
                            $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/chat/send/') }}",
                                method: 'post',
                                data: {
                                    message: message,
                                    to:id,
                                    from:{{Auth::user()->id}},
                                    profile_picture:'{{\Illuminate\Support\Facades\Auth::user()->profile_picture}}',
                                    name:'{{\Illuminate\Support\Facades\Auth::user()->name}}'
                                },
                                success: function (result) {
                                    console.log(result);

                                }
                            });



                        });


                        $('.inbox-item').click(function () {
                            $('.chat-send').attr('disabled',false);
                            $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);
                            id=$(this).attr('data-id');
                            $('#inbox-item-count'+id).text('0');
                            $('#inbox-item-count'+id).hide();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/chat/read/') }}",
                                method: 'post',
                                data: {
                                    to:id
                                },
                                success: function (result) {

                                    console.log(result);

                                },
                                error: function (result) {

                                    console.log(result);

                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/chat/getAll/') }}"+'/'+id,
                                method: 'get',
                                success: function (result) {
                                    $('.conversation-list').html('');


                                    for(res in result) {
                                        var d=new Date(result[res].created_at);
                                        var time=d.getHours()+':'+d.getMinutes();

                                        if (result[res].from =={{Auth::user()->id}}) {
                                            $('.conversation-list').append(' <li class="clearfix">\n' +
                                                '                        <div class="chat-avatar">\n' +
                                                '                            <img src="{{url('public/img/profiles/'.Auth::user()->profile_picture)}}" alt="male">\n' +
                                                '                            <i>' + time + '</i>\n' +
                                                '                        </div>\n' +
                                                '                        <div class="conversation-text">\n' +
                                                '                            <div class="ctext-wrap">\n' +
                                                '                                <i>'+result[res].from_contact.name+'</i>\n' +
                                                '                                <p>\n' +
                                                result[res].messages +
                                                '                                </p>\n' +
                                                '                            </div>\n' +
                                                '                        </div>\n' +
                                                '                    </li>');
                                        } else {

                                            $('.conversation-list').append(' <li class="clearfix odd">\n' +
                                                '                        <div class="chat-avatar">\n' +
                                                '                            <img src="{{url('public/img/profiles/')}}' + '/' + result[res].from_contact.profile_picture + '" alt="male">\n' +
                                                '                            <i>' + time + '</i>\n' +
                                                '                        </div>\n' +
                                                '                        <div class="conversation-text">\n' +
                                                '                            <div class="ctext-wrap">\n' +
                                                '                                <i>'+result[res].from_contact.name+'</i>\n' +
                                                '                                <p>\n' +
                                                result[res].messages +
                                                '                                </p>\n' +
                                                '                            </div>\n' +
                                                '                        </div>\n' +
                                                '                    </li>');
                                        }

                                    }
                                    $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);
                                }
                            });
                        });


                        $('body').on('click','.accept',function() {

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            jQuery.ajax({
                                url: "{{ url('/chat/accept/') }}",
                                method: 'post',
                                data: {
                                  id: {{Auth::user()->id}},
                                    from: $(this).attr('data-id'),
                                    order: $(this).attr('data-order')
                                },
                                success: function (result) {
                                    location.reload(true);

                                    console.log(result);

                                }
                            });

                        });
                    </script>
                    {{--CHAT ENDS LOGIC HERE--}}

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

                        $('.uploadDocuments').on('click', function (e) {
                            e.preventDefault();
                            window.open('{{url('employees/editOrder').'/'}}'+$(this).attr('data-id'), '_blank');

                        });
                    </script>


@endsection
