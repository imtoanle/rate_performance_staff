@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="featured-box featured-box-secundary default info-content">
						<div class="box-content text-left">
							<div class="ajax-alert"></div>
							<form role="form" class="ajax-submit-form" action="{{route('sign-up-post')}}" method="post" class="form-horizontal form-groups-bordered">
							<h4>{{trans('all.username')}}</h4>
							<hr>
							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.username')}} *</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon icon-user"></i></span>
										<input type="text" class="form-control" name="username" value="" placeholder="{{trans('all.username')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.email')}} *</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon icon-envelope"></i></span>
										<input type="text" class="form-control" name="email" value="" placeholder="{{trans('all.email')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.password')}} *</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon icon-key"></i></span>
										<input type="password" class="form-control" name="password" value="" placeholder="{{trans('all.password')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.confirm-password')}} *</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon icon-key"></i></span>
										<input type="password" class="form-control" name="password_confirm" value="" placeholder="{{trans('all.confirm-password')}}">
									</div>
								</div>
							</div>

							
							<h4>{{trans('all.settings.detail-address')}}</h4>
							<hr>
							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.full-name')}} *</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="full_name" value="" placeholder="{{trans('all.full-name')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.phone')}} *</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="phone" value="" placeholder="+(84) 932550039" data-mask="+(99) 9{1,10}">
									</div>
								</div>
							</div>

							

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.address')}}</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="address" value="" placeholder="{{trans('all.address')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.city')}}</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="city" value="" placeholder="{{trans('all.city')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.state')}}</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="state" value="" placeholder="{{trans('all.state')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.zip-code')}}</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="zip_code" value="" placeholder="{{trans('all.zip-code')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.country')}}</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="country" value="" placeholder="{{trans('all.country')}}">
									</div>
								</div>
							</div>

							<h4>{{trans('all.settings.more-info')}}</h4>
							<hr>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.language')}}</label>
								
								<div class="col-sm-7">
									<select class="form-control" name="language">
									@foreach(Config::get('variable.languages') as $value)
										<option value="{{$value}}" >{{trans('all.languages.'.$value)}}</option>
									@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.settings.question')}}</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<select class="form-control" name="security_question">
										@foreach(trans('all.security-question') as $value)
											<option value="{{$value}}">{{$value}}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.settings.answer')}}</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="security_answer">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-5 control-label">{{trans('all.captcha')}} *</label>
								
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" class="form-control" name="captcha">{{HTML::image(Captcha::img(), 'Captcha image')}}
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

		</div>
	</div>

</div>

@stop
