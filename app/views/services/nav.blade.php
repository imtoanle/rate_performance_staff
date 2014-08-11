<div class="col-md-3">
	<aside class="sidebar">

		<h4>{{trans('all.services')}}</h4>
		<ul class="nav nav-list primary push-bottom">
			<li><a href="@if(Auth::check()) {{route('place-order-imei')}} @else {{route('imei-service')}} @endif">{{ trans('all.service-imei') }}</a></li>
			<li><a href="#">{{ trans('all.service-file') }}</a></li>
			<li><a href="#">{{ trans('all.service-server') }}</a></li>
		</ul>

	</aside>
</div>