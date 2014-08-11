<?php

use Validators\Frontend as FrontendValidator;
class BlogController extends BaseController {

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
    $allBlogs = Blog::orderBy('created_at', 'desc')->paginate(10);
    $popularBlogs = Blog::orderBy('views', 'desc')->limit(5)->get();
    $recentBlogs = Blog::orderBy('created_at', 'desc')->limit(5)->get();
    return View::make(Config::get('view.index-blogs'), array(
      'allBlogs' => $allBlogs,
      'popularBlogs' => $popularBlogs,
      'recentBlogs' => $recentBlogs,
      ));
  }

  public function getViewBlog($blogId)
  {
  	$blog = Blog::find($blogId);
    //update views count
    $blog->views += 1;
    $blog->timestamps = false;
    $blog->save();

    $popularBlogs = Blog::orderBy('views', 'desc')->limit(5)->get();
    $recentBlogs = Blog::orderBy('created_at', 'desc')->limit(5)->get();

  	$arrBreadCrumb = array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.blog'), route('index-blog')),
        array($blog->title)
    );

  	return View::make(Config::get('view.view-blog'), array(
  		'blogDetail' => $blog, 
  		'dynamicTitle' => $blog->title, 
  		'dataBreadcrumb' => $arrBreadCrumb,
      'popularBlogs' => $popularBlogs,
      'recentBlogs' => $recentBlogs
  		));
  }

  public function postComment()
  {
    if(Request::Ajax())
    {
      $validator = new FrontendValidator(Input::all(),'create-comment');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors(), 'messageType' => 'danger'));
      }

      try
      {
        // update profile
        $comment = Comment::create(array(
            'name'    => Input::get('full_name'),
            'email'    => Input::get('email'),
            'content'    => Input::get('content'),
            'blog_id'    => Input::get('blog_id'),
        ));

        return json_encode(array('dataStatus' => true, 'redirectUrl' => 'self'));
      }catch (\Exception $e)
      {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.create-fail'), 'messageType' => 'danger'));
      }
    }
  }

}

