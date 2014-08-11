<nav>
	<ul class="list-inline">

		@if(Request::is('/'))
		<li><em>Home</em></li>
		@else
		<li><a href="{{ URL::route('indexHome') }}">Home</a></li>
		@endif

		@if(Auth::check())
			@if(Request::is('account/change-password'))
			<li><em>Change Password</em></li>
			@else
			<li><a href="{{ URL::route('change-password') }}">Change Password</a></li>
			@endif

			<li><a href="{{ URL::route('sign-out') }}">Sign Out</a></li>
		@else
			@if(Request::is('account/sign-in'))
			<li><em>Sign In</em></li>
			@else
			<li><a href="{{ URL::route('sign-in') }}">Sign In</a></li>
			@endif

			@if(Request::is('account/sign-up'))
			<li><em>Sign Up</em></li>
			@else
			<li><a href="{{ URL::route('sign-up') }}">Sign Up</a></li>
			@endif
		@endif
	</ul>
</nav>