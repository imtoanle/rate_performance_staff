@extends(Config::get('view.backend.master'))

@section('content')


<div data-collapsed="0" class="panel panel-dark">
			
	<!-- panel head -->
	<div class="panel-heading">
		<div class="panel-title">{{trans('all.overview')}}</div>
		
		<div class="panel-options">
			<a data-rel="collapse" href="index.html#"><i class="entypo-down-open"></i></a>
		</div>
	</div>
	
	<!-- panel body -->
	<div class="panel-body" style="display: block;">
		<div class="ajax-alert"></div>
		<form class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('createSupplier')}}" method="post" role="form">

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.username')}}</label>
				
				<div class="col-sm-5">
					<input type="text" name="username" value="" class="form-control">
				</div>
			</div>

		

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.password')}}</label>
				
				<div class="col-sm-5">
					<input type="password" name="password" value="" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.email')}}</label>
				
				<div class="col-sm-5">
					<input type="text" name="email" value="" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.status')}}</label>
				
				<div class="col-sm-5">
					<div class="make-switch" data-on-label="<i class='entypo-check'></i>" data-off-label="<i class='entypo-cancel'></i>">
						<input type="checkbox" name="active" checked/>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button class="btn btn-blue" data-loading-text="{{trans('all.loading')}}" type="submit">{{trans('all.update')}}</button>
				</div>
			</div>


			
			
		</form>
		
	</div>
	
</div>
@stop