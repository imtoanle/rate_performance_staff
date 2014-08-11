<?php

use Validators\Backend as BackendValidator;
class BackendInvoiceController extends BackendBaseController
{
    public function getAjaxClientInvoice($clientId)
    {
      if (Request::Ajax())
      {
        $order_by = Input::get('order_by_col', 'id');
        $order_dir = Input::get('order_dir', 'asc');
        $limit = Input::get('limit');

        $orders = Invoice::select(array('id as inputbox','id','created_at','created_at as due_date','paid_at' ,'total_price','status', 'id as actions'))
                  ->where('client_id', '=', $clientId)
                  ->orderBy($order_by, $order_dir)
                  ->limit($limit);
        return Datatables::of($orders)
          ->edit_column('inputbox', 
            '<div class="checkbox checkbox-replace neon-cb-replacement">
              <label class="cb-wrapper">
                <input type="checkbox" name="arr_check[]" value="{{$inputbox}}">
                <div class="checked"></div>
              </label>
            </div>')
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
              '<a href="javascript:;" onclick="AjaxModal(\'Edit nhom ne\',\'{{route(\'editImeiServiceGroups\', $actions)}}\');" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                {{trans("all.edit")}}
              </a>')
          ->make();
      }
    }

    public function getEditInvoice($invoiceId)
    {
      $invoice = Invoice::find($invoiceId);
      $client = Client::find($invoice->client_id);
      return View::make(Config::get('view.backend.invoice-edit'), array(
        'invoice' => $invoice,
        'client' => $client));
    }

    public function putUpdateInvoice($invoiceId)
    {
      $invoice = Invoice::find($invoiceId);
      switch (Input::get('action')) {
        case 'setPaid':
          $invoice->status = Config::get('variable.invoice-status.paid');
          break;
        case 'setUnpaid':
          $invoice->status = Config::get('variable.invoice-status.unpaid');
          break;
        case 'setCancel':
          $invoice->status = Config::get('variable.invoice-status.cancel');
          break;
        
        default:
          # code...
          break;
      }
      
      if($invoice->save())
      {
          return Response::json(array('dataStatus' => true));
      }
      return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
    }

    public function deleteClientInvoice()
    {
      $arrId = explode(',', Input::get('arr_id'));
      try
      {
        foreach ($arrId as $id) {
          $client = Invoice::find($id);
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