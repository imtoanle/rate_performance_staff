<?php

use Validators\Frontend as FrontendValidator;
class AreaClientController extends BaseController {

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
    $orderResults = Auth::user()->percent_orders();
    $latestBlogs = Blog::orderBy('created_at', 'desc')->limit(6)->get();
    $lastLogin = LogIP::where('client_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->first();
    return View::make(Config::get('view.index-area-client'), array(
      'orderResults' => $orderResults, 
      'lastLogin' => $lastLogin,
      'latestBlogs' => $latestBlogs));
  }

  public function postLoginLogs()
  {
    if(Request::Ajax())
    {
      $loginLogs = LogIP::orderBy('created_at', 'desc')->limit(20)->get();
      return View::make(Config::get('view.login-logs-area-client'), array('loginLogs' => $loginLogs))->render();
    }
  }

  public function postAjaxDetailOrder()
  {
    if(Request::Ajax())
    {
      $order = Order::leftJoin('services','orders.service_id','=','services.id')
                ->select(array('orders.id', 'orders.client_id','services.name as service_name' ,'orders.bulk_imei','orders.code', 'orders.created_at', 'orders.updated_at','services.credit'))
                ->where('orders.id', '=', Input::get('orderId'))->first();
      if (Auth::user()->id != $order->client_id) throw new NotOwnerException;
      return View::make(Config::get('view.ajax-detail-order'), array('order' => $order))->render();
    }
  }

  public function editProfile()
  {
  	//Xu ly post
  	if(Request::Ajax())
  	{
      $validator = new FrontendValidator(Input::all(),'update-profile');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors(), 'messageType' => 'danger'));
      }
      
      // update profile
      $user = Client::find(Auth::user()->id);
      $user->fill(array(
      		'phone' => Input::get('phone'),
          'name'    => Input::get('full_name'),
          'address'    => Input::get('address'),
          'city'    => Input::get('city'),
          'state'    => Input::get('state'),
          'zip_code'    => Input::get('zip_code'),
          'country'    => Input::get('country'),
          'language' => Input::get('language')
      ));

      if ($user->save())
      {
      	return json_encode(array('dataStatus' => true, 'redirectUrl' => 'self'));
      }
      else
      {
      	return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
      }
  	}
  	//Xu ly get
  	return View::make(Config::get('view.setting-profile'));
  }

  public function editPassword()
  {
  	return View::make(Config::get('view.setting-change-pass'));
  }

  public function editQuestion()
  {
  	if (Request::Ajax())
  	{
  		$validator = new FrontendValidator(Input::all(),'change-question');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors(), 'messageType' => 'danger'));
      }
      $user = Client::find(Auth::user()->id);
      if(Input::get('current_answer') == $user->security_answer)
      {
      	$user->fill(array(
      		'security_question' => Input::get('new_question'),
          'security_answer'    => Input::get('new_answer')
	      ));

	      if ($user->save())
	      {
	      	return json_encode(array('dataStatus' => true, 'redirectUrl' => 'self'));
	      }
      	return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
      }
      return Response::json(array('dataStatus' => false, 'errorMessages' => array('current_answer' => array(trans('all.current-question'))), 'messageType' => 'danger'));

      
  	}
  	return View::make(Config::get('view.setting-change-question'));
  }

  public function editEmailNotify()
  {
  	return View::make(Config::get('view.setting-email-notify'));
  }

  public function editSecurityLogin()
  {
    $user = Client::find(Auth::user()->id);
    if(Request::Ajax())
    {
      $user->fill(array(
        'security_login' => Input::get('access_ip')
      ));

      if ($user->save())
      {
        return json_encode(array('dataStatus' => true, 'redirectUrl' => 'self'));
      }
      return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
    }

  	return View::make(Config::get('view.setting-security-login'), array('access_ip' => $user->security_login));
  }

  public function getAddFundsPaypal()
  {
    return View::make(Config::get('view.add-funds-paypal'));
  }

  public function postCreateInvoice()
  {
    $ItemName = trans('all.invoice-page.add-fund-to-account'); //Item Name
    $ItemPrice = Input::get('amount_add');  //Item Price
    $ItemNumber = 1;  //Item Number
    $ItemQty = 1;  // Item Quantity
    $ItemTransactionTax = number_format($ItemPrice*Config::get('variable.transaction_tax')/100, 2);
    $ItemTotalPrice = number_format($ItemPrice+$ItemTransactionTax, 2); //(Item Price x Quantity = Total) Get total amount of product; 

    $invoice = Invoice::create(array(
      'client_id' => Auth::user()->id,
      'item_name' => $ItemName,
      'item_price' => $ItemPrice,
      'item_number' => $ItemNumber,
      'item_qlt' => $ItemQty,
      'transaction_tax' => $ItemTransactionTax,
      'total_price' => $ItemTotalPrice
      ));

    return Redirect::route('view-invoice', array($invoice->id));
  }

  public function getViewInvoice($invoiceId)
  {
    $invoice = Invoice::find($invoiceId);
    $client = Client::find($invoice->client_id);
    if (Auth::user()->id != $client->id) throw new NotOwnerException;
    
    return View::make(Config::get('view.view-invoice'), array('invoice' => $invoice, 'client' => $client));
  }

  public function getMyInvoice()
  {
    return View::make(Config::get('view.index-invoice'));
  }

  public function postMyInvoice()
  {
    if (Request::Ajax())
    {
      $order_by = Input::get('order_by_col', 'id');
      $order_dir = Input::get('order_dir', 'asc');
      $status = Input::get('invoice_status', Config::get('variable.invoice-status.unpaid'));
      $limit = Input::get('limit');

      $orders = Invoice::select(array('id','created_at','created_at as due_date','paid_at' ,'total_price','status', 'id as actions'))
                ->where('client_id', '=', Auth::user()->id)
                ->where('status', '=', $status)
                ->orderBy($order_by, $order_dir)
                ->limit($limit);
      return Datatables::of($orders)
        ->edit_column('paid_at', 
          '@if($paid_at != "0000-00-00 00:00:00")
          {{ date("d/m/Y", strtotime($paid_at)) }}
          @else
          ---
          @endif')
        ->edit_column('created_at', '{{ date("d/m/Y", strtotime($created_at)) }}')
        ->edit_column('due_date', '{{ date("d/m/Y", strtotime("+1day".$due_date)) }}')
        ->edit_column('status',
          '@if($status == Config::get("variable.invoice-status.unpaid"))
          <span class="label label-danger">{{ trans("all.unpaid")}}</span>
          @elseif($status == Config::get("variable.invoice-status.paid"))
          <span class="label label-success">{{ trans("all.paid")}}</span>
          @endif
            ')
        ->edit_column('actions',
          '<a href="{{route(\'view-invoice\', $actions)}}" data-original-title="{{trans(\'all.view-detail\')}}" rel="tooltip"><i class="icon icon-bars"></i></a>')
        ->make();
    }
  }

  public function getMyStatement()
  {
    return View::make(Config::get('view.index-statement'));
  }

  public function postMyStatement()
  {
    if (Request::Ajax())
    {
      $order_by = Input::get('order_by_col', 'id');
      $order_dir = Input::get('order_dir', 'asc');
      $limit = Input::get('limit');

      $statements = Statement::select(array('created_at','desc','type' ,'amount','balance', 'sid'))
                ->where('client_id', '=', Auth::user()->id)
                ->orderBy($order_by, $order_dir)
                ->limit($limit);
      return Datatables::of($statements)
        ->edit_column('created_at', '{{ date("d/m/Y", strtotime($created_at)) }}')
        ->edit_column('sid', 
          '@if($type == Config::get("variable.statement-type.addFund"))
          <a href="{{route(\'view-invoice\', $sid)}}">{{$sid}}</a>
          @elseif($type == Config::get("variable.statement-type.reFund"))
          refund
          @elseif($type == Config::get("variable.statement-type.placeOrder"))
          <a href="#">{{$sid}}</a>
          @endif')
        ->edit_column('type', 
          '@if($type == Config::get("variable.statement-type.addFund"))
          <span class="label label-success">{{trans("all.statement-page.add-amount")}}</span>
          @elseif($type == Config::get("variable.statement-type.reFund"))
          <span class="label label-success">{{trans("all.statement-page.add-amount")}}</span>
          @elseif($type == Config::get("variable.statement-type.placeOrder"))
          <span class="label label-success">{{trans("all.statement-page.subtract-amount")}}</span>
          @endif')
        
        
        ->make();
    }
  }
  

}
