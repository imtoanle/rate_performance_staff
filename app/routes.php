<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('', array(
    'as' => 'indexHome',
    'uses' => 'HomeController@getIndex')
);

Route::get('services/imei-list.html',
	array(
		'as' => 'imei-service',
		'uses' => 'ServiceController@getIndex'
	)
);

Route::get('services/file-list.html',
	array(
		'as' => 'file-service',
		'uses' => 'ServiceController@getIndex'
	)
);

Route::get('services/server-list.html',
	array(
		'as' => 'server-service',
		'uses' => 'ServiceController@getIndex'
	)
);

Route::get('about-us.html',
	array(
		'as' => 'about-us',
		'uses' => 'PageController@getAboutUs'
	)
);

Route::get('add-fund-bank.html',
	array(
		'as' => 'add-fund-bank',
		'uses' => 'PageController@getAddFundBankOffline'
	)
);

//contact us
Route::get('contact-us.html',
	array(
		'as' => 'contact-us',
		'uses' => 'PageController@getContactUs'
	)
);

Route::post('contact-us.html',
	array(
		'as' => 'contact-us',
		'uses' => 'PageController@postContactUs'
	)
);

Route::pattern('serviceId', '[0-9]+');
Route::get('services/{serviceId}/{titleService}.html',
	array(
		'as' => 'detail-imei-service',
		'uses' => 'ServiceController@getDetailService'
	)
);


Route::get('blogs.html',
	array(
		'as' => 'index-blog',
		'uses' => 'BlogController@getIndex'
	)
);

Route::pattern('blogId', '[0-9]+');
Route::get('blogs/{blogId}/{slugtitle}.html',
	array(
		'as' => 'view-blog',
		'uses' => 'BlogController@getViewBlog'
	)
);

Route::post('blogs/comment',
	array(
		'as' => 'post-comment',
		'uses' => 'BlogController@postComment'
	)
);
// Unauthenticated group

Route::group(array('before' => 'guest'), function() {

	// CSRF protection group

	Route::group(array('before' => 'csrf'), function() {

		// Sign In post

		Route::post('account/sign-in.html',
			array(
				'as' => 'sign-in-post',
				'uses' => 'AccountController@postSignIn'
			)
		);

		// Sign Up post

		Route::post('account/sign-up.html',
			array(
				'as' => 'sign-up-post',
				'uses' => 'AccountController@postSignUp'
			)
		);

		// Forgot password post

		Route::post('account/forgot-password.html',
			array(
				'as' => 'forgot-password-post',
				'uses' => 'AccountController@postForgotPassword'
			)
		);

	});

	// Sign In

	Route::get('account/sign-in.html',
		array(
			'as' => 'sign-in',
			'uses' => 'AccountController@getSignIn'
		)
	);

	// Sign Up

	Route::get('account/sign-up.html',
		array(
			'as' => 'sign-up',
			'uses' => 'AccountController@getSignUp'
		)
	);

	// Activate account

	Route::get('account/activate/{code}',
		array(
			'as' => 'activate-account',
			'uses' => 'AccountController@getActivateAccount'
		)
	);

	// Forgot password

	Route::get('account/forgot-password.html',
		array(
			'as' => 'forgot-password',
			'uses' => 'AccountController@getForgotPassword'
		)
	);

	// Activate temporary password

	Route::get('account/forgot-password/{user}/{code}',
		array(
			'as' => 'forgot-password-activate',
			'uses' => 'AccountController@getForgotPasswordActivate'
		)
	);
});

// Authenticated group

Route::group(array('before' => 'auth'), function() {

	// CSRF protection group

	Route::group(array('before' => 'csrf'), function() {

		// Change password post
		Route::post('account/setting/change-pass.html',
			array(
				'as' => 'change-password-post',
				'uses' => 'AccountController@postChangePassword'
			)
		);

		//create order
		Route::post('services/order.html',
			array(
				'as' => 'client-create-order',
				'uses' => 'OrderController@postOrder'
			)
		);

		Route::put('account/setting/change-question.html', array(
				'as' => 'setting-change-question',
				'uses' => 'AreaClientController@editQuestion'
			)
		);

		Route::post('account/setting/profile.html', array(
				'as' => 'setting-profile',
				'uses' => 'AreaClientController@editProfile'
			)
		);

		Route::put('account/setting/security-login.html', array(
				'as' => 'setting-security-login',
				'uses' => 'AreaClientController@editSecurityLogin'
			)
		);

		Route::post('account/invoice.html',
			array(
				'as' => 'post-create-invoice',
				'uses' => 'AreaClientController@postCreateInvoice'
			)
		);

	});	
	//controller
	//////////////////////////////
	Route::post('services/imei/place-order.html',
			array(
				'as' => 'place-order-imei',
				'uses' => 'ServiceController@getPlaceOrder'
			)
		);

	Route::get('services/imei/place-order.html',
			array(
				'as' => 'place-order-imei',
				'uses' => 'ServiceController@getPlaceOrder'
			)
		);

	//Client Area
	Route::get('area-client.html',
		array(
			'as' => 'area-client',
			'uses' => 'AreaClientController@getIndex'
		)
	);

	//ajax get login logs
	Route::post('area-client/login-logs.html',
		array(
			'as' => 'get-login-logs',
			'uses' => 'AreaClientController@postLoginLogs'
		)
	);

	//ajax get detail order
	Route::post('area-client/ajax-detail-order.html',
		array(
			'as' => 'ajax-detail-order',
			'uses' => 'AreaClientController@postAjaxDetailOrder'
		)
	);
	
	//post to get history orders
	Route::post('orders/orders_history.html',
		array(
			'as' => 'orders-history',
			'uses' => 'OrderController@postHistoryOrders'
		)
	);

	Route::get('orders/orders_history.html',
		array(
			'as' => 'orders-history',
			'uses' => 'OrderController@getHistoryOrders'
		)
	);

	//Trang quan ly user
	Route::get('account/setting/profile.html', array(
			'as' => 'setting-profile',
			'uses' => 'AreaClientController@editProfile'
		)
	);

	Route::get('account/setting/change-pass.html',
		array(
			'as' => 'setting-change-pass',
			'uses' => 'AreaClientController@editPassword'
		)
	);

	Route::get('account/setting/change-question.html', array(
			'as' => 'setting-change-question',
			'uses' => 'AreaClientController@editQuestion'
		)
	);

	Route::get('account/setting/email-notify.html',
		array(
			'as' => 'setting-email-notify',
			'uses' => 'AreaClientController@editEmailNotify'
		)
	);


	Route::get('account/setting/security-login.html', array(
			'as' => 'setting-security-login',
			'uses' => 'AreaClientController@editSecurityLogin'
		)
	);

	//my invoice
	Route::get('account/my-invoice.html',
		array(
			'as' => 'my-invoice',
			'uses' => 'AreaClientController@getMyInvoice'
		)
	);

	Route::post('account/my-invoice.html',
		array(
			'as' => 'my-invoice',
			'uses' => 'AreaClientController@postMyInvoice'
		)
	);

	//my statement
	Route::get('account/my-statement.html',
		array(
			'as' => 'my-statement',
			'uses' => 'AreaClientController@getMyStatement'
		)
	);

	Route::post('account/my-statement.html',
		array(
			'as' => 'my-statement',
			'uses' => 'AreaClientController@postMyStatement'
		)
	);

	//paypal checkout express
	Route::get('account/add-funds-paypal.html',
		array(
			'as' => 'add-fund-paypal',
			'uses' => 'AreaClientController@getAddFundsPaypal'
		)
	);


	Route::post('paypal.html',
		array(
			'as' => 'paypal-process',
			'uses' => 'PaypalController@post_index'
		)
	);

	Route::get('paypal.html',
		array(
			'as' => 'paypal-result',
			'uses' => 'PaypalController@get_index'
		)
	);

	Route::pattern('invoiceId', '[0-9]+');
	Route::get('account/invoice/{invoiceId}.html',
		array(
			'as' => 'view-invoice',
			'uses' => 'AreaClientController@getViewInvoice'
		)
	);

	// Sign Out

	Route::get('account/sign-out.html',
		array (
			'as' => 'sign-out',
			'uses' => 'AccountController@getSignOut'
		)
	);

	// Change password

	Route::get('account/change-password.html',
		array(
			'as' => 'change-password',
			'uses' => 'AccountController@getChangePassword'
		)
	);
	
});

View::composer(array(Config::get('view.contact-us'), Config::get('view.footer'), Config::get('view.header'), Config::get('view.master'), Config::get('view.view-invoice')), function($view)
{
    $view->with('setting_vars', array(
    	'company' => Setting::find('company')->value,
    	'address' => Setting::find('address')->value,
    	'phone' => Setting::find('phone')->value,
    	'email' => Setting::find('email')->value,
    	));
});

//set header
View::composer(array(Config::get('view.head'), Config::get('view.header')), function($view)
{
	$nameRoute = Route::currentRouteName();
	
	if ($nameRoute != 'detail-imei-service')
	{
		$view->with('pageTitle', Config::get('titlepage.'.$nameRoute));
	}
  
  $view->with('keywords', Setting::find('keywords')->value);
  $view->with('description', Setting::find('description')->value);
});

//enable breadcrumb
View::composer(Config::get('view.header'), function($view)
{
	$array_disable = array('indexHome');
	$array_dynamic = array('view-blog', 'detail-imei-service');
	if (!in_array(Route::currentRouteName(), $array_disable))
  {
  	$view->with('enableBreadcrumb', true);
  	if (!in_array(Route::currentRouteName(), $array_dynamic))
			$view->with('dataBreadcrumb', Config::get('breadcrumbs.'.Route::currentRouteName()));
  }
});







//admicp

/**
 * Loggued routes without permission
 */
Route::group(array('before' => 'basicAuth', 'prefix' => Config::get('variable.backend.uri-config')), function()
{
    Route::get('', array(
        'as' => 'indexDashboard',
        'uses' => 'BackendDashboardController@getIndex')
    );

    Route::get('dashboard-little', array(
        'as' => 'indexDashboardLittle',
        'uses' => 'BackendDashboardController@getIndex')
    );

    Route::get('logout', array(
        'as' => 'logout',
        'uses' => 'BackendDashboardController@getLogout')
    );

    Route::get('access-denied', array(
        'as' => 'accessDenied',
        'uses' => 'BackendDashboardController@getAccessDenied')
    );
});

/**
 * Loggued routes with permissions
 */
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('variable.backend.uri-config')), function()
{

  /**
   * User routes
   */
  Route::get('users', array(
      'as' => 'listUsers',
      'uses' => 'BackendUserController@getIndex')
  );

  Route::delete('user/delete', array(
      'as' => 'deleteUsers',
      'uses' => 'BackendUserController@delete')
  );

  Route::post('user/new', array(
      'as' => 'newUserPost',
      'uses' => 'BackendUserController@postCreate')
  );

  Route::get('user/new', array(
      'as' => 'newUser',
      'uses' => 'BackendUserController@getCreate')
  );

  Route::get('user/{userId}', array(
      'as' => 'showUser',
      'uses' => 'BackendUserController@getShow')
  );

  Route::put('user/{userId}', array(
      'as' => 'putUser',
      'uses' => 'BackendUserController@putShow')
  );

  Route::put('user/{userId}/activate', array(
      'as' => 'putActivateUser',
      'uses' => 'BackendUserController@putActivate')
  );

  Route::get('users/full-text-search', array(
      'as' => 'listUsersSearch',
      'uses' => 'BackendUserController@fullTextSearch')
  );

  Route::get('users/search-via-job-title', array(
      'as' => 'listUsersSearchJob',
      'uses' => 'BackendUserController@searchViaJobTitle')
  );

  /**
   * Group routes
   */
  Route::get('groups', array(
      'as' => 'listGroups',
      'uses' => 'BackendGroupController@getIndex')
  );

  Route::post('group/new', array(
      'as' => 'newGroupPost',
      'uses' => 'BackendGroupController@postCreate')
  );

  Route::get('group/new', array(
      'as' => 'newGroup',
      'uses' => 'BackendGroupController@getCreate')
  );

  Route::delete('group/deleteMulti', array(
      'as' => 'deleteGroup',
      'uses' => 'BackendGroupController@delete')
  );

  Route::get('group/{groupId}', array(
      'as' => 'showGroup',
      'uses' => 'BackendGroupController@getShow')
  );

  Route::put('group/{groupId}', array(
      'as' => 'putGroup',
      'uses' => 'BackendGroupController@putShow')
  );

  Route::delete('group/{groupId}/user/{userId}', array(
      'as' => 'deleteUserGroup',
      'uses' => 'BackendGroupController@deleteUserFromGroup')
  );

  Route::post('group/addUserGroup', array(
      'as' => 'addUserGroup',
      'uses' => 'BackendGroupController@addUserInGroup')
  );

  /**
   * Job Title routes
   */
  Route::get('job-titles', array(
      'as' => 'listJobTitles',
      'uses' => 'BackendJobTitleController@getIndex')
  );

  Route::post('job-title/new', array(
      'as' => 'newJobTitlePost',
      'uses' => 'BackendJobTitleController@postCreate')
  );

  Route::delete('job-title/deleteMulti', array(
      'as' => 'deleteJobTitle',
      'uses' => 'BackendJobTitleController@delete')
  );

  Route::put('job-title/{jobTitleId}', array(
      'as' => 'putJobTitle',
      'uses' => 'BackendJobTitleController@putShow')
  );

  /**
   * Department routes
   */
  Route::get('departments', array(
      'as' => 'listDepartments',
      'uses' => 'BackendDepartmentController@getIndex')
  );

  Route::post('department/new', array(
      'as' => 'newDepartmentPost',
      'uses' => 'BackendDepartmentController@postCreate')
  );

  Route::delete('department/deleteMulti', array(
      'as' => 'deleteDepartment',
      'uses' => 'BackendDepartmentController@delete')
  );

  Route::put('department/{jobTitleId}', array(
      'as' => 'putDepartment',
      'uses' => 'BackendDepartmentController@putShow')
  );

  /**
   * Voting Criterial routes
   */
  Route::get('criterias', array(
      'as' => 'listCriterias',
      'uses' => 'BackendCriteriaController@getIndex')
  );

  Route::post('criteria/new', array(
      'as' => 'newCriteriaPost',
      'uses' => 'BackendCriteriaController@postCreate')
  );

  Route::delete('criteria/deleteMulti', array(
      'as' => 'deleteCriteria',
      'uses' => 'BackendCriteriaController@delete')
  );

  Route::put('criteria/{criteriaId}', array(
      'as' => 'putCriteria',
      'uses' => 'BackendCriteriaController@putShow')
  );

  /**
   * Vote Roles routes
   */
  Route::get('roles', array(
      'as' => 'listRoles',
      'uses' => 'BackendRoleController@getIndex')
  );

  Route::post('role/new', array(
      'as' => 'newRolePost',
      'uses' => 'BackendRoleController@postCreate')
  );

  Route::delete('role/deleteMulti', array(
      'as' => 'deleteRole',
      'uses' => 'BackendRoleController@delete')
  );

  Route::put('role/{roleId}', array(
      'as' => 'putRole',
      'uses' => 'BackendRoleController@putShow')
  );

  /**
   * Permission routes
   */
  Route::get('permissions', array(
      'as' => 'listPermissions',
      'uses' => 'BackendPermissionController@getIndex')
  );

  Route::delete('permission/{permissionId}',array(
      'as' => 'deletePermission',
      'uses' => 'BackendPermissionController@delete')
  );

  Route::get('permission/new', array(
      'as' => 'newPermission',
      'uses' => 'BackendPermissionController@getCreate')
  );

  Route::post('permission/new', array(
      'as' => 'newPermissionPost',
      'uses' => 'BackendPermissionController@postCreate')
  );

  Route::get('permission/{permissionId}', array(
      'as' => 'showPermission',
      'uses' => 'BackendPermissionController@getShow')
  );

  Route::put('permission/{permissionId}', array(
      'as' => 'putPermission',
      'uses' => 'BackendPermissionController@putShow')
  );

  //vote manage
  Route::get('vote/{voteId}/list-persions', array(
      'as' => 'listPersionsVote',
      'uses' => 'BackendVoteController@getListPersion')
  );

  Route::get('votes', array(
      'as' => 'listVotes',
      'uses' => 'BackendVoteController@getIndex')
  );

  Route::get('vote/new', array(
      'as' => 'newVote',
      'uses' => 'BackendVoteController@getCreate')
  );

  Route::post('vote/new', array(
      'as' => 'postNewVote',
      'uses' => 'BackendVoteController@postCreate')
  );

  Route::get('vote/{voteId}', array(
      'as' => 'showVote',
      'uses' => 'BackendVoteController@getShow')
  );

  Route::get('vote-group/{voteGroupId}', array(
      'as' => 'showVoteGroup',
      'uses' => 'BackendVoteController@getShowGroup')
  );

  Route::put('vote/{voteId}', array(
      'as' => 'putVote',
      'uses' => 'BackendVoteController@putShow')
  );

  Route::put('vote-group/{voteGroupId}', array(
      'as' => 'putVoteGroup',
      'uses' => 'BackendVoteController@putShowGroup')
  );

  Route::delete('vote/delete', array(
      'as' => 'deleteVote',
      'uses' => 'BackendVoteController@delete')
  );

  Route::delete('vote-group/delete', array(
      'as' => 'deleteVoteGroup',
      'uses' => 'BackendVoteController@deleteGroup')
  );

  //user vote
  Route::get('user-votes', array(
      'as' => 'listUserVotes',
      'uses' => 'BackendUserVoteController@getIndex')
  );

  Route::get('user-votes/quick-vote', array(
      'as' => 'quickUserVote',
      'uses' => 'BackendUserVoteController@getQuickVote')
  );

  Route::post('user-votes/quick-vote', array(
      'as' => 'postQuickUserVote',
      'uses' => 'BackendUserVoteController@postQuickVote')
  );











	Route::get('services/imei', array(
      'as' => 'indexImeiServices',
      'uses' => 'BackendImeiServiceController@getIndex')
  );

  Route::post('services/imei', array(
      'as' => 'indexImeiServices',
      'uses' => 'BackendImeiServiceController@getAjaxTable')
  );

  Route::get('services/imei/quick-edit', array(
      'as' => 'quickEditImeiServices',
      'uses' => 'BackendImeiServiceController@getQuickEdit')
  );

  Route::put('services/imei/quick-edit', array(
      'as' => 'updateQuickEditImeiServices',
      'uses' => 'BackendImeiServiceController@putUpdateQuickEdit')
  );

  Route::get('services/imei/edit/{serviceId}', array(
      'as' => 'editImeiServices',
      'uses' => 'BackendImeiServiceController@getEdit')
  );

  //little edit service
  Route::get('services/imei/edit/api/{serviceId}', array(
      'as' => 'editImeiServiceApi',
      'uses' => 'BackendImeiServiceController@getEditServiceApi')
  );

  Route::get('services/imei/edit/promotion/{serviceId}', array(
      'as' => 'editImeiServicePromotion',
      'uses' => 'BackendImeiServiceController@getEdit')
  );

  Route::get('services/imei/edit/settings/{serviceId}', array(
      'as' => 'editImeiServiceSettings',
      'uses' => 'BackendImeiServiceController@getEdit')
  );

  Route::get('services/imei/edit/discounted-users/{serviceId}', array(
      'as' => 'editImeiServiceDiscountedUsers',
      'uses' => 'BackendImeiServiceController@getEdit')
  );

  Route::get('services/imei/edit/customer-review/{serviceId}', array(
      'as' => 'editImeiServiceCustomerReview',
      'uses' => 'BackendImeiServiceController@getEdit')
  );

  //update service
  Route::put('services/imei/edit/{serviceId}', array(
      'as' => 'updateImeiServices',
      'uses' => 'BackendImeiServiceController@putUpdate')
  );

  Route::put('services/imei/edit/api/{serviceId}', array(
      'as' => 'updateApiImeiServices',
      'uses' => 'BackendImeiServiceController@putUpdateApi')
  );

  Route::get('services/imei/new', array(
      'as' => 'newImeiServices',
      'uses' => 'BackendImeiServiceController@getNew')
  );

  Route::post('services/imei/new', array(
      'as' => 'createImeiServices',
      'uses' => 'BackendImeiServiceController@postCreate')
  );

  Route::delete('services/imei/delete', array(
      'as' => 'deleteServices',
      'uses' => 'BackendImeiServiceController@delete')
  );


  //service gorup
  Route::get('services/imei/groups', array(
      'as' => 'indexImeiServiceGroups',
      'uses' => 'BackendServiceGroupController@getIndex')
  );

  Route::post('services/imei/groups', array(
      'as' => 'indexImeiServiceGroups',
      'uses' => 'BackendServiceGroupController@getAjaxTable')
  );

  Route::get('services/imei/group/edit/{groupId}', array(
      'as' => 'editImeiServiceGroups',
      'uses' => 'BackendServiceGroupController@getEdit')
  );

  Route::put('services/imei/group/edit/{groupId}', array(
      'as' => 'updateImeiServiceGroup',
      'uses' => 'BackendServiceGroupController@putUpdate')
  );

  Route::get('services/imei/group/new', array(
      'as' => 'newImeiServiceGroup',
      'uses' => 'BackendServiceGroupController@getNew')
  );

  Route::post('services/imei/group/new', array(
      'as' => 'createImeiServiceGroup',
      'uses' => 'BackendServiceGroupController@postCreate')
  );

  Route::delete('services/imei/group/delete', array(
      'as' => 'deleteImeiServiceGroup',
      'uses' => 'BackendServiceGroupController@delete')
  );


  //supplier
  Route::get('suppliers', array(
      'as' => 'indexSupplier',
      'uses' => 'BackendSupplierController@getIndex')
  );

  Route::post('suppliers', array(
      'as' => 'indexSupplier',
      'uses' => 'BackendSupplierController@getAjaxIndex')
  );

  Route::get('suppliers/edit/{supplierId}', array(
      'as' => 'editSupplier',
      'uses' => 'BackendSupplierController@getEdit')
  );

  Route::put('suppliers/edit/{supplierId}', array(
      'as' => 'updateSupplier',
      'uses' => 'BackendSupplierController@putUpdate')
  );

  Route::get('suppliers/new', array(
      'as' => 'newSupplier',
      'uses' => 'BackendSupplierController@getNew')
  );

  Route::post('suppliers/new', array(
      'as' => 'createSupplier',
      'uses' => 'BackendSupplierController@postCreate')
  );

  Route::delete('suppliers/delete', array(
      'as' => 'deleteSupplier',
      'uses' => 'BackendSupplierController@delete')
  );
  //settings

  //general
  Route::get('settings/general', array(
      'as' => 'generalSetting',
      'uses' => 'BackendSettingController@getGeneral')
  );
  //api
  Route::get('settings/api', array(
      'as' => 'apiSetting',
      'uses' => 'BackendSettingController@getApi')
  );

  Route::get('settings/api/edit/{apiId}', array(
      'as' => 'editApiSetting',
      'uses' => 'BackendSettingController@getEditApi')
  );

  Route::put('settings/api/edit/{apiId}', array(
      'as' => 'updateApiSetting',
      'uses' => 'BackendSettingController@putUpdateApi')
  );

  Route::put('settings/api/syn', array(
      'as' => 'updateSynApiSetting',
      'uses' => 'BackendSettingController@putUpdateSynApi')
  );

  //clients
  Route::get('clients', array(
      'as' => 'indexClient',
      'uses' => 'BackendClientController@getIndex')
  );

  Route::post('clients', array(
      'as' => 'indexClient',
      'uses' => 'BackendClientController@getAjaxIndex')
  );

  Route::get('clients/edit/{clientId}', array(
      'as' => 'editClient',
      'uses' => 'BackendClientController@getEdit')
  );

  Route::post('clients/edit/reset-pass/{clientId}', array(
      'as' => 'editClientResetPass',
      'uses' => 'BackendClientController@postResetPass')
  );

  Route::get('clients/edit/financial/{clientId}', array(
      'as' => 'editClientFinancial',
      'uses' => 'BackendClientController@getEditFinancial')
  );

  Route::post('clients/edit/financial/add-credit/{clientId}', array(
      'as' => 'addCreditClientFinancial',
      'uses' => 'BackendClientController@postAddCreditFinancial')
  );

  Route::post('clients/edit/financial/rebate-credit/{clientId}', array(
      'as' => 'rebateCreditClientFinancial',
      'uses' => 'BackendClientController@postRebateCreditFinancial')
  );

  Route::get('clients/edit/profile/{clientId}', array(
      'as' => 'editClientProfile',
      'uses' => 'BackendClientController@getEditProfile')
  );

  Route::put('clients/edit/profile/{clientId}', array(
      'as' => 'updateClientProfile',
      'uses' => 'BackendClientController@putUpdateEditProfile')
  );

  Route::get('clients/edit/api/{clientId}', array(
      'as' => 'editClientApi',
      'uses' => 'BackendClientController@getEdit')
  );

  Route::get('clients/edit/bind-login/{clientId}', array(
      'as' => 'editClientBindLogin',
      'uses' => 'BackendClientController@getEditBindLogin')
  );

  Route::put('clients/edit/bind-login/{clientId}', array(
      'as' => 'updateClientBindLogin',
      'uses' => 'BackendClientController@putUpdateBindLogin')
  );

  Route::get('clients/edit/set-pricing/{clientId}', array(
      'as' => 'editClientSetPricing',
      'uses' => 'BackendClientController@getEdit')
  );

  Route::get('clients/edit/order/{clientId}', array(
      'as' => 'editClientOrder',
      'uses' => 'BackendClientController@getEditOrder')
  );

  Route::get('clients/edit/invoice/{clientId}', array(
      'as' => 'editClientInvoice',
      'uses' => 'BackendClientController@getEditInvoice')
  );

  Route::get('clients/edit/mail/{clientId}', array(
      'as' => 'editClientMail',
      'uses' => 'BackendClientController@getEdit')
  );

  Route::get('clients/edit/statement/{clientId}', array(
      'as' => 'editClientStatement',
      'uses' => 'BackendClientController@getEditStatement')
  );

  Route::get('clients/edit/subscription/{clientId}', array(
      'as' => 'editClientSubscription',
      'uses' => 'BackendClientController@getEdit')
  );

  Route::get('clients/edit/activity-log/{clientId}', array(
      'as' => 'editClientActivityLog',
      'uses' => 'BackendClientController@getEdit')
  );
  

  Route::put('clients/edit/{clientId}', array(
      'as' => 'updateClient',
      'uses' => 'BackendClientController@putUpdate')
  );

  Route::get('clients/new', array(
      'as' => 'newClient',
      'uses' => 'BackendClientController@getNew')
  );

  Route::post('clients/new', array(
      'as' => 'createClient',
      'uses' => 'BackendClientController@postCreate')
  );

  Route::delete('clients/delete', array(
      'as' => 'deleteClient',
      'uses' => 'BackendClientController@delete')
  );

  //clientgroup
  Route::get('clientgroups', array(
      'as' => 'indexClientGroup',
      'uses' => 'BackendClientGroupController@getIndex')
  );

  Route::post('clientgroups', array(
      'as' => 'indexClientGroup',
      'uses' => 'BackendClientGroupController@getAjaxIndex')
  );

  Route::get('clientgroups/members/{clientGroupId}', array(
      'as' => 'memberClientGroup',
      'uses' => 'BackendClientGroupController@getMember')
  );

  Route::get('clientgroups/edit/{clientgroupId}', array(
      'as' => 'editClientGroup',
      'uses' => 'BackendClientGroupController@getEdit')
  );

  Route::put('clientgroups/edit/{clientgroupId}', array(
      'as' => 'updateClientGroup',
      'uses' => 'BackendClientGroupController@putUpdate')
  );

  Route::get('clientgroups/new', array(
      'as' => 'newClientGroup',
      'uses' => 'BackendClientGroupController@getNew')
  );

  Route::post('clientgroups/new', array(
      'as' => 'createClientGroup',
      'uses' => 'BackendClientGroupController@postCreate')
  );

  Route::delete('clientgroups/delete', array(
      'as' => 'deleteClientGroup',
      'uses' => 'BackendClientGroupController@delete')
  );

  Route::get('clients/update-multi-account', array(
      'as' => 'updateMultiClient',
      'uses' => 'BackendClientController@getUpdateMulti')
  );

  Route::get('clientgroups/pricing/{groupId}', array(
      'as' => 'editClientGroupPricing',
      'uses' => 'BackendClientGroupController@getEditPricing')
  );

  Route::put('clientgroups/pricing', array(
      'as' => 'updateClientGroupPricing',
      'uses' => 'BackendClientGroupController@putUpdatePricing')
  );


  Route::get('invoice/edit/{invoiceId}', array(
      'as' => 'editInvoice',
      'uses' => 'BackendInvoiceController@getEditInvoice')
  );

  Route::put('invoice/edit/{invoiceId}', array(
      'as' => 'updateInvoice',
      'uses' => 'BackendInvoiceController@putUpdateInvoice')
  );

  //orders
  Route::get('orders/imei', array(
      'as' => 'indexImeiOrders',
      'uses' => 'BackendImeiOrderController@getIndex')
  );

  Route::get('orders/imei/quick-accept', array(
      'as' => 'quickAcceptImeiOrders',
      'uses' => 'BackendImeiOrderController@getQuickAccept')
  );

  Route::put('orders/imei/quick-accept', array(
      'as' => 'updateQuickAcceptImeiOrders',
      'uses' => 'BackendImeiOrderController@putUpdateQuickAccept')
  );

  Route::get('orders/imei/service-accept', array(
      'as' => 'serviceAcceptImeiOrders',
      'uses' => 'BackendImeiOrderController@getServiceAccept')
  );

  Route::get('orders/imei/quick-reply', array(
      'as' => 'quickReplyImeiOrders',
      'uses' => 'BackendImeiOrderController@getQuickReply')
  );

  Route::put('orders/imei/quick-reply', array(
      'as' => 'quickReplyImeiOrders',
      'uses' => 'BackendImeiOrderController@putUpdateQuickReply')
  );

  Route::get('orders/imei/bulk-reply', array(
      'as' => 'bulkReplyImeiOrders',
      'uses' => 'BackendImeiOrderController@getBulkReply')
  );

  Route::get('orders/imei/verification', array(
      'as' => 'verificationImeiOrders',
      'uses' => 'BackendImeiOrderController@getVerification')
  );

  Route::get('orders/imei/history', array(
      'as' => 'historyImeiOrders',
      'uses' => 'BackendImeiOrderController@getHistory')
  );

  Route::get('orders/imei/history/edit/{orderId}', array(
      'as' => 'editHistoryImeiOrders',
      'uses' => 'BackendImeiOrderController@getEditHistory')
  );

  Route::get('orders/imei/pending-payment', array(
      'as' => 'pendingPaymentImeiOrders',
      'uses' => 'BackendImeiOrderController@getPendingPayment')
  );

  Route::get('orders/imei/manual-reply', array(
      'as' => 'manualReplyImeiOrders',
      'uses' => 'BackendImeiOrderController@getManualReply')
  );
  
  Route::get('clients/invoices/{clientId}', array(
      'as' => 'indexClientInvoices',
      'uses' => 'BackendInvoiceController@getAjaxClientInvoice')
  );

  Route::delete('clients/invoices/delete', array(
      'as' => 'deleteClientInvoices',
      'uses' => 'BackendInvoiceController@deleteClientInvoice')
  );

  Route::get('clients/statements/{clientId}', array(
      'as' => 'indexClientStatements',
      'uses' => 'BackendStatementController@getAjaxClientStatement')
  );

  Route::delete('clients/statements/delete', array(
      'as' => 'deleteClientStatements',
      'uses' => 'BackendStatementController@deleteClientStatement')
  );

    
});

/**
 * Unlogged routes
 */
Route::group(array('before' => 'notAuth', 'prefix' => Config::get('variable.backend.uri-config')), function()
{
    Route::get('login', array(
        'as' => 'getLogin',
        'uses' => 'BackendDashboardController@getLogin')
    );

    Route::post('login', array(
        'as' => 'postLogin',
        'uses' => 'BackendDashboardController@postLogin')
    );
});

Route::group(array('prefix' => Config::get('variable.backend.uri-config')), function()
{
    /**
     * Activate a user (with view)
     */
    Route::get('user/activation/{activationCode}', array(
        'as' => 'getActivate',
        'uses' => 'BackendUserController@getActivate')
    );
});
