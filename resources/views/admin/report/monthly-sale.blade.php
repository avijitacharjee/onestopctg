@extends('admin.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .white {
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Monthly Sale Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sales</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <style type="text/css">
                                    .dfTable th,
                                    .dfTable td {
                                        text-align: center;
                                        vertical-align: middle;
                                    }

                                    .dfTable td {
                                        padding: 2px;
                                    }

                                    .data tr:nth-child(odd) td {
                                        color: #2FA4E7;
                                    }

                                    .data tr:nth-child(even) td {
                                        text-align: right;
                                    }
                                </style>
                                <div class="box">
                                    <div class="box-header">
                                        <h2 class="blue"><i class="fa-fw fa fa-calendar"></i>Monthly Sales</h2>

                                        {{-- <div class="box-icon">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Change Warehouse
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="/reports/monthly-sales/{{ request()->year }}/0">All
                                                                warehouses</a>
                                                            @foreach ($warehouses as $warehouse)
                                                                <a class="dropdown-item"
                                                                    href="/reports/monthly-sales/{{ request()->year }}/{{ $warehouse->id }}">{{ $warehouse->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> --}}
                                    </div>
                                    <div class="box-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="introtext">You can change the month by clicking the >> (next) or
                                                    << (previous) </p>
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered table-striped dfTable reports-table">
                                                                <thead>
                                                                    <tr class="year_roller">
                                                                        <th><a class="white"
                                                                                href="/reports/monthly-sales/{{ request()->year - 1 }}/{{ request()->warehouse_id }}">&lt;&lt;</a>
                                                                        </th>
                                                                        <th colspan="10"> {{ request()->year }}</th>
                                                                        <th><a class="white"
                                                                                href="/reports/monthly-sales/{{ request()->year + 1 }}/{{ request()->warehouse_id }}">&gt;&gt;</a>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @foreach ($monthlyDatam as $monthlyData)
                                                                            <td class="bold text-center">
                                                                                <button data-toggle="modal"
                                                                                    data-target="#myModal{{ $loop->index }}">
                                                                                    {{ $monthlyData['month'] }} </button>
                                                                                <div class="modal fade .modal-xl"
                                                                                    id="myModal{{ $loop->index }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog"
                                                                                        role="document" style="width:100%;">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title"
                                                                                                    id="exampleModalLongTitle">
                                                                                                    Sale report
                                                                                                    ({{ $monthlyData['month'] }},
                                                                                                    {{ request()->year }})
                                                                                                </h5>
                                                                                                <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                                    <span
                                                                                                        aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div id="modalBody"
                                                                                                class="modal-body">
                                                                                                <table class="table table-responsive table-striped">
                                                                                                    <tbody style="width: 100%">
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                Product's Revenue:
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                {{$monthlyData['revenue']}}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                Doctor Honor:
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                {{$monthlyData['discount']}}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                Product Cost:
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                {{$monthlyData['cost']}}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                Expenses
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                {{$monthlyData['expense']}}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                Profit
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                {{$monthlyData['profit']-$monthlyData['expense']}}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                    <tr>
                                                                        @foreach ($monthlyDatam as $monthlyData)
                                                                            <td width="8.3%">
                                                                                <strong>{{ $monthlyData['profit'] }}</strong>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
