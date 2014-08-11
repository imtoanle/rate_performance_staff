@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		@include(Config::get('view.setting-nav'))
		<div class="col-md-9">

			<h4>{{trans('all.settings.email-notify')}}</h4>
			<hr>

			<div class="row">
			<div class="col-md-12">
			<form role="form" class="form-horizontal form-groups-bordered">

	
	<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>{{trans('all.settings.when-notify')}}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Mark</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Jacob</td>
					</tr>
				</tbody>
			</table>
	

	
</form>
		</div>
			</div>
	</div>
</div>
@stop