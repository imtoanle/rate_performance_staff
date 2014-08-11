<div id="top-box">
  <div class="container">
    <div class="pull-left">
      <div class="btn-group language btn-select">
		<a href="#" data-toggle="dropdown" role="button" class="btn dropdown-toggle">
		  <span class="desktop">{{trans('all.language')}}</span>: {{trans('all.languages.'.Session::get('locale', 'vi'))}}
		  <i class="icon icon-caret-down"></i>
		</a>
		<ul class="dropdown-menu">
			@foreach(Config::get('variable.languages') as $key => $value)
				<li><a href="{{asset($value)}}"><img alt="" src="{{asset('img/flags/'.strtoupper($key).'.gif')}}"> {{trans('all.languages.'.$value)}}</a></li>
			@endforeach
		</ul>
	  </div>

    </div>
    
    @if(Auth::check())
	    <div class="my-account pull-right">
				{{trans('all.welcome-comeback')}}, <i class="icon icon-user"></i> {{Auth::user()->name}} - {{trans('all.total-money')}}: {{Auth::user()->amount}} {{trans('all.coin')}}
	    </div><!-- .my-account -->
	  @endif
  </div>
</div>
<header>
	<div class="container">
		<h1 class="logo">
			<a href="{{route('indexHome')}}">
				<img alt="Porto" width="200" height="67" data-sticky-width="119" data-sticky-height="40" src="{{ asset('img/logo.png') }}">
			</a>
		</h1>
		<div class="search">
			<form id="searchForm" action="http://preview.oklerthemes.com/porto/2.9.0/page-search-results.html" method="get">
				<div class="input-group">
					<input type="text" class="form-control search" name="q" id="q" placeholder="Search...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="icon icon-search"></i></button>
					</span>
				</div>
			</form>
		</div>
		<div class="social-icons">
			<ul class="social-icons">
				<li class="facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook">Facebook</a></li>
				<li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li>
				<li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>
			</ul>
		</div>
		<nav>
			<ul class="nav nav-pills nav-top">
				<li>
					<a href="{{route('about-us')}}"><i class="icon icon-angle-right"></i>{{trans('all.about-us')}}</a>
				</li>
				<li>
					<a href="{{route('contact-us')}}"><i class="icon icon-angle-right"></i>{{trans('all.contact')}}</a>
				</li>
				<li class="phone">
					<span><i class="icon icon-phone"></i>{{ $setting_vars['phone'] }}</span>
				</li>
			</ul>
		</nav>
		<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
			<i class="icon icon-bars"></i>
		</button>
	</div>
	<div class="navbar-collapse nav-main-collapse collapse">
		<div class="container">
			<nav class="nav-main mega-menu">
				<ul class="nav nav-pills nav-main" id="mainMenu">
					<li class="dropdown">
						<a class="dropdown-toggle" href="{{route('indexHome')}}">
							{{ trans('all.home') }}
						</a>
					</li>
					
					
					@if(Auth::check())
						<li>
							<a href="{{route('area-client')}}">{{ trans('all.client-area') }}</a>
						</li>
						<li>
							<a href="{{route('orders-history')}}">{{ trans('all.history-order') }}</a>
						</li>
					@else
						
					@endif
					<li class="dropdown">
						<a class="dropdown-toggle">
							{{ trans('all.services') }}
							<i class="icon icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="@if(Auth::check()) {{route('place-order-imei')}} @else {{route('imei-service')}} @endif">{{ trans('all.service-imei') }}</a></li>
							<li><a href="#">{{ trans('all.service-file') }}</a></li>
							<li><a href="#">{{ trans('all.service-server') }}</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle">
							{{ trans('all.add-fund-page.add-fund') }}
							<i class="icon icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{{route('add-fund-paypal')}}">{{ trans('all.add-fund-page.via-paypal') }}</a></li>
							<li><a href="{{route('add-fund-bank')}}">{{ trans('all.add-fund-page.via-bank') }}</a></li>
						</ul>
					</li>
					@if(!Auth::check())
					<li>
						<a href="{{route('sign-up')}}">{{ trans('all.sign-up') }}</a>
					</li>
					<li class="dropdown mega-menu-item mega-menu-signin signin" id="headerAccount">
						<a class="dropdown-toggle" href="#">
							<i class="icon icon-user"></i> {{ trans('all.sign-in')}}
							<i class="icon icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-12">

											<div class="signin-form">

												<span class="mega-menu-sub-title">{{ trans('all.sign-in')}}</span>
												<div class="ajax-alert"></div>
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
																<a class="pull-right" id="headerRecover" href="{{ URL::route('forgot-password') }}">({{trans('all.lost-password')}}?)</a>
																<label>{{ trans('all.password')}}</label>
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
															<input type="submit" value="Login" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
														</div>
													</div>
													{{ Form::token() }}
												</form>

												<p class="sign-up-info">{{ trans('all.recommend-sign-up')}} <a href="{{route('sign-up')}}" id="headerSignUp">{{ trans('all.sign-up')}}!</a></p>

											</div>

											<div class="signup-form">
												<span class="mega-menu-sub-title">{{trans('all.create-account')}}</span>

												<form action="index-header-signin.html" id="" type="post">
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>{{trans('all.email')}}</label>
																<input type="text" value="" class="form-control">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-6">
																<label>{{trans('all.password')}}</label>
																<input type="password" value="" class="form-control">
															</div>
															<div class="col-md-6">
																<label>{{trans('all.confirm-password')}}</label>
																<input type="password" value="" class="form-control">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<input type="submit" value="{{trans('all.create-account')}}" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
														</div>
													</div>
												</form>

												<p class="log-in-info">{{trans('all.recommend-sign-in')}} <a href="{{route('sign-in')}}" id="headerSignIn">{{trans('all.sign-in')}}!</a></p>
											</div>

											<div class="recover-form">
												<span class="mega-menu-sub-title">{{trans('all.reset-my-password')}}</span>
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

												<p class="log-in-info">{{trans('all.recommend-sign-in')}} <a href="{{route('sign-in')}}" id="headerRecoverCancel">{{trans('all.sign-in')}}!</a></p>
											</div>

										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					@else
					
					<li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
						<a class="dropdown-toggle" href="#">
							<i class="icon icon-user"></i> {{Auth::user()->name}}
							<i class="icon icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-7">
											<div class="user-avatar">
												<div class="img-thumbnail">
													<img src="{{asset('img/no-avatar.jpg')}}" alt="">
												</div>
												<p><strong>{{Auth::user()->name}}</strong><span>{{trans('all.client-group.'.array_flip(Config::get('variable.client-group'))[Auth::user()->client_group])}}</span></p>
											</div>
										</div>
										<div class="col-md-5">
											<ul class="list-account-options">
												<li>
													<a href="{{route('setting-profile')}}">{{trans('all.settings.personal-info')}}</a>
												</li>
												<li><a href="{{route('my-invoice')}}">{{trans('all.settings.invoice')}}</a></li>
												<li><a href="{{route('my-statement')}}">{{trans('all.settings.statement')}}</a></li>
												<li>
													<a href="{{route('sign-out')}}">{{trans('all.sign-out')}}</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					@endif
				</ul>
			</nav>
		</div>
	</div>
</header>

@if (isset($enableBreadcrumb))
<section class="page-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{{ BreadcrumbsFront::create($dataBreadcrumb) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2>{{ $pageTitle or $dynamicTitle }}</h2>
			</div>
		</div>
	</div>
</section>
@endif