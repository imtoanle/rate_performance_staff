<?php

return array(
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
    'listGroups' => 'groups-management',
    'newGroupPost' => 'groups-management',
    'newGroup' => 'groups-management',
    'deleteGroup' => 'groups-management',
    'showGroup' => 'groups-management',
    'putGroup' => 'groups-management',
    'listUsers' => 'view-users-list',
    'importUsers' => 'import-users',
    'users_list' => 'view-users-list',
    'deleteUsers' => 'delete-user',
    'newUser' => 'create-user',
    'newUserPost' => 'create-user',
    'showUser' => 'update-user-info',
    'putUser' => 'update-user-info',
    'putActivateUser' => 'update-user-info',
    'deleteUserGroup' => 'user-group-management',
    'addUserGroup' => 'user-group-management',
    'listPermissions' => 'permissions-management',
    'deletePermission' => 'permissions-management',
    'newPermission' => 'permissions-management',
    'newPermissionPost' => 'permissions-management',
    'showPermission' => 'permissions-management',
    'putPermission' => 'permissions-management',

    'listJobTitles' => 'job-titles-management',
    'newJobTitlePost' => 'job-titles-management',
    'deleteJobTitle' => 'job-titles-management',
    'putJobTitle' => 'job-titles-management',

    //department
    'listDepartments' => 'department-management',
    'newDepartmentPost' => 'department-management',
    'deleteDepartment' => 'department-management',
    'putDepartment' => 'department-management',

    //roles
    'listRoles' => 'role-management',
    'newRolePost' => 'role-management',
    'deleteRole' => 'role-management',
    'putRole' => 'role-management',

    //roles
    'listCriterias' => 'criteria-management',
    'newCriteriaPost' => 'criteria-management',
    'deleteCriteria' => 'criteria-management',
    'putCriteria' => 'criteria-management',
    
    //votes
    'listVotes' => 'votes-management',
    'newVote' => 'votes-management',
    'postNewVote' => 'votes-management',
    'postUnlockVote' => 'votes-management',
    'postCloseVote' => 'votes-management',
    'putVote' => 'votes-management',
    'putVoteGroup' => 'votes-management',
    'copyVoteGroup' => 'votes-management',
    'postCopyVoteGroup' => 'votes-management',
    'deleteVote' => 'votes-management',
    'deleteVoteGroup' => 'votes-management',
    'showVote' => 'votes-management',
    'showVoteGroup' => 'votes-management',
    'listUsersSearch' => 'votes-management',
    'listUsersSearchJob' => 'votes-management',
    'listUsersSearchDepartment' => 'votes-management',
    'listPersionsVote' => 'votes-management',
    //user-vote
    'listUserVotes' => 'user-votes-management',
    'quickUserVote' => 'user-votes-management',
    'postQuickUserVote' => 'user-votes-management',
    'postQuickMultiUserVote' => 'user-votes-management',
    'headGradingUserVote' => 'user-votes-management',
    'detailHeadGradingUserVote' => 'user-votes-management',
    'postQuickHeadGradingUserVote' => 'user-votes-management',
    'viewMyMark' => 'user-votes-management',
    'viewMyVote' => 'user-votes-management',

    //reports
    'listReportPeriod' => 'vote-reports-manager',
    'reportPeriodVote' => 'vote-reports-manager',
    'reportPeriodVoteGroup' => 'vote-reports-manager',

    'listReportYear' => 'vote-reports-manager',
    'postReportYear' => 'vote-reports-manager',
    'reportYearVote' => 'vote-reports-manager',
    'reportYearVoteGroup' => 'vote-reports-manager',

    //notify
    'getNotify' => 'notify-view',
  ),

);
