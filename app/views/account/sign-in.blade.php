@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="ajax-alert"></div>
			<div class="row featured-boxes login">
				<div class="col-md-offset-3 col-md-6">
					<div class="featured-box featured-box-secundary default info-content">
						<div class="box-content">
							<h4>{{ trans('all.sign-in')}}</h4>
							<form action="{{ URL::route('sign-in-post') }}" class="ajax-submit-form login" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{ trans('all.username')}}</label>
											<input type="text" name="username"{{ Input::old('username') ? ' value="'. e(Input::old('username')) .'"' : '' }} class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<a class="pull-right" href="{{ URL::route('forgot-password') }}">({{trans('all.lost-password')}}?)</a>
											<label>{{trans('all.password')}}</label>
											<input type="password" name="password" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<span class="remember-box checkbox">
											<label for="rememberme">
												<input type="checkbox" id="rememberme" name="rememberme">{{ trans('all.remember-me')}}
											</label>
										</span>
									</div>
									<div class="col-md-6">
										<input type="submit" value="{{ trans('all.sign-in')}}" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
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
