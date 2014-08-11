<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		@include(Config::get('view.head'))
		<!-- Libs -->
		<script src="{{ asset('vendor/jquery.js') }}"></script>
		<script src="{{ asset('js/plugins.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
		<script src="{{ asset('vendor/jquery.easing.js') }}"></script>
		<script src="{{ asset('vendor/jquery.appear.js') }}"></script>
		<script src="{{ asset('vendor/jquery.cookie.js') }}"></script>
		<!--<script src="{{ asset('master/style-switcher/style.switcher.js') }}"></script>-->
		<script src="{{ asset('vendor/bootstrap.js') }}"></script>
		<script src="{{ asset('vendor/twitterjs/twitter.js') }}"></script>
		<script src="{{ asset('vendor/rs-plugin/js/jquery.themepunch.plugins.min.js') }}"></script>
		<script src="{{ asset('vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
		<script src="{{ asset('vendor/owl-carousel/owl.carousel.js') }}"></script>
		<script src="{{ asset('vendor/circle-flip-slideshow/js/jquery.flipshow.js') }}"></script>
		<script src="{{ asset('vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('vendor/jquery.validate.js') }}"></script>
		@if(in_array(Route::currentRouteName(), array('area-client', 'orders-history', 'my-invoice', 'my-statement')))
			<link rel="stylesheet" href="{{ asset('assets/js/datatables/responsive/css/datatables.responsive.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">
      <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/js/datatables/TableTools.min.js') }}"></script>
      <script src="{{ asset('assets/js/dataTables.bootstrap.js') }}"></script>
      <script src="{{ asset('assets/js/datatables/jquery.dataTables.columnFilter.js') }}"></script>
      <script src="{{ asset('assets/js/datatables/jquery.dataTables.editable.js') }}"></script>
      <script src="{{ asset('assets/js/datatables/lodash.min.js') }}"></script>
      <script src="{{ asset('assets/js/datatables/fnReloadAjax.js') }}"></script>
      <script src="{{ asset('assets/js/datatables/responsive/js/datatables.responsive.js') }}"></script>
      <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    @elseif(in_array(Route::currentRouteName(), array('setting-profile', 'place-order-imei', 'sign-up')))
    	<script src="{{ asset('assets/js/jquery.inputmask.new.js') }}"></script>
		@endif
	</head>
	<body>

		<div class="body">
			@include(Config::get('view.header'))

			<div role="main" class="main">
				@yield('content')
			</div>

			@include(Config::get('view.footer'))
		</div>

		<!-- Current Page Scripts -->
			@if(in_array(Route::currentRouteName(), array('contact-us')))
				<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
				<script src="{{asset('vendor/jquery.gmap.js')}}"></script>

				<script>

					/*
					Map Settings

						Find the Latitude and Longitude of your address:
							- http://universimmedia.pagesperso-orange.fr/geo/loc.htm
							- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

					*/

					// Map Markers
					var mapMarkers = [{
						address: "{{$setting_vars['address']}}",
						html: "<strong>{{$setting_vars['company']}}</strong><br>{{$setting_vars['address']}}",
						icon: {
							image: "{{asset('img/pin.png')}}",
							iconsize: [26, 46],
							iconanchor: [12, 46]
						},
						popup: true
					}];

					// Map Initial Location
					var initLatitude = 12.248191;
					var initLongitude = 109.186181;

					// Map Extended Settings
					var mapSettings = {
						controls: {
							panControl: true,
							zoomControl: true,
							mapTypeControl: true,
							scaleControl: true,
							streetViewControl: true,
							overviewMapControl: true
						},
						scrollwheel: false,
						markers: mapMarkers,
						latitude: initLatitude,
						longitude: initLongitude,
						zoom: 16
					};

					var map = $("#googlemaps").gMap(mapSettings);

					// Map Center At
					var mapCenterAt = function(options, e) {
						e.preventDefault();
						$("#googlemaps").gMap("centerAt", options);
					}

				</script>
			@elseif(in_array(Route::currentRouteName(), array('indexHome')))
				<script src="{{ asset('js/views/view.home.js') }}"></script>
			@endif
		
		

		<!-- Theme Initializer -->
		<script src="{{ asset('js/theme.js') }}"></script>

		<!-- Custom JS -->
		<script src="{{ asset('js/custom.js') }}"></script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
		

	</body>
</html>
