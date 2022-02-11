@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    </style>

@endsection
@section('content')

    <div class="row mb-4" style="    padding-bottom: 31px; border-radius: 0% 0% 11% 11%;background-color: #323759 ">
        <div class="col-md-4 offset-md-6">
            <h4 class="page-title">Users</h4>
        </div>
        <div class="col-md-2">
            <button class="btn btn-success" onclick="window.location='{{url('userdetails/create')}}'">Add User</button>
            <input type="text" id="search" class="form-control" placeholder="Search"></input>

        </div>
        <div class="page-title-box">
            <div class="page-title-right">

            </div>
        </div>




        <div class="col-md-5 mb-4">

            <form action="{{url('userdetails/search')}}" method="POST">
                @csrf

                <button type="submit" name="action" value="all" class="btn btn-primary">All | {{session('all')}} </button>


                <button type="submit" name="action" value="admins" class="btn btn-primary">Admins | {{session('admins')}} </button>

                <button type="submit" name="action" value="clients" class="btn btn-primary">Clients | {{session('clients')}} </button>



            </form>
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
                        <input class="form-check-input" type="checkbox" id="checkbox">
                        <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                    </th>
                    <th class="th-lg">
                        <a>Username
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Name
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Email
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Telephone
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Created On
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <th class="th-lg">
                        <a href="">Action
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <!--Table head-->

                <!--Table body-->
                <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">
                        <input class="form-check-input" type="checkbox" id="checkbox1">
                        <label class="form-check-label" for="checkbox1" class="label-table"></label>
                    </th>
                    <td>@if(!empty($user->userdetail->username))
                            {{$user->userdetail->username}}
                            @endif
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>@if(!empty($user->userdetail->telephone))
                            {{$user->userdetail->telephone}}
                        @endif</td>
                    <td>{{$user->created_at}}</td>
                    <td><button onclick="window.location='{{url('userdetails/'.$user->id.'/edit')}}'" class="btn btn-primary btn-sm mr-2"><i class="ti-pencil"></i></button><form action="{{url('userdetails/'.$user->id)}}" method="POST" style="display: inline-block">@method('DELETE') @csrf <button class="btn btn-danger btn-sm"><i class="ti-close"></i></button></form></td>
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

    </script>

@endsection