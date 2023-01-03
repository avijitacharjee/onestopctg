@extends('admin.layout')
@section('css')
    <style>
        /* .navbar {
                    margin-top: -25px;
                } */
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($salesAmount, 0, '', ',') }}</h3>

                                <p>Sales Amount</p>
                            </div>
                            {{-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div> --}}
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format($totalPaid, 0, '', ',') }}</h3>

                                <p>Total Paid</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($totalDue, 0, '', ',') }}</h3>

                                <p>Total Due</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ number_format($numberOfSales, 0, '', ',') }}</h3>

                                <p>Total Sales</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ number_format($netProfit, 0, '', ',') }}</h3>

                                <p>Net profit</p>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>0</h3>

                                <p>Loss</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-6 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Sales of last 12 months
                                </h3>
                                {{-- <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                    {{-- <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div> --}}
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- DIRECT CHAT -->
                        {{-- <div class="card direct-chat direct-chat-primary">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>

                                <div class="card-tools">
                                    <span title="3 New Messages" class="badge badge-primary">3</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" title="Contacts"
                                        data-widget="chat-pane-toggle">
                                        <i class="fas fa-comments"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Is this template really for free? That's unbelievable!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            You better believe it!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                                            <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Working with AdminLTE on a great new app! Wanna join?
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            I would love to.
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                </div>
                                <!--/.direct-chat-messages-->

                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user1-128x128.jpg"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Count Dracula
                                                        <small class="contacts-list-date float-right">2/28/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user7-128x128.jpg"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Sarah Doe
                                                        <small class="contacts-list-date float-right">2/23/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I will be waiting for...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user3-128x128.jpg"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nadia Jolie
                                                        <small class="contacts-list-date float-right">2/20/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I'll call you back at...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user5-128x128.jpg"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nora S. Vans
                                                        <small class="contacts-list-date float-right">2/10/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Where is your new...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user6-128x128.jpg"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        John K.
                                                        <small class="contacts-list-date float-right">1/27/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Can I take a look at...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user8-128x128.jpg"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Kenneth M.
                                                        <small class="contacts-list-date float-right">1/4/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Never mind I found...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                    </ul>
                                    <!-- /.contacts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..."
                                            class="form-control">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-footer-->
                        </div> --}}
                        <!--/.direct-chat -->

                        <!-- TO DO List -->
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    To Do List
                                </h3>

                                <div class="card-tools">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul class="todo-list" data-widget="todo-list">
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                            <label for="todoCheck1"></label>
                                        </div>
                                        <!-- todo text -->
                                        <span class="text">Design a nice theme</span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo2" id="todoCheck2"
                                                checked>
                                            <label for="todoCheck2"></label>
                                        </div>
                                        <span class="text">Make the theme responsive</span>
                                        <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                            <label for="todoCheck3"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo4" id="todoCheck4">
                                            <label for="todoCheck4"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo5" id="todoCheck5">
                                            <label for="todoCheck5"></label>
                                        </div>
                                        <span class="text">Check your messages and notifications</span>
                                        <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo6" id="todoCheck6">
                                            <label for="todoCheck6"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                                    Add item</button>
                            </div>
                        </div> --}}
                        <!-- /.card -->
                    </section>
                    <section class="col-lg-6 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Zone based Sales
                                </h3>
                                {{-- <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#revenue-chart" data-toggle="tab">Area</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#sales-chart" data-toggle="tab">Donut</a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->

                                    <div class="chart tab-pane active" id="sales-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->

                    <section class="col-lg-6 connectedSortable">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Best products all time
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas class="chart" id="bar-chart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </section>
                    <section class="col-lg-6 connectedSortable">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Best products this month
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas class="chart" id="bar-chart-this-month"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </section>
                    <section class="col-lg-6 connectedSortable">

                        <!-- Map card -->
                        {{-- <div class="card bg-gradient-primary">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    Visitors
                                </h3>
                                <!-- card tools -->
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                        <i class="far fa-calendar-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <div class="card-body">
                                <div id="world-map" style="height: 250px; width: 100%;"></div>
                            </div>
                            <!-- /.card-body-->
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div id="sparkline-1"></div>
                                        <div class="text-white">Visitors</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div id="sparkline-2"></div>
                                        <div class="text-white">Online</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div id="sparkline-3"></div>
                                        <div class="text-white">Sales</div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div> --}}
                        <!-- /.card -->

                        <!-- solid sales graph -->
                        <div class="card bg-gradient-info">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Sales Graph
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas class="chart" id="line-chart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <input type="text" class="knob" data-readonly="true" value="20"
                                            data-width="60" data-height="60" data-fgColor="#39CCCC">

                                        <div class="text-white">Mail-Orders</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <input type="text" class="knob" data-readonly="true" value="50"
                                            data-width="60" data-height="60" data-fgColor="#39CCCC">

                                        <div class="text-white">Online</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <input type="text" class="knob" data-readonly="true" value="30"
                                            data-width="60" data-height="60" data-fgColor="#39CCCC">

                                        <div class="text-white">In-Store</div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                            </div> --}}
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->

                        <!-- Calendar -->
                        {{-- <div class="card bg-gradient-success">
                            <div class="card-header border-0">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-offset="-52">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="#" class="dropdown-item">Add new event</a>
                                            <a href="#" class="dropdown-item">Clear events</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item">View calendar</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.card-body -->
                        </div> --}}
                        <!-- /.card -->
                    </section>
                </div>
                <section class="card">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">Top 5</h1>
                                </div><!-- /.col -->

                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <ul class="nav nav-pills m-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                data-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Sales</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Expenses</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact"
                            type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Contact</button>
                    </li> --}}
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Sales</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>#</th> --}}
                                                        <th>Date</th>
                                                        <th>Customer</th>
                                                        <th>Sale Status</th>
                                                        <th>Grand Total</th>
                                                        <th>Paid</th>
                                                        <th>Balance</th>
                                                        <th>Sample</th>
                                                        <th>Bonus</th>
                                                        <th>Dr honor</th>
                                                        <th>Payment status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($sales as $sale)
                                                        <tr>
                                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                                            <td>{{ $sale->date_text }}</td>
                                                            <td>{{ $sale->customer->name }}</td>
                                                            <td><span class="badge badge-success">Completed</span></td>
                                                            <td>{{ $sale->total }}</td>
                                                            <td>{{ $sale->paid }}</td>
                                                            <td>{{ $sale->due }}</td>
                                                            <td>{{ $sale->total_sample }}</td>
                                                            <td>{{ $sale->total_bonus }}</td>
                                                            <td>{{ $sale->total_discount }}</td>
                                                            <td>
                                                                <x-payment-status message="{{ $sale->payment_status }}" />
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton">
                                                                        <button class="dropdown-item"
                                                                            id="listPaymentButton" data-toggle="modal"
                                                                            data-target="#listPaymentModal{{ $loop->index }}">View
                                                                            payment</button>
                                                                        <button class="dropdown-item"
                                                                            id="addPaymentButton" data-toggle="modal"
                                                                            data-target="#addPaymentModal{{ $loop->index }}">Add
                                                                            payment</button>
                                                                        {{-- <a class="dropdown-item" href="#">Edit sale</a> --}}
                                                                        <form action="/sale/{{ $sale->id }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="_method"
                                                                                value="DELETE">
                                                                            <button class="dropdown-item"
                                                                                type="submit">Delete
                                                                                sale</button>
                                                                        </form>
                                                                        <a class="dropdown-item"
                                                                            href="/sale/pdf/{{ $sale->id }}">Download
                                                                            pdf</a>
                                                                        <button class="dropdown-item" data-toggle="modal"
                                                                            data-target="#myModal{{ $loop->index }}">Sale
                                                                            details</button>
                                                                    </div>
                                                                </div>
                                                                <div class="modal fade .modal-xl"
                                                                    id="listPaymentModal{{ $loop->index }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-xl"
                                                                        role="document" style="width:100%;">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLongTitle">
                                                                                    Payments</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div id="modalBody" class="modal-body">
                                                                                <table id="paymentList"
                                                                                    class="table table-bordered table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Date</th>
                                                                                            <th>Reference</th>
                                                                                            <th>Amount</th>
                                                                                            <th>Paid by</th>
                                                                                            <th>Note</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($sale->payments as $payment)
                                                                                            <tr>
                                                                                                <td>{{ $loop->iteration }}
                                                                                                </td>
                                                                                                <td>{{ $payment->payment_date }}
                                                                                                </td>
                                                                                                <td>{{ $payment->reference_no }}
                                                                                                </td>
                                                                                                <td>{{ $payment->amount }}
                                                                                                </td>
                                                                                                <td>{{ $payment->payment_method }}
                                                                                                </td>
                                                                                                <td>{{ $payment->note }}
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Date</th>
                                                                                            <th>Reference</th>
                                                                                            <th>Amount</th>
                                                                                            <th>Paid by</th>
                                                                                            <th>Note</th>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal fade .modal-xl"
                                                                    id="addPaymentModal{{ $loop->index }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                    aria-hidden="true">
                                                                    <form action="/payment" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="sale_id"
                                                                            value="{{ $sale->id }}">
                                                                        <div class="modal-dialog modal-dialog-centered .modal-xl"
                                                                            role="document" style="width:100%;">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLongTitle">
                                                                                        Add Payment
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div id="modalBody" class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="">Date</label>
                                                                                                <input type="date"
                                                                                                    name="payment_date"
                                                                                                    class="form-control"
                                                                                                    value="<?php echo date('Y-m-d'); ?>"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="">Reference
                                                                                                    no</label>
                                                                                                <input type="text"
                                                                                                    name="reference_no"
                                                                                                    class="form-control"
                                                                                                    id=""
                                                                                                    placeholder="Reference no">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="">Amount</label>
                                                                                                <input type="number"
                                                                                                    step="any"
                                                                                                    name="amount"
                                                                                                    class="form-control"
                                                                                                    id=""
                                                                                                    max="{{ $sale->due }}"
                                                                                                    placeholder="Amount"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="">Paying
                                                                                                    by</label>
                                                                                                <select
                                                                                                    name="payment_method"
                                                                                                    class="form-control">
                                                                                                    <option value="cash">
                                                                                                        Cash
                                                                                                    </option>
                                                                                                    <option value="cheque">
                                                                                                        Cheque
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="deposit">
                                                                                                        Deposit
                                                                                                    </option>
                                                                                                    <option value="other">
                                                                                                        Other
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="">Note</label>
                                                                                                <textarea name="note" class="form-control"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">Close</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div id="printThis">
                                                                    <div class="modal fade in"
                                                                        id="myModal{{ $loop->index }}" tabindex="-1"
                                                                        role="dialog"
                                                                        aria-labelledby="myModalLabel{{ $loop->index }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg no-modal-header">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-hidden="true">
                                                                                        <i class="fa fa-2x">×</i>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn btn-md btn-default no-print pull-right"
                                                                                        style="margin-right:15px;"
                                                                                        id="btnPrint">
                                                                                        <i class="fa fa-print"></i> Print
                                                                                    </button>
                                                                                    <div class="text-center"
                                                                                        style="margin-bottom:20px;">
                                                                                        <img src="{{ asset('images/logo1.png') }}"
                                                                                            alt="Test Biller">
                                                                                    </div>
                                                                                    <div class="well well-sm">
                                                                                        <div class="row bold">
                                                                                            <div class="col-md-5">
                                                                                                <p class="bold">
                                                                                                    Date:
                                                                                                    {{ $sale->date_text }}<br>
                                                                                                    {{-- Reference: SALE2022/12/0061<br> --}}
                                                                                                    Sale Status:
                                                                                                    Completed<br>
                                                                                                    Payment Status: Paid<br>
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-7 text-right order_barcodes">
                                                                                                <img src="https://barcodeapi.org/api/auto/s/{{ $sale->id }}"
                                                                                                    alt="SALE2022/12/0061"
                                                                                                    class="bcimg"
                                                                                                    height="80px">
                                                                                            </div>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>
                                                                                    <div class="row"
                                                                                        style="margin-bottom:15px;">
                                                                                        <div class="col-md-6">
                                                                                            To:<br>
                                                                                            <h2 style="margin-top:10px;">
                                                                                                {{ $sale->customer->name }}
                                                                                            </h2>
                                                                                            <p></p>
                                                                                            Tel:
                                                                                            {{ $sale->customer->phone }}
                                                                                            <br>
                                                                                            Email:
                                                                                            {{ $sale->customer->email }}
                                                                                            <br>
                                                                                            Zone:
                                                                                            {{ $sale->customer->zone }}

                                                                                        </div>
                                                                                        {{-- <div class="col-md-6">
                                                                                        From:
                                                                                        <h2 style="margin-top:10px;">Test Biller</h2>
                                                                                        Biller adddress<br>Dhaka <br>Bangladesh
                                                                                        <p><br>VAT Number: 5555</p>
                                                                                        Tel: 012345678<br>Email: saleem@site.com
                                                                                    </div> --}}
                                                                                    </div>
                                                                                    <div class="table-responsive">
                                                                                        <table
                                                                                            class="table table-bordered table-hover table-striped print-table order-table">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>No.</th>
                                                                                                    <th>Description</th>
                                                                                                    <th>Quantity</th>
                                                                                                    <th>Sample</th>
                                                                                                    <th>Bonus</th>
                                                                                                    <th>Unit Price</th>
                                                                                                    <th>Tax</th>
                                                                                                    <th>Subtotal</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($sale->saleItems as $saleItem)
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="text-align:center; width:40px; vertical-align:middle;">
                                                                                                            {{ $loop->iteration }}
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="vertical-align:middle;">
                                                                                                            {{ $saleItem->product->name }}
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="width: 80px; text-align:center; vertical-align:middle;">
                                                                                                            {{ $saleItem->quantity }}
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="width: 80px; text-align:center; vertical-align:middle;">
                                                                                                            {{ $saleItem->sample }}
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="width: 80px; text-align:center; vertical-align:middle;">
                                                                                                            {{ $saleItem->bonus }}
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align:right; width:100px;">
                                                                                                            {{ $saleItem->price }}
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="width: 100px; text-align:right; vertical-align:middle;">
                                                                                                            <small>(VAT10)</small>
                                                                                                            00.00
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align:right; width:120px;">
                                                                                                            {{ $saleItem->total }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                            <tfoot>
                                                                                                <tr>
                                                                                                    <td colspan="6"
                                                                                                        style="text-align:right; padding-right:10px;">
                                                                                                        Total (BDT)
                                                                                                    </td>
                                                                                                    <td
                                                                                                        style="text-align:right;">
                                                                                                        0.00
                                                                                                    </td>
                                                                                                    <td
                                                                                                        style="text-align:right; padding-right:10px;">
                                                                                                        {{ $sale->total }}
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="6"
                                                                                                        style="text-align:right; font-weight:bold;">
                                                                                                        Total Amount (BDT)
                                                                                                    </td>
                                                                                                    <td
                                                                                                        style="text-align:right; padding-right:10px; font-weight:bold;">
                                                                                                        {{ $sale->total }}
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="6"
                                                                                                        style="text-align:right; font-weight:bold;">
                                                                                                        Paid (BDT)
                                                                                                    </td>
                                                                                                    <td
                                                                                                        style="text-align:right; font-weight:bold;">
                                                                                                        {{ $sale->total }}
                                                                                                    </td>
                                                                                                </tr>
                                                                                                {{-- <tr>
                                                                                                <td colspan="6"
                                                                                                    style="text-align:right; font-weight:bold;">
                                                                                                    Balance (BDT)
                                                                                                </td>
                                                                                                <td
                                                                                                    style="text-align:right; font-weight:bold;">
                                                                                                    {{0}}</td>
                                                                                            </tr> --}}
                                                                                            </tfoot>
                                                                                        </table>
                                                                                    </div>
                                                                                    {{-- <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="well well-sm">
                                                                                            <p class="bold">Note:</p>
                                                                                            <div>
                                                                                                <p>test</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-5 pull-right">
                                                                                        <div class="well well-sm">
                                                                                            <p>
                                                                                                Created by: Owner Owner <br>
                                                                                                Date: 17/12/2022 18:53
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> --}}
                                                                                    <!--  -->
                                                                                    {{-- <div class="buttons">
                                                                                    <div class="btn-group btn-group-justified">
                                                                                        <div class="btn-group">
                                                                                            <a href="https://pos2.onestopctg.com/admin/sales/add_payment/94"
                                                                                                class="tip btn btn-primary"
                                                                                                title="" data-toggle="modal"
                                                                                                data-target="#myModal2"
                                                                                                data-original-title="Add Payment">
                                                                                                <i class="fa fa-dollar"></i>
                                                                                                <span
                                                                                                    class="hidden-sm hidden-md">Payment</span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="btn-group">
                                                                                            <a href="https://pos2.onestopctg.com/admin/sales/add_delivery/94"
                                                                                                class="tip btn btn-primary"
                                                                                                title="" data-toggle="modal"
                                                                                                data-target="#myModal2"
                                                                                                data-original-title="Add Delivery">
                                                                                                <i class="fa fa-truck"></i>
                                                                                                <span
                                                                                                    class="hidden-sm hidden-md">Delivery</span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="btn-group">
                                                                                            <a href="https://pos2.onestopctg.com/admin/sales/email/94"
                                                                                                data-toggle="modal"
                                                                                                data-target="#myModal2"
                                                                                                class="tip btn btn-primary"
                                                                                                title=""
                                                                                                data-original-title="Email">
                                                                                                <i class="fa fa-envelope-o"></i>
                                                                                                <span
                                                                                                    class="hidden-sm hidden-md">Email</span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="btn-group">
                                                                                            <a href="https://pos2.onestopctg.com/admin/sales/pdf/94"
                                                                                                class="tip btn btn-primary"
                                                                                                title=""
                                                                                                data-original-title="Download as PDF">
                                                                                                <i class="fa fa-download"></i>
                                                                                                <span
                                                                                                    class="hidden-sm hidden-md">PDF</span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="btn-group">
                                                                                            <a href="https://pos2.onestopctg.com/admin/sales/edit/94"
                                                                                                class="tip btn btn-warning sledit"
                                                                                                title=""
                                                                                                data-original-title="Edit">
                                                                                                <i class="fa fa-edit"></i>
                                                                                                <span
                                                                                                    class="hidden-sm hidden-md">Edit</span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="btn-group">
                                                                                            <a href="#"
                                                                                                class="tip btn btn-danger bpo"
                                                                                                title=""
                                                                                                data-content="<div style='width:150px;'><p>Are you sure?</p><a class='btn btn-danger' href='https://pos2.onestopctg.com/admin/sales/delete/94'>Yes I'm sure</a> <button class='btn bpo-close'>No</button></div>"
                                                                                                data-html="true" data-placement="top"
                                                                                                data-original-title="<b>Delete Sale</b>">
                                                                                                <i class="fa fa-trash-o"></i>
                                                                                                <span
                                                                                                    class="hidden-sm hidden-md">Delete</span>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        {{-- <th>#</th> --}}
                                                        <th>Date</th>
                                                        <th>Customer</th>
                                                        <th>Sale Status</th>
                                                        <th>Grand Total</th>
                                                        <th>Paid</th>
                                                        <th>Balance</th>
                                                        <th>Sample</th>
                                                        <th>Bonus</th>
                                                        <th>Dr honor</th>
                                                        <th>Payment status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Expenses</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Expense</th>
                                                        <th>Category</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>Note</th>
                                                        <th>Action</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($expenses as $expense)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $expense->name }}</td>
                                                            <td>{{ $expense->cateogory->name }}</td>
                                                            <td>{{ $expense->amount }}</td>
                                                            <td>{{ date('jS M, Y', strtotime($expense->date)) }}</td>
                                                            <td>{{ $expense->note }}</td>

                                                            <td>
                                                                <form action="/expense/{{ $expense->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" style="border: none;">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <button id="previewButton" type="button"
                                                                    class="btn btn-primary" data-toggle="modal"
                                                                    data-target="#editModal{{ $expense->id }}"
                                                                    class="btn btn-success"><i
                                                                        class="fa fa-edit"></i></button>
                                                                <div class="modal fade .modal-xl"
                                                                    id="editModal{{ $expense->id }}" tabindex="-1"
                                                                    role="dialog"
                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                    aria-hidden="true">
                                                                    <form action="/expense/{{ $expense->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-dialog modal-dialog-centered "
                                                                            role="document" style="width:100%;">

                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLongTitle">
                                                                                        Update expense</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div id="modalBody" class="modal-body">
                                                                                    <input type="hidden" name="_method"
                                                                                        value="PUT">
                                                                                    <div class="form-group">
                                                                                        <label for="">Name</label>
                                                                                        <input type="text"
                                                                                            name="name"
                                                                                            class="form-control"
                                                                                            id=""
                                                                                            value="{{ $expense->name }}"
                                                                                            placeholder="Category Name">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="">Category</label>
                                                                                        <select name="category_id"
                                                                                            id=""
                                                                                            class="form-control">
                                                                                            @foreach ($categories as $category)
                                                                                                <option
                                                                                                    @selected($category->id == $expense->expense_category_id)
                                                                                                    value="{{ $category->id }}">
                                                                                                    {{ $category->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="">Amount</label>
                                                                                        <input type="number"
                                                                                            name="amount"
                                                                                            class="form-control"
                                                                                            id=""
                                                                                            value="{{ $expense->amount }}"
                                                                                            placeholder="Amount">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Date</label>
                                                                                        <input type="date"
                                                                                            name="date"
                                                                                            class="form-control"
                                                                                            id=""
                                                                                            value="{{ $expense->date }}"
                                                                                            placeholder="Date">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Note</label>
                                                                                        <textarea type="text" name="note" class="form-control" id="" tex="{{ $expense->note }}"
                                                                                            placeholder="Add some note..">{{ $expense->note }}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">Close</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Expense</th>
                                                        <th>Category</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>Note</th>
                                                        <th>Action</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            cadf</div>
                    </div>
                </section>
                <!-- /.row (main row) -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        /* Chart.js Charts */
        // Sales chart
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
        // $('#revenue-chart').get(0).getContext('2d');

        var salesChartData = {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                    label: 'Digital Goods',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: <?php echo json_encode($monthlySales); ?>
                },
                {
                    label: 'Electronics',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: <?php echo json_encode($monthlySales); ?>
                }
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })

        // Donut Chart
        var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var pieData = {
            labels: <?php echo json_encode($zones); ?>,
            datasets: [{
                data: <?php echo json_encode($zoneSales); ?>,
                // backgroundColor: ['#f56954', '#00a65a', '#f39c12']
                backgroundColor: <?php echo json_encode($colors); ?>
            }]
        }
        var pieOptions = {
            legend: {
                display: true
            },
            maintainAspectRatio: false,
            responsive: true
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })

        // Sales graph chart
        var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
        // $('#revenue-chart').get(0).getContext('2d');

        var salesGraphChartData = {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Digital Goods',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#efefef',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '#efefef',
                pointBackgroundColor: '#efefef',
                data: <?php echo json_encode($monthlySales); ?>
            }]
        }

        var salesGraphChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: '#efefef'
                    },
                    gridLines: {
                        display: false,
                        color: '#efefef',
                        drawBorder: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 5000,
                        fontColor: '#efefef'
                    },
                    gridLines: {
                        display: true,
                        color: '#efefef',
                        drawBorder: false
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'line',
            data: salesGraphChartData,
            options: salesGraphChartOptions
        })

        //bar chart
        var barCartCanvas = $('#bar-chart').get(0).getContext('2d');
        const labels = <?php echo json_encode($topProducts);?>;
        const barChartData = {
            labels: labels,
            datasets: [{
                label: 'Sale amount',
                data: <?php echo json_encode($topProductsQuantity);?>,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                ],
                borderWidth: 1
            }]
        };
        var barChart = new Chart(barCartCanvas, {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //bar chart this month
        var barCartThisMonthCanvas = $('#bar-chart-this-month').get(0).getContext('2d');
        const labelsThisMonth = <?php echo json_encode($topProductsThisMonth);?>;
        const barChartDataThisMonth = {
            labels: labelsThisMonth,
            datasets: [{
                label: 'Sale amount',
                data: <?php echo json_encode($topProductsQuantityThisMonth);?>,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                ],
                borderWidth: 1
            }]
        };
        var barChartThisMonth = new Chart(barCartThisMonthCanvas, {
            type: 'bar',
            data: barChartDataThisMonth,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
