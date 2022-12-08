@extends('admin.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer name</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sample</th>
                    <th>Bonus</th>
                    <th>Discount</th>
                    <th>Subtotal (bdt )</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                        $index=1;
                    @endphp
                    @foreach ($sales as $sale)
                        @if(isset($sale->saleItems))
                        @foreach ($sale->saleItems as $saleItem)
                        <tr>
                            @if($loop->first)
                                <td rowspan="{{$sale->saleItems->count()}}">{{$index++}}</td>
                                <td rowspan="{{$sale->saleItems->count()}}">{{$saleItem->customer->name}}</td>
                            @endif
                            <td>{{$saleItem->product->name}}</td>
                            <td>{{$saleItem->price}}</td>
                            <td>{{$saleItem->quantity}}</td>
                            <td>{{$saleItem->sample}}</td>
                            <td>{{$saleItem->bonus}}</td>
                            <td>{{$saleItem->discount}}</td>
                            <td>{{($saleItem->quantity*$saleItem->price)-$saleItem->discount}}</td>
                            {{-- <td>{{$sale->expire_date}}</td>
                            <td>{{$sale->cost_of_goods}}</td>
                            <td>{{$sale->sale_price}}</td>
                            <td>{{$sale->quantity}}</td>
                            <td>
                                <form action="/sale/{{$sale->id}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" style="border: none;">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="/sale/{{$sale->id}}/edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td> --}}
                        </tr>
                        @endforeach
                        @endif

                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Customer name</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sample</th>
                    <th>Bonus</th>
                    <th>Discount</th>
                    <th>Subtotal</th>
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
    <script src="{{asset('lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('lte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('lte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
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
