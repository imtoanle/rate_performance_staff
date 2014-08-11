@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		@include(Config::get('view.setting-nav'))
		<div class="col-md-9">

			<h4>{{trans('all.settings.change-pass')}}</h4>
			<hr>

			<div class="row">
			<div class="col-md-12">
			<div class="ajax-alert"></div>
			<form role="form" class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('change-password-post')}}" method="post">

	
	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('all.settings.current-pass')}}</label>
		
		<div class="col-sm-5">
			<div class="input-group">
				<span class="input-group-addon"><i class="icon icon-key"></i></span>
				<input type="password" class="form-control" name="old_password" placeholder="{{trans('all.settings.current-pass')}}">
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('all.settings.new-pass')}}</label>
		
		<div class="col-sm-5">
			<div class="input-group">
				<input type="password" class="form-control" name="password" placeholder="{{trans('all.settings.new-pass')}}">
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('all.settings.confirm-pass')}}</label>
		
		<div class="col-sm-5">
			<div class="input-group">
				<input type="password" class="form-control" name="password_again" placeholder="{{trans('all.settings.confirm-pass')}}">
			</div>
		</div>
	</div>

	
	<div class="row">
		<div class="col-md-12">
			<input type="submit" value="{{trans('all.save')}}" class="btn btn-primary" data-loading-text="{{trans('all.loading')}}">
		</div>
	</div>
	{{ Form::token() }}
</form>
		</div>
			</div>
	</div>
</div>
@stop