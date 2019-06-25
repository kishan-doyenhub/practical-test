@extends('layouts.appmaster')

@section('content')

<div class="col-md-12">
    <div class="box box-primary">
        <!-- form start -->
        <form enctype="multipart/form-data" method="post" action="{{route('product.store')}}">
            {{ csrf_field() }}
            <div class="box-body">
                <input type="hidden" name="product_id" value="{{ $product_data->id }}">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required value="{{ $product_data->name }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">Price <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="price" min=0 class="form-control" id="price" placeholder="Price" required value="{{ $product_data->price }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="in_stock" class="col-sm-2 control-label">In Stock <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="in_stock" min=0 class="form-control" id="in_stock" placeholder="In Stock" required value="{{ $product_data->in_stock }}">
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-primary" href="{{route('product.index')}}">Back</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('body_bottom')
    <script>
        $(document).ready(function(){
        });
    </script>    
@endsection