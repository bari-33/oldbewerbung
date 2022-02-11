<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>Bewerbung.one</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bewerbung.one" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{!! asset('public/img//logo/logo.png') !!}">

    <!-- Plugins css -->
    <link href="{!! asset('public/theme/assets/libs/flatpickr/flatpickr.min.css') !!}" rel="stylesheet" type="text/css" />

@yield('file_upload_css')
@yield('css')

    <!-- App css -->
    <link href="{!! asset('public/theme/assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/icons.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/app.min.css') !!}" rel="stylesheet" type="text/css" />
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<!-- Begin page -->
<div id="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">


                <!-- end page title -->


                <!-- end row-->

             @yield('content')
                <!-- end row -->


                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        {{ \Carbon\Carbon::now()->format('Y')}} &copy; Bewerbung.one
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            {{--  <a href="javascript:void(0);">About Us</a>
                              <a href="javascript:void(0);">Help</a>
                              <a href="javascript:void(0);">Contact Us</a>--}}
                          </div>
                      </div>
                  </div>
              </div>
          </footer>
          <!-- end Footer -->

      </div>

      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->


  </div>
  <!-- END wrapper -->

  <!-- Right Sidebar -->
  <div class="right-bar">
      <div class="rightbar-title">
          <a href="javascript:void(0);" class="right-bar-toggle float-right">
              <i class="dripicons-cross noti-icon"></i>
          </a>
          <h5 class="m-0 text-white">Settings</h5>
      </div>
      <div class="slimscroll-menu">
          <!-- User box -->
          <div class="user-box">
              <div class="user-img">
                  <img src="{!! asset('public/theme/assets/images/users/user-1.jpg') !!}" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                  <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
              </div>

              {{--<h5><a href="javascript: void(0);">  {{ Auth::user()->name }}</a> </h5>--}}
            <p class="text-muted mb-0"><small>Admin Head</small></p>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h5 class="pl-3">Basic Settings</h5>
        <hr class="mb-0" />

        <div class="p-3">
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox1" type="checkbox" checked>
                <label for="Rcheckbox1">
                    Notifications
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox2" type="checkbox" checked>
                <label for="Rcheckbox2">
                    API Access
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox3" type="checkbox">
                <label for="Rcheckbox3">
                    Auto Updates
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox4" type="checkbox" checked>
                <label for="Rcheckbox4">
                    Online Status
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-0">
                <input id="Rcheckbox5" type="checkbox" checked>
                <label for="Rcheckbox5">
                    Auto Payout
                </label>
            </div>
        </div>

        <!-- Timeline -->
        <hr class="mt-0" />
        <h5 class="pl-3 pr-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
        <hr class="mb-0" />
        <div class="p-3">
            <div class="inbox-widget">
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="theme/assets/images/users/user-2.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                    <p class="inbox-item-text">I've finished it! See you so...</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="theme/assets/images/users/user-3.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="theme/assets/images/users/user-4.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                    <p class="inbox-item-text">Nice to meet you</p>
                </div>

                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="theme/assets/images/users/user-5.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                    <p class="inbox-item-text">Hey! there I'm available...</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="theme/assets/images/users/user-6.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Adhamdannaway</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                </div>
            </div> <!-- end inbox-widget -->
        </div> <!-- end .p-3-->

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="{!! asset('public/theme/assets/js/vendor.min.js') !!}"></script>

<!-- Plugins js-->
<script src="{!! asset('public/theme/assets/libs/flatpickr/flatpickr.min.js') !!}"></script>
<script src="{!! asset('public/theme/assets/libs/jquery-knob/jquery.knob.min.js') !!}"></script>
<script src="{!! asset('public/theme/assets/libs/jquery-sparkline/jquery.sparkline.min.js') !!}"></script>
<script src="{!! asset('public/theme/assets/libs/flot-charts/jquery.flot.js') !!}"></script>
<script src="{!! asset('public/theme/assets/libs/flot-charts/jquery.flot.time.js') !!}"></script>
<script src="{!! asset('public/theme/assets/libs/flot-charts/jquery.flot.tooltip.min.js') !!}"></script>
<script src="{!! asset('public/theme/assets/libs/flot-charts/jquery.flot.selection.js') !!}"></script>
<script src="{!! asset('public/theme/assets/libs/flot-charts/jquery.flot.crosshair.js') !!}"></script>



<!-- Dashboar 1 init js-->
<script src="{!! asset('public/theme/assets/js/pages/dashboard-1.init.js') !!}"></script>

<!-- App js-->
<script src="{!! asset('public/theme/assets/js/app.min.js') !!}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@include('sweet.views.alert')  

<!-- Plugins js -->

@yield('file_upload_js')
@yield('quill_js')

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


        $('.delete-confirm').on('click', function (e) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

    </script>

</body>

</html>
