@extends('layouts.app')
@section('file_upload_css')
    <!-- Plugins css -->
    <link href="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/libs/dropify/dropify.min.css') !!}" rel="stylesheet" type="text/css" />

@endsection
@section('quill_css')
@php
    dd($$client->clientdetail->first_name);
@endphp
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-6">
            <h3><strong>die Einstellungen</strong></h3>
        </div>
    </div>


    <div class="row mt-2" style="border-right: 1px solid black;border-left: 1px solid black">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('userdetails/updateClient/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                    <div class="row" style="border-bottom: 1px solid black" >
                        <div class="col-12" >
                            <h4><strong>Persönliche Angaben</strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                    <hr/>
                        </div>
                    </div>


                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="nickname" class="col-form-label">Benutzername</label>
                                <input type="text"  class="form-control" name="nickname" value="{{!empty($client->clientdetail->nickname)?$client->clientdetail->nickname:''}}" placeholder="Nickame" required>
                                @error('nickname')
                                <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                          </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="first_name" class="col-form-label">Vorname</label>
                                <input type="text" class="form-control" name="first_name" value="{{!empty($client->clientdetail->first_name)?$client->clientdetail->first_name:''}}" id="first_name" placeholder="First Name" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="last_name" class="col-form-label">Nachname</label>
                                <input type="text" class="form-control" name="last_name" value="{{!empty($client->clientdetail->last_name)?$client->clientdetail->last_name:''}}" id="last_name" placeholder="Last Name">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="email" class="col-form-label">E-mail address</label>
                            <input type="email" class="form-control" name="email" value="{{$client->email}}" id="email" placeholder="Email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="mobile" class="col-form-label">Handynummer</label>
                            <input type="number" class="form-control" name="mobile" value="{{!empty($client->clientdetail->mobile)?$client->clientdetail->mobile:''}}" id="mobile" placeholder="Mobile" >

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="password" class="col-form-label">Passwort</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="password_confirm" class="col-form-label">Passwort wiederholen</label>
                            <input type="password" class="form-control" name="password_confirmation"  id="password_confirmation" placeholder="Confirm Password"
                            >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <input type="file" name="profile_picture" @if(!empty($client->profile_picture))data-default-file="{!! asset('public/img/profiles/'.$client->profile_picture) !!}" @endif class="dropify" data-max-file-size="1M" />
                                <p class="text-muted text-center mt-2 mb-0">Profilbild</p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                    <div class="row" style="border-bottom: 1px solid black">
                        <div class="col-12">
                            <h4><strong>Adresse</strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="address" class="col-form-label">Straße</label>
                            <input type="text" class="form-control" name="street_no" value="{{ $client->clientdetail->street_no }}" id="street_no" placeholder="Street No" required>
                            @error('street_no')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="house_no" class="col-form-label">Hausnummer</label>
                            <input type="text" class="form-control" name="house_no" value="{{$client->clientdetail->house_no}}" id="house_no" placeholder="House No" required>
                            @error('house_no')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="zip_code" class="col-form-label">Postleitzahl</label>
                            <input type="text" class="form-control" name="zip_code" value="{{ $client->clientdetail->zip_code }}" id="zip_code" placeholder="Zip Code" required>
                            @error('zip_code')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="city" class="col-form-label">Stadt</label>
                            <input type="text" class="form-control" name="city" value="{{$client->clientdetail->city}}" id="city" placeholder="City" required>
                            @error('city')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="additional_info" class="col-form-label">Zusätzliche Information</label>
                            <input type="text" class="form-control" name="additional_info" value="{{ $client->clientdetail->additional_info }}" id="additional_info" placeholder="Additional Info" >
                            @error('additional_info')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="country" class="col-form-label">Land</label>
                            <input type="text" class="form-control" name="country" value="{{ $client->clientdetail->country }}" id="country" placeholder="Country" required>
                            @error('country')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                    <div class="row" style="border-bottom: 1px solid black">
                        <div class="col-12">
                            <h4><strong>Web/Soziales Netzwerk</strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="website" class="col-form-label">Website</label>
                            <input type="url" class="form-control" name="website" value="{{!empty($client->clientdetail->website)?$client->clientdetail->website:''}}" id="website" placeholder="Website" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="xing" class="col-form-label">Xing</label>
                            <input type="url" class="form-control" name="xing" value="{{!empty($client->clientdetail->xing)?$client->clientdetail->xing:''}}" id="xing" placeholder="Xing" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="facebook" class="col-form-label">Facebook</label>
                            <input type="url" class="form-control" name="facebook" value="{{!empty($client->clientdetail->facebook)?$client->clientdetail->facebook:''}}" id="facebook" placeholder="Facebook">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="linkedin" class="col-form-label">LinkedIn</label>
                            <input type="url" class="form-control" name="linkedin" value="{{!empty($client->clientdetail->linkedin)?$client->clientdetail->linkedin:''}}" id="linkedin" placeholder="LinkedIn">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="twitter" class="col-form-label">Twitter</label>
                            <input type="url" class="form-control" name="twitter" value="{{!empty($client->clientdetail->twitter)?$client->clientdetail->twitter:''}}" id="twitter" placeholder="Twitter">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="other" class="col-form-label">Andere</label>
                            <input type="url" class="form-control" name="other" value="{{!empty($client->clientdetail->other)?$client->clientdetail->other:''}}" id="other" placeholder="Other">
                        </div>
                    </div>



                    <div class="row pt-2">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" style="border-radius: 25px !important; ">Speichern</button>
                        </div>
                    </div>

                    </form>










                </div> <!-- end card-body -->
            </div>
    <!-- end card-->
        </div> <!-- end col -->
    </div>

<script>

</script>


@endsection
@section('file_upload_js')
    <script>
        $("#new_category_button").click(function(){
    $("#new_category").show();
    });
    </script>

    <script src="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.js') !!}"></script>
    <script src="{!! asset('public/theme/assets/libs/dropify/dropify.min.js') !!}"></script>

    <!-- Init js-->
    <script src="{!! asset('public/theme/assets/js/pages/form-fileuploads.init.js') !!}"></script>
    @endsection
@section('quill_js')

    <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>

        $("#password").change(function(){
            if (!$("#password").val()) {

            }
            else
            {
                $("#password_confirmation").prop('required',true);

            }
        });
    </script>

@endsection
