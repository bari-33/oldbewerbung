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
            <h3><strong>Jetzt hizufügen</strong></h3>
        </div>
    </div>
    <form action="{{route('userdetails.store')}}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group col-md-4">
                                <label for="username" class="col-form-label">Benutzername <sub>(kann nicht geändert werden)</sub></label>
                                <input type="text" class="form-control" name="username" placeholder="Benutzername" required >
                            </div>
                          </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="first_name" class="col-form-label">Vorname</label>
                                <input type="text" class="form-control" name="first_name"  id="first_name" placeholder="Vorname" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="last_name" class="col-form-label">Nachname</label>
                                <input type="text" class="form-control" name="last_name"  id="last_name" placeholder="Nachname">
                            </div>
                        </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="password" class="col-form-label">Passwort</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  id="password" placeholder="Passwort" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group col-md-3">
                            <label for="password_confirm" class="col-form-label">Passwort wiederholen</label>
                            <input type="password" class="form-control" name="password_confirmation"  id="password" placeholder="Passwort wiederholen">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                    <div class="row" style="border-bottom: 1px solid black">
                        <div class="col-12">
                            <h4><strong>Kontaktinfo</strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="email" class="col-form-label">E-Mail (erforderlich)</label>
                            <input type="email" class="form-control" name="email"  id="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="telephone" class="col-form-label">Telefon</label>
                            <input type="number" class="form-control" name="telephone" id="telephone" placeholder="Telephone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="website" class="col-form-label">Website</label>
                            <input type="url" class="form-control" name="website"  id="website" placeholder="Website">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="facebook" class="col-form-label">Facebook</label>
                            <input type="url" class="form-control" name="facebook"  id="facebook" placeholder="Facebook">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="website" class="col-form-label">Instagram</label>
                            <input type="url" class="form-control" name="instagram"  id="instagram" placeholder="Instagram">
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
                        <div class="form-group col-md-3">
                            <label for="role" class="col-form-label">Rolle</label>
                            <select name="role" class="form-control" required>

                                @foreach($roles as $role)

                                    @if($role->id=3)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
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
                                <input type="checkbox" name="deutch" value="1" class="form-check-input" id="language">
                                Deutsch
                            </label>
                            </div>
                            <div class="form-check-inline">
                            <label class="form-check-label" for="check1">
                                <input type="checkbox" name="english" value="1" class="form-check-input" id="language">
                                Englisch
                            </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" name="spanish" value="1" class="form-check-input" id="language">
                                    Spanisch
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" name="french" value="1" class="form-check-input" id="language">
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
                                    <input type="checkbox" name="web_designer" value="1" class="form-check-input" id="web_designer">
                                    Webdesigner
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" name="graphic_designer" value="1" class="form-check-input" id="language">
                                    Grafikdesigner
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label" for="media_designer">
                                    <input type="checkbox" name="media_designer" value="1" class="form-check-input" id="media_designer">
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
                                <input type="file" name="profile_picture" class="dropify" data-max-file-size="1M" />
                                <p class="text-muted text-center mt-2 mb-0"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="biographical_information" class="col-form-label">Biografische Angaben</label>
                            <textarea class="form-control" name="biographical_information"  id="biographical_information" placeholder="Biographical Information">
                            </textarea>
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
        CKEDITOR.replace( 'article-ckeditor' );
    </script>

@endsection
