<?php

use Validators\Backend as BackendValidator;
use Carbon\Carbon;
class BackendClientController extends BackendBaseController
{
    public function getIndex()
    {
        return View::make(Config::get('view.backend.client-index'));
    }

    public function getAjaxIndex()
    {
        if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'id');
          $order_dir = Input::get('order_dir', 'asc');
          $limit = Input::get('limit');

          $client = Client::select(array('id as inputbox', 'id','username', 'email', 'amount', 'active', 'id as actions'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($client)
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
              '<a href="{{route(\'editClient\', $actions)}}" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                {{trans("all.edit")}}
              </a>
              
              <a data-id="[{{$actions}}]" class="btn btn-danger btn-sm btn-icon icon-left btn-delete">
                <i class="entypo-cancel"></i>
                {{trans("all.delete")}}
              </a>')
            ->make();
        }
    }

    public function getEdit($clientId)
    {
      /*
      switch (Route::currentRouteName()) {
        case 'editClientOverview':
          $view_name = 'client-edits.overview';
          break;
        case 'editClientFinancial':
          $view_name = 'client-edits.financial';
          break;
        case 'editClientProfile':
          $paramArr['clientGroups'] = ClientGroup::all();
          $view_name = 'client-edits.profile';
          break;
        case 'editClientApi':
          $view_name = 'client-edits.api';
          break;
        case 'editClientBindLogin':
          $view_name = 'client-edits.bind-login';
          break;
        case 'editClientSetPricing':
          $view_name = 'client-edits.set-pricing';
          break;
        case 'editClientOrder':
          $view_name = 'client-edits.order';
          break;
        case 'editClientInvoiceAdmin':
          $view_name = 'client-edits.invoice-admin';
          break;
        case 'editClientMail':
          $view_name = 'client-edits.mail';
          break;
        case 'editClientStatement':
          $view_name = 'client-edits.statement';
          break;
        case 'editClientSubscription':
          $view_name = 'client-edits.subscription';
          break;
        case 'editClientActivityLog':
          $view_name = 'client-edits.activity-log';
          break;
        
        default:
          
          break;
      }*/
      
      
      $paramArr['client'] = Client::find($clientId);
      $paramArr['lockedAmount'] = Order::where('client_id', $clientId)->whereRaw('status = ? or status = ?', array(Config::get('variable.order-status.processing'), Config::get('variable.order-status.pending')))->sum('amount');
      $paramArr['paidInvoice'] = Invoice::where('client_id', $clientId)->where('status', Config::get('variable.invoice-status.paid'))->sum('total_price');
      //create chart data
      $thisYear = array(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
      $orderSummary = Order::select(DB::raw('service_group_id, MONTH(created_at) as month, count(*) as total'))->where('client_id', $clientId)->whereBetween('created_at', $thisYear)->groupBy('service_group_id')->get();
      $arrOrderSummary = array_fill(1, 12, array_fill(1, 3, 0));
      foreach ($orderSummary as $value) {
        $arrOrderSummary[$value->month][$value->service_group_id] = $value->total;
      }
      $paramArr['chartOrderSummary'] = $arrOrderSummary;

      //top used service
      $topUsedService = Order::select(DB::raw('service_id, count(*) as total'))->where('client_id', $clientId)->groupBy('service_id')->orderBy('total', 'desc')->get();
      $arrTopUsedServier = array();
      foreach ($topUsedService as $value)  {
        $service = Service::find($value->service_id);

        $arrTopUsedServier[] = array(
          'service_name' => $service->name,
          'total' => $value->total,
          );
      }
      $paramArr['topUsedService'] = $arrTopUsedServier;

      //invoice billing
      $invoiceBilling = Invoice::select(DB::raw('admin_created, status, count(*) as total, sum(total_price) as sum_price'))->where('client_id', $clientId)->groupBy(DB::raw('admin_created, status'))->get();
      $arrInvoiceBilling = array_fill(0, 2, array_fill(1, 3, array('total' => 0, 'sum_price' => 0)));
      foreach ($invoiceBilling as $value) {
        $arrInvoiceBilling[$value->admin_created][$value->status]['total'] = $value->total;
        $arrInvoiceBilling[$value->admin_created][$value->status]['sum_price'] = $value->sum_price;
      }
      $paramArr['invoiceBilling'] = $arrInvoiceBilling;

      //total service
      $totalOrder = Order::select(DB::raw('service_group_id, status, count(*) as total'))->where('client_id', $clientId)->groupBy(DB::raw('service_group_id, status'))->get();
      $arrTotalOrder = array_fill(1, 3, array_fill(1, 5, 0));
      foreach ($totalOrder as $value) {
        $arrTotalOrder[$value->service_group_id][$value->status] = $value->total;
        $arrTotalOrder[$value->service_group_id][5] += $value->total;
      }
      $paramArr['totalOrder'] = $arrTotalOrder;

      $this->layout = View::make(Config::get('view.backend.client-edits.overview'), $paramArr);
    }

    public function getEditFinancial($clientId)
    {
      $paramArr['clientInvoices'] = Invoice::where('client_id', $clientId)->where('status', Config::get('variable.invoice-status.unpaid'))->get();
      $paramArr['client'] = Client::find($clientId);
      $this->layout = View::make(Config::get('view.backend.client-edits.financial'), $paramArr);
    }
    public function postAddCreditFinancial($clientId)
    {
      $client = Client::find($clientId);
      $validator = new BackendValidator(Input::all(), 'client-financial-add-credit');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      $status = Input::get('invoice_paid') ? Config::get('variable.invoice-status.paid') : Config::get('variable.invoice-status.unpaid');
      $invoice = new Invoice;
      $invoice->fill(array(
        'client_id' => $clientId,
        'item_name' => Input::get('comment'),
        'item_price' => Input::get('add_credit'),
        'item_number' => 1,
        'item_qlt' => 1,
        'transaction_tax' => 0,
        'total_price' => Input::get('add_credit'),
        'status' => $status,
        'paid_at' => Carbon::now(),
        'admin_created' => Config::get('variable.invoice-created-status.admin'),
        ));

      if($invoice->save())
      {
        if(Input::get('invoice_paid'))
        {
          $client->amount += Input::get('add_credit');
          $client->save();
        }
        if(Input::get('email_financial_info'))
        {
          $email = CustomHelper::sendMail('emails.client-financial-add-credit', array(
          'recipient' => $client->email,
          'recipientName' => $client->name,
          'mailSubject' => 'Your Account balance updated',
          'addCredit' => Input::get('add_credit'),
          'clientAmount' => $client->amount,
          ));
        }
        return Response::json(array('dataStatus' => true, 'clearField'=>true, 'message' => trans('all.backend.financial-create-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.backend.financial-create-fail'), 'messageType' => 'danger'));
      }
    } 

    public function postRebateCreditFinancial($clientId)
    {
      $client = Client::find($clientId);
      $validator = new BackendValidator(Input::all(), 'client-financial-rebate-credit');
      if(!$validator->passes())
      {
        return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $invoice = Invoice::find(Input::get('invoice_id'));

      if(Input::get('rebate_credit') > $invoice->item_price)
      {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.backend.financial-rebate-amount-fail'), 'messageType' => 'danger'));
      }

      $invoice->item_price -= Input::get('rebate_credit');
      if($invoice->transaction_tax > 0)
      {
        $invoice->transaction_tax = number_format($invoice->item_price*Config::get('variable.transaction_tax')/100, 2);
      }else
      {
        $invoice->transaction_tax = 0;
      }
      $invoice->total_price = $invoice->item_price + $invoice->transaction_tax;

      if($invoice->save())
      {
        if(Input::get('email_financial_info'))
        {
          $email = CustomHelper::sendMail('emails.client-financial-rebate-credit', array(
          'recipient' => $client->email,
          'recipientName' => $client->name,
          'mailSubject' => 'Your Invoice credit rebated',
          'rebateCredit' => Input::get('rebate_credit'),
          'invoiceId' => $invoice->id,
          'invoiceAmount' => $invoice->total_price,
          ));
        }
          return Response::json(array('dataStatus' => true, 'clearField'=>true, 'message' => trans('all.backend.financial-rebate-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.backend.financial-rebrate-fail'), 'messageType' => 'danger'));
      }
    }

    public function getEditProfile($clientId)
    {
      $paramArr['client'] = Client::find($clientId);
      $paramArr['clientGroups'] = ClientGroup::all();
      $this->layout = View::make(Config::get('view.backend.client-edits.profile'), $paramArr);
    }

    public function putUpdateEditProfile($clientId)
    {
      $validator = new BackendValidator(Input::all(), 'client-update');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      $client = Client::find($clientId);
      if(Input::get('password')) $client->password = Hash::make(Input::get('password'));
      $client->fill(array(
        'email' => Input::get('email'),
        'active' => Input::get('active') ? 1 : 0,
        'clientgroup_id' => Input::get('client_group'),
        'language' => Input::get('language'),
        'name' => Input::get('full_name'),
        'address' => Input::get('address'),
        'phone' => Input::get('phone'),
        'city' => Input::get('city'),
        'state' => Input::get('state'),
        'zip_code' => Input::get('zip_code'),
        'country' => Input::get('country'),
        ));

      if($client->save())
      {
          return Response::json(array('dataStatus' => true, 'message' => trans('all.update-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
      }
      
    }


    public function getEditBindLogin($clientId)
    {
      $paramArr['client'] = Client::find($clientId);
      $this->layout = View::make(Config::get('view.backend.client-edits.bind-login'), $paramArr);
    }

    public function putUpdateBindLogin($clientId)
    {
      $validator = new BackendValidator(Input::all(), 'client-bind-login-update');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      $client = Client::find($clientId);
      $client->security_login = Input::get('bind_login');

      if($client->save())
      {
          return Response::json(array('dataStatus' => true, 'message' => trans('all.update-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
      }
    }

    public function getEditOrder($clientId)
    {
      if(Request::Ajax())
      {
        //return Input::all();
        $order_by = Input::get('order_by_col', 'orders.updated_at');
        $order_dir = Input::get('order_dir', 'desc');
        $limit = Input::get('limit');
        $orders = Order::leftJoin("services", 'orders.service_id', '=', 'services.id')
                  ->select(array('orders.id','orders.created_at', 'services.name', 'orders.bulk_imei', 'orders.status as status', 'orders.id as actions'))
                  ->where('orders.service_group_id', Input::get('service_group_id'))
                  ->where('orders.client_id', $clientId)
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
      $paramArr['client'] = Client::find($clientId);
      $this->layout = View::make(Config::get('view.backend.client-edits.order'), $paramArr);
    }

    public function getEditInvoice($clientId)
    {
      if(Request::Ajax())
      {
        $order_by = Input::get('order_by_col', 'created_at');
        $order_dir = Input::get('order_dir', 'desc');
        $limit = Input::get('limit');
        $invoices = Invoice::select(array('id','created_at', 'paid_at', 'item_name', 'total_price', 'status', 'id as actions'))
                  ->where('admin_created', Input::get('admin_created'))
                  ->where('client_id', $clientId)
                  ->orderBy($order_by, $order_dir)
                  ->limit($limit);
        return Datatables::of($invoices)
          ->edit_column('created_at','{{ date("d/m/Y", strtotime($created_at)) }}')
          ->edit_column('paid_at',
            '@if($paid_at != "0000-00-00 00:00:00")
            {{ date("d/m/Y", strtotime($paid_at)) }}
            @endif')
          ->edit_column('status', 
              '@if($status == Config::get("variable.invoice-status.paid"))
                  <div class="label label-success">{{trans("variable.invoice-status.".$status)}}</div>
              @elseif($status == Config::get("variable.invoice-status.unpaid"))
                  <div class="label label-danger">{{trans("variable.invoice-status.".$status)}}</div>
              @elseif($status == Config::get("variable.invoice-status.cancel"))
                  <div class="label label-warning">{{trans("variable.invoice-status.".$status)}}</div>
              @endif')
          ->edit_column('actions',
              '<a href="{{route(\'editHistoryImeiOrders\', $actions)}}" class="btn btn-default btn-sm btn-icon icon-left">
              <i class="entypo-pencil"></i>
              {{trans("all.edit")}}
            </a>')
          ->make();
      }
      $paramArr['client'] = Client::find($clientId);
      $this->layout = View::make(Config::get('view.backend.client-edits.invoice'), $paramArr);
    }

    public function getEditStatement($clientId)
    {
      $paramArr['client'] = Client::find($clientId);
      $this->layout = View::make(Config::get('view.backend.client-edits.statement'), $paramArr);
    }

    public function postResetPass($clientId)
    {
      $client = Client::find($clientId);
      $password = str_random(10);
      $client->password = Hash::make($password);

      $email = CustomHelper::sendMail('emails.reset-password-via-admin', array(
        'recipient' => $client->email,
        'recipientName' => $client->name,
        'mailSubject' => 'Your new password',
        'name' => $client->name,
        'password' => $password,
        ));

      if($email) {
        $client->save();
        return Response::json(array('dataStatus' => true, 'message' => trans('all.reset-pass-success'), 'messageType' => 'success'));
      }
      return Response::json(array('dataStatus' => false, 'message' => trans('all.reset-pass-fail'), 'messageType' => 'danger'));
    }

    public function getUserInvoice($clientId)
    {
      

      try
      {
          $client = Client::find($clientId);
          $paramArr['client'] = $client;
          
          $this->layout = View::make(Config::get('view.backend.client-edits.invoice-user'), $paramArr);
      }
      catch (NotFoundInDatabaseException $e)
      {
      }
    }

    public function putUpdate($clientId)
    {
      try
        {
          $is_validate = true;
          if (in_array(Request::header('referer'), array(route('editClientBindLogin', $clientId))))
          {
            $is_validate = false;
          }
          if ($is_validate)
          {
            $validator = new BackendValidator(Input::all(), 'client-update');
            if(!$validator->passes())
            {
                return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
            }
          }
          // Find the permission using the permission id
          $client = Client::find($clientId);
          if (Input::get('password')) $client->password = Input::get('password');
          if (Input::get('active')) $client->status = Input::get('active') == 'on' ? 1 : 0;
          if (Input::get('email')) $client->email = Input::get('email');
          if (Input::get('client_group')) $client->clientgroup_id = Input::get('client_group');
          if (Input::get('language')) $client->language = Input::get('language');
          if (Input::get('full_name')) $client->name = Input::get('full_name');
          if (Input::get('address')) $client->phone = Input::get('address');
          if (Input::get('city')) $client->address1 = Input::get('city');
          if (Input::get('state')) $client->city = Input::get('state');
          if (Input::get('zip_code')) $client->zip_code = Input::get('zip_code');
          if (Input::get('country')) $client->country = Input::get('country');
          if (Input::get('bind_login')) $client->security_login = Input::get('bind_login');
          // Update the permission
          if($client->save())
          {
              return Response::json(array('dataStatus' => true, 'message' => trans('all.update-success'), 'messageType' => 'success'));
          }
          else 
          {
              return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
          }
        }
        catch (Exception $e)
        {
        }
    }


    public function getNew()
    {
      $clientGroups = ClientGroup::all();
      $this->layout = View::make(Config::get('view.backend.client-new'), array(
        'clientGroups' => $clientGroups));
    }

    public function postCreate()
    {
      $validator = new BackendValidator(Input::all(), 'client-create');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      if (Input::get('generate_invoice') && Input::get('amount')>0)
      {
        $status = Input::get('invoice_paid') ? Config::get('variable.invoice-status.paid') : Config::get('variable.invoice-status.unpaid');
        $invoice = new Invoice;
        $invoice->fill(array(
          'client_id' => $clientId,
          'item_name' => 'Nap tien vao tk',
          'item_price' => Input::get('amount'),
          'item_number' => 1,
          'item_qlt' => 1,
          'transaction_tax' => 0,
          'total_price' => Input::get('amount'),
          'status' => $status,
          'paid_at' => Carbon::now(),
          'admin_created' => Config::get('variable.invoice-created-status.admin'),
          ));
      }

      //create client
      $client = new User;
      $client->fill(array(
        'name' => Input::get('full_name'),
        'username' => Input::get('username'),
        'email' => Input::get('email'),
        'password' => Hash::make(Input::get('password', str_random(6))),
        'active' => Input::get('active') == 'on' ? 1 : 0,
        'phone' => Input::get('phone'),
        'amount' => Input::get('invoice_paid') ? Input::get('amount') : 0,
        'clientgroup_id' => Input::get('client_group'),
        'address' => Input::get('address'),
        'city' => Input::get('city'),
        'state' => Input::get('state'),
        'zip_code' => Input::get('zip_code'),
        'country' => Input::get('country'),
        'language' => Input::get('language'),
        ));

      // Update the permission
      if($client->save())
      {
        
          return Response::json(array('dataStatus' => true, 'clearField' => true, 'message' => trans('all.create-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.create-fail'), 'messageType' => 'danger'));
      }
    }

  public function getUpdateMulti()
  {
    return View::make(Config::get('view.backend.client-update-multi'));
  }

  public function delete()
  {
    $arrId = explode(',', Input::get('arr_id'));
    try
    {
      foreach ($arrId as $id) {
        $client = Client::find($id);
        $client->delete();
      }
    }
    catch (NotFoundInDatabaseException $e)
    {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.delete-fail'), 'messageType' => 'danger'));
    }

    return Response::json(array('dataStatus' => true, 'message' => trans('all.delete-success'), 'messageType' => 'success'));
  }
}