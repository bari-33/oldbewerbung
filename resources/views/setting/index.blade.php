@extends('layouts.app')
@section('file_upload_css')
    <!-- Plugins css -->
    <link href="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/libs/dropify/dropify.min.css') !!}" rel="stylesheet" type="text/css" />
<style>
    .line{
        margin-top: 17%;
        display: inline-block;
        height: 1px;
        position: relative;
        vertical-align: middle;
        width: 100%;
        margin-left: 130px;
    }
    .sixe{
        margin-left: 150px;
        margin-top: 5%;
    }
    </style>
@endsection
@section('quill_css')

@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-6">
            <h3 class= "ml-4" style="color: #4a4da5"><strong>Settings</strong></h3>
        </div>
    </div>
    <div class="container">
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    {{-- <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" name="form"> --}}
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name"  placeholder="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="regular_price" class="col-form-label">Suname</label>
                                <input type="text" class="form-control" name="Suname" placeholder="Suname" required>
                            </div>


                        <div class="form-group col-md-6">
                            <label for="promotional_price" class="col-form-label">E-mail address</label>
                            <input type="text" class="form-control" name="promotional_price" id="promotional_price" placeholder="Aktionspreis">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="promotional_price" class="col-form-label">Mobile</label>
                            <input type="text" class="form-control" name="promotional_price" id="promotional_price" placeholder="Aktionspreis">
                        </div>
                        <div class="col-md-4">
                            <hr class="line" style="border:2px;color :#4a4da5;background-color:#4a4da5 ">
                            </div>
                            <label class="sixe text-primary">Address</label>

                            <div class="col-md-4">
                                <hr class="line " style=" border:2px;color :#4a4da5;background-color:#4a4da5 ">
                                </div>
                                <div class="form-group col-md-10">
                                    <label for="promotional_price" class="col-form-label">Mobile</label>
                                    <input type="text" class="form-control" name="promotional_price" id="promotional_price" placeholder="Aktionspreis">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="promotional_price" class="col-form-label">Mobile</label>
                                    <input type="text" class="form-control" name="promotional_price" id="promotional_price" placeholder="Aktionspreis">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="promotional_price" class="col-form-label">Mobile</label>
                                    <input type="text" class="form-control" name="promotional_price" id="promotional_price" placeholder="Aktionspreis">
                                </div>
                                <div class="form-group col-md-10">
                                    <label for="promotional_price" class="col-form-label">Mobile</label>
                                    <input type="text" class="form-control" name="promotional_price" id="promotional_price" placeholder="Aktionspreis">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="promotional_price" class="col-form-label">Mobile</label>
                                    <input type="text" class="form-control" name="promotional_price" id="promotional_price" placeholder="Aktionspreis">
                                </div>
                        </div>

                        </form>
                </div>
            </div>
        </div>
    </div>

@endsection
