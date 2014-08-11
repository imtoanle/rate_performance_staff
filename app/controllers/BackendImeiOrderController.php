<?php

use Validators\Backend as BackendValidator;
class BackendImeiOrderController extends BackendBaseController
{
    public function getIndex()
    {
        return View::make(Config::get('view.backend.order.imei.index'));
    }

    public function getQuickAccept()
    {
      if(Request::Ajax())
      {
        $order_by = Input::get('order_by_col', 'orders.id');
        $order_dir = Input::get('order_dir', 'desc');
        $limit = Input::get('limit');
        $orders = Order::leftJoin("services", 'orders.service_id', '=', 'services.id')
                  ->select(array('orders.id as checkbox','orders.id', 'services.name', 'orders.created_at', 'orders.bulk_imei'))
                  ->where('orders.status', Config::get('variable.order-status.pending'))
                  //->where('services.api_id', 0)
                  ->orderBy($order_by, $order_dir)
                  ->limit($limit);
        return Datatables::of($orders)
          ->edit_column('checkbox', 
              '<div class="checkbox checkbox-replace neon-cb-replacement">
                <label class="cb-wrapper">
                  <input type="checkbox" name="arr_check[]" value="{{$checkbox}}">
                  <div class="checked"></div>
                </label>
              </div>')
          ->edit_column('created_at','{{ date("d/m/Y", strtotime($created_at)) }}')
          ->make();
      }  
      return View::make(Config::get('view.backend.order.imei.quick-accept'));
    }

    public function putUpdateQuickAccept()
    {
      try
      {
        Order::whereRaw('id IN ('.Input::get('arr_id', 0).')')->update(array('status' => Config::get('variable.order-status.processing')));
      }
      catch (NotFoundInDatabaseException $e)
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.backend.accept-order-fail'), 'messageType' => 'danger'));
      }

      return Response::json(array('dataStatus' => true, 'message' => trans('all.backend.accept-order-success'), 'messageType' => 'success'));
    }

    public function getServiceAccept()
    {
        return View::make(Config::get('view.backend.order.imei.service-accept'));
    }

    public function getQuickReply()
    {
      if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'orders.id');
          $order_dir = Input::get('order_dir', 'desc');
          $limit = Input::get('limit');
          $orders = Order::leftJoin("services", 'orders.service_id', '=', 'services.id')
                    ->leftJoin("clients", 'orders.client_id', '=', 'clients.id')
                    ->select(array('orders.id', 'services.name', 'orders.created_at', 'services.credit', 'clients.username', 'orders.bulk_imei', 'orders.code as result', 'orders.status'))
                    ->where('orders.status', Config::get('variable.order-status.processing'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($orders)
            ->edit_column('created_at','{{ date("d/m/Y", strtotime($created_at)) }}')
            ->edit_column('result', '<a href="#" data-name="code" data-pk="{{$id}}" data-type="textarea" data-value="{{$result}}" class="editable-click">{{empty($result) ? trans("all.empty") : str_limit($result, 20)}}</a>')
            ->edit_column('status', '<a href="#" data-name="status" data-pk="{{$id}}" data-type="select" data-value="{{$status}}" class="editable-click">{{trans("variable.order-status.".$status)}}</a>')
            ->remove_column('id')
            ->make();
        }

        return View::make(Config::get('view.backend.order.imei.quick-reply'));
    }

    public function putUpdateQuickReply()
    {
      try
      {
        $inputs = Input::all();
        $order = Order::find($inputs['pk']);
        $order->$inputs['name'] = $inputs['value'];
        
        if($inputs['name'] == 'code')
        {
          $order->status = Config::get('variable.order-status.completed');
        }else if ($inputs['name'] == 'status')
        {

        }
        $order->save();
        return 'true';
      }catch(Exception $e)
      {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail')));
      }
    }

    public function getManualReply()
    {
        return View::make(Config::get('view.backend.order.imei.manual-reply'));
    }

    public function getBulkReply()
    {
        return View::make(Config::get('view.backend.order.imei.bulk-reply'));
    }

    public function getVerification()
    {
        return View::make(Config::get('view.backend.order.imei.verification'));
    }

    public function getHistory()
    {
        if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'orders.updated_at');
          $order_dir = Input::get('order_dir', 'desc');
          $limit = Input::get('limit');
          $orders = Order::leftJoin("services", 'orders.service_id', '=', 'services.id')
                    ->leftJoin("clients", 'orders.client_id', '=', 'clients.id')
                    ->select(array('orders.id','orders.created_at', 'services.name','clients.username', 'orders.bulk_imei', 'orders.status as status', 'orders.id as actions'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($orders)
            ->edit_column('created_at','{{ date("d/m/Y", strtotime($created_at)) }}')
            ->edit_column('status', 
                '@if($status == Config::get("variable.order-status.completed"))
                    <div class="label label-success">{{trans("variable.order-status.".$status)}}</div>
                @elseif($status == Config::get("variable.order-status.pending"))
                    <div class="label label-warning">{{trans("variable.order-status.".$status)}}</div>
                @elseif($status == Config::get("variable.order-status.denied"))
                    <div class="label label-danger">{{trans("variable.order-status.".$status)}}</div>
                @elseif($status == Config::get("variable.order-status.processing"))
                    <div class="label label-info">{{trans("variable.order-status.".$status)}}</div>
                @endif')
            ->edit_column('actions',
                '<a href="{{route(\'editHistoryImeiOrders\', $actions)}}" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                {{trans("all.edit")}}
              </a>')
            //->edit_column('service_name', )
          /*
            ->edit_column('inputbox', 
              '<div class="checkbox checkbox-replace neon-cb-replacement">
                <label class="cb-wrapper">
                  <input type="checkbox" name="arr_check[]" value="{{$inputbox}}">
                  <div class="checked"></div>
                </label>
              </div>')
            ->edit_column('active',
              '@if($active)
              <span class="label label-success">{{trans("all.active")}}</span>
              @else
              <span class="label label-danger">{{trans("all.inactive")}}</span>
              @endif')
            ->edit_column('actions',
              '<a href="{{route(\'editImeiServices\', $actions)}}" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                {{trans("all.edit")}}
              </a>
              
              <a data-id="[{{$actions}}]" class="btn btn-danger btn-sm btn-icon icon-left btn-delete">
                <i class="entypo-cancel"></i>
                {{trans("all.delete")}}
              </a>')
              */
            ->make();
        }

        return View::make(Config::get('view.backend.order.imei.history'));
    }



    public function getEditHistory($orderId)
    {

        $order = Order::find($orderId);
        return View::make(Config::get('view.backend.order.imei.history-edit'), array(
          'order' => $order,
          'client' => $order->client,
          'service' => $order->service
          ));
    }

    public function getPendingPayment()
    {
        return View::make(Config::get('view.backend.order.imei.pending-payment'));
    }
}