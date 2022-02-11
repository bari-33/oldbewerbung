<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu" style="height: 100% !important">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                @can('admin')
                    <li>
                        <a href="{{ url('admin') }}">
                            <i class="fa fa-dashboard"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-cubes"></i>
                            <span> Produkte </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{ url('products') }}">- Alle Produkte</a>
                            </li>
                            <li>
                                <a href="{{ url('products/create') }}">- Produkt hinzufügen</a>
                            </li>
                            <li>
                                <a href="{{ url('designs') }}">- Alle Designs</a>
                            </li>
                            <li>
                                <a href="{{ url('designs/create') }}">- Design hinzufügen</a>
                            </li>
                            <li>
                                <a href="{{ url('websites') }}">- Alle Websites</a>
                            </li>
                            <li>
                                <a href="{{ url('websites/create') }}">- Websites hinzufügen</a>
                            </li>
                            <li>
                                <a href="{{ url('/categories') }}">- Alle Kategorien</a>
                            </li>
                            <li>
                                <a href="{{ url('categories/create') }}">- Kategorien hinzufügen</a>
                            </li>


                        </ul>
                    </li>


                    <li>
                        <a href="{{ url('adminorders') }}">
                            <i class="fe-shopping-cart"></i>
                            <span> Bestellungen </span>
                        </a>
                    </li>




                    <li>
                        <a href="{{ url('invoices') }}">
                            <i class="fe-file-text"></i>
                            <span> Rechnungen </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('userdetails') }}">
                            <i class="fa fa-user"></i>
                            <span> Benutzer </span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ url('message') }}">
                            <i class="fa fa-envelope-o"></i>
                            <span> Nachrichten </span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ url('message') }}">
                            <i class="fa fa-pie-chart"></i>
                            <span> Statistiken </span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ url('task') }}">
                            <i class="fa fa-check-square-o"></i>
                            <span> Tasks </span>
                        </a>

                    </li>

                    <li class="menu-title mt-2">
                        <hr>
                    </li>

                    <li>
                        <a href="{{ url('faqs') }}">
                            <i class="fa fa-question-circle-o"></i>
                            <span> FAQ </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('expration') }}">
                            <i class="fa fa-usb"></i>
                            <span> Expration </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('settings') }}">
                            <i class="fa fa-sliders"></i>
                            <span> Settings </span>
                        </a>
                    </li>
                    <li>


                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            <span> Ausloggen </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>


                    </li>
                @endcan


                @can('employee')
                    <li>
                        <a href="{{ url('employees_dashboard') }}">
                            <i class="fe-airplay"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('employees/orders') }}">
                            <i class="fe-shopping-cart"></i>
                            <span>Meine Bestellungen</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('employees/tasks') }}">
                            <i class="fe-file-text"></i>
                            <span>Meine Aufgaben</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('employees/invoices') }}">
                            <i class="fe-file-text"></i>
                            <span>Meine Rechnungen</span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">
                        <hr>
                    </li>

                    <li>
                        <a href="{{ url('faqs') }}">
                            <i class="fa fa-question-circle-o"></i>
                            <span> FAQ </span>
                        </a>
                    </li>
                    <li>
                        <a href="expration">
                            <i class="fa fa-usb"></i>
                            <span> Expration </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('settings') }}">
                            <i class="fa fa-sliders"></i>
                            <span> Settings </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            <span> Ausloggen </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endcan
                @can('customer')
                    @if (!empty(\Illuminate\Support\Facades\Auth::user()->orders))

                        <li>
                            <a href="{{ url('employees_dashboard') }}">
                                <i class="fe-airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('orders/current/' . Auth::user()->id) }}">
                                <i class="fe-stop-circle"></i>
                                <span> Aktueller Auftrag </span>
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('orders/customerOrders/' . Auth::user()->id) }}">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span>Meine Auftrag</span>
                            </a>
                        </li>
                    @endif
                    <li>

                        <a href="{{ url('orders') }}">
                            <i class="fe-plus"></i>
                            <span> Auftrag hinzufugen </span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">
                        <hr>
                    </li>

                    <li>
                        <a href="{{ url('faqs') }}">
                            <i class="fa fa-question-circle-o"></i>
                            <span> FAQ </span>
                        </a>
                    </li>
                    <li>
                        <a href="expration">
                            <i class="fa fa-usb"></i>
                            <span> Expration </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('settings') }}">
                            <i class="fa fa-sliders"></i>
                            <span> Settings </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            <span> Ausloggen </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endcan

            </ul>


            <div style="background-image: url('{{ asset('public/side.jpg') }}');height: 500px;
    background-size: 100%;
    background-repeat: no-repeat;"></div>


        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
