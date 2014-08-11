<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/


App::before(function($request)
{

    if ( in_array(Request::segment(1), Config::get('variable.languages')) ) {
        Session::put('locale', Request::segment(1));
        return Redirect::to(substr(Request::path(), 3));
    }
    if ( Session::has('locale') ) {
        App::setLocale(Session::get('locale'));
    }
});


App::after(function($request, $response)
{
	//var_dump($response);exit;
});

App::missing(function($exception)
{
    return Response::view(Config::get('view.error-404'), array('dynamicTitle' => trans('all.error-404')), 404);
});
/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	Session::put('prevPage', Request::url());
	if (Auth::guest()) return Redirect::guest(route('sign-in'));
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


//admincp
Route::filter('basicAuth', function()
{
    if(!Sentry::check())
    {
        // save the attempted url
        Session::put('attemptedUrl', URL::current());

        return Redirect::route('getLogin');
    }

    View::share('currentUser', Sentry::getUser());
});

Route::filter('notAuth', function()
{
    if(Sentry::check())
    {
        $url = Session::get('attemptedUrl');
        if(!isset($url))
        {
            $url = URL::route('indexDashboard');
        }
        Session::forget('attemptedUrl');

        return Redirect::to($url);
    }
});

Route::filter('hasPermissions', function($route, $request, $userPermission = null)
{
    if (Route::currentRouteNamed('putUser') && Sentry::getUser()->id == Request::segment(3) ||
        Route::currentRouteNamed('showUser') && Sentry::getUser()->id == Request::segment(3))
    {
    }
    else
    {
        if($userPermission === null)
        {
            $permissions = Config::get('variable.permissions');
            $permission = $permissions[Route::current()->getName()];
        }
        else
        {
            $permission = $userPermission;
        }

        if(!Sentry::getUser()->hasAccess($permission))
        {
            return Redirect::route('accessDenied');
        }
    }
});