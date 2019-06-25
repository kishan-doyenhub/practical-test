@extends('layouts.appmaster')

@section('content')

<div class="col-md-12">
    <div class="box box-primary">
        <!-- form start -->
        <form enctype="multipart/form-data" method="post" action="{{route('customer.store')}}">
            {{ csrf_field() }}
            <div class="box-body">
                <input type="hidden" name="customer_id" value="{{ $customer_data->id }}">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required value="{{ $customer_data->name }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required value="{{ $customer_data->email }}">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-primary" href="{{route('customer.index')}}">Back</a>
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