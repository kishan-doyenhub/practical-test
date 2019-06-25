 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Practical Test</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }} ">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }} ">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }} ">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }} ">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/morris.js/morris.css') }} ">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/jvectormap/jquery-jvectormap.css') }} ">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }} ">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }} ">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }} ">

        <link rel="stylesheet" href="{{ asset('admin/style.css') }} ">

        <link href="{{ asset('plugin/snackbar/css/snackbar.css') }}" rel="stylesheet" type="text/css" />

        <!-- selectize -->
        <link href="{{ asset('admin/package/selectize/css/selectize.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/package/selectize/css/selectize.default.css') }}" rel="stylesheet" type="text/css" />

        <!-- Datatable -->
        @if(isset($assets) && (in_array('datatable',$assets) || in_array('datatable_builder',$assets)))
            <link rel="stylesheet" href="{{ asset('admin/package/datatable/css/dataTables.bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('admin/package/datatable/css/jquery.dataTables.min.css') }}">
            <link rel="stylesheet" href="{{ asset('admin/package/datatable/fixedColumns/fixedColumns.dataTables.min.css') }}">
            <style type="text/css">
                .has-danger{ color: red; }
                .dataTables_wrapper .dataTables_paginate .paginate_button {padding: 0px !important	;border-width: 0px !important;}
                .dataTables_wrapper .dataTables_paginate .paginate_button:hover {border-width: 0px !important;}
                .dataTables_wrapper .dataTables_processing {background-color: #ddd !important;background-image: none !important;height: 60px !important;}
                .dt-button {color: #fff !important;background-color: #20a8d8 !important;border-color: #20a8d8 !important;background-image: none !important;}
                .table .btn-xs {padding: 0.2rem 0.5rem !important;}
            </style>
        @endif
        <!-- Datatable Builder	-->
        @if(isset($assets) && in_array('datatable_builder',$assets))
            <link rel="stylesheet" href="{{ asset('admin/package/datatable/buttons/css/dataTables.buttons.min.css') }}">
        @endif

        <!-- daterange picker -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }} ">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }} ">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }} ">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }} ">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.css') }} ">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }} ">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    @include('master_all._body')

</html>
