@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Meine Aufgaben</h4>
            </div>
        </div>
    </div>


    <!-- end row -->



    <!-- Table with panel -->



    <div class="row">

        <div class="col-xl-12">
            <div class="card-box">
                <h4 class="header-title mb-3">Meine Aufgaben</h4>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="search"autocomplete="off" value="" placeholder="&#xF002; Search..."
                        style="font-family:Arial, FontAwesome">
                      </div>
                      @foreach($orders as $order)
                      <?php
                      $data = explode(',', $order->user_id);
                       foreach ($data as $key => $value) {
                      ?>
                      @if ($value==$user->id)

                        <div class="container mt-4" id="allsearch">
                            <div>
                            <h3>{{$order->pdetail->product_title}}</h3>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">
                            @if ($order->pdetail->product_title=="Bewerbung Optimierung")
                        <input type="checkbox">
                        <span>Wir korrigieren Ihr Anschreiben und Lebenslauf und geben Ihnen Verbesserungsvorschl&auml;ge und Tipps. Die verbesserten Unterlagen erhalten Sie als PDF-Dateien.</span>
                        <hr style="border: 0.3px solid lightgrey;width: 100%;">


                        @endif
                        @if ($order->pdetail->product_title=="1 × Lebenslauf erstellen")
                        <input type="checkbox">
                        <span>Individueller Lebenslauf.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Bewerbungs-Deckblatt.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Word (.docx) &amp; PDF-Datei.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Premium Design (Optional).</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Bewerbungshomepage (Optional).</span>
                        @endif
                        @if ($order->pdetail->product_title=="Bewerbungspaket Standard")
                        <input type="checkbox">
                        <span>Pers&ouml;nliches Anschreiben.</span>
                          <hr style="border: 0.2px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Individueller Lebenslauf.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Bewerbungs-Deckblatt.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Word (.docx) &amp; PDF-Datei.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Premium Design (Optional).</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <input type="checkbox">
                        <span>Bewerbungshomepage (Optional).</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        <p><strong>F&uuml;r Fachkr&auml;fte | Angestellte | absolvierte Berufsausbildung</strong></p>
                        <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        @endif
                        @if ($order->pdetail->product_title=="Bewerbungspaket Advanced")
                        <input type="checkbox">
                        <span>Erstellung &ndash; Komplette Bewerbung.</span>
                        <hr style="border: 0.3px solid lightgrey;width: 100%;">
                        <input type="checkbox">
                        <span>Deckblatt, Anschreiben und Lebenslauf.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">
                        <input type="checkbox">
                        <span>Bearbeitbare Word-Datei inkl. PDF.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">
                        <input type="checkbox">
                        <span>Modernes Bewerbungsdesign.</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">
                        <input type="checkbox">
                        <span>Premium Design (Optional).</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">
                        <input type="checkbox">
                        <span>Bewerbungshomepage&nbsp;(optional).</span>
                          <hr style="border: 0.3px solid lightgrey;width: 100%;">
                        <p><strong>F&uuml;r F&uuml;hrungskr&auml;fte | Akademiker | Management</strong></p>
                        <hr style="border: 0.3px solid lightgrey;width: 100%;">

                        @endif
                    </div>
                        </div>
                         @endif
                         <?php
                        }
                          ?>
                         @endforeach

            </div> <!-- end card-box-->
        </div> <!-- end col -->
        <!-- Todos app -->
    </div> <!-- end row -->
@endsection


@section('quill_js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
            $("#search").on("keyup", function() {
            var value = $(this).val();
            $("#allsearch  div").filter(function() {

                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

        });
    });
    </script>
@endsection
