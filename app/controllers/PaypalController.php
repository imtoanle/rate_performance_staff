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

class PaypalController extends Controller{
    
  public $restful = true;
  
  public function get_index()
  {
		$token = Input::get('token');
		$playerid = Input::get('PayerID'); 
		$report = array();
    if(isset($token)&&isset($playerid))
    {
			//get session variables
			$ItemPrice 		= Session::get('itemprice');
			$ItemTotalPrice = Session::get('totalamount');
			$ItemName 		= Session::get('itemName');
			$ItemQTY 		= Session::get('itemQTY');

      $PayPalCurrencyCode = Config::get('paypal.paypalcurrencycode');
      $PayPalReturnURL = Config::get('paypal.paypalreturnurl');
      $PayPalCancelURL = Config::get('paypal.paypalcancelurl');
      $PayPalApiUsername = Config::get('paypal.paypalapiusername');
      $PayPalApiPassword = Config::get('paypal.paypalapipassword');
      $PayPalApiSignature = Config::get('paypal.paypalapisignature');
      $PayPalMode = Config::get('paypal.paypalmode');

			$padata = '&TOKEN='.urlencode($token).
								'&PAYERID='.urlencode($playerid).
								'&PAYMENTACTION='.urlencode("SALE").
								'&AMT='.urlencode($ItemTotalPrice).
								'&CURRENCYCODE='.urlencode($PayPalCurrencyCode);

			//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
			$paypal = new Paypal();
			$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
			
			//Check if everything went ok..
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"])) 
			{
				/*
				//Sometimes Payment are kept pending even when transaction is complete. 
				//May be because of Currency change, or user choose to review each payment etc.
				//hence we need to notify user about it and ask him manually approve the transiction
				*/
				
				if('Completed' == $httpParsedResponseAr["PAYMENTSTATUS"])
				{
					//Cong tien cho user
					$arrInvoice = explode('#', $ItemName);
					$invoice = Invoice::find($arrInvoice[1]);
					$client = Client::find($invoice->client_id);
					$client->amount += $ItemPrice;
					$client->save();
					//update invoice to paid
					$invoice->status = Config::get('variable.invoice-status.paid');
					$invoice->paid_at = date("Y-m-d H:i:s");
					$invoice->save();
					//insert to statement
					$statement = Statement::create(array(
						'client_id' => $client->id,
						'desc' => trans('all.statement-page.add-fund-paypal-desc'),
						'type' => Config::get('variable.statement-type.addFund'),
						'amount' => $ItemPrice,
						'balance' => $client->amount,
						'sid' => $invoice->id
						));

					$report = array('type' => 'success', 'message' => trans('all.payment-result.success-complete'));
				}
				elseif('Pending' == $httpParsedResponseAr["PAYMENTSTATUS"])
				{
					$report = array('type' => 'warning', 'message' => trans('all.payment-result.success-pending'));
				}
				
				//Luu thong tin payment
				$payment = Payment::create(array(
					'invoice_id' => $invoice->id,
					'transaction_id' => $httpParsedResponseAr["TRANSACTIONID"],
					'payer_id' => $playerid,
					'token' => $token,
					'payment_type' => Config::get('variable.payment-type.paypal'),
					'status' => Config::get('variable.payment-status.complete'),
				));
			} else {
				$report = array('type' => 'danger', 'message' => trans('all.error').': '.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]));
			}

			return View::make(Config::get('view.paypal-result'), array('report' => $report));
    }
    return Redirect::route('indexHome');
    
  }

  	
    public function post_index()
    {
		  $ItemName = 'Invoice #'.Input::get('invoice_id');
			$ItemPrice = Input::get('item_price');  //Item Price
			$ItemQty = 1;  // Item Quantity
			$transactionTax = number_format($ItemPrice*5/100, 2);
			$ItemTotalPrice = number_format($transactionTax + $ItemPrice, 2); //(Item Price x Quantity = Total) Get total amount of product; 

        $PayPalCurrencyCode = Config::get('paypal.paypalcurrencycode');
        $PayPalReturnURL = Config::get('paypal.paypalreturnurl');
        $PayPalCancelURL = Config::get('paypal.paypalcancelurl');
        $PayPalApiUsername = Config::get('paypal.paypalapiusername');
        $PayPalApiPassword = Config::get('paypal.paypalapipassword');
        $PayPalApiSignature = Config::get('paypal.paypalapisignature');
        $PayPalMode = Config::get('paypal.paypalmode');
	//Data to be sent to paypal
	$padata = 	'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode('Sale').
							'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
							//'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode('623083').
							'&L_PAYMENTREQUEST_0_DESC0='.urlencode('Add fund to account').
							'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
							'&L_PAYMENTREQUEST_0_QTY0='.urlencode($ItemQty).
							'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemPrice).
							'&PAYMENTREQUEST_0_TAXAMT='.urlencode($transactionTax).
							//'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode('3.00').
							//'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode('2.99').
							//'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode('-3.00').
							//'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode('1.00').
							'&PAYMENTREQUEST_0_AMT='.urlencode($ItemTotalPrice).
							'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
							'&ALLOWNOTE='.urlencode('1').
				'&RETURNURL='.urlencode($PayPalReturnURL ).
				'&CANCELURL='.urlencode($PayPalCancelURL);	
		
		//We need to execute the "SetExpressCheckOut" method to obtain paypal token
		$paypal= new Paypal();
		$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
		
		//Respond according to message we receive from Paypal
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
		{
				
				// If successful set some session variable we need later when user is redirected back to page from paypal. 
				Session::put('itemprice', $ItemPrice);
				Session::put('totalamount', $ItemTotalPrice);
				Session::put('itemName', $ItemName);
				Session::put('itemQTY', $ItemQty);
				
				if($PayPalMode=='sandbox')
				{	
					$paypalmode 	=	'.sandbox';
				}
				else
				{
					$paypalmode 	=	'';
				}
				//Redirect user to PayPal store with Token received.
			 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
				//header('Location: '.$paypalurl);
                                return Redirect::to($paypalurl);
                                var_dump($paypalurl);
			
		}else{
			//Show error message
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			print_r($httpParsedResponseAr);
			echo '</pre>';
		}
        
    }
    
    
    
    
}