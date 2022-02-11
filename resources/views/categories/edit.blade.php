@extends('layouts.app')

@section('content')
    <div class="row mt-2">
        <div class="col-md-6">
            <h3><strong>Kategorie bearbeiten</strong></h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <form action="{{url('categories/update/'.$data->id.'/'.$flag)}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name" class="col-form-label">Kategoriename</label>
                                <input type="text" class="form-control" name="name" value="{{$data->name}}" placeholder="Category Name" required>
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
