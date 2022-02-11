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
            <h3><strong>Design bearbeiten</strong></h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <form action="{{route('designs.update',[$design->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4" class="col-form-label">Produktname</label>
                                <input type="text" class="form-control" name="design_title" value="{{$design->design_title}}" placeholder="Product Title" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="regular_price" class="col-form-label">Regulärpreis</label>
                                <input type="text" class="form-control" id="regular_price" name="regular_price" value="{{$design->regular_price}}" placeholder="Regular Price" required>
                            </div>


                        <div class="form-group col-md-3">
                            <label for="promotional_price" class="col-form-label">Aktionspreis</label>
                            <input type="text" class="form-control" name="promotional_price" id="promotional_price" value="{{$design->promotional_price}}" placeholder="Promotional Price">
                        </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-5">
                                <div style="padding: 2px;color: black;">Bedienung </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Letter" name="service" {{$design->service=="Letter"?'checked':''}} required>
                                    <label for="service"> Letter </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Resume" name="service" {{$design->service=="Resume"?'checked':''}}>
                                    <label for="service"> Resume </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Motivation" name="service" {{$design->service=="Motivation"?'checked':''}}>
                                    <label for="service"> Motivation </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Package" name="service" {{$design->service=="Package"?'checked':''}}>
                                    <label for="service"> Package </label>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="status" class="col-form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{$design->status==1?'selected':''}}>Online</option>
                                    <option value="0" {{$design->status==0?'selected':''}}>Offline</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tax_class " class="col-form-label">Steuerklasse</label>
                                <select name="tax_class" class="form-control" required>
                                    <option value="0% VAT" {{$design->tax_class=="0% VAT"?'selected':''}}>0% MwSt</option>
                                    <option value="7% VAT" {{$design->tax_class=="7% VAT"?'selected':''}}>7% MwSt</option>
                                    <option value="19% VAT" {{$design->tax_class=="19% VAT"?'selected':''}}>19% MwSt</option>

                                </select>
                            </div>
                        </div>



                        <div class="row">

                            <div class="form-group col-md-3">
                                <label for="category" class="col-form-label">Produkt-Kategorie</label>
                                <select name="category" class="form-control" required>
                                    @foreach($design_categories as $category)
                                        <option value="{{$category->id}}" <?php if($design->product_category==$category->name) echo "selected='selected';" ?> >{{$category->name}}</option>
                                    @endforeach
                                </select>

                            </div>

{{--                            <div class="form-group col-md-3">--}}
{{--                                <label for="category" class="col-form-label">New Category</label>--}}
{{--                                <button id="new_category_button" type="button" class="btn btn-primary waves-effect waves-light">Add Category +</button>--}}
{{--                                <input type="text" style="display: none" class="form-control" name="new_category" id="new_category" placeholder="New Category">--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">



                            <div class="col-lg-4">
                                <div class="mt-3">
                                    <input type="file" name="primary_image" class="dropify" data-default-file="{!! asset('public/img/designs/primary/'.$design->primary_image) !!}" data-max-file-size="1M" />
                                    <p class="text-muted text-center mt-2 mb-0" >Primärbild</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mt-3">
                                    <input type="file" name="secondary_image" class="dropify" data-default-file="{!! asset('public/img/designs/secondary/'.$design->secondary_image) !!}" data-max-file-size="1M" />
                                    <p class="text-muted text-center mt-2 mb-0">Zweites Bild</p>
                                </div>
                            </div>

                        </div>

                        <div class="row">


                        </div>

                        <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" style="border-radius: 25px !important; ">Speichern</button>
                        </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
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

    <script>
        //Validation for price in german format
        var input = document.querySelector('#regular_price');
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9 \,]/, '');
        });
        var input = document.querySelector('#promotional_price');
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9 \,]/, '');
        });
    </script>

@endsection
