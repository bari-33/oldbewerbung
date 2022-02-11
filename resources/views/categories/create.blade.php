@extends('layouts.app')

@section('content')
    <div class="row mt-2">
        <div class="col-md-6">
            <h3><strong>Kategorie hinzufügen</strong></h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <form action="{{url('/categories')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="category" class="col-form-label">Kategorie</label>
                                <select name="category" class="form-control" required>
                                    <option value="1">Produkt</option>
                                    <option value="2">Design</option>
                                    <option value="3">Website</option>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="name" class="col-form-label">Kategoriename</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Kategoriename" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
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

    <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>

@endsection
