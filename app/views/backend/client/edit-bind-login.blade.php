@extends(Config::get('view.backend.master'))
@section('content')

<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.client'), 'id' => $client->id, 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<div class="ajax-alert"></div>
			<form class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('updateClientBindLogin', $client->id)}}" method="put" role="form">
				<div class="row">
				<div data-collapsed="0" class="panel panel-primary">
							
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">{{trans('all.bind-login')}}</div>
						
						<div class="panel-options">
							<a data-rel="collapse" href="index.html#"><i class="entypo-down-open"></i></a>
						</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body" style="display: block;">
						
						
							<div class="alert alert-info">{{trans('all.settings.notice-ip-limit')}}</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.ip-range')}} *</label>
								
								<div class="col-sm-6">
									<textarea name="bind_login" class="form-control">{{$client->security_login}}</textarea>
								</div>
							</div>


					</div>
					
				</div>

				</div>
				<div class="form-group default-padding">
					<button type="submit" class="btn btn-success" data-loading-text="{{trans('all.loading')}}">{{trans('all.update')}}</button>
				</div>
				</form>
		</div>
	</div>
</div>




@stop