@extends('admin.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tax Report</h1>
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
                                <h3 class="card-title">Tax</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- <p>
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse"
                                        data-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Add Filtering
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <form action="" method="get">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Product</label>
                                                        <input type="text" name="product" class="form-control" value="{{request()->product}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Customer</label>
                                                        <input type="text" name="customer" class="form-control" value="{{request()->customer}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Start date</label>
                                                        <input type="date" name="start_date" id="" value="{{request()->start_date}}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">End date</label>
                                                        <input type="date" name="end_date" id="" value="{{request()->end_date}}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Payment status</label>
                                                        <select name="payment_status" id="" class="form-control">
                                                            <option @selected(request()->payment_status=="all") value="all">All</option>
                                                            <option @selected(request()->payment_status=="due") value="due">Due</option>
                                                            <option @selected(request()->payment_status=="paid") value="paid">Paid</option>
                                                            <option @selected(request()->payment_status=="pending") value="pending">Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}
                                <table id="example1" class="table table-bordered table-responsive table-sm">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference No.</th>
                                            <th>Status</th>
                                            <th>Product tax</th>
                                            <th>Grand total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($sales as $sale)
                                            <tr>
                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                <td>{{ $sale->date }}</td>
                                                <td>{{ $sale->reference_no }}</td>
                                                <td style="width:5%;">
                                                    <x-payment-status message="{{ $sale->payment_status }}" />
                                                </td>
                                                <td>{{ $sale->tax }}</td>
                                                <td>{{ $sale->total+$sale->tax }}</td>
                                                <td>
                                                    <button style="border: none;" data-toggle="modal"
                                                    data-target="#myModal{{ $loop->index }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <div id="printThis">
                                                        <div class="modal fade in" id="myModal{{ $loop->index }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="myModalLabel{{ $loop->index }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg no-modal-header">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-hidden="true">
                                                                            <i class="fa fa-2x">×</i>
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-md btn-default no-print pull-right"
                                                                            style="margin-right:15px;" id="btnPrint">
                                                                            <i class="fa fa-print"></i> Print </button>
                                                                        <div class="text-center"
                                                                            style="margin-bottom:20px;">
                                                                            <img src="{{ asset('images/logo1.png') }}"
                                                                                alt="Test Biller">
                                                                        </div>
                                                                        <div class="well well-sm">
                                                                            <div class="row bold">
                                                                                <div class="col-md-5">
                                                                                    <p class="bold">
                                                                                        Date: {{ $sale->date_text }}<br>
                                                                                        {{-- Reference: SALE2022/12/0061<br> --}}
                                                                                        Sale Status: Completed<br>
                                                                                        Payment Status: {{$sale->payment_status}}<br>
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-md-7 text-right order_barcodes">
                                                                                    <img src="https://barcodeapi.org/api/auto/s/{{ $sale->id }}"
                                                                                        alt="SALE2022/12/0061"
                                                                                        class="bcimg" height="80px">
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="row" style="margin-bottom:15px;">
                                                                            <div class="col-md-6">
                                                                                To:<br>
                                                                                <h2 style="margin-top:10px;">
                                                                                    {{ $sale->customer->name }}
                                                                                </h2>
                                                                                <p></p>
                                                                                Tel: {{ $sale->customer->phone }}
                                                                                <br>
                                                                                Email: {{ $sale->customer->email }}
                                                                                <br>
                                                                                Zone: {{ $sale->customer->zone }}

                                                                            </div>
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
                                                                                                {{ $loop->iteration }}</td>
                                                                                            <td
                                                                                                style="vertical-align:middle; width: 40px;">
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
                                                                                                {{ $saleItem->bonus }}</td>
                                                                                            <td
                                                                                                style="text-align:right; width:100px;">
                                                                                                {{ $saleItem->price }}
                                                                                            </td>
                                                                                            <td style="text-align: right;">
                                                                                                {{-- style="width: 100px; text-align:right; vertical-align:middle;"> --}}
                                                                                                {{-- <small>(VAT)</small> --}}
                                                                                                 {{$saleItem->product->tax*$saleItem->quantity}}
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align:right; width:120px;">
                                                                                                {{ $saleItem->total }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <td colspan="6"
                                                                                            style="text-align:right; padding-right:10px;">
                                                                                            Total (BDT)
                                                                                        </td>
                                                                                        <td style="text-align:right;">0.00
                                                                                        </td>
                                                                                        <td
                                                                                            style="text-align:right; padding-right:10px;">
                                                                                            {{ $sale->total }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="6"
                                                                                            style="text-align:right; font-weight:bold;">
                                                                                            Total Amount (BDT)
                                                                                        </td>
                                                                                        <td
                                                                                            style="text-align:right; padding-right:10px; font-weight:bold;">
                                                                                            {{ $sale->total }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="6"
                                                                                            style="text-align:right; font-weight:bold;">
                                                                                            Paid (BDT)
                                                                                        </td>
                                                                                        <td
                                                                                            style="text-align:right; font-weight:bold;">
                                                                                            {{ $sale->total }}</td>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>

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
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>{{$sales->sum('tax')}}</th>
                                            <th>{{$sales->sum('total')}}</th>
                                            <th></th>
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
                "aaSorting": [],
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
