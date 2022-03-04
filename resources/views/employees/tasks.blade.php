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
                    <input type="text" class="form-control" id="search" autocomplete="off" value=""
                        placeholder="&#xF002; Search..." style="font-family:Arial, FontAwesome">
                </div>




                @foreach ($orders as $order)
                    <?php
                      $data = explode(',', $order->user_id);
                      foreach ($data as $key => $value) {
                      ?>
                    @if ($value == $user->id)
                    <?php
                      $checked = explode(',', $order->check_box);
                     ?>

                        <div class="container mt-4" id="allsearch">
                            <div>
                                {{-- <h3>{{ $order->pdetail->product_title }}</h3> --}}

                                @if ($order->pdetail->product_title == 'Bewerbung Optimierung')

                                <h3>{{ $order->pdetail->product_title }}</h3>

                                <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                <?php
                                 $data="12";
                                    if (in_array($data, $checked)) {
                                ?>

                                    <input class="check" id="checkbox1" type="checkbox"
                                        value="{{ $order->id }}" data-id="12" data-name ="2" checked>
                                        <?php
                                        }else {
                                            ?>
                                             <input class="check" id="checkbox1" type="checkbox"
                                             value="{{ $order->id }}" data-id="12" data-name ="2" required>
                                            <?php

                                        }
                                        ?>
                                    <span>Wir korrigieren Ihr Anschreiben und Lebenslauf und geben Ihnen
                                        Verbesserungsvorschl&auml;ge und Tipps. Die verbesserten Unterlagen erhalten Sie als
                                        PDF-Dateien.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                @endif
                                @if ($order->pdetail->product_title == '1 × Lebenslauf erstellen')
                                <h3>{{ $order->pdetail->product_title }}</h3>
                                <hr style="border: 0.3px solid lightgrey;width: 100%;">
                                <?php
                                $data="14";
                             if (in_array($data, $checked)) {
                                  ?>
                              <input class="check" id="checkbox1" type="checkbox"
                              value="{{ $order->id }}" data-id="14" data-name ="3" checked>
                              <?php
                              }else {
                                  ?>

                               <input class="check" id="checkbox1" type="checkbox"
                              value="{{ $order->id }}" data-id="14" data-name ="3" >
                              <?php
                              }
                              ?>


                                    <span>Individueller Lebenslauf.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                    $data="15";
                                 if (in_array($data, $checked)) {
                                      ?>
                                  <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="15" data-name ="3" checked>
                                  <?php
                                  }else {
                                      ?>

                                   <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="15" data-name ="3" >
                                  <?php
                                  }
                                  ?>


                                    <span>Bewerbungs-Deckblatt.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                $data="16";
                             if (in_array($data, $checked)) {
                                  ?>
                              <input class="check" id="checkbox1" type="checkbox"
                              value="{{ $order->id }}" data-id="16" data-name ="3" checked>
                              <?php
                              }else {
                                  ?>

                               <input class="check" id="checkbox1" type="checkbox"
                              value="{{ $order->id }}" data-id="16" data-name ="3" >
                              <?php
                              }
                              ?>


                                    <span>Word (.docx) &amp; PDF-Datei.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                    $data="17";
                                 if (in_array($data, $checked)) {
                                      ?>
                                  <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="17" data-name ="3" checked>
                                  <?php
                                  }else {
                                      ?>

                                   <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="17" data-name ="3" >
                                  <?php
                                  }
                                  ?>


                                    <span>Premium Design (Optional).</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">

                                    <?php
                                    $data="18";
                                 if (in_array($data, $checked)) {
                                      ?>
                                  <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="18" data-name ="3" checked>
                                  <?php
                                  }else {
                                      ?>

                                   <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="18" data-name ="3" >
                                  <?php
                                  }
                                  ?>


                                    <span>Bewerbungshomepage (Optional).</span>
                                @endif
                                @if ($order->pdetail->product_title == 'Bewerbungspaket Standard')
                                <h3>{{ $order->pdetail->product_title }}</h3>
                                <hr style="border: 0.3px solid lightgrey;width: 100%;">
                                <?php
                                $data="7";
                             if (in_array($data, $checked)) {
                                  ?>
                              <input class="check" id="checkbox1" type="checkbox"
                              value="{{ $order->id }}" data-id="7"  data-name ="1" checked>
                              <?php
                              }else {
                                  ?>

                               <input class="check" id="checkbox1" type="checkbox"
                              value="{{ $order->id }}" data-id="7" data-name ="1" >
                              <?php
                              }
                              ?>


                                    <span>Pers&ouml;nliches Anschreiben.</span>
                                    <hr style="border: 0.2px solid lightgrey;width: 100%;">


                                    <?php
                                    $data="8";
                                 if (in_array($data, $checked)) {
                                      ?>
                                  <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="8"  data-name ="1" checked>
                                  <?php
                                  }else {
                                      ?>

                                   <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="8" data-name ="1" >
                                  <?php
                                  }
                                  ?>

                                    <span>Individueller Lebenslauf.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                     $data="9";
                                  if (in_array($data, $checked)) {
                                       ?>
                                   <input class="check" id="checkbox1" type="checkbox"
                                   value="{{ $order->id }}" data-id="9" data-name ="1" checked>
                                   <?php
                                   }else {
                                       ?>

                                    <input class="check" id="checkbox1" type="checkbox"
                                   value="{{ $order->id }}" data-id="9" data-name ="1" >
                                   <?php
                                   }
                                   ?>

                                    <span>Bewerbungs-Deckblatt.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                    $data="10";
                                 if (in_array($data, $checked)) {
                                      ?>
                                  <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="10"  data-name ="1" checked>
                                  <?php
                                  }else {
                                      ?>

                                   <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="10" data-name ="1" >
                                  <?php
                                  }
                                  ?>
                                    <span>Word (.docx) &amp; PDF-Datei.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                    $data="11";
                                 if (in_array($data, $checked)) {
                                      ?>
                                  <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="11" data-name ="1" checked>
                                  <?php
                                  }else {
                                      ?>

                                   <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="11" data-name ="1" >
                                  <?php
                                  }
                                  ?>

                                    <span>Premium Design (Optional).</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                    $data="13";
                                 if (in_array($data, $checked)) {
                                      ?>
                                  <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="13" data-name ="1" checked>
                                  <?php
                                  }else {
                                      ?>

                                   <input class="check" id="checkbox1" type="checkbox"
                                  value="{{ $order->id }}" data-id="13" data-name ="1" >
                                  <?php
                                  }
                                  ?>

                                    <span>Bewerbungshomepage (Optional).</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">

                                    <p><strong>F&uuml;r Fachkr&auml;fte | Angestellte | absolvierte
                                            Berufsausbildung</strong></p>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">
                                @endif
                                @if ($order->pdetail->product_title == 'Bewerbungspaket Advanced')

                                <h3>{{ $order->pdetail->product_title }}</h3>
                                <hr style="border: 0.3px solid lightgrey;width: 100%;">
                                <?php
                                     $data="1";
                                  if (in_array($data, $checked)) {
                                       ?>
                                   <input class="check" id="checkbox1" type="checkbox"
                                   value="{{ $order->id }}" data-id="1" data-name ="1" checked>
                                   <?php
                                   }else {
                                       ?>

                                    <input class="check" id="checkbox1" type="checkbox"
                                   value="{{ $order->id }}" data-id="1" data-name ="1" >
                                   <?php
                                   }
                                   ?>
                                    <span>Erstellung &ndash; Komplette Bewerbung.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                       $data="2";
                                    if (in_array($data, $checked)) {
                                       ?>
                                   <input class="check" id="checkbox1" type="checkbox"
                                   value="{{ $order->id }}" data-id="2"data-name ="1" checked>
                                   <?php
                                   }else {
                                       ?>

                                    <input class="check" id="checkbox1" type="checkbox"
                                   value="{{ $order->id }}" data-name ="1" data-id="2" >
                                   <?php
                                   }
                                   ?>

                                    <span>Deckblatt, Anschreiben und Lebenslauf.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">

                                    <?php
                                    $data="3";
                                    if (in_array($data, $checked)) {
                                         ?>
                                     <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-name ="1" data-id="3" checked>
                                     <?php
                                     }else {
                                         ?>

                                      <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-name ="1" data-id="3" >
                                     <?php
                                     }
                                     ?>

                                    <span>Bearbeitbare Word-Datei inkl. PDF.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">

                                    <?php
                                   $data="4";
                                    if (in_array($data, $checked)) {
                                         ?>
                                     <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-id="4" data-name ="1" checked>
                                     <?php
                                     }else {
                                         ?>

                                      <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-name ="1" data-id="4" >
                                     <?php
                                     }
                                     ?>

                                    <span>Modernes Bewerbungsdesign.</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">


                                    <?php
                                   $data="5";
                                    if (in_array($data, $checked)) {
                                         ?>
                                     <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-id="5" data-name ="1" checked>
                                     <?php
                                     }else {
                                         ?>

                                      <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-id="5" data-name ="1" >
                                     <?php
                                     }
                                     ?>

                                    <span>Premium Design (Optional).</span>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">

                                    <?php
                                     $data="6";
                                    if (in_array($data, $checked)) {
                                         ?>
                                     <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-id="6" data-name ="1" checked>
                                     <?php
                                     }else {
                                         ?>

                                      <input class="check" id="checkbox1" type="checkbox"
                                     value="{{ $order->id }}" data-id="6" data-name ="1" >
                                     <?php
                                     }
                                     ?>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
            // function task(id) {

        });


        $('.check').click(function() {
        var  checked = $(this).attr("data-id");
        var  checked1 = $(this).attr("data-name");
          var  id = $(this).val();
            if (!$(this).is(':checked')) {

                $.ajax({
                    type: "get",
                    url: "uncheck/"+ id + '/' + checked + '/' +checked1,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                    }
                });
            } else {
                $.ajax({
                    type: "get",
                    url: "check1/"+ id + '/' + checked +'/' +checked1,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>
@endsection
