@extends(Config::get('view.master'))
@section('content')
	<!-- Google Maps -->
	<div id="googlemaps" class="google-map hidden-xs"></div>

	<div class="container">

		<div class="row">
			<div class="col-md-6">

				<div class="ajax-alert"></div>

				<h2 class="short"><strong>{{trans('all.contact')}}</strong></h2>
				<form action="{{route('contact-us')}}" class="ajax-submit-form" method="post">
					<div class="row">
						<div class="form-group">
							<div class="col-md-6">
								<div class="input-group">
								<label>{{trans('all.full-name')}} *</label>
								<input type="text" value="" maxlength="100" class="form-control" name="full_name" id="full_name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
								<label>{{trans('all.email')}} *</label>
								<input type="email" value="" maxlength="100" class="form-control" name="email" id="email">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="input-group">
									<label>{{trans('all.subject')}} *</label>
									<input type="text" value="" maxlength="100" class="form-control" name="subject" id="subject">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="input-group">
									<label>{{trans('all.content')}} *</label>
									<textarea maxlength="5000" rows="10" class="form-control" name="content" id="content"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="input-group">
									<label class="radio-inline">
										<input type="radio" name="type_contact" value="{{Config::get('variable.feedback-type.Contact')}}" checked="checked"> {{trans('all.contact-with-admin')}}
									</label>
									<label class="radio-inline">
										<input type="radio" name="type_contact" value="{{Config::get('variable.feedback-type.FeedBack')}}"> {{trans('all.feed-back-website')}}
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="input-group">
									<label class="radio-inline">
										{{trans('all.captcha')}} *
									</label>
									<label class="radio-inline">
										{{Form::text('captcha')}}{{HTML::image(Captcha::img(), 'Captcha image')}}
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" value="{{trans('all.submit')}}" class="btn btn-primary btn-lg" data-loading-text="Loading...">
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">

				<h4 class="push-top">{{trans('all.contact-us-page.the-office')}}</h4>
				<ul class="list-unstyled">
					<li><i class="icon icon-map-marker"></i> <strong>{{trans('all.address')}}:</strong> {{ $setting_vars['address'] }}</li>
					<li><i class="icon icon-phone"></i> <strong>{{trans('all.phone')}}:</strong> {{ $setting_vars['phone'] }}</li>
					<li><i class="icon icon-envelope"></i> <strong>{{trans('all.email')}}:</strong> <a href="mailto:{{ $setting_vars['email'] }}">{{ $setting_vars['email'] }}</a></li>
				</ul>

				<hr />

				<h4>{{trans('all.contact-us-page.business-hours')}}</h4>
				<ul class="list-unstyled">
					<li><i class="icon icon-time"></i> {{trans('all.contact-us-page.business-hours-detail')}}</li>
				</ul>

			</div>

		</div>

	</div>

</div>
@stop
