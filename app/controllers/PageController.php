<?php
use Validators\Frontend as FrontendValidator;
class PageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getAboutUs()
	{
		$aboutUs = Page::where('name', '=', 'about-us')->first();
		return View::make(Config::get('view.about-us'), array('aboutUs' => $aboutUs));
	}

	public function getContactUs()
	{
		return View::make(Config::get('view.contact-us'));
	}

	public function postContactUs()
	{
		if(Request::Ajax())
		{
			$validator = new FrontendValidator(Input::all(), 'contact-us');

      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'clearOffset' => true, 'errorMessages' => $validator->getErrors(), 'messageType' => 'danger'));
      }

      $contact = new FeedBack;
      $contact->fill(array(
      	'name' => Input::get('full_name'),
      	'email' => Input::get('email'),
      	'subject' => Input::get('subject'),
      	'content' => Input::get('content'),
      	'type' => Input::get('type_contact')
      	));

      if ($contact->save())
      {
      	return Response::json(array('dataStatus' => true, 'clearField'=> true, 'message' => trans('all.contact-us-page.success'), 'messageType' => 'success'));
      }
      else
      {
      	return Response::json(array('dataStatus' => false, 'message' => trans('all.contact-us-page.error'), 'messageType' => 'danger'));
      }
		}
	}

	public function getAddFundBankOffline()
	{
		$addFundBank = Page::where('name', '=', 'add-fund-bank')->first();
		return View::make(Config::get('view.add-funds-bank'), array('addFundBank' => $addFundBank));
	}
}
