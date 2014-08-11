@extends(Config::get('view.master'))
@section('content')
	<div class="container">

		<div class="row">
			@include(Config::get('view.setting-nav'))
			<div class="col-md-9">

				<h4>{{trans('all.settings.security-login')}}</h4>
				<hr>

				<div class="row">
				<div class="col-md-12">
				<div class="ajax-alert"></div>
				<form role="form" class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('setting-security-login')}}" method="put">

		
		<div class="form-group">
			<label class="col-sm-3 control-label">{{trans('all.settings.ip-limit')}}</label>
			
			<div class="col-sm-5">
				<div class="input-group">
					<textarea type="text" class="form-control" name="access_ip">{{$access_ip}}</textarea>
				</div>
				<div class="input-group"><span>{{trans('all.settings.notice-ip-limit')}}</span></div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<input type="submit" value="{{trans('all.save')}}" class="btn btn-primary" data-loading-text="{{trans('all.loading')}}">
			</div>
		</div>
		{{Form::token()}}
	</form>
			</div>
				</div>
		</div>
	</div>
@stop