<?php

return array(
	'master' => 'layouts.master',
	'head' => 'layouts.head',
	'footer-js' => 'layouts.footer-js',
	'header' => 'layouts.header',
	'footer' => 'layouts.footer',
	'breadcrumbs' => '_partials.breadcrumbs',
	'index-services' => 'services.index-services',
	'place-order-imei' => 'services.place-order-imei',
	'place-order-imei-form' => 'services.imei-form',
	'services-nav' => 'services.nav',
	'detail-imei-service' => 'services.detail',
	'index-area-client' => 'area-client.index',
	'login-logs-area-client' => 'area-client.login-logs',
	'index-orders-history' => 'orders-history.index',
	'setting-profile' => 'settings.profile',
	'setting-change-pass' => 'settings.change-pass',
	'setting-change-question' => 'settings.change-question',
	'setting-email-notify' => 'settings.email-notify',
	'setting-nav' => 'settings.nav',
	'setting-security-login' => 'settings.security-login',
	'index-blogs' => 'blog.index',
	'view-blog' => 'blog.view',
	'paypal-result' => 'paypal.result',
	'add-funds-paypal' => 'account.addfund-paypal',
	'add-funds-bank' => 'account.addfund-bank',
	'sign-up' => 'account.sign-up',
	'sign-in' => 'account.sign-in',
	'forgot-pass' => 'account.forgot-pass',
	'view-invoice' => 'invoice.view',
	'index-invoice' => 'invoice.index',
	'index-statement' => 'statement.index',
	'about-us' => 'page.about-us',
	'contact-us' => 'page.contact-us',
	'home' => 'home.index',
	'error-404' => 'error.404',
	'ajax-detail-order' => 'area-client.ajax-detail-order',
	'pagination-lg' => '_partials.pagination-lg',

	'backend' => array(
    // layouts
    'master' => 'backend.layouts.master',
    'master-js' => 'backend.layouts.master-js',
    'header-css' => 'backend.layouts.header-css',
    'footer-js' => 'backend.layouts.footer-js',
    'custom-js' => 'backend.layouts.custom-js',
    'header' => 'backend.layouts.header',


    'chat' => 'backend.layouts.dashboard.chat',
    'left-nav' => 'backend.layouts.left-nav',
    'submenu' => 'backend.layouts.submenu',

    
    // dashboard
    'dashboard-index' => 'backend.dashboard.index',
    'dashboard-index-little' => 'backend.dashboard.index-little',
    'login' => 'backend.dashboard.login',

    // groups
    'groups-index' => 'backend.group.index-group',
    'groups-list' => 'backend.group.list-groups',
    'group-create' => 'backend.group.new-group',
    'users-in-group' => 'backend.group.list-users-group',
    'group-edit' => 'backend.group.show-group',
    
    // permissions
    'permissions-index' => 'backend.permission.index-permission',
    'permissions-list' => 'backend.permission.list-permissions',
    'permission-create' => 'backend.permission.new-permission',
    'permission-edit' => 'backend.permission.show-permission',

    // users
    'users-index' => 'backend.user.index-user',
    'users-list' => 'backend.user.list-users',
    'user-create' => 'backend.user.new-user',
    'user-informations' => 'backend.user.user-informations',
    'user-profile' => 'backend.user.show-user',
    'user-activation' => 'backend.user.activation',

    //votes
    'job-titles-index' => 'backend.job-title.index',
    'job-title-create' => 'backend.job-title.create',
    'job-title-show' => 'backend.job-title.show',

    //votes
    'votes-index' => 'backend.vote.index-vote',
    'vote-create' => 'backend.vote.create-vote',
    'vote-show' => 'backend.vote.show-vote',

    //votes
    'user-votes-index' => 'backend.user-vote.index',





    //dashboards
    'dashboard' => array(
    	'unpaid-invoice' =>  'backend.dashboard.unpaid-invoice',
        'system-summary' =>  'backend.dashboard.system-summary',
        'system-summary-child' =>  'backend.dashboard.system-summary-child',
    	),

    //services
    'services' => array(
    	'imei' => array(
    		'index' => 'backend.service.imei.index',
    		'new' => 'backend.service.imei.new',
    		'quick-edit' => 'backend.service.imei.quick-edit',
    		'list-tr' => 'backend.service.imei.list-tr',
		    'edit' => 'backend.service.imei.edit',
		    'edits' => array(
		    	'overview' => 'backend.service.imei.edit-overview',
		    	'field' => 'backend.service.imei.edit-field',
		    	'api' => 'backend.service.imei.edit-api',
		    	'retail-purchase' => 'backend.service.imei.edit-retail-purchase',
		    	'inventory' => 'backend.service.imei.edit-inventory',
		    	'promotion' => 'backend.service.imei.edit-promotion',
		    	'settings' => 'backend.service.imei.edit-settings',
		    	'subscribed-user' => 'backend.service.imei.edit-subscribed-user',
		    	'discounted-users' => 'backend.service.imei.edit-discounted-users',
		    	'customer-review' => 'backend.service.imei.edit-customer-review',
	    	),
  		),
  	),
    
    
    //invoice

    'invoice-edit' => 'backend.invoice.edit',
    //service group
    'service-group-index' => 'backend.service.group.index',
    'service-group-edit' => 'backend.service.group.edit',
    'service-group-new' => 'backend.service.group.new',

    //supplier
    'supplier-index' => 'backend.supplier.index',
    'supplier-edit' => 'backend.supplier.edit',
    'supplier-new' => 'backend.supplier.new',

    //client
    'client-index' => 'backend.client.index',
    'client-edit' => 'backend.client.edit',
    'client-edits' => array(
    	'overview' => 'backend.client.edit-overview',
    	'financial' => 'backend.client.edit-financial',
    	'profile' => 'backend.client.edit-profile',
    	'api' => 'backend.client.edit-api',
    	'bind-login' => 'backend.client.edit-bind-login',
    	'order' => 'backend.client.edit-order',
    	'set-pricing' => 'backend.client.edit-set-pricing',
    	'invoice' => 'backend.client.edit-invoice',
    	'mail' => 'backend.client.edit-mail',
    	'statement' => 'backend.client.edit-statement',
    	'subscription' => 'backend.client.edit-subscription',
    	'activity-log' => 'backend.client.edit-activity-log	',	
    	),
    'client-update-multi' => 'backend.client.update-multi',
    'client-new' => 'backend.client.new',

    //client-group
    'client-group-index' => 'backend.client-group.index',
    'client-group-edit' => 'backend.client-group.edit',
    'client-group-edit-pricing' => 'backend.client-group.edit-pricing',
    'client-group-edit-pricing-list-tr' => 'backend.client-group.edit-pricing-tr',
    
    'client-group-new' => 'backend.client-group.new',
    'client-group-member' => 'backend.client-group.member',



    //orders
    'order' => array(
    	'imei' => array(
	    	'index' => 'backend.order.imei.index',
	    	'quick-accept' => 'backend.order.imei.quick-accept',
	    	'service-accept' => 'backend.order.imei.service-accept',
	    	'quick-reply' => 'backend.order.imei.quick-reply',
	    	'manual-reply' => 'backend.order.imei.manual-reply',
	    	'bulk-reply' => 'backend.order.imei.bulk-reply',
	    	'verification' => 'backend.order.imei.verification',
	    	'history' => 'backend.order.imei.history',
	    	'history-edit' => 'backend.order.imei.history-edit',
	    	'pending-payment' => 'backend.order.imei.pending-payment',
    	),
  	),


    //settings
    'settings' => array(
        'general' => array(
            'general' => 'backend.setting.general.general'
            ),
    	'api' => array(
    		'index' => 'backend.setting.api.index',
    		'edit' => 'backend.setting.api.edit',
  		),
  	),
    
    
    'error' => 'backend.dashboard.error',

    

    

    
		),

	
	/*
	|--------------------------------------------------------------------------
	| View Storage Paths
	|--------------------------------------------------------------------------
	|
	| Most templating systems load templates from disk. Here you may specify
	| an array of paths that should be checked for your views. Of course
	| the usual Laravel view path has already been registered for you.
	|
	*/

	'paths' => array(__DIR__.'/../views'),

	/*
	|--------------------------------------------------------------------------
	| Pagination View
	|--------------------------------------------------------------------------
	|
	| This view will be used to render the pagination link output, and can
	| be easily customized here to show any view you like. A clean view
	| compatible with Twitter's Bootstrap is given to you by default.
	|
	*/

	'pagination' => 'pagination::slider-3',

);
