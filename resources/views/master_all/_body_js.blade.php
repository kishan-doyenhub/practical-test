  <!-- jQuery 3 -->
  <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  
  <!-- Morris.js charts -->
  <script src="{{ asset('admin/bower_components/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('admin/bower_components/morris.js/morris.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }} "></script>
  <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }} "></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
  
  <!-- Chart -->
  <script src="{{ asset('admin/bower_components/Chart/Chart.js') }}"></script>
  
  <script src="{{ asset('admin/bower_components/Chart/amcharts.js') }}"></script>
  <script src="{{ asset('admin/bower_components/Chart/funnel.js') }}"></script>
  
  <!-- Slimscroll -->
  <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
  <!-- CK Editor -->
  <script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }} "></script>

  <script src="{{ asset('plugin/snackbar/js/snackbar.js') }}"></script>
  <script src="{{ asset('plugin/pnotify/pnotify.min.js') }}"></script>

  <!-- selectize -->
  <script type="text/javascript" src="{{ URL::to('/admin/package/selectize/standalone/selectize.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::to('/admin/package/selectize/standalone/selectize.js') }}"></script>

  <!-- DataTables -->
  @if(isset($assets) && (in_array('datatable',$assets) || in_array('datatable_builder',$assets)))
    <script src="{{ asset('admin/package/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/package/datatable/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/package/datatable/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('admin/package/datatable/sum().js') }}" type="text/javascript" charset="utf-8" async defer></script>
  @endif
  <!-- Datatable Builder	-->
  @if(isset($assets) && in_array('datatable_builder',$assets))
    <!-- DataTables Button -->
    <script src="{{ asset('admin/package/datatable/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/package/datatable/buttons.server-side.js') }}"></script>
  @endif

  <!-- Select2 -->
  <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }} "></script>
  <!-- date-range-picker -->
  <script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }} "></script>
  <script src="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }} "></script>
  <!-- bootstrap datepicker -->
  <script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }} "></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }} "></script>
  <!-- bootstrap time picker -->
  <script src="{{ asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') }} "></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }} "></script>

  @include('helper.app_mesage')

  <script>
    // $(document).ready(function(){
    //   // Replace the <textarea id="editor1"> with a CKEditor
    //   // instance, using default configuration.
    //   CKEDITOR.replace('editor1');
      
    //   //bootstrap WYSIHTML5 - text editor
    //   $('.property_textarea').wysihtml5({
    //     toolbar: {
    //       "image": false, // Button to insert an image.
    //     }
    //   });
    // })

    $(function () {     

      //Initialize Select2 Elements
      $('.all_select2').select2();

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      });      

      //Date range picker
      $('.reservation').daterangepicker();

      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      });
    })
  </script>

  <script>
    $('.multipleSelect').selectize({
      plugins: ['remove_button'],
      delimiter: ',',
      persist: false,
      create: function(input) {
          return false
      }
    });
    $(document).ready(function() {
    //   $('.sidebar-wrapper .nav .nav-item').removeClass('active')
    //   $().ready(function() {
    //     $sidebar = $('.sidebar');

    //     var menuActive = sessionStorage.getItem('urlData');
    //     if(menuActive == ''){
    //       $("#home_list").parent().addClass('active');
    //     }else{
    //       $("#"+menuActive).parent().addClass('active');
    //       sessionStorage.removeItem(menuActive)
    //     }

    //     $sidebar_img_container = $sidebar.find('.sidebar-background');

    //     $full_page = $('.full-page');

    //     $sidebar_responsive = $('body > .navbar-collapse');

    //     window_width = $(window).width();

    //     fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
    //     if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
    //       if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
    //         $('.fixed-plugin .dropdown').addClass('open');
    //       }
    //     }        
    //   });
    });
    // $('.sidebar-wrapper .nav .nav-item .nav-link').click(function() {
    //   sessionStorage.setItem('urlData', $(this).attr('id'));      
    // });
  </script>
  <script>
    // $(document).ready(function() {
    //   md.initDashboardPageCharts();
    // });

   
  </script>
