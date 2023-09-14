@extends('admin.layout')
@section('content')
    <section class="content-wrapper">
        <x-content-header name="Add product" subDirectory="Product" subDirectoryUrl="product" />
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <form method="POST" action="/customer/add-csv" enctype="multipart/form-data" class="m-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                @csrf

                                <div class="form-group">
                                    <label for="">Upload csv</label>
                                    <input type="file" name="csv" accept=".csv" class="form-control" required>
                                </div>

                                @if (session('message'))
                                    <div style="color: green">
                                        <ul>
                                            <li>{{ session('message') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="/csv-sample" class="btn btn-secondary">
                                    Download Format
                                </a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->




                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
    </section>
@endsection
@section('js')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
