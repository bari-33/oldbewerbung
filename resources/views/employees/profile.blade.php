@extends('layouts.app')
@section('file_upload_css')
    <!-- Plugins css -->
    <link href="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/libs/dropify/dropify.min.css') !!}" rel="stylesheet" type="text/css" />

@endsection
@section('quill_css')

@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-6">
            <h3><strong>Employee Details</strong></h3>
        </div>
    </div>
    <form action="{{route('employees.update',[$user->id])}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="row mt-2" style="border-right: 1px solid black;border-left: 1px solid black">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="border-bottom: 1px solid black" >
                            <div class="col-12" >
                                <h4><strong>Name</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="username" class="col-form-label">Benutzername <sub>(kann nicht geändert werden)</sub></label>
                                <input type="text"  class="form-control" name="username" value="{{$user->userdetail->username}}" placeholder="User Name" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="first_name" class="col-form-label">Vorname</label>
                                <input type="text" class="form-control" name="first_name" value="{{$first_name}}" id="first_name" placeholder="Vorname" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="last_name" class="col-form-label">Nachname</label>
                                <input type="text" class="form-control" name="last_name" value="{{$last_name}}" id="last_name" placeholder="Nachname">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="password" class="col-form-label">Passwort</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  id="password" placeholder="Passwort" >
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-3">
                                <label for="password_confirm" class="col-form-label">Passwort wiederholen</label>
                                <input type="password" class="form-control" name="password_confirmation"  id="password_confirmation" placeholder="Passwort wiederholen" >
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row" style="border-bottom: 1px solid black">
                            <div class="col-12">
                                <h4><strong>Kontaktinfo / Adresse</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="email" class="col-form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" id="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="telephone" class="col-form-label">Telefon</label>
                                <input type="number" class="form-control" name="telephone" value="{{$user->userdetail->telephone}}" id="telephone" placeholder="Telefon" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="website" class="col-form-label">Website</label>
                                <input type="url" class="form-control" name="website" value="{{$user->userdetail->website}}" id="website" placeholder="Website">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="facebook" class="col-form-label">Facebook</label>
                                <input type="url" class="form-control" name="facebook" value="{{$user->userdetail->facebook}}" id="facebook" placeholder="Facebook">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="website" class="col-form-label">Instagram</label>
                                <input type="url" class="form-control" name="instagram" value="{{$user->userdetail->instagram}}" id="instagram" placeholder="Instagram">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row" style="border-bottom: 1px solid black">
                            <div class="col-12">
                                <h4><strong>Position</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-1" style="color: black;">
                                Texter
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-check-inline">

                                    <label class="form-check-label" for="check1">
                                        <input type="checkbox" name="deutch" value="1" class="form-check-input" id="language" {{$user->userdetail->deutch=="1"?'checked':''}}>
                                        Deutsch
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="check1">
                                        <input type="checkbox" name="english" value="1" class="form-check-input" id="language" {{$user->userdetail->english=="1"?'checked':''}}>
                                        Englisch
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="check1">
                                        <input type="checkbox" name="spanish" value="1" class="form-check-input" id="language" {{$user->userdetail->spanish=="1"?'checked':''}}>
                                        Spanisch
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="check1">
                                        <input type="checkbox" name="french" value="1" class="form-check-input" id="language" {{$user->userdetail->french=="1"?'checked':''}}>
                                        Französich
                                    </label>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-3 mb-1" style="color: black;">
                                Designer
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-check-inline">

                                    <label class="form-check-label" for="check1">
                                        <input type="checkbox" name="web_designer" value="1" class="form-check-input" id="web_designer" {{$user->userdetail->web_designer=="1"?'checked':''}}>
                                        Webdesigner
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="check1">
                                        <input type="checkbox" name="graphic_designer" value="1" class="form-check-input" id="language" {{$user->userdetail->graphic_designer=="1"?'checked':''}}>
                                        Grafikdesigner
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="media_designer">
                                        <input type="checkbox" name="media_designer" value="1" class="form-check-input" id="media_designer" {{$user->userdetail->media_designer=="1"?'checked':''}}>
                                        Mediengestalter
                                    </label>
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
                                <h4><strong>Über den Benutzer</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mt-3">
                                    <input type="file" name="profile_picture" data-default-file="{!! asset('public/img/profiles/'.$user->profile_picture) !!}" class="dropify" data-max-file-size="1M" />
                                    <p class="text-muted text-center mt-2 mb-0">Profilbild</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="biographical_information" class="col-form-label">Biografische Angaben</label>
                                <textarea class="form-control" name="biographical_information" id="biographical_information" placeholder="Biografische Angaben" >{{$user->userdetail->biographical_information}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>


                        <div class="row" style="border-bottom: 1px solid black">
                            <div class="col-12">
                                <h4><strong>Rechnungsadresse</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Name der Firma</label>
                                <input type="text" class="form-control" name="company" value="{{$user->userdetail->company}}" id="" placeholder="Name der Firma" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Straßenname und Nr .</label>
                                <input type="text" class="form-control" name="street_no" value="{{$user->userdetail->street_no}}" id="" placeholder="Straßenname und Nr" >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">.</label>
                                <input type="text" class="form-control" style="display: inline-block" name="house_no" value="{{$user->userdetail->house_no}}" id="house_no" placeholder="Hausnummer" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Zusätzliche Information</label>
                                <input type="text" class="form-control" name="additional_info" value="{{$user->userdetail->additional_info}}" id="additional_info" placeholder="Zusätzliche Information" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Postleitzahl</label>
                                <input type="text" class="form-control" name="zip_code" value="{{$user->userdetail->zip_code}}" id="zip_code" placeholder="Postleitzahl" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Stadt</label>
                                <input type="text" class="form-control" name="city" value="{{$user->userdetail->city}}" id="city" placeholder="Stadt" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Land</label>
                                <input type="text" class="form-control" name="country" value="{{$user->userdetail->country}}" id="country" placeholder="Land" >
                            </div>
                        </div>


                        <div class="row" style="border-bottom: 1px solid black">
                            <div class="col-12">
                                <h4><strong>Auszahlungsinformationen</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Name der Bank</label>
                                <input type="text" class="form-control" name="bank_name" value="{{$user->userdetail->bank_name}}" id="bank_name" placeholder="Name der Bank" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">IBAN</label>
                                <input type="text" class="form-control" name="iban" value="{{$user->userdetail->iban}}" id="iban" placeholder="IBAN" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">BC</label>
                                <input type="text" class="form-control" name="bc" value="{{$user->userdetail->bc}}" id="bc" placeholder="BC" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text" class="col-form-label">Paypal</label>
                                <input type="text" class="form-control" name="paypal" value="{{$user->userdetail->paypal}}" id="paypal" placeholder="Paypal" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>


                        <div class="row pt-2" style="border-top: 1px solid black">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light" style="border-radius: 25px !important; ">Speichern</button>
                            </div>
                        </div>



                    </div> <!-- end card-body -->
                </div>
                <!-- end card-->
            </div> <!-- end col -->
        </div>
    </form>
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
