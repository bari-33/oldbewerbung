@extends('layouts.app')
@section('content')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="{!! asset('public/img/profiles/'.$client->clientdetail->profile_picture) !!}" class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">

                    <h4 class="mb-0">{{$client->name}}</h4>
                    <p class="text-muted">@ {{$client->clientdetail->nickname}}</p>

                   <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                    <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

                    <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase"><strong>Biographical Information: </strong></h4>
                        <p class="text-muted font-13 mb-3">
                            {{$client->clientdetail->biographical_information}}
                        </p>
                        <p class="mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{
                        $client->name
                        }}</span></p>

                        <p class="mb-2 font-13"><strong>Telephone :</strong><span class="ml-2">
                               {{ $client->clientdetail->mobile }}
                            </span></p>

                        <p class="mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">
                                                               {{ $client->email }}
                            </span></p>

                        <p class="mb-1 font-13"><strong>Website :</strong> <span class="ml-2">
                                <a href="{{ $client->clientdetail->website }}">{{ $client->clientdetail->website }}</a>

                            </span></p>
                        <p class="mb-1 font-13"><strong>Facebook :</strong> <span class="ml-2">
                                <a href="{{ $client->clientdetail->facebook }}">{{ $client->clientdetail->facebook }}</a>

                            </span></p>
                        <p class="mb-1 font-13"><strong>Twitter :</strong> <span class="ml-2">
                                <a href="{{ $client->clientdetail->twitter }}">{{ $client->clientdetail->twitter }}</a>

                            </span></p>

                        <p class="mb-2 font-13"><strong>Role :</strong> <span class="ml-2 ">
                                                               {{ $client->roles()->first()->name }}
                            </span></p>


                    </div>

                    <ul class="social-list list-inline mt-3 mb-0">
                        <li class="list-inline-item">
                            <a href="{{ $client->clientdetail->facebook }}" class="social-list-item border-primary text-primary"><i
                                        class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ $client->clientdetail->twitter }}" class="social-list-item border-danger text-danger"><i
                                        class="mdi mdi-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ $client->clientdetail->website }}" class="social-list-item border-info text-info"><i
                                        class="mdi mdi-web"></i></a>
                        </li>
                    </ul>
                </div> <!-- end card-box -->




            </div>



        </div>
        <!-- end row-->

@endsection
