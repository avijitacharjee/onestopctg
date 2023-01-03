@extends('admin.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .dropdown-menu {
            list-style: none;
            text-shadow: none;
            border-radius: 0px;
        }

        .dropdown-menu li a i {
            padding-right: 10px;
        }

        .well {
            border: 1px solid #ddd;
            background-color: #f6f6f6;
            box-shadow: none;
            border-radius: 0px;
        }

        .bold {
            font-weight: bold;
        }

        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        .table>thead:first-child>tr:first-child>th {
            background-color: #428bca;
            color: white;
            border-color: #357ebd;
            border-top: 1px solid #357ebd;
            text-align: center;
        }

        #paymentList td,
        th {
            text-align: center;
        }
    </style>
    <style media="print">
        .modal-content {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .table>thead:first-child>tr:first-child>th {
            background-color: white;
            color: black;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <x-content-header name="List sale" subDirectory="Sale" subDirectoryUrl="sale" />

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
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <button class="dropdown-item" id="listPaymentButton"
                                                                data-toggle="modal"
                                                                data-target="#listPaymentModal{{ $loop->index }}">View
                                                                payment</button>
                                                            <button class="dropdown-item" id="addPaymentButton"
                                                                data-toggle="modal"
                                                                data-target="#addPaymentModal{{ $loop->index }}">Add
                                                                payment</button>
                                                            {{-- <a class="dropdown-item" href="#">Edit sale</a> --}}
                                                            <form action="/sale/{{ $sale->id }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button class="dropdown-item" type="submit">Delete
                                                                    sale</button>
                                                            </form>
                                                            <a class="dropdown-item"
                                                                href="/sale/pdf/{{ $sale->id }}">Download pdf</a>
                                                            <button class="dropdown-item" data-toggle="modal"
                                                                data-target="#myModal{{ $loop->index }}">Sale
                                                                details</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade .modal-xl"
                                                        id="listPaymentModal{{ $loop->index }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl"
                                                            role="document" style="width:100%;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Payments</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
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
                                                                                    <td>{{ $loop->iteration }}</td>
                                                                                    <td>{{ $payment->payment_date }}</td>
                                                                                    <td>{{ $payment->reference_no }}</td>
                                                                                    <td>{{ $payment->amount }}</td>
                                                                                    <td>{{ $payment->payment_method }}</td>
                                                                                    <td>{{ $payment->note }}</td>
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
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade .modal-xl"
                                                        id="addPaymentModal{{ $loop->index }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                        aria-hidden="true">
                                                        <form action="/payment" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="sale_id"
                                                                value="{{ $sale->id }}">
                                                            <div class="modal-dialog modal-dialog-centered .modal-xl"
                                                                role="document" style="width:100%;">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                                            Add Payment
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div id="modalBody" class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Date</label>
                                                                                    <input type="date"
                                                                                        name="payment_date"
                                                                                        class="form-control"
                                                                                        value="<?php echo date('Y-m-d'); ?>"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Reference
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
                                                                                    <label for="">Amount</label>
                                                                                    <input type="number" step="any"
                                                                                        name="amount"
                                                                                        class="form-control"
                                                                                        id=""
                                                                                        max="{{ $sale->due }}"
                                                                                        placeholder="Amount" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Paying by</label>
                                                                                    <select name="payment_method"
                                                                                        class="form-control">
                                                                                        <option value="cash">Cash
                                                                                        </option>
                                                                                        <option value="cheque">Cheque
                                                                                        </option>
                                                                                        <option value="deposit">Deposit
                                                                                        </option>
                                                                                        <option value="other">Other
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Note</label>
                                                                                    <textarea name="note" class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
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
                                                                                        Payment Status: Paid<br>
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
                                                                                                {{ $loop->iteration }}</td>
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
                                                                                                {{ $saleItem->bonus }}</td>
                                                                                            <td
                                                                                                style="text-align:right; width:100px;">
                                                                                                {{ $saleItem->price }}
                                                                                            </td>
                                                                                            <td
                                                                                                style="width: 100px; text-align:right; vertical-align:middle;">
                                                                                                <small>(VAT10)</small> 00.00
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
                                                            <script type="text/javascript">
                                                                $(document).ready(function() {
                                                                    $('.tip').tooltip();
                                                                });
                                                            </script>
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
    <script>
        $(document).ready(function() {
            $('.tip').tooltip();
        });
        document.getElementById("btnPrint").onclick = function() {
            //console.log('hi');
            printElement(document.getElementById("printThis"));
        }

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
@endsection
