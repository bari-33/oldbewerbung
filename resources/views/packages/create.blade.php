@extends('layouts.app')
@section('file_upload_css')
    <!-- Plugins css -->
    <link href="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/libs/dropify/dropify.min.css') !!}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-6">
            <h3><strong>Add Packages</strong></h3>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <form action="{{route('packages.store')}}" method="POST" enctype="multipart/form-data" name="form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4" class="col-form-label">Title</label>
                                <input type="text" class="form-control" name="package_title"  placeholder="Product Title" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="price" class="col-form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label class="form-check-label ml-2" for="popular">
                                    <input type="checkbox" name="popular" value="1" class="form-check-input" id="popular">
                                    Popular
                                </label>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-5">
                                <div style="padding: 2px;color: black;">Language </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="German" name="language" required>
                                    <label for="language"> German </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="English" name="language">
                                    <label for="language"> English </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="Spanish" name="language">
                                    <label for="language"> Spanish </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" value="French" name="language">
                                    <label for="language"> French </label>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-lg-4">
                                <div class="mt-3">
                                    <input type="file" name="package_image" class="dropify" data-max-file-size="1M" required />
                                    <p class="text-muted text-center mt-2 mb-0">Package Image</p>
                                </div>
                            </div>
                            </div>




                        <div class="row">
                            <div class="col-12">
                                <h3>Description</h3>

                                <textarea name="package_description" id="article-ckeditor"  cols="30" rows="10" required></textarea>
                                <!-- end card-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light" style="border-radius: 25px !important; ">Save</button>
                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

@endsection


@section('quill_js')

    <script src="{!! asset('public/theme/assets/libs/dropzone/dropzone.min.js') !!}"></script>
    <script src="{!! asset('public/theme/assets/libs/dropify/dropify.min.js') !!}"></script>

    <!-- Init js-->
    <script src="{!! asset('public/theme/assets/js/pages/form-fileuploads.init.js') !!}"></script>

    <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );

        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['article-ckeditor'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'This Field is Required' );
                e.preventDefault();
            }
        });
    </script>

@endsection
