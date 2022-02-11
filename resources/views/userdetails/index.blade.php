@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    </style>

@endsection
@section('content')

    <div class="row mb-4" style=" padding-bottom: 0px;border-radius: 0px 0px 25px 25px;background-color: #323759;margin-left: -27px;margin-right: 0px;width:104%;padding-left: 15px;padding-right: 15px;">
        <div class="col-md-4 mt-2">
            <h4 class="page-title" style="color:white">Benutzer</h4>
        </div>
        <div class="offset-md-4 col-md-2 mt-3 text-right" style="margin-right: -1%">
            <button class="btn btn-success" style="border-radius: 25px;border-color: white;" onclick="window.location='{{url('userdetails/create')}}'"><i class="fas fa-user-plus ml-1"></i> Jetzt hizufügen</button>
        </div>
        <div class="col-md-2 mt-3">
            <input type="text" id="search" style="border-radius: 25px;border-color: white;" class="form-control" placeholder="Suchen" />
        </div>
        <div class="page-title-box">
            <div class="page-title-right">

            </div>
        </div>




        <div class="col-md-5 mb-4 ml-2" style="background-color: #3b3f77;border-radius: 25px;
  border: 2px solid #3b3f77;
  padding: 10px 0px 10px 0px;">
            <center>
            <form action="{{url('userdetails/search')}}" method="POST" >
                @csrf

                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="all" class="btn btn-primary">Alle | {{session('all')}} </button>


                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="admins" class="btn btn-primary">Admin | {{session('admins')}} </button>

              {{--  <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="clients" class="btn btn-primary">Clients | {{session('clients')}} </button>
--}}
                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="customers" class="btn btn-primary">Kunden | {{session('customers')}} </button>

                <button style="background-color: #3b3f77;border-radius: 25px;border-color: white;" type="submit" name="action" value="employees" class="btn btn-primary">Mitarbeiter | {{session('employees')}} </button>



            </form>
            </center>
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
                    <th class="th-lg">
                        <input class="form-check-input" id="checkAll" type="checkbox">
                        <label class="form-check-label" for="checkbox" class=" label-table"></label>
                    </th>
                   <!--  <th class="th-lg">
                        <a>Benutzername
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th> -->
                    <th class="th-lg">
                        <a href="">Name
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">E-mail
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Telefon
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="">Erstellt am
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
                @foreach($users as $user)
                <tr>
                    <th scope="row">
                        <input class="form-check-input" type="checkbox" id="checkbox1">
                        <label class="form-check-label" for="checkbox1" class="label-table"></label>
                    </th>
                   <!--  <td>@if(!empty($user->userdetail->username))
                            {{$user->userdetail->username}}
                            @endif
                    </td> -->
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>@if(!empty($user->userdetail->telephone))
                            {{$user->userdetail->telephone}}
                        @endif</td>
                    <td>{{$user->created_at}}</td>
                    <td><button @if($user->roles()->first()->slug=='admin'||$user->roles()->first()->slug=='employee') onclick="window.location='{{url('userdetails/'.$user->id.'/edit')}}'" @elseif($user->roles()->first()->slug=='customer') onclick="window.location='{{url('userdetails/'.$user->id.'/edit')}}'"  @endif class="btn btn-primary btn-sm mr-2"><i class="ti-pencil"></i></button>



                        <a href="{{url('userdetails/delete/'.$user->id)}}" class="delete-confirm  btn btn-danger btn-sm"><i class="ti-close"></i></a>


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
    $(document).ready(function() {
        $("#checkAll").click(function () {
    		 $('input:checkbox').not(this).prop('checked', this.checked);
		 });
    });
    </script>

@endsection
