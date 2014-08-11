<?php

use Validators\Frontend as FrontendValidator;
class AccountController extends BaseController {

	public function postSignUp() {
		$validator = new FrontendValidator(Input::all(), 'create-client');
    if(!$validator->passes())
    {
        return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors(), 'messageType' => 'danger'));
    }

		$name = Input::get('name');
		$username = Input::get('username');
		$email = Input::get('email');
		$password = Input::get('password');
		$full_name = Input::get('full_name');

		$code = str_random(60);

		$user = Client::create(array(
			'name' => $name,
			'username' => $username,
			'email' => $email,
			'password' => Hash::make($password),
			'name' => $full_name,
			'code' => $code,
			'active' => 0,
			'phone' => Input::get('phone'),
			'address' => Input::get('address'),
			'city' => Input::get('city'),
			'state' => Input::get('state'),
			'zip_code' => Input::get('zip_code'),
			'country' => Input::get('country'),
			'language' => Input::get('language'),
			'security_question' => Input::get('security_question'),
			'security_answer' => Input::get('security_answer'),
		));

		if ($user)
		{
			$email = Mail::send('emails.activate', array('name' => $name, 'link' => URL::route('activate-account', $code)), function($message) use ($user) {
				$message->to($user->email, $user->name)->subject(trans('all.activate-account'));
			});
			if($email) {
				return Response::json(array('dataStatus' => true, 'clearField' => true, 'message' => trans('all.sign-up-page.success'), 'messageType' => 'success'));
			}
		}
		return Response::json(array('dataStatus' => false, 'message' => trans('all.sign-up-page.error'), 'messageType' => 'danger'));
	}

	public function postSignIn() {
		$redirect_url = Request::header('referer') == route('sign-in') ? Session::get('prevPage') : Request::header('referer');

		$valid = Validator::make(Input::all(),
			array(
				'username' => 'required',
				'password' => 'required'
			)
		);

		if(!$valid->fails()) {
			$user = Client::where('username', '=', Input::get('username'));
			
			if($user->count()) {
				$user = $user->first();
				if(Hash::check(Input::get('password'), $user->password)) {
					if($user->active == 1) {
						Auth::login($user);
						//Tao log dang nhap
						LogIP::create(array(
							'client_id' => $user->id,
							'ip' => Request::getClientIp()
						));
						if($user->password_temp != '') {
							return Response::json(array('dataStatus' => true, 'redirectUrl' => URL::route('setting-change-pass'), 'messageType' => 'success'));
						}
						return Response::json(array('dataStatus' => true, 'redirectUrl' => $redirect_url, 'messageType' => 'success'));
					}
					return Response::json(array('dataStatus' => false, 'message' => trans('all.sign-in-form.inactive-account'), 'messageType' => 'danger'));
				}
				else {
					return Response::json(array('dataStatus' => false, 'message' => trans('all.sign-in-form.invalid-account'), 'messageType' => 'danger'));
				}
			}
			return Response::json(array('dataStatus' => false, 'message' => trans('all.sign-in-form.account-doesnt-exist'), 'messageType' => 'danger'));
		}
		
		return Response::json(array('dataStatus' => false, 'message' => trans('all.sign-in-form.invalid-account'), 'messageType' => 'danger'));
	}

	public function postForgotPassword() {
		
		$valid = Validator::make(Input::all(),
			array(
				'email' => 'required|email'
			)
		);

		if(!$valid->fails()) {
			$user = Client::where('email', '=', Input::get('email'));

			if($user->count()) {
				$user = $user->first();

				if($user->active == 1) {
					$code = str_random(60);
					$password = str_random(10);

					$user->code = $code;
					$user->password_temp = Hash::make($password);

					if($user->save()) {

						$email = Mail::send('emails.forgotpassword', array('name' => $user->name, 'link' => URL::route('forgot-password-activate', array('user' => $user->id, 'code' => $code)), 'password' => $password), function($message) use ($user) {
							$message->to($user->email, $user->name)->subject('Your new password');
						});

						if($email) {
							return Response::json(array('dataStatus' => true, 'message' => trans('all.forgot-pass.success'), 'messageType' => 'success'));
						}

						return Response::json(array('dataStatus' => false, 'message' => trans('all.forgot-pass.unexpected-error'), 'messageType' => 'danger'));
					}
					return Response::json(array('dataStatus' => false, 'message' => trans('all.forgot-pass.unexpected-error'), 'messageType' => 'danger'));
				}
				return Response::json(array('dataStatus' => false, 'message' => trans('all.forgot-pass.inactive-account'), 'messageType' => 'danger'));
			}
			return Response::json(array('dataStatus' => false, 'message' => trans('all.forgot-pass.account-doesnt-exist'), 'messageType' => 'danger'));
		}
		return Response::json(array('dataStatus' => false, 'message' => trans('all.forgot-pass.invalid-email'), 'messageType' => 'danger'));
	}

	public function postChangePassword() {
		$validator = new FrontendValidator(Input::all(), 'change-pass');
    if(!$validator->passes())
    {
        return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors(), 'messageType' => 'danger'));
    }

		$user = Auth::user();

		if(Hash::check(Input::get('old_password'), $user->password)) 
		{
			$user->password = Hash::make(Input::get('password'));
			$user->password_temp = '';

			if($user->save()) 
			{
				return Response::json(array('dataStatus' => true, 'clearField' => true, 'message' => trans('all.update-success'), 'messageType' => 'success'));
			}
			return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
		}
		return Response::json(array('dataStatus' => false, 'errorMessages' => array('old_password' => array(trans('all.incorrect-current-pass'))), 'messageType' => 'danger'));
	}
	
	public function getSignIn() {
		return View::make(Config::get('view.sign-in'));
	}

	public function getSignUp() {
		return View::make(Config::get('view.sign-up'));
	}

	public function getActivateAccount($code) {
		$user = Client::where('code', '=', $code)->where('active', '=', 0);
		if($user->count()) {
			$user = $user->first();
			$user->active = 1;
			$user->code = '';

			if($user->save()) {
				return Redirect::route('sign-in')->with('success', true);
			}
			return Redirect::route('sign-in')->with('error', 'unactive-account');
		}
		return App::abort(404);
	}

	public function getSignOut() {
		Auth::logout();
		return Redirect::route('indexHome');
	}

	public function getForgotPassword() {
		return View::make(Config::get('view.forgot-pass'));
	}

	public function getForgotPasswordActivate($userId, $code) {
		$user = Client::find($userId);
		if($user->code == $code) {
			$user->password = $user->password_temp;
			$user->code = '';

			if($user->save()) {
				return Redirect::route('sign-in');
			}

			return Redirect::route('forgot-password')->with('error', 'unexpected-error');
		}

		return Redirect::route('forgot-password')->with('error', 'account-doesnt-exist');
	}

	public function getChangePassword() {
		return View::make('changepassword');
	}
}