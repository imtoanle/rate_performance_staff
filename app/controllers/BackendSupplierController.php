<?php

use Validators\Backend as BackendValidator;
class BackendSupplierController extends BackendBaseController
{
    public function getIndex()
    {
        return View::make(Config::get('view.backend.supplier-index'));
    }

    public function getAjaxIndex()
    {
        if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'id');
          $order_dir = Input::get('order_dir', 'asc');
          $limit = Input::get('limit');

          $supplier = Supplier::select(array('id as inputbox', 'id','username', 'email', 'status', 'id as actions'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($supplier)
            ->edit_column('inputbox', 
              '<div class="checkbox checkbox-replace neon-cb-replacement">
                <label class="cb-wrapper">
                  <input type="checkbox" name="arr_check[]" value="{{$inputbox}}">
                  <div class="checked"></div>
                </label>
              </div>')
            ->edit_column('status',
              '@if($status)
              <span class="label label-success">{{trans("all.status")}}</span>
              @else
              <span class="label label-danger">{{trans("all.inactive")}}</span>
              @endif')
            ->edit_column('actions',
              '<a href="javascript:;" onclick="editAjaxModal(\'{{route(\'editSupplier\', $actions)}}\');" class="btn btn-default btn-sm btn-icon icon-left">
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

    public function getEdit($supplierId)
    {
      try
      {
          $supplier = Supplier::find($supplierId);
          
          $this->layout = View::make(Config::get('view.backend.supplier-edit'), array(
              'supplier' => $supplier,
          ));
      }
      catch (NotFoundInDatabaseException $e)
      {
      }
    }

    public function putUpdate($supplierId)
    {
      try
        {
          $validator = new BackendValidator(Input::all(), 'supplier-update');
          if(!$validator->passes())
          {
              return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
          }
          // Find the permission using the permission id
          $supplier = Supplier::find($supplierId);
          $supplier->fill(array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'status' => Input::get('active') == 'on' ? 1 : 0,
            'email' => Input::get('email')
            ));

          // Update the permission
          if($supplier->save())
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
      $this->layout = View::make(Config::get('view.backend.supplier-new'));
    }

    public function postCreate()
    {
      $validator = new BackendValidator(Input::all(), 'supplier-create');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      // Find the permission using the permission id
      $supplier = new Supplier;
      $supplier->fill(array(
        'username' => Input::get('username'),
        'password' => Input::get('password'),
        'status' => Input::get('active') == 'on' ? 1 : 0,
        'email' => Input::get('email')
        ));

      // Update the permission
      if($supplier->save())
      {
          return Response::json(array('dataStatus' => true, 'clearField' => true, 'message' => trans('all.create-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.create-fail'), 'messageType' => 'danger'));
      }
    }

  public function delete()
  {
    $arrId = explode(',', Input::get('arr_id'));
    try
    {
      foreach ($arrId as $id) {
        $supplier = Supplier::find($id);
        $supplier->delete();
      }
    }
    catch (NotFoundInDatabaseException $e)
    {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.delete-fail'), 'messageType' => 'danger'));
    }

    return Response::json(array('dataStatus' => true, 'message' => trans('all.delete-success'), 'messageType' => 'success'));
  }
}