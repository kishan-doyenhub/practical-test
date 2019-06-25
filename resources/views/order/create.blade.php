@extends('layouts.appmaster')

@section('content')

<div class="col-md-12">
    <div class="box box-primary">
        <!-- form start -->
        <form enctype="multipart/form-data" method="post" action="{{route('order.store')}}">
            {{ csrf_field() }}
            <div class="box-body">
                <input type="hidden" name="order_id" value="{{ $order_data->id }}">

                <div class="form-group">
                    <label for="customer" class="col-sm-2 control-label">Customer <span class="required">*</span></label>
                    <div class="col-sm-10">
                        {!! Form::select('customer_id', $customer, $order_data->customer_id, ['class' => 'form-control thisPageSelect2', 'required', 'id' => 'customer']) !!}
                    </div>
                </div>               
                <div class="form-group">
                    <label for="invoice_no" class="col-sm-2 control-label">Invoice Number <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="invoice_number" class="form-control" id="invoice_no" placeholder="Invoice Number" required value="{{ $order_data->invoice_number }}">
                    </div>
                </div>

                <div class="col-sm-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Pirce</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="append_item">
                                <?php $row=0;?>
                                <tr id="product_item_{{ $row }}" row="{{ $row }}" style="display:none;" data-ajax-id="{{ $row }}" >
                                    <td>
                                        <input type="hidden" name="item_id[]" value="" id="item_id_{{$row}}" row="{{ $row }}">
                                        <select name="product_id[]" id="product_data_item_{{$row}}" row="{{ $row }}" class="form-control thisPageSelect2">
                                            <option value="">--Select--</option>
                                            @foreach($product as $key => $pData)
                                                <option value="{{ $pData->id }}" data-qty="{{ $pData->in_stock }}" data-price="{{ $pData->price }}">{{ $pData->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" min=0 class="form-control" id="quantity_{{ $row }}" row="{{ $row }}" placeholder="Enter Quantity" value="">
                                    </td>
                                    <td>
                                        <input type="number" name="price[]" class="form-control" id="price_{{ $row }}" row="{{ $row }}" placeholder="Enter Price" readonly value="0.00">
                                    </td>
                                    <td>
                                        <a class="btn btn-danger deleteRow" id="deletes_{{ $row }}" row="{{ $row }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $row++;?>
                                @foreach($order_item as $item_data)
                                    <tr id="product_item_{{ $row }}" row="{{ $row }}" data-ajax-id="{{ isset($item_data->id)?$item_data->id:0 }}" >
                                        <td>
                                            <input type="hidden" name="item_id[]" value="{{ $item_data->id }}" id="item_id_{{$row}}" row="{{ $row }}">
                                            <select name="product_id[]" id="product_data_item_{{$row}}" row="{{ $row }}" class="form-control thisPageSelect2">
                                                <option value="">--Select--</option>
                                                @foreach($product as $key => $pData)
                                                    <option value="{{ $pData->id }}" data-qty="{{ $pData->in_stock }}" data-price="{{ $pData->price }}" {{ ($item_data->product_id == $pData->id) ? "selected" : "" }}>{{ $pData->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" min=0 class="form-control" id="quantity_{{ $row }}" row="{{ $row }}" placeholder="Enter Quantity" value="{{ $item_data->quantity }}">
                                        </td>
                                        <td>
                                            <input type="number" name="price[]" class="form-control" id="price_{{ $row }}" row="{{ $row }}" placeholder="Enter Price" readonly value="0.00">
                                        </td>
                                        <td>
                                            <a class="btn btn-danger deleteRow" id="deletes_{{ $row }}" row="{{ $row }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $row++; ?>
                                @endforeach
                            </tbody>
                            <tfoot class="FirstSelectRooms">
                                <tr>
                                    <td colspan="1">
                                        <button type="button" id="add_new" class="btn btn-primary AddNewRoomType"><i class="fa fa-plus"></i>Add More</button>
                                    </td>
                                    <td colspan="2" align="right" style="font-size: 20px;">
                                        <span>Total Amount :</span>
                                        <span id="total_amount">0.00</span></br>
                                        <input type="hidden" name="final_amt" id="total_final_amount"/>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-primary" href="{{route('order.index')}}">Back</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('body_bottom')
    <script>
        $(document).ready(function(){
            $('.thisPageSelect2').select2();
        });

        var row = {{ $row }};
        var $date_clone  = $('#product_item_0');
        var $append_dates = $('#append_item');
        $('#add_new').on('click', function () {            
            // $('.thisPageSelect2').select2('destroy');
            $("select.select2-hidden-accessible").select2("destroy");
            var $slabDatePer = $date_clone.clone(true);
            $slabDatePer.css('display', '');
            $slabDatePer.attr('data-ajax-id', 0);
            $slabDatePer.find('[id^="product_data_item_"]').attr('id', "product_data_item_" + row).attr('row', row).val('');
            $slabDatePer.find('[id^="quantity_"]').attr('id', "quantity_" + row).attr('row', row).val('');
            $slabDatePer.find('[id^="price_"]').attr('id', "price_" + row).attr('row', row).val('0.00');
            $slabDatePer.find('[id^="deletes_"]').attr('id', "deletes_" + row).attr('row', row);
            $slabDatePer.attr('id', 'product_item_' + row);
            $slabDatePer.attr('row', row);
            $slabDatePer.find('[class^="deleteRow"]').attr('class', "deleteRow").show();
            $append_dates.append($slabDatePer);
            $('.thisPageSelect2').select2();
            row = row + 1;
        });

        $(document).on('change', '[id^="product_data_item_"]', function() {
            var row = $(this).attr('row');
            var qty = $(this).find("option:selected").data('qty');
            $("#quantity_"+row).attr('max',qty);
            calculate_amount(row);
        });

        $(document).on('change', '[id^="quantity_"]', function() {
            var row = $(this).attr('row');
            calculate_amount(row);
        });

        $(document).on('click', '[id^="deletes_"]', function() {
            var row = $(this).attr('row');
            var $delete_product_item_row  = $('#product_item_'+row);
            var $check_exists_id = $delete_product_item_row.attr('data-ajax-id');
            var user_response = confirm("Are you sure ?");
            if(!user_response) {
                return false;
            }
            if($check_exists_id != '' && $check_exists_id != 0)
            {
                $.ajax({
                    url : '{{ route("productitemdata.delete")}}',
                    type :'post',
                    data: {'check_exists_id':$check_exists_id, '_token': $('input[name=_token]').val()},
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
            $delete_product_item_row.remove();
            calculate_final_amount();
        });

        add_product_amt();
        function add_product_amt() {
            $('[id^="product_item_"]').each(function() {
                var row = $(this).attr('row');
                var qty = $("#product_data_item_"+row).find("option:selected").data('qty');
                var edit_qty = $("#quantity_"+row).val();
                var max_qty = +qty + +edit_qty; 
                $("#quantity_"+row).attr('max',max_qty);
                calculate_amount(row)
            })
        }

        function calculate_amount(row) {
            var price = $("#product_data_item_"+row).find("option:selected").data('price');
            var product_val = $("#quantity_"+row).val();
            if(product_val != 0){
                product_val = product_val * price;
            }
            $("#price_"+row).val(product_val);
            calculate_final_amount();
        }

        calculate_final_amount();
        function calculate_final_amount() {
            var final_amount = 0;

            $('[id^="product_item_"]').each(function() {
                var row = $(this).attr('row');
                var amount = isNaN(parseFloat($("#price_"+row).val())) ? 0 : parseFloat($("#price_"+row).val());
                if(amount > 0) {
                    $('#product_item_'+row).attr('required','required');
                } else {
                    $('#product_item_'+row).removeAttr('required');
                }
                final_amount += amount;
            });
            $("#total_amount").text(parseFloat(final_amount).toFixed(2));
            $("#total_final_amount").val(parseFloat(final_amount).toFixed(2));
        }
    </script>    
@endsection