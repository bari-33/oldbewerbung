@extends('layouts.app')

@section('content')
    <div class="row mt-2">
        <div class="col-md-6">
            <h3><strong>Frequently Asked Questions</strong></h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Add New FAQ</h4>
                        </div>
                    </div>
                    <form action="{{url('faqs')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="category" class="col-form-label">Set Public</label>
                                <select name="set_public" class="form-control" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="question" class="col-form-label">Question</label>
                                <textarea name="question" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="answer" class="col-form-label">Reply</label>
                                <textarea name="answer" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="answer" class="col-form-label">Send Mail</label>
                                <input type="checkbox" name="email" value="1">

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