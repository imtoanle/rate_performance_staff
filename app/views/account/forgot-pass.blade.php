@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="row featured-box login">
				<div class="col-md-offset-3 col-md-6">
					<div class="featured-box featured-box-secundary default info-content">
						<div class="box-content text-left">
							<h4>{{trans('all.reset-my-password')}}</h4>
							<p>{{trans('all.notice-reset-password')}}</p>
							<div class="ajax-alert"></div>
							<form action="{{ URL::route('forgot-password-post') }}" class="ajax-submit-form forgot" method="post">
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{trans('all.email')}}</label>
											<input type="text" name="email"{{ Input::old('email') ? ' value="'. e(Input::old('email')) .'"' : '' }}  class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" value="{{trans('all.submit')}}" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
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
