@extends('layout.main')

@section('seo')
<title>Forgot Password</title>
@stop

@section('content')
<br /><h4>Forgot password?</h4><br />

@if(Session::has('success'))
<div class="alert alert-success">
	We have sent you instructions in your email in order to recover your account.
</div>
@else

@if(Session::has('error'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Error!</strong> 
	{{ (Session::get('error') == 'invalid-email') ? 'Invalid email. Please try again.' : '' }}
	{{ (Session::get('error') == 'account-doesnt-exist') ? 'Account does not exist. Please try again or '.link_to_route('sign-up', 'Sign Up') : '' }}
	{{ (Session::get('error') == 'inactive-account') ? 'Account not active, please check your email and activate.' : '' }}
	{{ (Session::get('error') == 'unexpected-error') ? 'Unexpected error occurred. Please try again.' : '' }}
</div>
@endif

<form method="post" action="{{ URL::route('forgot-password-post') }}" role="form"> 

	<div class="form-group">
		<label for="inputEmail">Email:</label>
		<input type="email" class="form-control" id="inputEmail" placeholder="me@myemail.com" name="email"{{ Input::old('email') ? ' value="'. e(Input::old('email')) .'"' : '' }} />
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
	{{ Form::token() }}

</form>
@endif
@stop