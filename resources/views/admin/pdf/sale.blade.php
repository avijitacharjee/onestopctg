<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<style>
    /* .table > thead:first-child > tr:first-child > th {
        background-color: #428bca;
        color: white;
        border-color: #357ebd;
        border-top: 1px solid #357ebd;
        text-align: center;
    } */
</style>

<body>
    <div class="modal-content">
        <div class="modal-body">
            <div class="text-center" style="margin-bottom:20px;">
                <img src="{{ public_path('images/logo1.png') }}" alt="Test Biller">
            </div>
            <div class="well well-sm">
                <div class="row bold">
                    <div class="col-xs-5">
                        <p class="bold">
                            Date: {{ $sale->date_text }}<br>
                            {{-- Reference: SALE2022/12/0061<br> --}}
                            Sale Status: Completed<br>
                            Payment Status: Paid<br>
                        </p>
                    </div>
                    <div class="col-xs-7 text-right order_barcodes">
                        {{-- <img src="https://barcodeapi.org/api/auto/avijit" alt="SALE2022/12/0061" class="bcimg" height="80px"> --}}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row" style="margin-bottom:15px;">
                <div class="col-xs-6">
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
                {{-- <div class="col-xs-6">
                        From:
                        <h2 style="margin-top:10px;">Test Biller</h2>
                        Biller adddress<br>Dhaka <br>Bangladesh
                        <p><br>VAT Number: 5555</p>
                        Tel: 012345678<br>Email: saleem@site.com
                    </div> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped print-table order-table"
                style="table-layout: fixed">
                    <thead>
                        <tr>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: left">Description</th>
                            <th style="text-align: center">Quantity</th>
                            <th style="text-align: center">Sample</th>
                            <th style="text-align: center">Bonus</th>
                            <th style="text-align: center">Unit Price</th>
                            <th style="text-align: center">Tax</th>
                            <th style="text-align: center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->saleItems as $saleItem)
                            <tr>
                                <td style="text-align:center; width:40px; vertical-align:middle;">
                                    {{ $loop->index }}</td>
                                <td style="vertical-align:middle;">
                                    {{ $saleItem->product->name }}
                                </td>
                                <td style="width: 80px; text-align:center; vertical-align:middle;">
                                    {{ $saleItem->quantity }}</td>
                                <td style="width: 80px; text-align:center; vertical-align:middle;">
                                    {{ $saleItem->sample }}</td>
                                <td style="width: 80px; text-align:center; vertical-align:middle;">
                                    {{ $saleItem->bonus }}</td>
                                <td style="text-align:center; width:100px;">
                                    {{ $saleItem->price }}
                                </td>
                                <td style="width: 100px; text-align:center; vertical-align:middle;">
                                    <small>(VAT10)</small> 00.00
                                </td>
                                <td style="text-align:center; width:120px;">
                                    {{ $saleItem->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" style="text-align:right; padding-right:10px;">
                                Total (BDT)
                            </td>
                            <td style="text-align:center;">0.00
                            </td>
                            <td style="text-align:center; padding-right:10px;">
                                {{ $sale->total }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right; font-weight:bold;">
                                Total Amount (BDT)
                            </td>
                            <td style="text-align:center; padding-right:10px; font-weight:bold;">
                                {{ $sale->total }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right; font-weight:bold;">
                                Paid (BDT)
                            </td>
                            <td style="text-align:center; font-weight:bold;">
                                {{ $sale->total }}</td>
                        </tr>
                        {{-- <tr>
                                <td colspan="6"
                                    style="text-align:center; font-weight:bold;">
                                    Balance (BDT)
                                </td>
                                <td
                                    style="text-align:center; font-weight:bold;">
                                    {{0}}</td>
                            </tr> --}}
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
