@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    </style>

@endsection
@section('content')



    <div class="row mb-4" style="padding-bottom: 0px;border-radius: 0px 0px 25px 25px;background-color: #323759;margin-left: -27px;margin-right: 0px;width: 104%;padding-left: 15px;padding-right: 15px;">
        <div class="col-md-4">
            <h4 class="page-title ml-2 mt-3" style="color: #FFF;">Tasks</h4>
        </div>
        <div class="offset-md-3 col-md-3 mt-3 text-right" >
            <button class="btn btn-success" style="border-radius: 25px;border-color: white;" onclick="window.location='{{url('orders')}}'"><i class="fa fa-plus"></i>  Rechnung erstellen</button>
        </div>
        <div class="col-md-2 mt-3 text-left">
            <input type="text" id="search" style="border-radius: 25px;border-color: white;" class="form-control"   placeholder="Suchen" />
        </div>
        <div class="page-title-box">
            <div class="page-title-right">

            </div>
        </div>
        <div class="col-md-12 mb-2 mt-5" style="background-color: #3b3f77;border-radius: 25px;border: 2px solid #3b3f77;padding: 10px 0px 10px 0px;">
            <center>



                <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="all" class="btn btn-primary">Alle |  </button>

                <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="progress" class="btn btn-primary">In Bearbeitung  </button>

                <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="waiting" class="btn btn-primary">In Wartestellung  </button>

                <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="completed" class="btn btn-primary">Fertig  </button>

                <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="cancelled" class="btn btn-primary">Storniert </button>

                <button type="submit" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" name="action" value="deleted" class="btn btn-primary">Gelöscht </button>

                <div class="dropdown" style="display: inline;">
                  <button type="button" style="background-color: #3b3f77;border-radius: 25px;border-color: white;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Letzte 30 Tage <i class="fa fa-chevron-down"></i>
                  </button>
                {{-- </form> --}}
            </center>
        </div>
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


    <script>
        $(document).ready(function() {
            $('#invoiceDownload').on('click', function (e) {
                e.preventDefault();
                window.open('{{url('invoices/pdf').'/'}}'+$(this).attr('data-id'), '_blank');

            });

            $('#uploadDocuments').on('click', function (e) {
                e.preventDefault();
                window.open('{{url('adminorders/').'/'}}'+$(this).attr('data-id')+'/edit', '_blank');

            });
        });

		$("#checkAll").click(function () {
    		 $('input:checkbox').not(this).prop('checked', this.checked);
		 });

    </script>
@endsection


