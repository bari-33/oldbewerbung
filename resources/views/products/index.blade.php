@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    </style>

@endsection
@section('content')

    <div class="row mb-4" style="padding-bottom: 0px;border-radius: 0px 0px 25px 25px;background-color: #323759;margin-left: -27px;margin-right: 0px;width: 104%;padding-left: 15px;padding-right: 15px;">
        <div class="col-md-4 mt-3 mb-3">
            <h4 class="page-title" style="color:white"><strong>Produkte</strong></h4>
        </div>
        <div class="offset-md-4 col-md-2 mt-3" style="margin-right: -1%">
            <button style="border-radius: 25px;" class="btn btn-success" onclick="window.location='{{url('products/create')}}'">Produkt hinzufügen</button>
        </div>
        <div class="col-md-2 mt-3">
            <input type="text" style="border-radius: 25px;" id="search" class="form-control" placeholder="Search"/>
        </div>

        <div class="page-title-box">
            <div class="page-title-right">

            </div>
        </div>




        <div class="col-md-8 mb-4 ml-2" style="background-color: #3b3f77;border-radius: 25px;border: 2px solid #3b3f77;padding: 10px 0px 10px 0px;">
            <center>
            <form action="{{url('products/search')}}" method="POST" style="display: inline;">
                @csrf

                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="all" class="btn btn-primary">Alle | {{session('count')}} </button>


                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="published" class="btn btn-primary">Veröffentlichte | {{session('published')}} </button>

                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="draft" class="btn btn-primary">Entwurf | {{session('draft')}} </button>

                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="deleted" class="btn btn-primary">Gelöscht | {{session('deleted')}} </button>

                </form>
                <div class="dropdown" style="display: inline;background-color: #3b3f77;border-radius: 25px;border-color: white;">
                  <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Kategorie <i class="fa fa-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu">

                    @foreach($product_categories as $category)
                    <a class="dropdown-item category_list" data-id="{{$category->id}}" href="#">{{$category->name}} ({{$category->count}})</a>

                    @endforeach
                   <form action="{{url('products/search')}}" id="category_form" name="form" method="POST">
                            @csrf
                            <input type="hidden" name="category" id="selected_category">
                            <input type="hidden" name="action" value="category">
                            <input type="submit" style="display: none;" name="submit_category" id="submit_category">
                    </form>

                  </div>

                </div>
            </center>

        </div>
        <div class="col-md-2">
        </div>
       <!--  <div class="col-md-1">
            <a href="{{url('products')}}"><button class="btn btn-primary">Produkte</button></a>
        </div>
        <div class="col-md-1">
            <a href="{{url('designs')}}"><button class="btn btn-primary">Designs</button></a>
        </div>
        <div class="col-md-1">
            <a href="{{url('websites')}}"><button class="btn btn-primary">Homepage</button></a>
        </div> -->
    </div>
<!-- end row-->


    <!-- TABLE STARTS HERE -->

<!-- Table with panel -->
<div class="card card-cascade narrower">

    <!--Card image-->


    <!--/Card image-->

    <div class="px-4 pt-4 pb-4">

        <div class="table-wrapper">
            <!--Table-->
            <table id="designtable" class="table mb-0" style="color: #000;">

                <!--Table head-->
                <thead>
                <tr>
                    <th>
                        <input class="form-check-input" id="checkbox" type="checkbox">
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
                        <a href="">Preis
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Sprache
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Gehoben
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Beschreibung
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
                @foreach($products as $product)
                <tr>
                    <th scope="row">
                        <input class="form-check-input" type="checkbox" id="checkbox1">
                        <label class="form-check-label" for="checkbox1" class="label-table"></label>
                    </th>
                    <td>{{$product->id}}</td>
                    <td>{{$product->product_title}}</td>
                    <td>{{$product->regular_price}}</td>
                    <td>{{$product->language}}</td>
                    <td>{{$product->popular}}</td>
                    <td>{!!$product->product_description!!}</td>
                    @if($trash==false)
                    <td><button onclick="window.location='{{url('products/'.$product->id.'/edit')}}'" class="btn btn-primary btn-sm mr-2"><i class="ti-pencil"></i></button>

                        <a href="{{url('product/destroy',['id'=>$product->id])}}" class="delete-confirm  btn btn-danger btn-sm"><i class="ti-close"></i></a>


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
                $("#designtable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#designtable').DataTable();

            $('.category_list').click(function(){

                id = $(this).attr('data-id');

                $('#selected_category').val(id);
                $('#submit_category').click();
            });
        });
        $("#checkbox").click(function () {
    		 $('input:checkbox').not(this).prop('checked', this.checked);
		 });
    </script>

@endsection
