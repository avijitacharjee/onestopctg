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
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <x-content-header name="Update product" subDirectory="Product" subDirectoryUrl="product"/>

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
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Sale Status</th>
                                            <th>Grand Total</th>
                                            <th>Paid</th>
                                            <th>Balance</th>
                                            <th>Payment status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sale->date_text}}</td>
                                                <td>{{ $sale->customer->name }}</td>
                                                <td>{{ "Completed" }}</td>
                                                <td>{{ $sale->total }}</td>
                                                <td>{{ $sale->total }}</td>
                                                <td>0</td>
                                                <td>Paid
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">View payment</a>
                                                            <a class="dropdown-item" href="#">Add payment</a>
                                                            <a class="dropdown-item" href="#">Edit sale</a>
                                                            <a class="dropdown-item" href="#">Delete sale</a>
                                                            <a class="dropdown-item" href="#">Download pdf</a>
                                                            <button class="dropdown-item" data-toggle="modal"
                                                                data-target="#myModal{{ $loop->index }}">Sale
                                                                details</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <div class="modal fade in" id="myModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$loop->index}}" aria-hidden="false" style="display: block;">
                                                    <div class="modal-dialog modal-lg no-modal-header">
                                                      <div class="modal-content">
                                                        <div class="modal-body">
                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                          <i class="fa fa-2x">×</i>
                                                          </button>
                                                          <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
                                                          <i class="fa fa-print"></i> Print            </button>
                                                          <div class="text-center" style="margin-bottom:20px;">
                                                            <img src="https://pos2.onestopctg.com/assets/uploads/logos/logo1.png" alt="Test Biller">
                                                          </div>
                                                          <div class="well well-sm">
                                                            <div class="row bold">
                                                              <div class="col-xs-5">
                                                                <p class="bold">
                                                                  Date: 17/12/2022 18:53<br>
                                                                  Reference: SALE2022/12/0061<br>
                                                                  Sale Status: Completed<br>
                                                                  Payment Status: Pending<br>
                                                                </p>
                                                              </div>
                                                              <div class="col-xs-7 text-right order_barcodes">
                                                                <img src="https://pos2.onestopctg.com/admin/misc/barcode/U0FMRTIwMjIvMTIvMDA2MQ/code128/74/0/1" alt="SALE2022/12/0061" class="bcimg">
                                                              </div>
                                                              <div class="clearfix"></div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                          </div>
                                                          <div class="row" style="margin-bottom:15px;">
                                                            <div class="col-xs-6">
                                                              To:<br>
                                                              <h2 style="margin-top:10px;">MD.Safiul Karim Raza</h2>
                                                              Bogura<br>Bogura   <br>
                                                              <p></p>
                                                              Tel: 01711236190<br>Email: mizan_1279@yahoo.com
                                                            </div>
                                                            <div class="col-xs-6">
                                                              From:
                                                              <h2 style="margin-top:10px;">Test Biller</h2>
                                                              Biller adddress<br>Dhaka  <br>Bangladesh
                                                              <p><br>VAT Number: 5555</p>
                                                              Tel: 012345678<br>Email: saleem@site.com
                                                            </div>
                                                          </div>
                                                          <div class="table-responsive">
                                                            <table class="table table-bordered table-hover table-striped print-table order-table">
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
                                                                <tr>
                                                                  <td style="text-align:center; width:40px; vertical-align:middle;">1</td>
                                                                  <td style="vertical-align:middle;">
                                                                    02911734 - Omaprin-20
                                                                  </td>
                                                                  <td style="width: 80px; text-align:center; vertical-align:middle;">10.00 box</td>
                                                                  <!--  Riad -->
                                                                  <td style="width: 80px; text-align:center; vertical-align:middle;">5.00</td>
                                                                  <td style="width: 80px; text-align:center; vertical-align:middle;">5.00</td>
                                                                  <!-- //riad
                                                                    -->
                                                                  <td style="text-align:right; width:100px;">
                                                                    660.00
                                                                  </td>
                                                                  <td style="width: 100px; text-align:right; vertical-align:middle;"><small>(VAT10)</small> 600.00</td>
                                                                  <td style="text-align:right; width:120px;">6,600.00</td>
                                                                </tr>
                                                              </tbody>
                                                              <tfoot>
                                                                <tr>
                                                                  <td colspan="6" style="text-align:right; padding-right:10px;">Total                                (BDT)
                                                                  </td>
                                                                  <td style="text-align:right;">600.00</td>
                                                                  <td style="text-align:right; padding-right:10px;">6,600.00</td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="6" style="text-align:right; font-weight:bold;">Total Amount                            (BDT)
                                                                  </td>
                                                                  <td style="text-align:right; padding-right:10px; font-weight:bold;">6,600.00</td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="6" style="text-align:right; font-weight:bold;">Paid                            (BDT)
                                                                  </td>
                                                                  <td style="text-align:right; font-weight:bold;">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="6" style="text-align:right; font-weight:bold;">Balance                            (BDT)
                                                                  </td>
                                                                  <td style="text-align:right; font-weight:bold;">6,600.00</td>
                                                                </tr>
                                                              </tfoot>
                                                            </table>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-xs-12">
                                                              <div class="well well-sm">
                                                                <p class="bold">Note:</p>
                                                                <div>
                                                                  <p>test</p>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-xs-5 pull-right">
                                                              <div class="well well-sm">
                                                                <p>
                                                                  Created by: Owner Owner <br>
                                                                  Date: 17/12/2022 18:53
                                                                </p>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <!--  -->
                                                          <div class="buttons">
                                                            <div class="btn-group btn-group-justified">
                                                              <div class="btn-group">
                                                                <a href="https://pos2.onestopctg.com/admin/sales/add_payment/94" class="tip btn btn-primary" title="" data-toggle="modal" data-target="#myModal2" data-original-title="Add Payment">
                                                                <i class="fa fa-dollar"></i>
                                                                <span class="hidden-sm hidden-xs">Payment</span>
                                                                </a>
                                                              </div>
                                                              <div class="btn-group">
                                                                <a href="https://pos2.onestopctg.com/admin/sales/add_delivery/94" class="tip btn btn-primary" title="" data-toggle="modal" data-target="#myModal2" data-original-title="Add Delivery">
                                                                <i class="fa fa-truck"></i>
                                                                <span class="hidden-sm hidden-xs">Delivery</span>
                                                                </a>
                                                              </div>
                                                              <div class="btn-group">
                                                                <a href="https://pos2.onestopctg.com/admin/sales/email/94" data-toggle="modal" data-target="#myModal2" class="tip btn btn-primary" title="" data-original-title="Email">
                                                                <i class="fa fa-envelope-o"></i>
                                                                <span class="hidden-sm hidden-xs">Email</span>
                                                                </a>
                                                              </div>
                                                              <div class="btn-group">
                                                                <a href="https://pos2.onestopctg.com/admin/sales/pdf/94" class="tip btn btn-primary" title="" data-original-title="Download as PDF">
                                                                <i class="fa fa-download"></i>
                                                                <span class="hidden-sm hidden-xs">PDF</span>
                                                                </a>
                                                              </div>
                                                              <div class="btn-group">
                                                                <a href="https://pos2.onestopctg.com/admin/sales/edit/94" class="tip btn btn-warning sledit" title="" data-original-title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                                <span class="hidden-sm hidden-xs">Edit</span>
                                                                </a>
                                                              </div>
                                                              <div class="btn-group">
                                                                <a href="#" class="tip btn btn-danger bpo" title="" data-content="<div style='width:150px;'><p>Are you sure?</p><a class='btn btn-danger' href='https://pos2.onestopctg.com/admin/sales/delete/94'>Yes I'm sure</a> <button class='btn bpo-close'>No</button></div>" data-html="true" data-placement="top" data-original-title="<b>Delete Sale</b>">
                                                                <i class="fa fa-trash-o"></i>
                                                                <span class="hidden-sm hidden-xs">Delete</span>
                                                                </a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                      $(document).ready( function() {
                                                          $('.tip').tooltip();
                                                      });
                                                    </script>
                                                  </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Sale Status</th>
                                            <th>Grand Total</th>
                                            <th>Paid</th>
                                            <th>Balance</th>
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
            //printElement(document.getElementById("printThis"));
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
