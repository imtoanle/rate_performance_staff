<?php

return array(
    'vote-status' => array(
      'newly' => 0,
      'opened' => 1,
      'closed' => 2,
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
    
    //votes
    'listVotes' => 'votes-management',
    'newVote' => 'votes-management',
    'postNewVote' => 'votes-management',
    'putVote' => 'votes-management',
    'deleteVote' => 'votes-management',
    'showVote' => 'votes-management',
    'listUsersSearch' => 'votes-management',
    //user-vote
    'listUserVotes' => 'user-votes-management',
    
    
    //servives
    'indexImeiServices' => 'imei-service-management',
    'quickEditImeiServices' => 'imei-service-management',
    'updateQuickEditImeiServices' => 'imei-service-management',
    'editImeiServices' => 'imei-service-management',

    //little edit
    'editImeiServiceApi'=> 'imei-service-management',
    'updateApiImeiServices'=> 'imei-service-management',
    'editImeiServicePromotion'=> 'imei-service-management',
    'editImeiServiceSettings'=> 'imei-service-management',
    'editImeiServiceDiscountedUsers'=> 'imei-service-management',
    'editImeiServiceCustomerReview'=> 'imei-service-management',

    'updateImeiServices' => 'imei-service-management',
    'newImeiServices' => 'imei-service-management',
    'createImeiServices' => 'imei-service-management',
    'deleteServices' => 'imei-service-management',

    'indexImeiServiceGroups' => 'imei-service-management',
    'editImeiServiceGroups' => 'imei-service-management',
    'updateImeiServiceGroup' => 'imei-service-management',
    'newImeiServiceGroup'  => 'imei-service-management',
    'createImeiServiceGroup' => 'imei-service-management', 
    'deleteImeiServiceGroup' => 'imei-service-management', 
    
    //supplier
    'indexSupplier' => 'supplier-management',
    'editSupplier' => 'supplier-management',
    'updateSupplier' => 'supplier-management',
    'newSupplier' => 'supplier-management',
    'createSupplier' => 'supplier-management',
    'deleteSupplier' => 'supplier-management',

    //client
    'indexClient' => 'client-management',
    'editClient' => 'client-management',
    'editClientResetPass' => 'client-management',
    'editClientFinancial' => 'client-management',
    'addCreditClientFinancial' => 'client-management',
    'rebateCreditClientFinancial' => 'client-management',
    'editClientProfile' => 'client-management',
    'updateClientProfile' => 'client-management',
    'editClientApi' => 'client-management',
    'editClientBindLogin' => 'client-management',
    'updateClientBindLogin' => 'client-management',
    'editClientSetPricing' => 'client-management',
    'editClientOrder' => 'client-management',
    'editClientInvoice' => 'client-management',
    'editClientMail' => 'client-management',
    'editClientStatement' => 'client-management',
    'editClientSubscription' => 'client-management',
    'editClientActivityLog' => 'client-management',
    'updateClient' => 'client-management',
    'updateMultiClient' => 'client-management',
    'newClient' => 'client-management',
    'createClient' => 'client-management',
    'deleteClient' => 'client-management',
    'indexClientInvoices' => 'client-management',
    'deleteClientInvoices' => 'client-management',
    'indexClientStatements' => 'client-management',
    'deleteClientStatements' => 'client-management',
    
    //invoice
    'editInvoice' => 'invoice-management',
    'updateInvoice' => 'invoice-management',

    //clientgroup
    'indexClientGroup' => 'client-group-management',
    'memberClientGroup' => 'client-group-management',
    'editClientGroup' => 'client-group-management',
    'updateClientGroup' => 'client-group-management',
    'newClientGroup' => 'client-group-management',
    'createClientGroup' => 'client-group-management',
    'deleteClientGroup' => 'client-group-management',
    'editClientGroupPricing' => 'client-group-management',
    'updateClientGroupPricing' => 'client-group-management',

    //order
    'indexImeiOrders' => 'order-management',
    'quickAcceptImeiOrders' => 'order-management',
    'updateQuickAcceptImeiOrders' => 'order-management',
    'serviceAcceptImeiOrders' => 'order-management',
    'quickReplyImeiOrders' => 'order-management',
    'bulkReplyImeiOrders' => 'order-management',
    'verificationImeiOrders' => 'order-management',
    'historyImeiOrders' => 'order-management',
    'editHistoryImeiOrders' => 'order-management',
    'pendingPaymentImeiOrders' => 'order-management',
    'manualReplyImeiOrders' => 'order-management',

    //settings
    'generalSetting' => 'setting-management',

    'apiSetting' => 'setting-management',
    'editApiSetting' => 'setting-management',
    'updateApiSetting'  => 'setting-management',
    'updateSynApiSetting' => 'setting-management',


    'newImeiServices' => 'create-imei-service',
    'showImeiServices' => 'show-imei-service',
    'deleteImeiServices' => 'delete-imei-service',
    'listImeiServiceGroup' => 'ime-service-group-management',
    'ImeiServiceGroupNew' => 'ime-service-group-new-management',
    'ImeiServiceGroupShow' => 'ime-service-group-new-management',
    'deleteServiceGroup' => 'ime-service-group-delete-management'
  ),

);
