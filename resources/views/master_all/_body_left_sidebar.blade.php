<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{\Auth::user()->name}}</p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <!-- <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> 
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->

        <li class="">
          <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php $user = \Auth::user(); ?>
        
        @if($user->id == 1)
          <li>
            <a href="{{ route('customer.index') }}">
              <i class="fa fa-user"></i> <span>Customer</span>
            </a>
          </li>
          <li>
            <a href="{{ route('product.index') }}">
              <i class="fa fa-product-hunt"></i> <span>Product</span>
            </a>
          </li>
          <li>
            <a href="{{ route('order.index') }}">
              <i class="fa fa-calendar-plus-o"></i> <span>Order</span>
            </a>
          </li>
        @endif
        @if($user->id == 2)
          <li>
            <a href="{{ route('customer.index') }}">
              <i class="fa fa-user"></i> <span>Customer</span>
            </a>
          </li>
        @endif
        @if($user->id == 3)
          <li>
            <a href="{{ route('product.index') }}">
              <i class="fa fa-product-hunt"></i> <span>Product</span>
            </a>
          </li>
          <li>
            <a href="{{ route('order.index') }}">
              <i class="fa fa-calendar-plus-o"></i> <span>Order</span>
            </a>
          </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>