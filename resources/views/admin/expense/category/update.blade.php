@extends('admin.layout')
@section('content')
    <section class="content content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="/product/{{ $product->id }}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        value="{{ $product->name }}" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Generic name</label>
                                    <input type="text" name="generic_name" class="form-control"
                                        value="{{ $product->generic_name }}" id="exampleInputPassword1"
                                        placeholder="Generic name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Group name</label>
                                    <input type="text" name="group_name" class="form-control" id="exampleInputPassword1"
                                        value="{{ $product->group_name }}" placeholder="Group name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Batch name</label>
                                    <input type="text" name="batch_name" class="form-control" id="exampleInputPassword1"
                                        value="{{ $product->batch_name }}" placeholder="Batch name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Expiry date</label>
                                    <input type="date" name="expire_date" class="form-control"
                                        value="{{ $product->expire_date }}" id="exampleInputPassword1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Cost of goods</label>
                                    <input type="number" name="cost_of_goods" step="any" class="form-control"
                                        id="exampleInputPassword1" value="{{ $product->cost_of_goods }}"
                                        placeholder="Cost of goods">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sale price</label>
                                    <input type="number" name="sale_price" step="any" class="form-control"
                                        id="exampleInputPassword1" value="{{ $product->sale_price }}"
                                        placeholder="Sale price">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quantity</label>
                                    <input type="number" name="quantity" class="form-control"
                                        value="{{ $product->quantity }}" id="exampleInputPassword1" placeholder="Quantity">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Alert quantity</label>
                                    <input type="number" name="alert_quantity" class="form-control"
                                        value="{{ $product->alert_quantity }}" id="exampleInputPassword1"
                                        placeholder="Alert quantity">
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
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->




                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('js')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
