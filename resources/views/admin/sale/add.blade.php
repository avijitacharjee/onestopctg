@extends('admin.layout')
@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@endsection
@section('content')
    <section class="content content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Sale</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/sale">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Customer name</label>
                                    <input type="text" name="name" class="form-control" id="customer"
                                        placeholder="Name">
                                    <input type="hidden" name="customer_id" id="customer_id">
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label for="">Product</label>
                                    <input type="text" name="product" id="product" class="form-control">
                                    <input type="hidden" name="product_id" id="product_id">
                                </div>
                                <button id="addButton" style="float: left;" class="btn btn-secondary">Add to list</button>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Customer name</th>
                                      <th>Product</th>
                                      {{-- <th>Price</th> --}}
                                      <th>Quantity</th>
                                      <th>Bounus/Dr reffered</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer name</th>
                                        <th>Product</th>
                                        {{-- <th>Price</th> --}}
                                        <th>Quantity</th>
                                        <th>Bounus/Dr reffered</th>
                                    </tr>
                                    </tfoot>
                                  </table>
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
                                <button type="submit" style="float: right" class="btn btn-primary">Submit</button>
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
    <script>
        $.get("http://localhost:8000/api/customers", function(response) {
            console.log(response.data);
            var data = [];
            for (var i = 0; i < response.data.length; i++) {
                data.push({
                    'value': response.data[i].id,
                    'label': response.data[i].name,
                });
            }
            $("#customer").autocomplete({
                source: data,
                select: function(event, ui) {
                    if($('#customer').val()!=''){
                        $('#customer'). attr('disabled','disabled');
                    }
                    $('#customer').val(ui.item.label);
                    $('#customer_id').val(ui.item.value);
                    return false;
                }
            });

        });

        $.get("http://localhost:8000/api/products", function(response) {
            console.log(response.data);
            var data = [];
            for (var i = 0; i < response.data.length; i++) {
                data.push({
                    'value': response.data[i].id,
                    'label': response.data[i].name,
                });
            }
            $("#product").autocomplete({
                source: data,
                select: function(event, ui) {
                    $('#product').val(ui.item.label);
                    $('#product_id').val(ui.item.value);
                    return false;
                }
            });

        });

        $('#addButton').click(function(e){
                e.preventDefault();
                if($('#customer').val()=='' || $('#product').val()==''){
                    alert('Please select customer and product');
                    return false;
                }
                $('tbody').append(
                    `
                    <tr>
                        <td>${$('tbody').children().length}</td>
                        <td>${$('#customer').val()}</td>
                        <td>${$('#product').val()}</td>
                        <td>
                            <input type='number' name='quantities[]'/>
                            <input type='hidden' name='product_ids[]' value='${$('#product_id').val()}'/>
                        </td>
                        <td>
                            <div class="form-check">
                                <input name="is_bonuses[]" class="form-check-input" type="checkbox" value="${$('tbody').children().length}" id="flexCheckDefault">
                            </div>
                        </td>
                    </tr>
                    `
                );
            });
    </script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
