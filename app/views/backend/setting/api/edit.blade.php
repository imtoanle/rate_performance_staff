@extends(Config::get('view.backend.master'))
@section('content')

<div class="ajax-alert"></div>
<div class="panel panel-primary" data-collapsed="0">
			
	<!-- panel head -->
	<div class="panel-heading">
		<div class="panel-title">{{$api->name}}</div>
		
		<div class="panel-options">
			<a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
		</div>
	</div>
	
	<!-- panel body -->
	<div class="panel-body">
		<form class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('updateApiSetting', $api->id)}}" method="put" role="form">

			<div class="form-group">
				<label class="col-sm-3 control-label">Site</label>
				
				<div class="col-sm-5">
					<input type="text" name="site" value="{{$api->site}}" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Username</label>
				
				<div class="col-sm-5">
					<input type="text" name="username" value="{{$api->username}}" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Api Key</label>
				
				<div class="col-sm-5">
					<input type="text" name="api_key" value="{{$api->api_key}}" class="form-control">
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button class="btn btn-green" data-loading-text="{{trans('all.loading')}}" type="submit">{{trans('all.update')}}</button>
					<button class="btn btn-danger" data-loading-text="{{trans('all.loading')}}" type="submit">{{trans('all.deactive')}}</button>
				</div>
			</div>

		</form>
		
	</div>
	
</div>



<div class="panel panel-primary" data-collapsed="0">
			
	<!-- panel head -->
	<div class="panel-heading">
		<div class="panel-title">{{trans('all.synchronize')}}</div>
		
		<div class="panel-options">
			<a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
		</div>
	</div>
	
	<!-- panel body -->
	<div class="panel-body">
		<form class="form-horizontal form-groups-bordered ajax-syn-form" action="{{route('updateSynApiSetting')}}" method="put" role="form">

			<div class="form-group">
				<div class="col-sm-5">
					<div class="checkbox checkbox-replace color-green">
						<input type="checkbox" name="syn_this_api" checked>
						<label>{{trans('all.syn-imei-list')}}</label>
					</div>

					<div class="checkbox checkbox-replace color-green">
						<input type="checkbox" name="setup_same_api">
						<label>{{trans('all.setup-service-for-this-api')}}</label>
					</div>

					<div class="checkbox checkbox-replace color-green">
						<input type="checkbox" name="delete_all_current">
						<label>{{trans('all.delete-current-service')}}</label>
					</div>
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-5">
					<button class="btn btn-green" data-loading-text="{{trans('all.loading')}}" type="submit">{{trans('all.synchronize')}}</button>
				</div>
			</div>
			{{Form::hidden('api_id', $api->id)}}

		</form>
		
	</div>
	
</div>
@stop