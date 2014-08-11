<?php
/**
 * --------------------------------------------------------------------------
 * Paypal-express-checkout
 * --------------------------------------------------------------------------
 *
 * Paypal express chekout, a paypal express checkout bundle for use with the Laravel Framework.
 *
 * @package  Paypal-express-checkout
 * @version  1.1.1
 * @author   Abhishek Kumar <abhitheawesomecoder@gmail.com>
 * @link     https://github.com/abhitheawesomecoder/pec
 */
 
return array(

    'paypalmode' => 'sandbox',   // sandbox or live
    'paypalapiusername' => 'vietnamvisa_seller_api1.gmail.com', //PayPal API Username
    'paypalapipassword' => '1368617034', //Paypal API password
    'paypalapisignature'=>'AxLpWcoOlFt7xzIONRQZMHBAp5eTAO.dvowP9N4LQnLdneRNMfhSBqiu',  //Paypal API Signature
    'paypalcurrencycode'=>'USD',    //Paypal Currency Code
    'paypalreturnurl'=> route('paypal-result'),     //Point to process.php page
    'paypalcancelurl'=>'http://yourwebsite.com/cancel'   //Cancel URL if user clicks cancel
);