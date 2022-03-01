@extends('layouts.app')
@section('css')
    <meta name="_token" content="{{csrf_token()}}" />
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



    <div class="col-md-6 col-xl-3">
        <div class="card-box card_bg">
            <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h4 class="mt-0 font-16 card_bg_color">BESTELLUNGEN</h4>
            <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$orders_count}} </span> <i class="ti-shopping-cart card_bg_color" style="float: right"></i></h2>
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

    <div class="col-md-6 col-xl-3">
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

    <div class="col-md-6 col-xl-3">
        <div class="card-box card_bg">
            <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h4 class="mt-0 font-16 card_bg_color">TAGESDURCHSCHNITT</h4>
            <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$cdaily_avg}} </span> <i class="fe-bar-chart-2" style="float: right;color:white"></i></h2>
            <p class="mb-0 card_bg_color">

                @if($avg_p > 0)
                <span style="background-color: #50a5e8;padding: 3px;">{{$avg_p}}%</span>
                @elseif($avg_p < 0)
                <span style="background-color: #e25757;padding: 3px;">{{$avg_p}}%</span>
                @elseif($avg_p==0)
                <span style="background-color: #eaa20e;padding: 3px;">{{$avg_p}}%</span>
                @endif vom Vormonat


            </p>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-box card_bg">
            <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h4 class="mt-0 font-16 card_bg_color">PRODUKTE</h4>
            <h2 class="text-primary my-3 card_bg_color">{{--$--}}<span data-plugin="counterup" class="card_bg_color">{{$products}}</span> <i class="fe-shopping-bag" style="float: right;color:white"></i></h2>
            <p class="mb-0 card_bg_color">

                @if($prod_p > 0)
                <span style="background-color: #50a5e8;padding: 3px;">{{$prod_p}}%</span>
                @elseif($prod_p < 0)
                <span style="background-color: #e25757;padding: 3px;">{{$prod_p}}%</span>
                @elseif($prod_p==0)
                <span style="background-color: #eaa20e;padding: 3px;">{{$prod_p}}%</span>
                @endif vom Vormonat


            </p>
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
                <h4 class="header-title mb-0">Aufträge</h4>

                <div id="cardCollpase4" class="collapse pt-3 show">
                    <div class="table-responsive-xl">
                        <table class="table table-centered ">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Datum</th>
                                <th>Mitarbeiter</th>
                                <th>Fertigstellug</th>
                                <th>Produkt</th>
                                <th>Preis</th>
                                <th>Bezahlt</th>
                                <th>Daten</th>
                                <th>Express</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{url('adminorders/'.$order->id.'/edit')}}" class="text-body font-weight-bold">{{$order->id}}</a> </td>
                                    <td>{{date('d.m.Y',strtotime($order->created_at))}}</td>
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
                                        <label class="label label-success">{{date('l d.m.Y',strtotime($order->completion_date))}}</label>
                                    </td>
                                    <td>{{$order->product}}</td>
                                    <td>{{$order->total_price}} <i class='fas fa-euro-sign'></i></td>
                                    <td>
                                        @if ($order->express_status=="Normal")
                                        <div style="width:16px;height:6px;background-color: #6BD2C3;border-radius: 20px"></div>
                                            @else
                                            <div style="width:16px;height:6px;background-color: #6BD2C3;border-radius: 20px"></div>
                                        @endif
                                    </td>
                                    <td>@if(!empty($order->orderdetail))
                                            <div><i style="color: #6BD2C3;font-size: 18px;" class="mdi mdi-checkbox-marked"></i>
                                            </div>
                                        @else
                                        <div>
                                           <i style="color: red;font-size: 18px;" class="mdi mdi-close-box"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->is_express==1)
                                   <span style="padding:4px;background-color: #6BD2C3;border-radius: 5px;text-align: center;color:white;font-size:10px">24</span>
                                            @else
                                    <span style="padding:4px;background-color: #C3DDD9;border-radius: 5px;text-align: center;color:white;font-size:10px">24</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{-- @if($order->order_status==1||$order->order_status==0)
                                            <a href="{{url('adminorders/inProcess/'.$order->id)}}"><button type="button" class="btn btn-sm btn-light"><i class="fe-more-horizontal"></i></button></a>
                                        @elseif($order->order_status==2||$order->order_status==3)
                                            <a href="{{url('adminorders/completed/'.$order->id)}}"><button type="button" class="btn btn-sm btn-light"><i class="ti-check"></i></button></a>
                                        @endif --}}
                                            <button type="button" class="btn btn-sm btn-light" id="invoiceDownload" data-id="{{$order->id}}"><i class="fe-file-text"></i></button>
                                        <button type="button" id="uploadDocuments" data-id="{{$order->id}}" class="btn btn-sm @if($order->finisheddocuments()->count()==0) btn-light @else btn-primary @endif" ><i class="fe-upload"></i></button>

                                        <a href="{{url('adminorders/deleteOrder',['order'=>$order->id])}}" id="deleteOrder" data-id="{{$order->id}}" class="delete-confirm btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>

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

    <div class="row">
        <!-- INBOX -->
        <div class="col-xl-4">
            <div class="card-box" style="background-color: white;height:480px">
                <div style="margin-bottom: 20px;border-bottom: 1px solid grey;padding-bottom: 18px;">
                    <div class="row">
                        <div class="col-md-6"><h4 class="header-title " style="color: black;" >Inbox</h4></div>
                        <div class="col-md-6 text-right"> <img src="{{url('public/img/profiles/'.Auth::user()->profile_picture)}}" class="rounded-circle" alt="" style=" width:18%;">
                        </div>

                    </div>


                </div>
                <div class="inbox-widget slimscroll" style="max-height: 404px;">

                    @foreach($employees as $employee)
                        <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author" style="color:black; ">{{$employee->name}}</p>
                            <span style="font-size: 10px">I've finished it! See you so...</span>
                            <p class="inbox-item-date" id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                            </p>
                        </div>
                        <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author" style="color:black; ">{{$employee->name}}</p>
                            <span style="font-size: 10px">I've finished it! See you so...</span>
                            <p class="inbox-item-date" id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                            </p>
                        </div>
                        <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author" style="color:black; ">{{$employee->name}}</p>
                            <span style="font-size: 10px">I've finished it! See you so...</span>
                            <p class="inbox-item-date" id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                            </p>
                        </div>
                        <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author" style="color:black; ">{{$employee->name}}</p>
                            <span style="font-size: 10px">I've finished it! See you so...</span>
                            <p class="inbox-item-date" id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                            </p>
                        </div>
                        <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author" style="color:black; ">{{$employee->name}}</p>
                            <span style="font-size: 10px">I've finished it! See you so...</span>
                            <p class="inbox-item-date" id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                            </p>
                        </div>
                        <div class="inbox-item" style="border:0;cursor: pointer" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author" style="color:black; ">{{$employee->name}}</p>
                            <span style="font-size: 10px">I've finished it! See you so...</span>
                            <p class="inbox-item-date" id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                            </p>
                        </div>
                    @endforeach



                </div> <!-- end inbox-widget -->

            </div> <!-- end card-box-->
        </div> <!-- end col -->

        <!-- CHAT -->
        <div class="col-xl-4">
            <div class="card-box">
                <div style="margin-bottom: 20px;border-bottom: 1px solid grey;padding-bottom: 18px;">
                    <div class="row">
                        <div class="col-md-6"><h4 class="header-title " style="color: black;" >Chat</h4></div>
                    </div>
                </div>

                <div class="chat-conversation">
                    <ul class="conversation-list slimscroll" style="max-height: 315px;">
                        <li class="row">
                            <div class="col-md-3" style="text-align: center;padding-right: 2px"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" style="width:80%"  class="rounded-circle" alt="">
                            <span style="font-size: 10px">10:00</span>
                            </div>
                            <div class="col-md-9" style="padding-left:0px;">
                                <div style="display:inline-block;background-color: #F2F5F7;padding: 8px">
                                <span style="display: block;font-weight: bold">Izhar</span>
                                <span  style="font-size: 10px">Hi this izhar ali</span>
                                </div>
                            </div>
                        </li>
                        <li class="row" style="text-align: right">
                            <div class="col-md-9" style="padding-right:0px;">
                                <div style="display:inline-block;background-color: #F9DDD7;padding: 8px">
                                <span style="display: block;font-weight: bold">Izhar</span>
                                <span  style="font-size: 10px">Hi this izhar ali</span>
                                </div>
                            </div>

                            <div class="col-md-3" style="text-align: center;padding-left: 2px"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" style="width:80%"  class="rounded-circle" alt="">
                                <span style="font-size: 10px">10:00</span>
                                </div>
                        </li>
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

        <div class="col-xl-4">
            <div class="card-box" style="background-color: white;height:480px">

                    <div class="row">
                        <div class="col-md-12"><h4 class="header-title " style="color: black;" >Meine Aufgaben</h4>
                         </div>
                    </div>
                    <div class="row" style="margin-top: 6px">
                        <div class="col-md-6"><p style="color: black;" >3 von 7 übrig</p>
                         </div>
                         <div class="col-md-6 text-right"><span style="color: black;border-radius: 10px;border:1px solid gray;z-index: 9999;padding: 6px;background-color: #F2F5F7;font-size: 10px" >Erledigen</span>
                         </div>
                    </div>
                <div class="inbox-widget slimscroll" style="max-height: 404px;">

                    @foreach($employees as $employee)
                        <div class="inbox-item " style="margin-bottom:6px;box-shadow: 1px #C5C5C5;border: 1px solid #C5C5C5;cursor: pointer;z-index: 9999;border-radius: 6px;padding:5px" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <div class="row" style="padding-left: 0px;margin-left: 0px">
                                <div class="col-md-6">
                                    <p  style="color:black;margin-bottom: 0px">{{$employee->name}}</p>
                                    <span style="font-size: 10px;box-shadow: 1px #C5C5C5;border: 1px solid #C5C5C5;cursor: pointer;z-index: 9999;border-radius: 6px;padding: 1px">I've finished</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p  id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray;margin-bottom: 0px"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                                    </p>
                                    <span style="font-size: 10px;">12:00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inbox-item " style="margin-bottom:6px;box-shadow: 1px #C5C5C5;border: 1px solid #C5C5C5;cursor: pointer;z-index: 9999;border-radius: 6px;padding:5px" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <div class="row" style="padding-left: 0px;margin-left: 0px">
                                <div class="col-md-6">
                                    <p  style="color:black;margin-bottom: 0px">{{$employee->name}}</p>
                                    <span style="font-size: 10px;box-shadow: 1px #C5C5C5;border: 1px solid #C5C5C5;cursor: pointer;z-index: 9999;border-radius: 6px;padding: 1px">I've finished</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p  id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray;margin-bottom: 0px"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                                    </p>
                                    <span style="font-size: 10px;">12:00</span>
                                </div>
                            </div>
                        </div>
                        <div class="inbox-item " style="margin-bottom:6px;box-shadow: 1px #C5C5C5;border: 1px solid #C5C5C5;cursor: pointer;z-index: 9999;border-radius: 6px;padding:5px" data-id="{{$employee->id}}">
                            <div class="inbox-item-img"><img src="{{url('public/img/profiles/'.$employee->profile_picture)}}" class="rounded-circle" alt=""></div>
                            <div class="row" style="padding-left: 0px;margin-left: 0px">
                                <div class="col-md-6">
                                    <p  style="color:black;margin-bottom: 0px">{{$employee->name}}</p>
                                    <span style="font-size: 10px;box-shadow: 1px #C5C5C5;border: 1px solid #C5C5C5;cursor: pointer;z-index: 9999;border-radius: 6px;padding: 1px">I've finished</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p  id="inbox-item-date{{$employee->id}}" style="font-size: 140%;color:gray;margin-bottom: 0px"><span  class="badge badge-success" id="inbox-item-count{{$employee->id}}">{{$employee->count}}</span>
                                    </p>
                                    <span style="font-size: 10px;">12:00</span>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div> <!-- end inbox-widget -->

            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>





@endsection
@section('quill_js')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
   // Pusher.logToConsole = true;

    var id=0;
    var pusher = new Pusher('d7767093b596500eb0a2', {
        cluster: 'mt1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel'+{{Auth::user()->id}});
    channel.bind('my-event', function(data) {
        var date=new Date();
        var time=date.getHours()+':'+date.getMinutes();
        console.log(data);
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
            $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);

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
        }
        else
        {

            //incrementing the message count
            var msg_count = parseInt($('#inbox-item-count' + data.from).text());
            msg_count++;
            $('#inbox-item-count' + data.from).text(msg_count);
            $('#inbox-item-count' + data.from).show();
        }

    });
</script>
{{--CHAT LOGIC HERE--}}
<script>

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
                from:{{\Illuminate\Support\Facades\Auth::user()->id}},
                profile_picture:'{{\Illuminate\Support\Facades\Auth::user()->profile_picture}}',
                name:'{{\Illuminate\Support\Facades\Auth::user()->name}}'
            },
            success: function(result) {

                console.log(result);

            }
        });



    });


    $('.inbox-item').click(function () {
        $('.chat-send').attr('disabled',false);
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
                            '                                <i>{{Auth::user()->name}}</i>\n' +
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
            }
        });
    });
</script>

<script>
    //  function dropimage(id) {
    //             $("#drop").val(id);

    //         }

            function down(id,order) {

                $.ajax({
                    type: 'GET',
                    url: 'dropupdate/'+id+'/'+order,
                    success: function(data) {

                        location.reload();

                    }
                });
            }
            function unassing(id,order) {

            $.ajax({
                type: 'GET',
                url: 'unassingemploy/'+id+'/'+order,
                success: function(data) {
                    location.reload();

                }
            });
            }
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
                console.log("here");
                e.preventDefault();
                window.open('{{url('invoices/pdf').'/'}}'+$(this).attr('data-id'), '_blank');

            });
        });

            $('#uploadDocuments').on('click', function (e) {
                e.preventDefault();
                window.open('{{url('adminorders/').'/'}}'+$(this).attr('data-id')+'/edit', '_blank');

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
{{--CHAT ENDS LOGIC HERE--}}
@endsection
