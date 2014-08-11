<?php 

return array(
    'imei-service' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.services'), route('imei-service')),
        array(trans('all.service-imei'))
    ),
    'file-service' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.services'), route('imei-service')),
        array(trans('all.service-file'))
    ),
    'server-service' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.services'), route('imei-service')),
        array(trans('all.service-server'))
    ),
    'sign-in' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.sign-in'))
    ),
    'sign-up' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.sign-up'))
    ),
    'add-fund-bank' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.add-fund-page.via-bank'))
    ),
    'area-client' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'))
    ),
    'orders-history' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.history-order'))
    ),
    'place-order-imei' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.place-order-imei'))
    ),
    'place-order-imei' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.place-order-imei'))
    ),
    'add-fund-paypal' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.add-fund-page.via-paypal'))
    ),
    'setting-profile' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.personal-info'))
    ),
    'setting-change-pass' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.change-pass'))
    ),
    'setting-change-question' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.change-question'))
    ),
    'setting-email-notify' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.email-notify'))
    ),
    'setting-security-login' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.security-login'))
    ),
    'my-invoice' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.invoice'))
    ),
    'view-invoice' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.invoice'), route('my-invoice')),
        array(trans('all.invoice-detail'))
        
    ),
    'my-statement' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.client-area'), route('area-client')),
        array(trans('all.settings.statement'))
    ),
    'contact-us' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.contact'))
    ),
    'about-us' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.about-us'))
    ),
    'index-blog' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.blog'))
    ),
    'error-404' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.error-404'))
    ),
    'index-blog' => array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.blog'))
    ),
    
    
);

