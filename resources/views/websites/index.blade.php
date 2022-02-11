@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    </style>

@endsection
@section('content')
<!-- end row-->


<div class="row mb-4" style="padding-bottom: 0px;border-radius: 0px 0px 25px 25px;background-color: #323759;margin-left: -27px;margin-right: 0px;width: 104%;padding-left: 15px;padding-right: 15px;">
    <div class="col-md-4 mt-3 mb-3">
        <h4 class="page-title" style="color:white">Homepage</h4>
    </div>
    <div class="offset-md-3 col-md-3 mt-3 text-right" style="margin-right: -1%">
        <button class="btn btn-success" style="border-radius: 25px;border-color: white;" onclick="window.location='{{url('websites/create')}}'">HomePage hinzufügen</button>
    </div>
    <div class="col-md-2 mt-3">
        <input type="text" id="search" style="border-radius: 25px;border-color: white;" class="form-control" placeholder="Search"/>
    </div>
    <div class="page-title-box">
        <div class="page-title-right">

        </div>
    </div>




    <div class="col-md-6 mb-4" style="background-color: #3b3f77;border-radius: 25px;border: 2px solid #3b3f77;padding: 10px 0px 10px 0px;">
            <center>

        <form action="{{url('websites/search')}}" method="POST">
            @csrf

            <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="all" class="btn btn-primary">Alle | {{session('count')}} </button>


            <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="published" class="btn btn-primary">Veröffentlichte | {{session('published')}} </button>

            <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="draft" class="btn btn-primary">Entwurf | {{session('draft')}} </button>

            <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="deleted" class="btn btn-primary">Gelöscht | {{session('deleted')}} </button>


        </form>
    </center>
    </div>
    <div class="col-md-2">
        <form action="{{url('websites/searchCategory')}}" name="form" method="POST">
            @csrf
            <select name="category" class="form-control" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" onchange="this.form.submit()" >
                <option value="">Kategorie</option>


                @foreach($product_categories as $category)
                    <option value="{{$category->id}}">{{$category->name}} ({{$category->count}})</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="col-md-1">
        <a href="{{url('products')}}"><button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" class="btn btn-primary">Produkte</button></a>
    </div>
    <div class="col-md-1">
        <a href="{{url('designs')}}"><button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" class="btn btn-primary">Designs</button></a>
    </div>
    <div class="col-md-1">
        <a href="{{url('websites')}}"><button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" class="btn btn-primary">Homepage</button></a>
    </div>
</div>
    <!-- TABLE STARTS HERE -->


<!-- Table with panel -->
<div class="card card-cascade narrower pt-4 pb-4">

    <!--Card image-->

    <!--/Card image-->

    <div class="px-4 ">

        <div class="table-wrapper">
            <!--Table-->
            <table id="websitetable" class="table mb-0" style="color: #000;">

                <!--Table head-->
                <thead>
                <tr>
                    <th>
                        <input class="form-check-input" id="checkbox" type="checkbox" >
                        <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                    </th>
                    <th class="th-lg">
                        <a>ProdukteID
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Titel
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Primärbild
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Zweites Bild
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Preis
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <th class="th-lg">
                        <a href="">Farbe
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    @if($trash==false)
                    <th class="th-lg">
                        <a href="">Aktion
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                        @endif
                </tr>
                </thead>
                <!--Table head-->

                <!--Table body-->
                <tbody>
                @foreach($websites as $website)
                <tr>
                    <th scope="row">
                        <input class="form-check-input" type="checkbox" id="checkbox1">
                        <label class="form-check-label" for="checkbox1" class="label-table"></label>
                    </th>
                    <td>{{$website->id}}</td>
                    <td>{{$website->website_title}}</td>
                    <td><img src="{!! asset('public/img/websites/primary/'.$website->primary_image) !!}" width="150" height="150"  class="img-thumbnail"></td>
                    <td><img src="{!! asset('public/img/websites/secondary/'.$website->secondary_image) !!}" width="150" height="150" class="img-thumbnail"></td>
                    <td>{{$website->regular_price}}</td>
                    <td>{!!$website->product_category!!}</td>
                    @if($trash==false)
                    <td><button onclick="window.location='{{url('websites/'.$website->id.'/edit')}}'" class="btn btn-primary btn-sm mr-2"><i class="ti-pencil"></i></button>


                        <a href="{{url('websites/destroy',['id'=>$website->id])}}" class="delete-confirm  btn btn-danger btn-sm"><i class="ti-close"></i></a>


                    </td>
                     @endif
                </tr>
                @endforeach

                </tbody>
                <!--Table body-->
            </table>
            <!--Table-->
        </div>

    </div>

</div>
<!-- Table with panel -->
@endsection

@section('quill_js')

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#websitetable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#websitetable').DataTable();
        });
        $("#checkbox").click(function () {
    		 $('input:checkbox').not(this).prop('checked', this.checked);
		 });
    </script>

@endsection
