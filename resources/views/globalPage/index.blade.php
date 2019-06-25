
	<div class="row">
		<div class="col-md-12 ">
			<legend class="main-title"><b>{{isset($title)?$title:''}}</b></legend>
		</div>
		<hr>
	</div>
	<div class="col-md-12 mb-30 card pall-20 mt-10">
		
		<div class="custom-datatable text-center  table-responsive">
			{!! $dataTable->table(['id'=>1,'class'=>'table-bordered'], true) !!}
		</div>
	</div>

	{!! $dataTable->scripts() !!}

