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
            <h3><strong>Produkt bearbeiten</strong></h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <form name="form" action="{{route('products.update',[$product->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4" class="col-form-label">Produktname</label>
                                <input type="text" class="form-control" name="product_title" value="{{$product->product_title}}" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="regular_price" class="col-form-label">Regulärpreis</label>
                                <input type="text" class="form-control" id="regular_price" value="{{$product->regular_price}}" name="regular_price" placeholder="Regular Price" required>
                            </div>


                        <div class="form-group col-md-3">
                            <label for="promotional_price" class="col-form-label">Aktionspreis</label>
                            <input type="text" class="form-control" name="promotional_price" value="{{$product->promotional_price}}" id="promotional_price" placeholder="Promotional Price">
                        </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="subtitle" class="col-form-label">Untertitel</label>
                                <input type="text" class="form-control" name="subtitle" value="{{$product->product_subtitle}}" id="subtitle" placeholder="Subtitle" required>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="status" class="col-form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{$product->status==1?'selected':''}}>Online</option>
                                    <option value="0" {{$product->status==0?'selected':''}}>Offline</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tax_class " class="col-form-label">Steuerklasse</label>
                                <select name="tax_class" class="form-control" required>
                                    <option value="0% VAT" {{$product->tax_class=="0% VAT"?'selected':''}}>0% MwSt</option>
                                    <option value="7% VAT" {{$product->tax_class=="7% VAT"?'selected':''}}>7% MwSt</option>
                                    <option value="19% VAT" {{$product->tax_class=="19% VAT"?'selected':''}}>19% MwSt</option>

                                </select>
                            </div>
                        </div>



                        <div class="row">

                            <div class="form-group col-md-5">
                               <div style="padding: 2px;color: black;">Sprache </div>
                            <div class="radio form-check-inline">
                                <input type="radio" value="Deutsch" {{$product->language=="Deutsch"?'checked':''}} name="language" required>
                                <label for="language"> Deutsch </label>
                            </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Englisch" {{$product->language=="Englisch"?'checked':''}} name="language">
                                    <label for="language"> Englisch </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Spanisch" {{$product->language=="Spanisch"?'checked':''}} name="language">
                                    <label for="language"> Spanisch </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Französisch" {{$product->language=="Französisch"?'checked':''}} name="language">
                                    <label for="language"> Französisch </label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mt-3">
                                    <input type="file" name="product_image" class="dropify" data-default-file="{!! asset('public/img/products/'.$product->product_image) !!}"  data-max-file-size="1M" />
                                    <p class="text-muted text-center mt-2 mb-0">Produktbild</p>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="popular" class="col-form-label">Gehoben</label>
                                <select name="popular" class="form-control" required>
                                    <option value="1" {{$product->getOriginal('popular')=="1"?'selected':''}}>Ja</option>
                                    <option value="0" {{$product->getOriginal('popular')=="0"?'selected':''}}>Nein</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="category" class="col-form-label">Produkt-Kategorie</label>
                                <select name="category" class="form-control" required>
                                  @foreach($product_categories as $category)
                                      <option value="{{$category->id}}" {{$product->product_category==$category->id?'selected':''}}>{{$category->name}}</option>
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
                        <div class="col-12">
                            <h3>Produktbeschreibung</h3>

                            <textarea name="product_description" id="article-ckeditor"  cols="30" rows="10">
                                {{$product->product_description}}

                            </textarea>
                            <!-- end card-->
                        </div>
                        </div>
                        <br>
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

    <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
        //Validation for price in german format
        var input = document.querySelector('#regular_price');
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9 \,]/, '');
        });
        var input = document.querySelector('#promotional_price');
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9 \,]/, '');
        });

        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['article-ckeditor'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'This Field is Required' );
                e.preventDefault();
            }
        });
    </script>

@endsection
