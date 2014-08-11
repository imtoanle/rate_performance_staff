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
					<div class="panel-title">{{trans('all.overview')}}</div>
					
					<div class="panel-options">
						<a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>
				
				<!-- panel body -->
				<div class="panel-body">
					
					<form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('updateImeiServices', $service->id)}}" method="put" role="form">

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.services')}}</label>
							
							<div class="col-sm-5">
								<input type="text" name="service_name" value="{{$service->name}}" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<textarea class="form-control ckeditor" name="content_info">
									{{$service->content}}
								</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.group-service')}}</label>
							
							<div class="col-sm-5" id="selectCatService">
								<select class="form-control" name="service_cat">
									@foreach($serviceCats as $cat)
									<option value="{{$cat->id}}" {{ $cat->id == $service->getCatId() ?  'selected="selected"' : ''}}>{{$cat->name}}</option>
									@endforeach
								</select>
							</div>

							<div class="col-sm-3">
								<button type="button" class="btn btn-info" href="javascript:;" onclick="AjaxModal('{{trans('all.backend.create-service-group')}}', '{{route('newImeiServiceGroup')}}')">Add Group</button>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.service-imei-page.delivery-time')}}</label>
							
							<div class="col-sm-5">
								<input type="text" name="delivery_time" value="{{$service->delivery_time}}" class="form-control">
							</div>

						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.credit')}}</label>
							
							<div class="col-sm-3">
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="text" name="credit" value="{{$service->credit}}" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.service-type')}}</label>
							
							<div class="col-sm-5">
								<select class="form-control" name="service_type">
									@foreach(Config::get('variable.type-service') as $key => $value)
									<option value="{{$value}}" {{ $value == $service->type ?  'selected="selected"' : ''}}>{{$key}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.backend.can-cancel-order')}}</label>
							
							<div class="col-sm-2">
								<div class="radio radio-replace color-green">
									<input type="radio" value="1" name="cancel_service" {{ is_object($serviceSettings) && $serviceSettings->cancel_service ? 'checked="checked"' : ''}}>
									<label>{{trans('all.yes')}}</label>
								</div>
							</div>

							<div class="col-md-2">
								<div class="radio radio-replace color-green">
									<input type="radio" value="0" name="cancel_service" {{ !(is_object($serviceSettings) && $serviceSettings->cancel_service) ? 'checked="checked"' : ''}}>
									<label>{{trans('all.no')}}</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.backend.send-order-notify-admin')}}</label>
							
							<div class="col-sm-2">
								<div class="radio radio-replace color-green">
									<input type="radio" value="1" name="admin_notify" {{ is_object($serviceSettings) && $serviceSettings->admin_notify ? 'checked="checked"' : ''}}>
									<label>{{trans('all.yes')}}</label>
								</div>
							</div>

							<div class="col-md-2">
								<div class="radio radio-replace color-green">
									<input type="radio" value="0" name="admin_notify" {{ !(is_object($serviceSettings) && $serviceSettings->admin_notify) ? 'checked="checked"' : ''}}>
									<label>{{trans('all.no')}}</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.features')}}</label>
							
							<div class="col-sm-5">
								<div class="checkbox checkbox-replace color-blue">
									<input type="checkbox" name="refund_code_not_found" {{ is_object($serviceSettings) && $serviceSettings->refund_code_not_found ? 'checked="checked"' : ''}}>
									<label>{{trans('all.backend.refund-if-code-not-found')}}</label>
								</div>
								<div class="checkbox checkbox-replace color-blue">
									<input type="checkbox" name="service_247" {{ is_object($serviceSettings) && $serviceSettings->service_247 ? 'checked="checked"' : ''}}>
									<label>{{trans('all.backend.service-avaiable-247')}}</label>
								</div>
								<div class="checkbox checkbox-replace color-blue">
									<input type="checkbox" name="unlock_guarant" {{ is_object($serviceSettings) && $serviceSettings->unlock_guarant ? 'checked="checked"' : ''}}>
									<label>{{trans('all.backend.unlock-guaranteed')}}</label>
								</div>
								<div class="checkbox checkbox-replace color-blue">
									<input type="checkbox" name="no_refund_bad_request" {{ is_object($serviceSettings) && $serviceSettings->no_refund_bad_request ? 'checked="checked"' : ''}}>
									<label>{{trans('all.backend.no-refund-bad-request')}}</label>
								</div>
								<div class="checkbox checkbox-replace color-blue">
									<input type="checkbox" name="work_business_day" {{ is_object($serviceSettings) && $serviceSettings->work_business_day ? 'checked="checked"' : ''}}>
									<label>{{trans('all.backend.working-on-business-day')}}</label>
								</div>
							</div>

						</div>


						<div class="form-group">
							<label class="col-sm-3 control-label">{{trans('all.status')}}</label>
							
							<div class="col-sm-2">
								<div class="radio radio-replace color-green">
									<input type="radio" value="1" name="service_active" {{ $service->active ? 'checked="checked"' : ''}}>
									<label>{{trans('all.active')}}</label>
								</div>
							</div>

							<div class="col-md-2">
								<div class="radio radio-replace color-green">
									<input type="radio" value="0" name="service_active" {{ !$service->active ? 'checked="checked"' : ''}}>
									<label>{{trans('all.inactive')}}</label>
								</div>
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

</div>
<div class="modal fade" id="ajax-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			
			<div class="modal-body" data-callback="loadCatList">
			
				{{trans('all.loading')}}
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
				<button type="button" class="btn btn-info btn-ok">{{trans('all.update')}}</button>
			</div>
		</div>
	</div>
</div>

<div>

<script type="text/javascript">
function loadCatList(){
	var $ = jQuery;
	 $.ajax({
	      "type": 'get',
	      "url": document.URL,
	      "data": 'action=loadCatList'
	  }).done(function(result)
	  {
	    $('#selectCatService').html(result);
	  });
}
</script>
@stop