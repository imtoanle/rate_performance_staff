@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		@include(Config::get('view.setting-nav'))
		<div class="col-md-9">

			<h4>{{trans('all.settings.personal-info')}}</h4>
			<hr>

			<div class="row">
			<div class="col-md-12">
			<div class="ajax-alert"></div>
			<form role="form" class="ajax-submit-form" action="{{route('setting-profile')}}" method="post" class="form-horizontal form-groups-bordered">
			
			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.username')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<span class="input-group-addon"><i class="icon icon-user"></i></span>
						<input type="text" class="form-control" name="username" value="{{Auth::user()->username}}" disabled placeholder="{{trans('all.username')}}">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.email')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<span class="input-group-addon"><i class="icon icon-envelope"></i></span>
						<input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" disabled placeholder="{{trans('all.email')}}">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.phone')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<span class="input-group-addon"><i class="icon icon-phone"></i></span>
						<input type="text" class="form-control" name="phone" value="{{Auth::user()->phone}}" placeholder="+(84) 932550039" data-mask="+(99) 9{1,10}">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.full-name')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<span class="input-group-addon"><i class="icon icon-user"></i></span>
						<input type="text" class="form-control" name="full_name" value="{{Auth::user()->name}}" placeholder="{{trans('all.full-name')}}">
					</div>
				</div>
			</div>
			<h4>{{trans('all.settings.detail-address')}}</h4>
			<hr>
			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.address')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<input type="text" class="form-control" name="address" value="{{Auth::user()->address}}" placeholder="{{trans('all.address')}}">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.city')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<input type="text" class="form-control" name="city" value="{{Auth::user()->city}}" placeholder="{{trans('all.city')}}">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.state')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<input type="text" class="form-control" name="state" value="{{Auth::user()->state}}" placeholder="{{trans('all.state')}}">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.zip-code')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<input type="text" class="form-control" name="zip_code" value="{{Auth::user()->zip_code}}" placeholder="{{trans('all.zip-code')}}">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.country')}}</label>
				
				<div class="col-sm-5">
					<div class="input-group">
						<input type="text" class="form-control" name="country" value="{{Auth::user()->country}}" placeholder="{{trans('all.country')}}">
					</div>
				</div>
			</div>

			<h4>{{trans('all.settings.more-info')}}</h4>
			<hr>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.language')}}</label>
				
				<div class="col-sm-5">
					<select class="form-control" name="language">
					@foreach(Config::get('variable.languages') as $value)
						<option value="{{$value}}" {{ Auth::user()->language == $value ? 'selected="selected"' : '' }}>{{ trans('all.languages.'.$value)}}</option>
					@endforeach
					</select>
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