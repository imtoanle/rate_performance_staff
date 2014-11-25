<?php

return array(
    'type-of-person' => array(
      'voter' => 1,
      'view-report' => 2,
      'head-grading' => 3,
        ),

    'vote-status' => array(
      'newly' => 0,
      'opened' => 1,
      'closed' => 2,
        ),

    'head-department-role-id' => 2,

    'breadcrumbs' => array(
        'listVotes' => trans('all.votes'),  
        'listUserVotes' => trans('all.vote-manage'),  
        'listRoles' => trans('all.role'),  
        'quickUserVote' => '',  
        'listCriterias' => '',
        ),

    'order-status' => array(
    	'pending' => 1,
    	'denied' => 2,
    	'completed' => 3,
        'processing' => 4
    	),
    'client-status' => array(
        'active' => 1,
        'inactive' => 0
        ),
    'payment-type' => array(
    	'paypal' => 1,
    	'bank-offline' => 2
    	),
    'payment-status' => array(
    	'pending' => 1,
    	'complete' => 2
    	),
    'invoice-status' => array(
        'unpaid' => 1,
        'paid' => 2,
        'cancel' => 3
        ),
    'invoice-created-status' => array(
        'user' => 0,
        'admin' => 1),
    'languages' => array(
    	'vn' => 'vi',
    	'us' => 'en',
    	),
    'currency' => array(
        'usd' => 'USD',
        'eur' => 'EUR',
        'gbp' => 'GBP',
        ),
    'type-service' => array(
        'Database' => 1,
        'Calculator' => 2,
        ),
    'feedback-type' => array(
        'FeedBack' => 1,
        'Contact' => 2,
        ),
    'client-group' => array(
        'client' => 1,
        'reseller' => 2,
        ),
    'statement-type' => array(
        'addFund' => 1,
        'reFund' => 2,
        'placeOrder' => 3,
        ),
    'service-group-type' => array(
        'IMEI' => 1,
        'FILE' => 2,
        'SERVER' => 3,
        ),
    'transaction_tax' => 5,
    'backend' => array(
        'uri-config' => '',
        'sub-menus' => array(
            'service' => array(
                array(trans('all.overview'), 'editImeiServices'),
                array('Api','editImeiServiceApi'),
                array('Service Promotion','editImeiServicePromotion'),
                array('Settings','editImeiServiceSettings'),
                array('DiscountedUsers','editImeiServiceDiscountedUsers'),
                array('Customer Review','editImeiServiceCustomerReview'),
                ),
            'client' => array(
                array(trans('all.overview'), 'editClient'),
                array(trans('all.amount'),'editClientFinancial' ),
                array(trans('all.backend.edit-profile'),'editClientProfile' ),
                array('API','editClientApi' ),
                array(trans('all.bind-login'),'editClientBindLogin' ),
                array('Set Pricing','editClientSetPricing' ),
                array(trans('all.order'),'editClientOrder' ),
                array(trans('all.settings.invoice'),'editClientInvoice' ),
                array('Mail','editClientMail' ),
                array(trans('all.settings.statement'),'editClientStatement' ),
                array('Subscription','editClientSubscription' ),
                array('Activity Log','editClientActivityLog' ),
                ),
            'order' => array(
                array('Qick Accept', 'quickAcceptImeiOrders'),
                array('Service wise Accept','serviceAcceptImeiOrders' ),
                array('Quick Reply','quickReplyImeiOrders' ),
                array('Manual Reply','manualReplyImeiOrders' ),
                array('Bulk Reply','bulkReplyImeiOrders' ),
                array('Verification','verificationImeiOrders' ),
                array('History','historyImeiOrders' ),
                array('Pending Payment','pendingPaymentImeiOrders' ),
                ),
            ),
        ),
  'permissions' => array(
    'listGroups' => 'groups-management_list',
    'newGroupPost' => 'groups-management_create',
    'newGroup' => 'groups-management_create',
    'deleteGroup' => 'groups-management_delete',
    'showGroup' => 'groups-management_edit',
    'putGroup' => 'groups-management_edit',

    //users
    'listUsers' => 'users-management_list',
    'importUsers' => 'users-management_import',
    
    'deleteUsers' => 'users-management_delete',
    'newUser' => 'users-management_create',
    'newUserPost' => 'users-management_create',
    'showUser' => 'users-management_edit',
    'putUser' => 'users-management_edit',
    'putActivateUser' => 'users-management_edit',
    'addUserGroup' => 'users-management_edit',
    'deleteUserGroup' => 'users-management_delete',
    

    //permission
    'listPermissions' => 'permissions-management_list',
    'deletePermission' => 'permissions-management_delete',
    'newPermission' => 'permissions-management_create',
    'newPermissionPost' => 'permissions-management_create',
    'showPermission' => 'permissions-management_edit',
    'putPermission' => 'permissions-management_edit',

    //job title
    'listJobTitles' => 'job-titles-management_list',
    'newJobTitlePost' => 'job-titles-management_create',
    'deleteJobTitle' => 'job-titles-management_delete',
    'putJobTitle' => 'job-titles-management_edit',

    //department
    'listDepartments' => 'department-management_list',
    'newDepartmentPost' => 'department-management_create',
    'deleteDepartment' => 'department-management_delete',
    'putDepartment' => 'department-management_edit',

    //roles
    'listRoles' => 'role-management_list',
    'newRolePost' => 'role-management_create',
    'deleteRole' => 'role-management_delete',
    'putRole' => 'role-management_edit',

    //roles
    'listCriterias' => 'criteria-management_list',
    'newCriteriaPost' => 'criteria-management_create',
    'deleteCriteria' => 'criteria-management_delete',
    'putCriteria' => 'criteria-management_edit',
    
    //votes
    'listVotes' => 'votes-management_list',
    'newVote' => 'votes-management_create',
    'postNewVote' => 'votes-management_create',
    'openVoteGroup' => 'votes-management_open',
    'postUnlockVote' => 'votes-management_open',
    'postCloseVote' => 'votes-management_close',
    'closeVoteGroup' => 'votes-management_close',
    'putVote' => 'votes-management_edit',
    'putVoteGroup' => 'votes-management_edit',
    'copyVoteGroup' => 'votes-management_edit',
    'postCopyVoteGroup' => 'votes-management_edit',
    'deleteVote' => 'votes-management_delete',
    'deleteVoteGroup' => 'votes-management_delete',
    'showVote' => 'votes-management_edit',
    'showVoteGroup' => 'votes-management_edit',
    'listUsersSearch' => 'votes-management_edit',
    'listUsersSearchJob' => 'votes-management_edit',
    'listUsersSearchDepartment' => 'votes-management_edit',
    'listPersionsVote' => 'votes-management_edit',

    //user-vote
    'listUserVotes' => 'user-votes-management_list',
    'resultSpecifyUserVotes' => 'user-votes-management_list',
    'quickUserVote' => 'user-votes-management_quick',
    'postQuickUserVote' => 'user-votes-management_quick',
    'postQuickMultiUserVote' => 'user-votes-management_quick',
    'headGradingUserVote' => 'user-votes-management_head-grading',
    'detailHeadGradingUserVote' => 'user-votes-management_head-grading',
    'postQuickHeadGradingUserVote' => 'user-votes-management_head-grading',
    'viewMyMark' => 'user-votes-management_list',
    'viewMyVote' => 'user-votes-management_list',

    //reports
    'listReportPeriod' => 'reports-management_period',
    'reportPeriodVote' => 'reports-management_period-vote',
    'reportPeriodVoteGroup' => 'reports-management_period',

    'listReportYear' => 'reports-management_year',
    'postReportYear' => 'reports-management_year',
    'reportYearVote' => 'reports-management_year',
    'reportYearVoteGroup' => 'reports-management_year',

    'listReportSpecifyUser' => 'reports-management_specify-user',
    //export excel
    'exportExcelReport' => 'reports-management_export-excel'
  ),

);
