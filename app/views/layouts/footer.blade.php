<footer>
	<div class="container">
		<div class="row">
			<div class="footer-ribon">
				<span>{{trans('all.footer-page.get-in-touch')}}</span>
			</div>
			<div class="col-md-4">
				<div class="newsletter">
					<h4>{{trans('all.footer-page.newsletter')}}</h4>
					<p>{{trans('all.footer-page.newsletter-text')}}</p>

					<div class="alert alert-success hidden" id="newsletterSuccess">
						<strong>Success!</strong> You've been added to our email list.
					</div>

					<div class="alert alert-danger hidden" id="newsletterError"></div>

					<form id="newsletterForm" action="http://preview.oklerthemes.com/porto/2.9.0/php/newsletter-subscribe.php" method="POST">
						<div class="input-group">
							<input class="form-control" placeholder="{{trans('all.address')}} {{trans('all.email')}}" name="email" id="email" type="text">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">{{trans('all.submit')}}!</button>
							</span>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="contact-details">
					<h4>{{trans('all.contact')}}</h4>
					<ul class="contact">
						<li><p><i class="icon icon-map-marker"></i> <strong>{{trans('all.address')}}:</strong> {{ $setting_vars['address'] }}</p></li>
						<li><p><i class="icon icon-phone"></i> <strong>{{trans('all.phone')}}:</strong> {{ $setting_vars['phone'] }}</p></li>
						<li><p><i class="icon icon-envelope"></i> <strong>{{trans('all.email')}}:</strong> <a href="mailto:{{ $setting_vars['email'] }}">{{ $setting_vars['email'] }}</a></p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-2">
				<h4>{{trans('all.follow-us')}}</h4>
				<div class="social-icons">
					<ul class="social-icons">
						<li class="facebook"><a href="http://www.facebook.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="http://www.twitter.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Twitter">Twitter</a></li>
						<li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">Linkedin</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-1">
					<a href="index.html" class="logo">
						<img alt="Porto Website Template" class="img-responsive" src="{{ asset('img/logo-footer.png') }}">
					</a>
				</div>
				<div class="col-md-5">
					<p>© Copyright 2014. All Rights Reserved.</p>
				</div>
				<div class="col-md-6">
					<nav id="sub-menu">
						<ul>
							<li><a href="{{route('index-blog')}}">{{trans('all.blog')}}</a></li>
							<li><a href="#">{{trans('all.track-order')}}</a></li>
							<!--<li><a href="page-faq.html">{{trans('all.faq')}}</a></li>
							<li><a href="sitemap.html">{{trans('all.sitemap')}}</a></li>-->
							<li><a href="{{route('contact-us')}}">{{trans('all.contact')}}</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</footer>