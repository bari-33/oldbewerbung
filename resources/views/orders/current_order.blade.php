@extends('layouts.app')
@section('file_upload_css')
    <meta name="_token" content="{{csrf_token()}}" />
    <!-- Plugins css -->
   <link href="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.css') !!}" rel="stylesheet" type="text/css" />
     <link href="{!! asset('public/theme/assets/libs/dropify/dropify.min.css') !!}" rel="stylesheet" type="text/css" />

 @endsection
 @section('css')
     <style>
     .brdr-tp {
         box-shadow: 0px -7px 0px 0px #7e57c2b5 !important;
         border-radius: 6px !important;
     }
     .separator{margin:20px 0;position:relative;padding:20px 0;color:#7e80c0;}
     .separator>hr{border-color:#7e80c0;}
     .separator>i{width:34px;height:34px;line-height:32px;border:1px solid;border-radius:50%;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:18px;background-color:#fcfcff;}


         /* PROGRESS BAR */

     .stepsProgress{padding:60px 0;margin:0 60px;position:relative;}
     .stepsProgress .progress{height:6px;margin:10px 0;box-shadow:none;background-color:#d3d3db;border-radius:0;}
     .stepsProgress .progress .progress-bar{line-height:6px;background-color:#8082c0;}
     .stepsProgress .progress .step{position:absolute;z-index:1;height:18px;width:18px;margin-left:-9px;border-radius:50%;border:4px solid #d3d3db;top:50%;-o-transform:translate(0,-50%);-ms-transform:translate(0,-50%);-moz-transform:translate(0,-50%);-webkit-transform:translate(0,-50%);transform:translate(0,-50%);background-color:#fff;}
     .stepsProgress .progress .step:before{position:absolute;top:-40px;left:50%;-o-transform:translate(-50%,0);-ms-transform:translate(-50%,0);-moz-transform:translate(-50%,0);-webkit-transform:translate(-50%,0);transform:translate(-50%,0);font-size:20px;}
     .stepsProgress .progress .step.activated{width:28px;height:28px;border-width:6px;margin-left:-14px;border-color:#4a4da5;}
     .stepsProgress .progress .step.activated:before{font-size:24px;color:#323759;}
     .stepsProgress .progress .step.one:before{content:'20%';}
     .stepsProgress .progress .step.two:before{content:'40%';}
     .stepsProgress .progress .step.three:before{content:'60%';}
     .stepsProgress .progress .step.four:before{content:'80%';}
     .stepsProgress .progress .step.five:before{content:'100%';}
     .stepsProgress .progress .progress-info{position:absolute;transform:translate(-50%,0);top:90px;font-size:16px;}
     .stepsProgress .progress .progress-info.activated{font-size:20px;color:#323759;}
     .stepsProgress .progress .one{left:0;}
     .stepsProgress .progress .two{left:25%;}
     .stepsProgress .progress .three{left:50%;}
     .stepsProgress .progress .four{left:75%;}
     .stepsProgress .progress .five{left:100%;}
     .stepsProgress .progress .primary-color{border-color:#8082c0;color:#9b9ca2;}
     .stepsProgress .progress .no-color{border-color:#d3d3db;color:#d3d3db;}
     @media (max-width:767px){
         .stepsProgress{padding:0;margin:60px 0;display:inline-block;}
         .stepsProgress .progress{width:6px;height:300px;display:block;margin:0 auto;}
         .stepsProgress .progress .progress-bar{width:100% !important;height:inherit;}
         .stepsProgress .progress .step{top:auto;left:50%;margin:-2px 0 0 -6px;}
         .stepsProgress .progress .step.activated{margin-left:-11px;}
         .stepsProgress .progress .step:before{top:50%;left:40px;-o-transform:translate(0,-50%);-ms-transform:translate(0,-50%);-moz-transform:translate(0,-50%);-webkit-transform:translate(0,-50%);transform:translate(0,-50%);}
         .stepsProgress .progress .one{left:auto;top:0;}
         .stepsProgress .progress .two{left:auto;top:25%;}
         .stepsProgress .progress .three{left:auto;top:50%;}
         .stepsProgress .progress .four{left:auto;top:75%;}
         .stepsProgress .progress .five{left:auto;top:100%;}
     }
     /* ProgressBar Style Ends
     --------------------------------------------*/



     .feed{
         background: #f0f0f0;
         height: 100%;
         height: 300px;
         overflow: scroll;
     }

     .feed ul {
         list-style-type: none;
         padding: 5px;
     }



     .feed ul li.received {
         text-align: right;
     }

     .feed ul li.received .text{
         background: lightgray;
     }

     .feed ul li.message {
         margin: 10px 0;
         width: 100%;
     }


     .feed ul li.message .text{
        /* max-width: 200px; */
         border-radius:5px;
         padding:12px;
         display:inline-block;
     }



     .feed ul li.sent {
         text-align: left;
     }

     .feed ul li.sent .text{
         background: lightblue;
     }

     </style>
     @endsection
 @section('content')

     <!-- Payment Failed alert -->
     @if(!empty(session('error')))
     <div class="alert alert-danger alert-dismissible fade show">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <strong>session('error')!</strong> Try again !.
     </div>
     @endif

     <!-- Payment Modal -->
     <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body" id="payment_body">



                     <div class="card card-body bg-light" style="border:2px;padding-top: 1%;padding-bottom: 0%;box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.51);">
                         <a href="{{url('orders/paypal/'.$order->id)}}"> <div class="row">
                             <div class="col-md-6">
                                 <p><i class="mdi mdi-paypal"></i> Paypal</p>
                             </div>
                             <div class="col-md-6">
                                 <p style="text-align: right">Access Instant</p>

                             </div>
                         </div>
                         </a>
                     </div>

                     <div class="card card-body bg-light" style="border:2px;padding-top: 1%;padding-bottom: 0%;box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.51);">
                         <a href="{{url('orders/paypal/'.$order->id)}}">
                             <div class="row">
                             <div class="col-md-6">
                                 <p><i class="mdi mdi-credit-card"></i> Credit Card <sub>Via Paypal</sub></p>
                             </div>
                             <div class="col-md-6">
                                 <p style="text-align: right">Access Instant</p>

                             </div>
                         </div>
                         </a>
                     </div>


                     <div class="card card-body bg-light" id="wire_transfer" style="border:2px;padding-top: 1%;padding-bottom: 0%;box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.51);">
                         <div class="row">
                             <div class="col-md-6">
                                 <p><i class="mdi mdi-bank"></i> Wire Transfer</p>
                             </div>
                             <div class="col-md-6">
                                 <p style="text-align: right">Access: 1-2 Days</p>

                             </div>
                         </div>
                     </div>


                 </div>

                 <div class="modal-body" style="display: none" id="wire_transfer_body">

                     <div class="card card-body bg-light" style="border:2px;padding-top: 1%;padding-bottom: 0%;box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.51);">
                         <div class="row">
                             <div class="col-md-6">
                                 <p><i class="mdi mdi-bank"></i> Wire Transfer</p>
                             </div>
                             <div class="col-md-6">
                                 <p style="text-align: right">Access: 1-2 Days</p>

                             </div>
                         </div>

                         <div class="row" style="text-align: center">
                             <div class="col-md-6" style="text-align: right">
                                 <p> Name of the bank :</p>
                                 <p> Name of the company :</p>
                                 <p style="height: 38px;margin-bottom: 16px;"> Purpose :</p>                                <p> Iban :</p>
                                 <p> Bic :</p>

                             </div>
                             <div class="col-md-6" style="text-align: left">
                                 <p>  Postbank</p>
                                 <p> Graviando OHG</p>
                                 <p>  RE-35468 (Please Specify Exactly this)</p>
                                 <p>  DEB2440100460413924468</p>
                                 <p>  PBNKDEFF</p>
                             </div>
                         </div>

                     </div>


                 </div>

                 <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF">
                     <p style="text-align: center;" id="footer">Access to the documents takes place after receipt of payment.<br> Note: For bank transfers 1-2 days.</p>
                     <p style="text-align: center;display: none" id="wire_transfer_footer"><button id="wire_transfer_back" type="button" class="btn btn-success" style="margin-left: 300%;border-radius: 20px;">Back</button>
                     </p>

                 </div>
             </div>
         </div>
     </div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Express 24 h Processing</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <p style="text-align: center">During Express Processing.Your documents will be processed and completed within 24 hours.</p>
                 </div>
                 <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                     <p class="h5" style="color:#FFF">Price : 59.00 €</p>
                     <div>
                             <button type="button" class="btn btn-success" style="border-radius: 20px;" onclick="location.href='{{url('orders/express/'.$order->id)}}'">Book Express</button>
                     </div>
                     </div>
                 </div>
             </div>
         </div>

     <div class="modal fade" id="trialDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Download Trial</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">

                     <table class="table">
                         <tbody>
                         @foreach($order->trialdocuments as $document)
                             <tr>
                                 <td><a href="{{url('public/files/trialdocuments/'.$document->name)}}" download="{{$document->name}}">{{$document->name}}</a></td>
                             </tr>
                         @endforeach
                         </tbody>
                     </table>
                 </div>
                 <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                     <div style="margin-left: 40%">
                         <button type="button" class="btn btn-success" data-dismiss="modal"  style="border-radius: 20px;">ok</button>
                     </div>

                 </div>
             </div>
         </div>
     </div>

     <div class="modal fade" id="finishedDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Download</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">

                        <table class="table">
                            <tbody>
                            @foreach($order->finisheddocuments as $document)
                            <tr>
                            <td><a href="{{url('public/files/finisheddocuments/'.$document->name)}}" download="{{$document->name}}">{{$document->name}}</a></td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                 </div>
                 <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                     <div style="margin-left: 40%">
                         <button type="button" class="btn btn-success" data-dismiss="modal"  style="border-radius: 20px;">ok</button>
                     </div>

                 </div>
             </div>
         </div>
     </div>


     <div class="modal fade" id="waitingOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Download</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <p style="text-align: center">To Download the finished Documents. You have to pay first.</p>
                 </div>
                 <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                     <div style="margin-left: 25%">
                         <button type="button" class="btn btn-light" data-dismiss="modal" onclick="$('#trialDocumentsModal').modal({ show: true });" style="background-color: orange;color:white;border-color:orange;border-radius: 20px;" >Trial Version</button>
                         <button type="button" class="btn btn-success" data-dismiss="modal" onclick="$('#paymentModal').modal({ show: true });" style="border-radius: 20px;">Pay Now</button>
                     </div>

                 </div>
             </div>
         </div>
     </div>


     <div class="modal fade" id="releaseOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Release Order</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <p style="text-align: center" id="releaseOrderOpenText">Do you want to release the order now</p>
                     <p style="text-align: center;display: none" id="releaseOrderCloseText">Thank you very much! <br> We will review and confirm your order.</p>

                 </div>
                 <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                     <div style="margin-left: 40%" id="releaseOrderOpen">
                         <button type="button" class="btn btn-success" style="border-radius: 20px;" id="releaseOrderModalButton">Yes</button>
                         <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 20px;">No</button>
                     </div>

                     <div style="margin-left: 45%;display:none" id="releaseOrderClose">
                         <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 20px;">Close</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>


     <div class="row">
         <div class="col-12">
             <div class="page-title-box">
                 <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                         <li class="breadcrumb-item active">Current Order</li>
                     </ol>
                 </div>
                 <h4 class="page-title">Current Order</h4>
             </div>
         </div>
     </div>

     @if($order->order_status!=4)
     @if($order->express!=0 and $order->payment_status==0)
 <div class="container">
     <div class="row mt-2 mb-2">
         <div class="col-lg-12 text-center mb-3" style="background-color: #7e57c2b5;color: #FFF;padding: 1%;border-radius:20px; ">
             <span class="mr-2">You have booked express processing so payment is required in advance.</span><button data-toggle="modal" data-target="#paymentModal" class="btn btn-success" style="border-radius: 20px;">Pay Now</button>
         </div>
     </div>
 </div>
 @endif
     @endif


     {{-- <!-- PROGRESS BAR -->
     <div class="row mt-2 mb-2">
     <div class="offset-md-1 col-md-10">
     <div class="stepsProgress">
         <div class="progress">
             <div class="step one @if(empty($order->orderprogress->get(0)->name)) no-color @else  primary-color @endif @if(!empty($order->orderprogress->get(0)->name)&&$order->orderprogress->get(0)->name==$last_progress)activated @endif"></div>
             <div class="step two @if(empty($order->orderprogress->get(1)->name)) no-color @else  primary-color @endif @if(!empty($order->orderprogress->get(1)->name)&&$order->orderprogress->get(1)->name==$last_progress)activated @endif"></div>
             <div class="step three @if(empty($order->orderprogress->get(2)->name)) no-color @else  primary-color @endif @if(!empty($order->orderprogress->get(2)->name)&&$order->orderprogress->get(2)->name==$last_progress)activated @endif"></div>
             <div class="step four @if(empty($order->orderprogress->get(3)->name)) no-color @else  primary-color @endif @if(!empty($order->orderprogress->get(3)->name)&&$order->orderprogress->get(3)->name==$last_progress)activated @endif"></div>
             <div class="step five @if(empty($order->orderprogress->get(4)->name)) no-color @else  primary-color @endif @if(!empty($order->orderprogress->get(4)->name)&&$order->orderprogress->get(4)->name==$last_progress)activated @endif"></div>
             <div class="progress-bar" style="width:@if($progress_count==1)20%@elseif($progress_count==2)40%@elseif($progress_count==3)60%@elseif($progress_count==4)80%@elseif($progress_count==0)0%@elseif($progress_count==5)100%@endif;"></div>

             <div class="progress-info one @if(empty($order->orderprogress->get(0)->name)) no-color @else  primary-color @endif @if(!empty($order->orderprogress->get(0)->name)&&$order->orderprogress->get(0)->name==$last_progress)activated @endif">
                 @if(empty($order->orderprogress->get(0)->name)) Step 1 @else  {{ $order->orderprogress->get(0)->name }} @endif
             </div>

      <div class="progress-info two @if(empty($order->orderprogress->get(1)->name)) no-color @else primary-color @endif @if(!empty($order->orderprogress->get(1)->name)&&$order->orderprogress->get(1)->name==$last_progress) activated @endif">@if(empty($order->orderprogress->get(1)->name)) Step 2 @else{{ $order->orderprogress->get(1)->name }} @endif</div>
    <div class="progress-info three @if(empty($order->orderprogress->get(2)->name)) no-color @else primary-color @endif @if(!empty($order->orderprogress->get(2)->name)&&$order->orderprogress->get(2)->name==$last_progress) activated @endif">@if(empty($order->orderprogress->get(2)->name)) Step 3 @else {{ $order->orderprogress->get(2)->name }} @endif</div>
    <div class="progress-info four @if(empty($order->orderprogress->get(3)->name)) no-color @else primary-color @endif @if(!empty($order->orderprogress->get(3)->name)&&$order->orderprogress->get(3)->name==$last_progress) activated @endif" >@if(empty($order->orderprogress->get(3)->name)) Step 4 @else {{ $order->orderprogress->get(3)->name }} @endif</div>
    <div class="progress-info five @if(empty($order->orderprogress->get(4)->name)) no-color @else primary-color @endif @if(!empty($order->orderprogress->get(4)->name)&&$order->orderprogress->get(4)->name==$last_progress) activated @endif">Payment</div>
 </div>
 </div>
 </div> --}}
 </div>

 <div class="row">
 <div class="col-lg-6">
    <div class="row">
        <div class="col-md-12">
            <div class="card-box brdr-tp">
                <h4 class="mt-3"><a href="#" class="text-dark">deine Bestellung</a></h4>

                <h5 class="mt-3"><a href="#" class="text-dark">{{$product->product_title}}</a></h5>
                <h5 class="mt-3"><a href="#" class="text-dark">{{$design->design_title}}</a></h5>
                <h5 class="mt-3"><a href="#" class="text-dark">{{$website->website_title}}</a></h5>

            </div> <!-- end card-box-->

        </div>
        <div class="col-md-12">
            <div class="card-box brdr-tp">
                <h4 class="mt-3"><a href="#" class="text-dark">Ihr Bestellstatus</a></h4>
                @if($order->order_status==0)
                    <h5 ><a href="#" class="text-dark">Bestätigung ist erforderlich</a></h5>
                    <h4 class="mt-3 pb-3" style="border-bottom: 0.5px solid lightgrey"><span class="badge badge-warning" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">In Warte Stellung</span></h4>
                @endif
                @if($order->order_status==1 || $order->order_status==2)
                    <h5><a href="#" class="text-dark">Auftrag ist in Bearbeitung</a></h5>
                    @if($order->order_status==1)
                        <h4 class="mt-3 pb-3" style="border-bottom: 0.5px solid lightgrey"><span class="badge badge-warning" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">In Warte Stellung</span></h4>
                    @elseif($order->order_status==2)
                    <h4 class="mt-3 pb-3" style="border-bottom: 0.5px solid lightgrey"><span class="badge badge-success" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">In Bearbeitung</span></h4>
                        @endif
                @endif
                @if($order->order_status==3)
                    <h5><a href="#" class="text-dark">Order is awaiting payment</a></h5>
                    <h4 class="mt-3 pb-3" style="border-bottom: 0.5px solid lightgrey"><span class="badge badge-warning" style="background-color:orange;border-color:orange;padding-left: 4%;padding-right: 4%;border-radius: 20px;">Zahlung ausstehend</span></h4>
                @endif
                @if($order->order_status==4)
                    <h5><a href="#" class="text-dark">Order Completed</a></h5>
                    <h4 class="mt-3 pb-3" style="border-bottom: 0.5px solid lightgrey"><span class="badge badge-primary" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">Fertiggestellt</span></h4>
                @endif

                <h5 class="mt-3"><a href="#" class="text-dark">Herstellungsdatum</a></h5>
                <h4 style="display: inline-block;margin-right: 20%"><span class="badge badge-light" style="padding-top:10px;padding-bottom:10px;border-radius: 20px;">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}
                </span></h4>
                @if($order->express==0)
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;" @if($order->payment_status==1) disabled @endif>Buch Express 24h</button>
                 @else
                    <button class="btn btn-danger" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">Express gebucht</button>
                @endif

            </div> <!-- end card-box-->

        </div>
    </div>

 </div>


 <div class="col-lg-6">
    <div class="card-box brdr-tp">
        <div class="row" id="employee_id"  @if(!empty($emp)) data-id="{{$emp->id}}" @else data-id="" @endif >
            @if(!empty($emp))
            <div class="col-4">
                <img src="{{url('public/img/profiles/'.$emp->profile_picture)}}" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">
            </div>
            <div class="col-6">
                <h4 class="mt-3" style="text-align: left; border-bottom: 1px solid black"><a href="#" class="text-dark">{{$emp->name}}</a></h4>
                <p class="text-muted" style="text-align: left">Email <span> | </span> <span> <a href="#" class="text-pink">{{$emp->email}}</a> </span></p>
            </div>
            @else
                <div class="col-4">
                    <img src="{{url('public/img/profiles/profile.png')}}" id="emp_profile" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">
                </div>
                <div class="col-6">
                    <h4 class="mt-3" style="text-align: left; border-bottom: 1px solid black"><a href="#" class="text-dark" id="emp_name">Customer Support</a></h4>
                    <p class="text-muted" style="text-align: left">Email <span> | </span> <span> <a href="#" class="text-pink" id="emp_email"></a> </span></p>

                </div>
                @endif
            <div class="col-12 mt-2">
                <div class="feed">
                <ul>
                    @foreach($messages as $message)
                    <li @if($message->from==Auth::user()->id) class="message sent" @else class="message received" @endif ><div class="text">
                            {{$message->messages}}
                            </div>
                        </li>
                    @endforeach
                </ul>
                </div>
                <form>
                    <textarea name="user_personal" class="form-control" id="chat-message" style="resize: none" required></textarea>
                    <span id="personal_error" style="display: none; color: red">This Field is required</span>
                    <button type="button" id="personal_button" class="btn btn-primary btn-sm waves-effect waves-light mt-2" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">Send</button>
                </form>
            </div>

        </div> <!-- end .padding -->
    </div> <!-- end card-box-->
 </div> <!-- end col -->
 </div>
     @if($order->order_status==4)
         <div class="row">
             <div class="col-lg-12 text-center mb-3" style="background-color: #7e57c2b5;color: #FFF;padding: 1%;border-radius:20px; ">
                 <span class="mr-2">Your documents are ready and ready to download</span><button  class="btn btn-success waves-effect waves-success" data-toggle="modal" data-target="#finishedDocumentsModal" style="color:white;padding-left: 4%;padding-right: 4%;border-radius: 20px;">Download Now</button>
             </div>
         </div>
 @elseif($order->order_status==3)
     <div class="row">
         {{-- <div class="col-lg-12 text-center mb-3" style="background-color: #7e57c2b5;color: #FFF;padding: 1%;border-radius:20px; ">
             <span class="mr-2">Your documents are ready and ready to download</span><button  data-toggle="modal" data-target="#waitingOrderModal" class="btn btn-warning waves-effect waves-warning" style="border-color: orange;background-color:orange;color:white;padding-left: 4%;padding-right: 4%;border-radius: 20px; @if($progress_count<4) pointer-events:none;cursor:default; @endif">Download Now</button>
         </div> --}}
     </div>
     @elseif(($order->order_status==1 || $order->order_status==2) and $order->payment_status==0)
         <div class="container">
             <div class="row text-center mb-3" style="background-color: #7e57c2b5;color: #FFF;padding: 1%;border-radius:20px;">
                 <div class="offset-lg-2 col-lg-6">
                     <span class="mr-2">You have to pay after the documents are ready. <br> If you pay now. Your documents will be ready faster.</span>
                 </div>
                 <div class="col-lg-2" >
                     <button data-toggle="modal" data-target="#paymentModal" class="btn btn-success waves-effect waves-light" style="padding-left: 10%;padding-right: 10%;border-radius: 20px;" >Pay Now</button>
                 </div>
             </div>
         </div>

 @elseif($order->express==0 and $order->order_status==0)
 <div class="row">
 <div class="col-lg-12 text-center mb-3" style="background-color: #7e57c2b5;color: #FFF;padding: 1%;border-radius:20px; ">
    {{-- <span class="mr-2">Please enter all the data you need to release the order</span><button  data-toggle="modal" data-target="#releaseOrderModal" class="btn btn-primary waves-effect waves-primary releaseOrder" @if($order->orderprogress->count()>=4) style="/*border-color: lightgrey;background-color:lightgrey;*/color:white;padding-left: 4%;padding-right: 4%;border-radius: 20px; @if($progress_count<4) pointer-events:none;cursor:default; @endif" @endif @if($order->order_status!=0 || $order->orderprogress->count()<4) style="border-color: lightgrey;background-color:lightgrey;color:white;padding-left: 4%;padding-right: 4%;border-radius: 20px; @if($progress_count<4) pointer-events:none;cursor:default; @endif" disabled @endif>Release Order</button> --}}
 </div>
 </div>
     @elseif($order->express!=0 and $order->order_status==0)
 <div class="container">
 <div class="row text-center mb-3" style="background-color: #7e57c2b5;color: #FFF;padding: 1%;border-radius:20px;">
    <div class="col-lg-8 ">
        <span class="mr-2">The express processing does not begin until we have all the necessary data <br> and paid the order.Please enter all the data you need to release the order</span>
    </div>
    <div class="col-lg-4" >
       {{-- <button data-toggle="modal" data-target="#releaseOrderModal" class="btn @if($progress_count<4) btn-danger @else btn-success @endif waves-effect waves-light releaseOrder" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;@if($progress_count<4) pointer-events:none;cursor:default @endif"  @if($order->order_status!=0) disabled @endif>Release Order</button> --}}
    </div>
 </div>
 </div>
 @endif
 <div class="separator text-center">
 <hr>
 <i class="fa fa-angle-down"  style="display: none"></i>
 <i class="fa fa-angle-up"></i>
 </div>

 <div class="row mt-3 mb-3" id="job-u-1">
 <div class="col-md-12 text-center">
 <p>The following information will help us to better adapt your application to your person and the desired position</p>
 <p>The more personalized the application the higher the chances</p>
 </div>
 </div>
 <div class="row mt-3 job">
 <div class="col-lg-6">
 <div class="row">
    <div class="col-md-12">

        <div class="card-box brdr-tp">
            <h4 class="mt-3"><a href="#" class="text-dark">Job Advertisement</a></h4>
            <span>Data on vacancy notice</span>

            <form id="job_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Job</span>
                        </div>
                        <input type="text" name="job" id="job" class="form-control" placeholder="Job" value="{{$order->orderdetail->job}}" aria-label="Job" aria-describedby="basic-addon1" @if($order->order_status!=0) disabled @endif>

                    </div>
                </div>


                <div class="form-group mb-1">
                    <div class="input-group">
                        <div class="custom-file">
                            <label class="custom-file-label" id="job_file_label" for="inputGroupFile04">Choose file</label>
                            <input type="file" class="custom-file-input" name="job_file" id="job_file" @if($order->order_status!=0) disabled @endif>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="input-group">
                    <textarea name="job_description" id="article-ckeditor2"  cols="25" rows="7" @if($order->order_status!=0) disabled @endif>{{ $order->orderdetail->job_description }}</textarea>
                        <span id="job_description_error" style="display: none; color: red">This Field is required</span>
                      <button type="submit" id="job_button" class="btn btn-primary btn-sm waves-effect waves-light mt-2" @if($order->order_status==0) style="padding-left: 4%;padding-right: 4%;border-radius: 20px;" @else style="background-color: lightgrey;border-color:lightgrey;padding-left: 4%;padding-right: 4%;border-radius: 20px;" @endif disabled>Save</button>
                    </div>

                </div>

            </form>
            <span id="job_error" style="color: red;display: none">Atleast One of the followig fields must be filled</span>
            <span id="job_success" style="color: green;display: none">Job saved successfully</span>
        </div> <!-- end card-box-->


    </div>
     @if($order->order_status==0)
    <div class="col-md-12">
        <div class="card-box brdr-tp">
            <h4 class="mt-3"><a href="#" class="text-dark">Documents</a></h4>
            <span>Upload documents e.g current CV</span>

            <form method="post" action="{{url('orders/documents/'.$order->id)}}" enctype="multipart/form-data"
                  class="dropzone" id="dropzone">
                @csrf
            </form>
            @if($order->documents->count()==0)
            <h4><span class="badge badge-warning" id="document_error" style="padding:1%;border-radius: 20px;">You Haven't uploaded any documents yet. Documents are required</span></h4>
          @endif
            <button class="btn btn-success mt-1" id="documentsSubmit" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;" @if($order->order_status!=0) disabled @endif>Save</button>

            </div> <!-- end card-box-->

        </div>
     @endif
     @if($order->documents->count()!=0)
     <div class="col-md-12" style="height: 200px; overflow: auto">
         <table class="table">
             <thead>
             <th>Document</th>
             <th>Action</th>
             </thead>
             <tbody>
             @foreach($order->documents as $document)
                 <tr>
             <td>{{$document->name}}</td>
             <td><button id="deleteDocument"  @if($order->order_status==0) style="padding-left: 5%;padding-right: 5%;border-radius: 20px;" @endif data-getid="{{$document->id}}" class="btn btn-danger"  @if($order->order_status!=0) style="background-color: lightgrey;border-color:lightgrey;padding-left: 4%;padding-right: 4%;border-radius: 20px;" disabled @endif>Delete</button></td>
                 </tr>
             @endforeach
             </tbody>
         </table>
     </div>
         @endif

    </div>

 </div>


 <div class="col-lg-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card-box brdr-tp" id="qualifications_card" >


                    <h4 class="mt-3"><a href="#" class="text-dark">Qualifications</a></h4>
                    <span>Personal Strengths | Specifics </span>

                    <form id="qualifications_form" >
                        @csrf
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <textarea name="qualifications" id="article-ckeditor3"  cols="25" rows="7" @if($order->order_status!=0||$order->orderdetail->qualifications=="-1") disabled @endif required>@if($order->orderdetail->qualifications!="-1"){{ $order->orderdetail->qualifications }}@endif</textarea>
                                <span id="qualifications_error" style="display: none; color: red">This Field is required</span>
                                 <button type="button" id="qualifications_button_skip" class="btn btn-light btn-sm waves-effect waves-light mt-2"  @if(empty($order->orderdetail->qualifications)) style="padding-left: 4%;padding-right: 4%;border-radius: 20px;" @else style="border-color:lightgrey;padding-left: 4%;padding-right: 4%;border-radius: 20px;" disabled @endif>@if($order->orderdetail->qualifications=="-1") Skipped @else Skip @endif</button>
                                <button type="button" id="qualifications_button" class="btn btn-primary btn-sm waves-effect waves-light mt-2"  @if($order->order_status==0) style="padding-left: 4%;padding-right: 4%;border-radius: 20px;" @elseif($order->order_status!=0||$order->orderdetail->qualifications=="-1")  style="background-color: lightgrey;border-color:lightgrey;padding-left: 4%;padding-right: 4%;border-radius: 20px;" @endif disabled>Save</button>

                            </div>
                        </div>
                    </form>

                </div> <!-- end card-box-->

            </div>


            <div class="col-md-12">

                <div class="card-box brdr-tp" id="motivation_card" >
                    <h4 class="mt-3"><a href="#" class="text-dark">Motivation</a></h4>
                    <span>Why are you interested in this job ? </span>

                    <form id="motivation_form">

                        <div class="form-group mb-2">
                            <div class="input-group">
                                <textarea name="motivation" id="article-ckeditor4"  cols="25" rows="7" @if($order->order_status!=0||$order->orderdetail->motivation_description=="-1") disabled @endif required>@if($order->orderdetail->motivation_description!="-1"){{$order->orderdetail->motivation_description}}@endif</textarea>
                                <span id="motivation_description_error" style="display: none; color: red">This Field is required</span>
                            </div>
                        </div>
                        <span>Optional Information </span>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Salary</span>
                                </div>
                                <input type="text" id="salary" class="form-control" placeholder="Salary" aria-label="Username" aria-describedby="basic-addon1" value="{{$order->orderdetail->motivation_salary}}" @if($order->order_status!=0||$order->orderdetail->motivation_description=="-1") disabled @endif>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Entry Date</span>
                                </div>
                                <input type="text" id="entry_date" class="form-control" placeholder="Entry Date" aria-label="Username" aria-describedby="basic-addon1" value="{{$order->orderdetail->motivation_entry_date}}" @if($order->order_status!=0||$order->orderdetail->motivation_description=="-1") disabled @endif>

                            </div>
                        </div>

                        <button type="button" id="motivation_button_skip" class="btn btn-light btn-sm waves-effect waves-light" @if(empty($order->orderdetail->motivation_description)) style="padding-left: 4%;padding-right: 4%;border-radius: 20px;" @else style="border-color: lightgrey;padding-left: 4%;padding-right: 4%;border-radius: 20px;" disabled @endif>@if($order->orderdetail->motivation_description=="-1") Skipped @else Skip @endif</button>
                        <button type="button" id="motivation_button" class="btn btn-primary btn-sm waves-effect waves-light" @if($order->order_status==0) style="padding-left: 4%;padding-right: 4%;border-radius: 20px;" @elseif($order->order_status!=0||$order->orderdetail->motivation_description=="-1")  style="background-color: lightgrey;border-color:lightgrey;padding-left: 4%;padding-right: 4%;border-radius: 20px;" @endif disabled>Save</button>


                    </form>

                </div> <!-- end card-box-->

            </div>

        </div> <!-- end .padding -->
    </div> <!-- end card-box-->
 </div> <!-- end col -->
 <div class="separator text-center job-l">
 <hr>
 </div>
 <div class="row mt-3">
 <div class="col-lg-12">
    <div class="card-box brdr-tp">
    <div class="row">
        <div class="col-md-6">

                <h4 class="mt-3"><a href="#" class="text-dark">Payment</a></h4>

                <h5 ><div class="alert alert-primary" style="padding-left: 4%;padding-right: 4%">You have to pay after documents are ready</div></h5>
                <h5 class="mt-3"><div class="alert alert-info" style="padding-left: 4%;padding-right: 4%;">If you pay now your documents will be ready faster</div></h5>
                <h5 class="mt-3"><div class="alert alert-secondary" style="padding-left: 4%;padding-right: 4%;">Your data and documents will be absolutely confidential<br> treated and transmited only encrypted</div></h5>
            <h5 class="mt-3"><div class="alert alert-warning" style="padding-left: 4%;padding-right: 4%;">If you are posting express processing so that the payment in advance is required</div></h5>

            </div> <!-- end card-box-->


        <div class="col-md-6">
            <div style="border-left:0.5px solid lightgrey; padding: 20px">
            <p style="overflow: auto; border-bottom:0.5px solid lightgrey;" class="mt-4 pb-1">
                <span style="float: left"><b>Complete Application</b></span>
            <span style="float: right">{{$product->regular_price}} €</span>
            </p>
            <p style="overflow: auto;border-bottom:0.5px solid lightgrey" class="pb-1">
                <span style="float: left"><b>Application Homepage</b></span>
                <span style="float: right">{{$website->regular_price}} €</span>
            </p>
            <p style="overflow: auto;border-bottom:0.5px solid lightgrey" class="pb-1">
                <span style="float: left"><b>Design</b></span>
                <span style="float: right">{{$design->regular_price}} €</span>
            </p>
                @if($order->express!=0)
                <p style="overflow: auto;border-bottom:0.5px solid lightgrey" class="pb-1">
                    <span style="float: left"><b>Express</b></span>
                    <span style="float: right">{{$order->express}} €</span>
                </p>
                @endif
            <p style="overflow: auto;border-bottom:0.5px solid lightgrey" class="pb-1 h3">
                <span style="float: left"><b>Total</b></span>
                <span style="float: right">{{ $order->total_price}} €</span>
            </p>
            <p style="overflow: auto" >
                <span style="float: left">All prices including {{ $order->pdetail->tax_class }} of which {{$tax}} € VAT</span>

            </p>
                @if ($order->payment_status==0)
            <a href="#" data-toggle="modal" data-target="#paymentModal" class="btn btn-success" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">Pay Now</a>
            @endif
            </div>

    </div>
            </div><!-- end card-box-->
    </div>
        </div>
    </div>

 </div>



 @endsection
 @section('file_upload_js')



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
             $('.feed ul').append('<li class="message received"><div class="text">'
                 + data.message +
                 '</div>' +
                 '</li>');
             $('.feed').scrollTop($('.feed')[0].scrollHeight);

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 }
             });
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

         });


         var channel = pusher.subscribe('my-channel-request-accept'+{{Auth::user()->id}});
         channel.bind('my-event', function(data) {
             $('#employee_id').attr('data-id',data.employee_id);
             $('#emp_name').text(data.name);
             $('#emp_profile').attr('src','{{url('public/img/profiles/')}}'+'/'+data.profile_picture);
             $('#emp_email').text(data.email);
             $('.feed ul').append('<li class="message received"><div class="text" style="color:white;background-color:green;font-weight:bold">'
                 + data.name +' Assigned'+
                 '</div>' +
                 '</li>');

             $('.feed').scrollTop($('.feed')[0].scrollHeight);
         });
     </script>
     {{--CHAT LOGIC HERE--}}
     <script>
         $('.feed').scrollTop($('.feed')[0].scrollHeight);
         jQuery('#personal_button').click(function (e) {
             var message=$('#chat-message').val();
             $('#chat-message').val('');
             $('.feed ul').append('<li class="message sent"><div class="text">'
                                         + message +
                                       '</div>' +
                                  '</li>');
             $('.feed').scrollTop($('.feed')[0].scrollHeight);
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
                         to: $('#employee_id').attr('data-id'),
                         from:{{Auth::user()->id}},
                         orderid:{{$order->id}},
                         profile_picture:'{{\Illuminate\Support\Facades\Auth::user()->profile_picture}}',
                         name:'{{\Illuminate\Support\Facades\Auth::user()->name}}'
                     },
                     success: function (result) {

                         console.log(result);

                     }
                 });

         });

     </script>
     {{--CHAT ENDS LOGIC HERE--}}

     <script>
         @if(!empty($order->orderdetail->job_file))
$('#job_file_label').html('{{ $order->orderdetail->job_file }}');
         @endif
     </script>


 <script src="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.js') !!}"></script>

<script>

Dropzone.options.dropzone =
   {
       maxFilesize: 100,
       renameFile: function(file) {
           var dt = new Date();
           var time = dt.getTime();
           return time+file.name;
       },
       acceptedFiles: ".pdf,.doc,.TIFF,.JPEG,.txt,.docx,.doc,.dot,.wpd,.wps,.rtf,.csv,.xls,.xlsx",
       addRemoveLinks: true,
       timeout: 5000,
       removedfile: function(file)
       {
           var name = file.upload.filename;
           $.ajax({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
               },
               type: 'POST',
               url: '{{ url("orders/documents") }}',
               data: {filename: name},
               success: function (data){
                   console.log("File has been successfully removed!!");

               },
               error: function(e) {
                   console.log(e);
               }});
           var fileRef;
           return (fileRef = file.previewElement) != null ?
               fileRef.parentNode.removeChild(file.previewElement) : void 0;
       },

       success: function(file, response)
       {
           console.log(response);
           $('#documentsSubmit').attr('disabled',false);


       },
       error: function(file, response)
       {
           console.log(response);

           return false;
       }
   };


$('#deleteDocument').on('click',function()
{
    var id=$('#deleteDocument').attr('data-getid');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "{{ url('/orders/documentsDelete').'/' }}"+id,
        method: 'get',
        success: function (result) {

            location.reload(true);

            console.log(result);

        },
        error: function(file, response)
        {
            console.log(response);
        }
    });
});

$('#documentsSubmit').on('click',function () {
    location.reload(true);

});
</script>
<!-- Init js-->

@endsection


@section('quill_js')


<script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script>

@if($order->order_status==0)
CKEDITOR.replace( 'article-ckeditor2' ).on('key',
   function(e){
       $('#job_button').attr('disabled',false);
   }
);
@if($order->orderdetail->qualifications=="-1")
CKEDITOR.replace( 'article-ckeditor3' );
@else
CKEDITOR.replace( 'article-ckeditor3' ).on('key',
    function(e){
        $('#qualifications_button').attr('disabled',false);
    }
);
@endif

@if($order->orderdetail->motivation_description=="-1")
CKEDITOR.replace( 'article-ckeditor4' );
@else
CKEDITOR.replace( 'article-ckeditor4' ).on('key',
function(e){
    $('#motivation_button').attr('disabled',false);
}
);
@endif

@else

CKEDITOR.replace( 'article-ckeditor2' );
CKEDITOR.replace( 'article-ckeditor3' );
CKEDITOR.replace( 'article-ckeditor4' );


@endif




//FOR ANY VALUE CHANGE IN TEXT FIELD

$('#job_form').on('change paste keyup',function () {
   $('#job_button').attr('disabled',false);
});
$('#motivation_form').on('change paste keyup',function () {
   if(CKEDITOR.instances['article-ckeditor4'].getData())
   {$('#motivation_button').attr('disabled',false);}
});


// AJAX STARTS HERE


jQuery(document).ready(function() {

    //personal data


    //job data


    $("#job_form").submit(function () {

        var messageLength = CKEDITOR.instances['article-ckeditor2'].getData().replace(/<[^>]*>/gi, '').length;
        /*if( !messageLength ) {
         event.preventDefault();
         $('#job_description_error').show();
         }
         else {*/

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        event.preventDefault();
        $.ajax({
            url: "{{ url('orders/job/'.$order->id ) }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#job_description_error').hide();
                $('#job_button').attr('disabled', true);
                // $('#job_success').show();
                $('#job_error').hide();
                location.reload(true);

                console.log(data);

            },
            error: function (reject) {
                $('#job_error').show();
                if (reject.status == 422) { // when status code is 422, it's a validation issue
                    console.log(reject.responseJSON);

                }
            }

        });

    });


    $('#job_file').on('change', function () {
        var fileName = $(this).val();
        $('#job_file_label').html(fileName.replace("C:\\fakepath\\", ""));
    });


    //documents data

    $("#documents_form").submit(function () {
        event.preventDefault();
        $.ajax({
            url: "{{ url('orders/documents/'.$order->id ) }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $('#document_button').hide();
                $('#document_error').hide();
                $('#documents_success').show();

            }
        });
    });


    //qualifications data

    jQuery('#qualifications_button').click(function (e) {

        var messageLength = CKEDITOR.instances['article-ckeditor3'].getData().replace(/<[^>]*>/gi, '').length;
        if (!messageLength) {
            $('#qualifications_error').show();
        }
        else {

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/orders/qualifications/'.$order->id) }}",
                method: 'post',
                data: {
                    qualifications: CKEDITOR.instances['article-ckeditor3'].getData()
                },
                success: function (result) {
                    $('#qualifications_button').attr('disabled', true);
                    $('#qualifications_button_skip').hide();
                    $('#qualifications_error').hide();
                    location.reload(true);

                    console.log(result);

                }
            });
        }
    });


    // QUALIFICATION SKIP BUTTON

    jQuery('#qualifications_button_skip').click(function (e) {


        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/orders/qualificationsSkip/'.$order->id) }}",
            method: 'post',
            success: function (result) {
                location.reload(true);
                console.log(result);

            }
        });
    });


    //motivation data

    jQuery('#motivation_button').click(function (e) {

        var messageLength = CKEDITOR.instances['article-ckeditor4'].getData().replace(/<[^>]*>/gi, '').length;
        if (!messageLength) {
            $('#motivation_description_error').show();
        }
        else {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/orders/motivation/'.$order->id) }}",
                method: 'post',
                data: {
                    motivation_description: CKEDITOR.instances['article-ckeditor4'].getData(),
                    salary: $('#salary').val(),
                    entry_date: $('#entry_date').val()
                },
                success: function (result) {
                    $('#motivation_button').attr('disabled', true);
                    $('#motivation_description_error').hide();
                    location.reload(true);


                    console.log(result);

                }
            });
        }
    });



    jQuery('#motivation_button_skip').click(function (e) {


        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/orders/motivationSkip/'.$order->id) }}",
            method: 'post',
            success: function (result) {
                location.reload(true);
                console.log(result);

            }
        });
    });


    // MOTIVATION SKIP BUTTO

    // DOCUMENTS DELETE


// horizontal rule


    $('.fa-angle-down').on('click', function () {
        $('.fa-angle-up').show();
        $('.fa-angle-down').hide();
        $('.job').show();
        $('.job-l').show();
        $('#job-u-1').show();
    });

    $('.fa-angle-up').on('click', function () {
        $('.fa-angle-up').hide();
        $('.fa-angle-down').show();
        $('.job').hide();
        $('.job-l').hide();
        $('#job-u-1').hide();
    });

    $('#wire_transfer').css('cursor', 'pointer');
    $('#wire_transfer').on('click', function () {
        $('#wire_transfer_body').show();
        $('#payment_body').hide();
        $('#footer').hide();
        $('#wire_transfer_footer').show();
    });

    $('#wire_transfer_back').on('click', function () {
        $('#wire_transfer_body').hide();
        $('#payment_body').show();
        $('#footer').show();
        $('#wire_transfer_footer').hide();
    });


//SKIP BUTTONS FUNCTIONALITIES



    $('#releaseOrderModalButton').on('click',function () {

        $('#releaseOrderClose').show();
        $('#releaseOrderOpen').hide();
        $('#releaseOrderOpenText').hide();
        $('#releaseOrderCloseText').show();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/orders/release/'.$order->id)}}",
            method: 'get',
            success: function (result) {

               /* $('#job_button').hide();
                $('#qualifications_button').hide();
                $('#documentsSubmit').hide();
                $('#deleteDocument').hide();
                $('#motivation_button').hide();
                $('#motivation_button_skip').hide();
                $('#qualifications_button_skip').hide();
                $('.releaseOrder').attr('disabled',true);
                $('#dropzone').hide();
                $('.releaseOrder').attr('disabled',true);
                $('.releaseOrder').attr('disabled',true);

                CKEDITOR.instances['article-ckeditor2'].setReadOnly(true);
                CKEDITOR.instances['article-ckeditor3'].setReadOnly(true);
                CKEDITOR.instances['article-ckeditor4'].setReadOnly(true);*/

               //location.reload(true);
            },
            error: function(file, response)
            {
                console.log(response);
            }
        });

    });

    $('#releaseOrderModal').on('hidden.bs.modal', function () {
        location.reload(true);
    });
});
</script>
@endsection
