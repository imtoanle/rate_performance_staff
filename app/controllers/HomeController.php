<?php

class HomeController extends BaseController {

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

	public function getIndex()
	{
		$latestBlogs = Blog::orderBy('created_at', 'desc')->limit(6)->get();
		$latestFeedBacks = FeedBack::orderBy('created_at', 'desc')->limit(4)->get();
		return View::make('home.index', array('latestBlogs' => $latestBlogs, 'latestFeedBacks' => $latestFeedBacks));
	}

}
