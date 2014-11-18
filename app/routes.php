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

    Route::get('notify/{notifyId}', array(
      'as' => 'getNotify',
      'uses' => 'NotifyBackendController@getNotify')
    );  

    Route::get('user/{userId}', array(
      'as' => 'showUser',
      'uses' => 'BackendUserController@getShow')
    );

    Route::put('user/{userId}', array(
        'as' => 'putUser',
        'uses' => 'BackendUserController@putShow')
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

  Route::get('users/search-via-department', array(
      'as' => 'listUsersSearchDepartment',
      'uses' => 'BackendUserController@searchViaDepartment')
  );

  Route::get('users/import', array(
      'as' => 'importUsers',
      'uses' => 'BackendUserController@getImportUser')
  );

  Route::post('users/import', array(
      'as' => 'importUsers',
      'uses' => 'BackendUserController@postImportUser')
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

  Route::get('vote-group/copy/{voteGroupId}', array(
      'as' => 'copyVoteGroup',
      'uses' => 'BackendVoteController@getCopyGroup')
  );
  
  Route::post('vote-group/copy/{voteGroupId}', array(
      'as' => 'postCopyVoteGroup',
      'uses' => 'BackendVoteController@postCopyGroup')
  );

  Route::post('vote/new', array(
      'as' => 'postNewVote',
      'uses' => 'BackendVoteController@postCreate')
  );

  Route::post('vote/unlock', array(
      'as' => 'postUnlockVote',
      'uses' => 'BackendVoteController@postUnlock')
  );

  Route::post('vote/close', array(
      'as' => 'postCloseVote',
      'uses' => 'BackendVoteController@postClose')
  );

  Route::get('vote/{voteId}', array(
      'as' => 'showVote',
      'uses' => 'BackendVoteController@getShow')
  );

  Route::pattern('voteGroupId', '[0-9]+');
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

  Route::put('vote-group/open', array(
      'as' => 'openVoteGroup',
      'uses' => 'BackendVoteController@openGroup')
  );

  Route::put('vote-group/close', array(
      'as' => 'closeVoteGroup',
      'uses' => 'BackendVoteController@closeGroup')
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

  Route::get('user-votes/head-grading', array(
      'as' => 'headGradingUserVote',
      'uses' => 'BackendUserVoteController@getIndexHeadGradingVote')
  );

  Route::post('user-votes/head-grading-quick', array(
      'as' => 'postQuickHeadGradingUserVote',
      'uses' => 'BackendUserVoteController@postQuickDetailHeadGradingVote')
  );

  Route::post('user-votes/quick-vote', array(
      'as' => 'postQuickUserVote',
      'uses' => 'BackendUserVoteController@postQuickVote')
  );

  Route::post('user-votes/quick-multi-vote', array(
      'as' => 'postQuickMultiUserVote',
      'uses' => 'BackendUserVoteController@postQuickMultiVote')
  );

  Route::get('user-votes/view-mark/{voteGroupId}', array(
      'as' => 'viewMyMark',
      'uses' => 'BackendUserVoteController@getViewMyMark')
  );

  Route::get('user-votes/view-vote/{voteGroupId}', array(
      'as' => 'viewMyVote',
      'uses' => 'BackendUserVoteController@getViewMyVote')
  );


  //report route
  Route::get('reports-by-period', array(
      'as' => 'listReportPeriod',
      'uses' => 'VoteReportBackendController@getIndexPeriod')
  );

  Route::get('reports-by-period/vote/{VoteId}', array(
      'as' => 'reportPeriodVote',
      'uses' => 'VoteReportBackendController@getPeriodVote')
  );

  Route::get('reports-by-period/vote-group/{voteGroupId}', array(
      'as' => 'reportPeriodVoteGroup',
      'uses' => 'VoteReportBackendController@getPeriodVoteGroup')
  );


  Route::get('reports-by-year', array(
      'as' => 'listReportYear',
      'uses' => 'VoteReportBackendController@getIndexYear')
  );

  Route::post('reports-by-year', array(
      'as' => 'postReportYear',
      'uses' => 'VoteReportBackendController@postYearVote')
  );

  Route::get('reports/head-grading-detail/{voteId}', array(
    'as' => 'detailHeadGradingUserVote',
    'uses' => 'VoteReportBackendController@getDetailHeadGradingVote')
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


//enable breadcrumb
View::composer([Config::get('view.backend.breadcrumbs'), Config::get('view.backend.header')], function($view)
{
  /*
  $array_disable = array('indexHome');
  $array_dynamic = array('view-blog', 'detail-imei-service');
  if (!in_array(Route::currentRouteName(), $array_disable))
  {
    $view->with('enableBreadcrumb', true);
    if (!in_array(Route::currentRouteName(), $array_dynamic))
      $view->with('dataBreadcrumb', Config::get('breadcrumbs.'.Route::currentRouteName()));
  }
  */
  $menuData = Config::get('breadcrumbs.'.Route::currentRouteName());
  $menuData = isset($menuData) ? $menuData : [];
  $view->with('dataBreadcrumb', $menuData);
});

