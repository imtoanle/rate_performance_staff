<?php

use MrJuliuss\Syntara\Models\Services\ImeiGroup;
use MrJuliuss\Syntara\Models\Services\Imei;
use Validators\Frontend as FrontendValidator;
class OrderController extends BaseController {

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

	public function postOrder()
	{
		//try
    {
    	if(Input::get('typeImeiRadio') == 'multi')
        {
          $validator = new FrontendValidator(Input::all(),'order-create-multi-imei');
          $imeis = Input::get('imei_bulk');
        }
      else
        {
          $validator = new FrontendValidator(Input::all(),'order-create-single-imei');
          $imeis = Input::get('imei1').Input::get('imei2');
        }
      if(!$validator->passes())
      {
        return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors(), 'clearOffset' => true));
      }

      $current_user = Auth::user();
      //validation amount
      $arrImeis = explode("\n", $imeis);
      $selectService = Service::find(Input::get('service_id'));
      $priceAll = $selectService->credit * count($arrImeis);
      if ($priceAll > $current_user->amount)
      {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.service-imei-page.not-enough-amount'), 'messageType' => 'danger'));
      }
      
      //tru tien em no ngay
      $current_user->amount -=  $priceAll;
      $current_user->save();

      // create Orders
      $order = new Order;
      $order->fill(array(
          'client_id'    => $current_user->id,
          'bulk_imei'    => $imeis,
          'comment'    => Input::get('comment'),
          'response_email'    => Input::get('response_email'),
          'service_id'    => Input::get('service_id')
          //mac dinh databse set new record status =1 
          //'status' => '1
      ));

      $order->save();
    }
    //catch(\Exception $e)
    {
        //return Response::json(array('dataStatus' => false, 'message' => trans('all.messages.create-fail'), 'messageType' => 'danger'));
    }

    return json_encode(array('dataStatus' => true, 'redirectUrl' => URL::route('area-client')));
	}

  public function postHistoryOrders()
  {
    if (Request::Ajax())
    {
      $order_by = isset($_POST['order_by_col']) ? 'orders.'.Input::get('order_by_col') : 'orders.id';
      $order_dir = isset($_POST['order_dir']) ? Input::get('order_dir') : 'asc';
      $limit = Input::get('limit');

      $orders = Order::leftJoin('services','orders.service_id','=','services.id')
                ->select(array('orders.id','orders.status','services.name as service_name' ,'orders.bulk_imei','orders.code', 'orders.id as actions'))
                ->where('orders.client_id', '=', Auth::user()->id)
                ->orderBy($order_by, $order_dir)
                ->limit($limit);
      return Datatables::of($orders)
        ->edit_column('status',
          '@if($status == Config::get("variable.order-status.pending"))
          <span class="label label-warning">{{ trans("all.orders-history-page.pending")}}</span>
          @elseif($status == Config::get("variable.order-status.denied"))
          <span class="label label-danger">{{ trans("all.orders-history-page.denied")}}</span>
          @elseif($status == Config::get("variable.order-status.completed"))
          <span class="label label-success">{{ trans("all.orders-history-page.completed")}}</span>
          @endif
            ')
        ->edit_column('bulk_imei',
          '@foreach(explode(" ", $bulk_imei) as $imei)
          {{$imei}} <br>
          @endforeach')
        ->edit_column('actions',
          '<a href="javascript:;" onclick="showLoginLogModal(\'{{route(\'ajax-detail-order\')}}\', \'modal-detail-order\', {{$actions}});" class="btn btn-info btn-sm btn-icon icon-left">
            <i class="entypo-info"></i>
            {{trans(\'all.view\')}}
          </a>')
        ->make();
    }
  }

  public function getHistoryOrders()
  {
    $orderResults = Auth::user()->percent_orders();
    return View::make(Config::get('view.index-orders-history'), array('orderResults' => $orderResults));
  }

}
