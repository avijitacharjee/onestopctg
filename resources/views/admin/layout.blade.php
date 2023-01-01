<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS | OneStopCtg</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
             {{-- style="margin-top: -24px;"> --}}
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('lte/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('lte/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li> --}}
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
                    </a>
                    {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div> --}}
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-user"></i> My profile
                            {{-- <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span> --}}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">One Stop Ctg</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
            <a href="orders" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Orders
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
                        @if (auth()->user()->permissions->contains('name', 'product') || auth()->user()->role->name == 'Super Admin')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Products
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/product" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>See all products</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/product/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add product</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/add-csv" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add product via csv</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @access('customer')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Customers
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/customer" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>See all customers</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/customer/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add customer</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endaccess
                        @access('sale')
                        <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-shopping-cart"></i>
                                    <p>
                                        Sales
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/sale" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>See all sales</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/sale/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add sale</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endaccess
                        @access('expense')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-money-bill-alt"></i>
                                <p>
                                    Expenses
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/expense" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Expenses</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/expense-category" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Expense Categories</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endaccess
                        @access('transfer')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>
                                    Transfers
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/transfer/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add transfer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/transfer" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transfer History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endaccess
                        @access('return')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-undo-alt"></i>
                                <p>
                                    Returns
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/return" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List return</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/return/create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add return</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endaccess
                        @access('supplier')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>
                                    Supplier
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/supplier" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List supplier</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endaccess
                        @if (auth()->user()->role->name == 'Super Admin')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Users
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/user" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>See all users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/user/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add user</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif
                        @access('report')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Reports
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/reports/sale" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sale report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports/product" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Product report</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="/reports/best-sale" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Best sale</p>
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a href="/reports/quantity-alert" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quantity alert</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports/expiry-alert" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Expiry alert</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports/daily-sales" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daily sales</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports/monthly-sales" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Monthly sales</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="/reports/supplier" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Supplier report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports/customer" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Customer report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports/expense" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Expense report</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="/reports/payment" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payment report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports/tax" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tax report</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        @endaccess
                        @access('warehouse')
                        <li class="nav-item">
                            <a href="/warehouse" class="nav-link">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>
                                    Warehouse
                                </p>
                            </a>
                        </li>
                        @endaccess
                        {{-- <li class="nav-item">
                            <a href="/notifications" class="nav-link">
                                <i class="nav-icon fa fa-bell"></i>
                                <p>Notifications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/settings" class="nav-link">
                                <i class="nav-icon fa fa-cog"></i>
                                <p>Settings</p>
                            </a>
                        </li> --}}
                        <div class="line nav-item"></div>
                        <li class="nav-item">
                            <a href="/logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="">OneStopCtg</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 0.4.2
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('lte/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('lte/dist/js/pages/dashboard.js') }}"></script>
    @yield('js')
</body>

</html>
