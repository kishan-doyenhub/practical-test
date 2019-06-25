<!-- Main content -->
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				{{ $title or 'Dashboard' }}
				<!-- <small>Control panel</small> -->
				<small style="float:right">@yield('right_header_button')</small>
			</h1>
			<!-- <ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">{{ $title or 'Dashboard' }}</li>
			</ol> -->
		</section>
		<section class="content">
			<div class="row">
				<!-- Content Section [START] -->
				<div class="">
					@yield('content')
				</div>
				<!-- Content Section [END] -->
			</div>
		</section>		
	</div>
<!-- /.content -->
