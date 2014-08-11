<?php

use Validators\Backend as BackendValidator;
class BackendStatementController extends BackendBaseController
{
    public function getAjaxClientStatement($clientId)
    {
      if (Request::Ajax())
      {
        $order_by = Input::get('order_by_col', 'id');
        $order_dir = Input::get('order_dir', 'asc');
        $limit = Input::get('limit');

        $statements = Statement::select(array('id as inputbox','id','created_at','desc','type' ,'amount','balance', 'sid'))
                  ->where('client_id', '=', $clientId)
                  ->orderBy($order_by, $order_dir)
                  ->limit($limit);
        return Datatables::of($statements)
          ->edit_column('inputbox', 
            '<div class="checkbox checkbox-replace neon-cb-replacement">
              <label class="cb-wrapper">
                <input type="checkbox" name="arr_check[]" value="{{$inputbox}}">
                <div class="checked"></div>
              </label>
            </div>')
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

    public function deleteClientStatement()
    {
      $arrId = explode(',', Input::get('arr_id'));
      try
      {
        foreach ($arrId as $id) {
          $client = Statement::find($id);
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