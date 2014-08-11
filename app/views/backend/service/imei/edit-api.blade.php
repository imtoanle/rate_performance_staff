@extends(Config::get('view.backend.master'))
@section('content')

<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.service'), 'id' => $service->id, 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<div class="ajax-alert"></div>
			<div class="panel panel-gradient" data-collapsed="0">
			
				<!-- panel head -->
				<div class="panel-heading">
					<div class="panel-title">{{trans('all.api-connection')}}</div>
					
					<div class="panel-options">
						<a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>
				
				<!-- panel body -->
				<div class="panel-body">
					
					<form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('updateApiImeiServices', $service->id)}}" method="put" role="form">

						<div class="form-group">
							<label class="col-sm-3 control-label">API</label>
							
							<div class="col-sm-5">
								<select class="form-control" name="api_id">
									<option value="0" {{$service->api_id == 0 ? 'selected="selected"' : ''}}>{{trans('all.backend.no-api')}}</option>
									@foreach(Api::all() as $api)
									<option value="{{$api->id}}" {{$service->api_id == $api->id ? 'selected="selected"' : ''}}>{{$api->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.services')}}</label>
							
							<div class="col-sm-5">
								<select  name="api_service_id"  class="select2" data-allow-clear="false" data-placeholder="{{trans('all.choose-service')}}">
									@foreach($sourceServices as $sourceService)
										<option value="{{$sourceService->service_id}}" {{$service->api_service_id == $sourceService->service_id ? 'selected="selected"' : ''}}>{{$sourceService->service_name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-5">
								<button class="btn btn-green" data-loading-text="{{trans('all.loading')}}" type="submit">{{trans('all.update')}}</button>
							</div>
						</div>


						
					</form>
					
				</div>
				
			</div>

		</div>
	</div>
</div>




@stop


