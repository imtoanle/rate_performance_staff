@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		@include(Config::get('view.setting-nav'))
		<div class="col-md-9">

			<h4>{{trans('all.settings.change-question')}}</h4>
			<hr>

			<div class="row">
			<div class="col-md-12">
			<div class="ajax-alert"></div>
			<form role="form" class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('setting-change-question')}}" method="put">

	
	<div class="form-group">
		<label class="col-sm-3 control-label">{{Auth::user()->security_question}}</label>
		
		<div class="col-sm-5">
			<div class="input-group">
				<span class="input-group-addon"><i class="icon icon-question"></i></span>
				<input type="text" class="form-control" name="current_answer">
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('all.settings.new-question')}}</label>
		
		<div class="col-sm-5">
			<div class="input-group">
				<select class="form-control" name="new_question">
				@foreach(trans('all.security-question') as $value)
					<option value="{{$value}}">{{$value}}</option>
				@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('all.settings.answer')}}</label>
		
		<div class="col-sm-5">
			<div class="input-group">
				<input type="text" class="form-control" name="new_answer">
			</div>
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