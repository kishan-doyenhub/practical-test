@extends('layouts.appmaster')

@section('right_header_button')
	{!! isset($button_link) ? $button_link : '' !!}
@endsection
@section('content')
<style type="text/css"> .mt-8{margin-top:8px;}</style>

	<div class="col-md-12 mb-10">
		<div class="box box-primary">
			<div class="card mt-8">
				<div class="card-block pall-10">
					<div class="custom-datatable table-responsive">
						{!! $dataTable->table(['class' => 'text-center table-bordered'], true) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('body_bottom')
	@parent
	{!! $dataTable->scripts() !!}

	<script>
		$(document).ready(function (e) {
			var open_modal = {{ isset($open_group_modal) ? $open_group_modal : 0 }};
			if (open_modal == 1){
                $('.group_modal').trigger('click');
            }
        })
	</script>
@endsection
