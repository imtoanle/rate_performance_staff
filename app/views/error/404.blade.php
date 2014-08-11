@extends(Config::get('view.master'))
@section('content')
<div class="container">
	<section class="page-not-found">
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
				<div class="page-not-found-main">
					<h2>404 <i class="icon icon-file"></i></h2>
					<p>{{trans('all.error-404-desc')}}</p>
				</div>
			</div>
			<div class="col-md-4">
				<h4>{{trans('all.useful-links')}}</h4>
				<ul class="nav nav-list primary">
					<li><a href="{{route('indexHome')}}">{{trans('all.home')}}</a></li>
					<li><a href="{{route('about-us')}}">{{trans('all.about-us')}}</a></li>
					<li><a href="{{route('index-blog')}}">{{trans('all.blog')}}</a></li>
					<li><a href="{{route('imei-service')}}">{{trans('all.services')}}</a></li>
					<li><a href="{{route('contact-us')}}">{{trans('all.contact')}}</a></li>
				</ul>
			</div>
		</div>
	</section>

</div>
@stop