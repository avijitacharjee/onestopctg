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
                        <form method="POST" action="{{route('sale.store')}}">
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
                                    <label for="">Product <sub>( with stock )</sub></label>
                                    <input type="text" name="product" id="product" class="form-control">
                                    <input type="hidden" name="product_id" id="product_id">
                                    <input type="hidden" name="price" id="price">
                                </div>
                                <button id="addButton" style="float: left;" class="btn btn-secondary">Add to list</button>
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Sample</th>
                                            <th>Bounus</th>
                                            <th>Dr honor</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Sample</th>
                                            <th>Bounus</th>
                                            <th>Dr honor</th>
                                            <th>Subtotal</th>
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
                                <button id="clearButton" style="float: right;" class="btn btn-danger">Clear</button>
                                <button id="previewButton" style="float: right;margin-right:20px;" type="button"
                                    class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                                    class="btn btn-success">Preview</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade .modal-xl" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document"
                                    style="width:100%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Invoice</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div id="modalBody" class="modal-body">
                                            <table id="tableModal" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Sample</th>
                                                        <th>Bounus</th>
                                                        <th>Dr honor</th>
                                                        <th>Sub-total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyModal">

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        {{-- <th>#</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Sample</th>
                                                        <th>Bounus</th> --}}
                                                        <th colspan="7"></th>
                                                        <th>total</th>
                                                        <th>
                                                            <span id="total"></span>
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
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
    <!-- Button trigger modal -->
@endsection
@section('js')
    <script>
        $.get(`${window.location.origin}/api/customers`, function(response) {
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
                    if ($('#customer').val() != '') {
                        $('#customer').attr('disabled', 'disabled');
                    }
                    $('#customer').val(ui.item.label);
                    $('#customer_id').val(ui.item.value);
                    return false;
                },
                change: function(event, ui) {
                    if (!ui.item) {
                        //http://api.jqueryui.com/autocomplete/#event-change -
                        // The item selected from the menu, if any. Otherwise the property is null
                        //so clear the item for force selection
                        $("#customer").val("");
                    }
                }
            });

        });

        $.get(`${window.location.origin}/api/products`, function(response) {
            console.log(response.data);
            var data = [];
            for (var i = 0; i < response.data.length; i++) {
                data.push({
                    'value': response.data[i].id,
                    'label': `${response.data[i].name} - (${response.data[i].quantity})`,
                    'name': response.data[i].name,
                    'price': response.data[i].sale_price,
                });
            }
            $("#product").autocomplete({
                source: data,
                select: function(event, ui) {
                    $('#product').val(ui.item.name);
                    $('#product_id').val(ui.item.value);
                    $('#price').val(ui.item.price);
                    return false;
                },
                change: function(event, ui) {
                    if (!ui.item) {
                        //http://api.jqueryui.com/autocomplete/#event-change -
                        // The item selected from the menu, if any. Otherwise the property is null
                        //so clear the item for force selection
                        $("#product").val("");
                    }
                }
            });
        });

        $('#addButton').click(function(e) {
            e.preventDefault();
            if ($('#customer').val() == '' || $('#product').val() == '') {
                alert('Please select customer and product');
                return false;
            }
            var index = $('#tbody').children().length;
            $('#tbody').append(
                `
                    <tr>
                        <td>${index+1}</td>
                        <td id='customer${index}'>${$('#customer').val()}</td>
                        <td id='product${index}'>${$('#product').val()}</td>
                        <td>
                            ${$('#price').val()}
                            <input type='hidden' name='prices[]' id='price${index}' value='${$('#price').val()}'/>
                        </td>
                        <td>
                            <input type='number' min='0' id='quantity${index}' name='quantities[]' class="form-control"/>
                            <input type='hidden' name='product_ids[]' value='${$('#product_id').val()}' />
                        </td>
                        <td>
                            <input type='number' min='0' id='sample${index}' name='samples[]' class="form-control"/>
                        </td>
                        <td>
                            <input type='number' min='0' id='bonus${index}' name='bonuses[]'class="form-control"/>
                        </td>
                        <td>
                            <input type='number' min='0' id='discount${index}' name='discounts[]' class="form-control"/>
                        </td>
                        <td id='subtotal${index}'>
                            0
                        </td>
                    </tr>
                    `
            );
            // $('#quantity' + index).change(function() {
            //     $subtotal = $('#price').val() * $('#quantity' + index).val();
            //     $('#subtotal' + index).html($subtotal);

            // });
            $('#quantity' + index).change(function() {
                $('#subtotal' + index).html($('#quantity' + index).val() * $('#price' + index).val()-$('#discount'+index).val());
            });
            $('#discount' + index).change(function() {
                $('#subtotal' + index).html($('#quantity' + index).val() * $('#price' + index).val()-$('#discount'+index).val());
            });
        });
        $('#previewButton').click(function(e) {
            e.preventDefault();
            $('#tbodyModal').html('');
            let itemCount = $('#tbody').children().length;
            let total = 0;
            for (let i = 0; i < itemCount; i++) {
                let quantity = $('#quantity' + i).val();
                let sample = $('#sample' + i).val();
                let bonus = $('#bonus' + i).val();
                let discount = $('#discount' + i).val();
                let price = $('#price' + i).val();
                let subTotal = (quantity) * price - discount;
                total = total + subTotal;
                $('#tbodyModal').append(
                    `
                        <tr>
                            <td>${i+1}</td>
                            <td>${$('#customer'+i).html()}</td>
                            <td>${$('#product'+i).html()}</td>
                            <td>${price}</td>
                            <td>${quantity}</td>
                            <td>${sample}</td>
                            <td>${bonus}</td>
                            <td>${discount}</td>
                            <td>${subTotal}</td>
                        </tr>
                    `
                );
            }
            $('#total').html(total);
        });
        $('#clearButton').click(function(e) {
            e.preventDefault();
            $('#tbody').html('');
        });
    </script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
