@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
.pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
</style>

    @endsection
@section('content')


<div class="row mb-4" style="padding-bottom: 0px;border-radius: 0px 0px 25px 25px;background-color: #323759;margin-left: -27px;margin-right: 0px;width: 104%;padding-left: 15px;padding-right: 15px;">
        <div class="col-md-4 mt-3">
                        <h4 class="page-title" style="color:white">Kategorien</h4>
        </div>
        <div class="offset-md-3 col-md-3 text-right mt-3">
            <button style="border-radius: 25px;border-color: white;" class="btn btn-success" onclick="window.location='{{url('categories/create')}}'">Kategorie hinzufügen</button>
        </div>
    <div class="col-md-2 mt-3">
            <input type="text" id="search" style="border-radius: 25px;border-color: white;" class="form-control" placeholder="Search"/>
        </div>
        <div class="page-title-box">
            <div class="page-title-right">

                        </div>
            </div>




    <div class="col-md-5 mb-4">

    </div>
    <div class="col-md-2">

    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-1">
    </div>
</div>


    <!-- TABLE STARTS HERE -->


<!-- Table with panel -->
<div class="card card-cascade narrower pt-4 pb-4">

    <!--Card image-->




    <!--/Card image-->

    <div class="px-4">

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
                        <a>Kategoriename
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Aktion
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                </tr>
                </thead>
                <!--Table head-->

                <!--Table body-->
                <tbody>
                @foreach($products as $product)
                <tr>
                    <th scope="row">
                        <input class="form-check-input" id="checkbox" type="checkbox">
                        <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                    </th>

                    <td>{{$product->name}}</td>
                    <td><button onclick="window.location='{{url('categories/edit/'.$product->id.'/1')}}'" class="btn btn-primary btn-sm mr-2"><i class="ti-pencil"></i></button>

                        <a href="{{url('categories/delete/'.$product->id.'/1')}}" class="delete-confirm  btn btn-danger btn-sm"><i class="ti-close"></i></a>
                    </td>
                </tr>
                @endforeach
                @foreach($designs as $design)
                    <tr>
                        <th scope="row">
                            <input class="form-check-input" id="checkbox" type="checkbox">
                            <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                        </th>

                        <td>{{$design->name}}</td>
                        <td><button onclick="window.location='{{url('categories/edit/'.$design->id.'/2')}}'" class="btn btn-primary btn-sm mr-2"><i class="ti-pencil"></i></button>

                                                  <a href="{{url('categories/delete/'.$product->id.'/2')}}" class="delete-confirm  btn btn-danger btn-sm"><i class="ti-close"></i></a>

                        </td>
                    </tr>
                @endforeach
                @foreach($websites as $website)
                    <tr>
                        <th scope="row">
                            <input class="form-check-input" id="checkbox" type="checkbox">
                            <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                        </th>

                        <td>{{$website->name}}</td>
                        <td><button onclick="window.location='{{url('categories/edit/'.$website->id.'/3')}}'" class="btn btn-primary btn-sm mr-2"><i class="ti-pencil"></i></button>


                        <a href="{{url('categories/delete/'.$product->id.'/3')}}" class="delete-confirm  btn btn-danger btn-sm"><i class="ti-close"></i></a>
                        </td>
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
        });
        $("#checkbox").click(function () {
    		 $('input:checkbox').not(this).prop('checked', this.checked);
		 });
    </script>

@endsection
