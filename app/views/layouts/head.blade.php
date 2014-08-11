		<!-- Basic -->
		<meta charset="utf-8">
		<title>{{ $pageTitle or $dynamicTitle }}</title>
		<meta name="keywords" content="{{$keywords}}" />
		<meta name="description" content="{{$description}}">
		<meta name="author" content="Cool Boy">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Entype Font-->
		<link rel="stylesheet" href="{{asset('assets/css/font-icons/entypo/css/entypo.css')}}">
		<!-- Web Fonts  -->
		<link rel="stylesheet" href="{{ asset('css/google-fonts.css') }}">
		<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">-->

		<!-- Libs CSS -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('css/fonts/font-awesome/css/font-awesome.css') }}">
		<link rel="stylesheet" href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}" media="screen">
		<link rel="stylesheet" href="{{ asset('vendor/owl-carousel/owl.theme.css') }}" media="screen">
		<link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" media="screen">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
		<link rel="stylesheet" href="{{ asset('css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ asset('css/theme-animate.css') }}">

		<!-- Current Page Styles -->
		@if(in_array(Route::currentRouteName(), array('view-blog', 'index-blog')))
		<link rel="stylesheet" href="{{asset('css/theme-blog.css')}}" media="screen">
		@else
		<link rel="stylesheet" href="{{ asset('vendor/rs-plugin/css/settings.css') }}" media="screen">
		<link rel="stylesheet" href="{{ asset('vendor/circle-flip-slideshow/css/component.css') }}" media="screen">
		@endif

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('css/skins/blue.css') }}">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

		<!-- Responsive CSS -->
		<link rel="stylesheet" href="{{ asset('css/theme-responsive.css') }}" />

		<!-- Head Libs -->
		<script src="{{ asset('vendor/modernizr.js') }}"></script>

		<!--[if IE]>
			<link rel="stylesheet" href="{{ asset('css/ie.css') }}">
		<![endif]-->

		<!--[if lte IE 8]>
			<script src="{{ asset('vendor/respond.js') }}"></script>
		<![endif]-->