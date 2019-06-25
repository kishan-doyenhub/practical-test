@extends('layouts.appmaster')

@section('content')

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">

            <div class="form-group row">
                <label for="customer" class="col-sm-2 control-label">Customer Name</label>
                <div class="col-sm-10">{{ $orderData->customer_id }} </div>
            </div>               
            <div class="form-group row">
                <label for="invoice_no" class="col-sm-2 control-label">Invoice Number </label>
                <div class="col-sm-10">{{ $orderData->invoice_number }} </div>
            </div>
            <div class="form-group row">
                <label for="invoice_no" class="col-sm-2 control-label">Total Amount </label>
                <div class="col-sm-10">{{ $orderData->total_amount }} </div>
            </div>
            <div class="form-group row">
                <label for="invoice_no" class="col-sm-2 control-label">Status </label>
                <div class="col-sm-10">{{ $orderData->status }} </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-12">
                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:center;">Product Name</th>
                                <th style="text-align:center;">Quantity</th>
                                <th style="text-align:center;">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orderItemData) != 0)
                                @foreach($orderItemData as $item)
                                    <?php $pData = \App\Product::where('id',$item->product_id)->first(); ?>
                                    <tr style="text-align:center">
                                        <td>{{ $pData->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $pData->price }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="center">
                                <td colspan="2"> No Record Found</td>
                                </tr>
                            @endif
                            <tr><td></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="box-footer">
                <a class="btn btn-primary" href="{{route('order.index')}}">Back</a>
        </div>
    </div>
</div>

@endsection

@section('body_bottom')
    <script>
    </script>    
@endsection