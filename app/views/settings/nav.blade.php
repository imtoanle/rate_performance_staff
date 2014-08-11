<div class="col-md-3">
	<aside class="sidebar">

		<h4>{{trans('all.category')}}</h4>
		<ul class="nav nav-list primary push-bottom">
			<li><a href="{{route('setting-profile')}}">{{trans('all.settings.personal-info')}}</a>
				<ul>
					<li><a href="{{route('setting-profile')}}">{{trans('all.settings.edit-info')}}</a></li>
					<li><a href="{{route('setting-change-pass')}}">{{trans('all.settings.change-pass')}}</a></li>
					<li><a href="{{route('setting-change-question')}}">{{trans('all.settings.change-question')}}</a></li>
					<li><a href="{{route('setting-email-notify')}}">{{trans('all.settings.email-notify')}}</a></li>
				</ul>
			</li>
			<li><a href="{{route('setting-security-login')}}">{{trans('all.settings.security-login')}}</a></li>
			<li><a href="{{route('my-invoice')}}">{{trans('all.settings.invoice')}}</a></li>

			<!--<li><a href="page-left-sidebar.html#">{{trans('all.settings.my-mail')}}</a></li>-->
			<li><a href="{{route('my-statement')}}">{{trans('all.settings.statement')}}</a></li>
			<li><a href="page-left-sidebar.html#">{{trans('all.settings.my-services')}}</a></li>
		</ul>

	</aside>
</div>