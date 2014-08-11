<?php

use Validators\Backend as BackendValidator;
class BackendServiceGroupController extends BackendBaseController
{

//service group

  public function getIndex()
  {
    return View::make(Config::get('view.backend.service-group-index'));
  }

  public function getAjaxTable()
  {
    if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'id');
          $order_dir = Input::get('order_dir', 'asc');
          $limit = Input::get('limit');

          $serviceGroup = ServiceCat::select(array('id as inputbox', 'id', 'name', 'active', 'id as actions'))
                    ->where('service_group_id', '=', Config::get('variable.service-group-type.IMEI'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($serviceGroup)
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
              '<a href="javascript:;" onclick="AjaxModal(\'Edit nhom ne\',\'{{route(\'editImeiServiceGroups\', $actions)}}\');" class="btn btn-default btn-sm btn-icon icon-left">
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

  public function getEdit($serviceGroupId)
  {
    try
      {
        $serviceGroup = ServiceCat::find($serviceGroupId);
        $this->layout = View::make(Config::get('view.backend.service-group-edit'), array(
            'serviceGroup' => $serviceGroup,
        ));
      }
      catch (NotFoundInDatabaseException $e)
      {
      }   
  }

  public function putUpdate($serviceGroupId)
    {
      try
        {
          $validator = new BackendValidator(Input::all(), 'service-group-update');
          if(!$validator->passes())
          {
              return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
          }
          // Find the permission using the permission id
          $serviceGroup = ServiceCat::find($serviceGroupId);
          $serviceGroup->fill(array(
            'name' => Input::get('group_name'),
            'active' => Input::get('group_active') == 'on' ? 1 : 0,
            ));

          // Update the permission
          if($serviceGroup->save())
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
      $this->layout = View::make(Config::get('view.backend.service-group-new'));
    }

    public function postCreate()
    {
      $validator = new BackendValidator(Input::all(), 'service-group-update');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      // Find the permission using the permission id
      $serviceGroup = new ServiceCat;
      $serviceGroup->fill(array(
        'name' => Input::get('group_name'),
        'active' => Input::get('group_active') == 'on' ? 1 : 0,
        'service_group_id' => self::getServiceGroup(),
        ));

      // Update the permission
      if($serviceGroup->save())
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
        $serviceGroup = ServiceCat::find($id);
        $serviceGroup->delete();
      }
    }
    catch (NotFoundInDatabaseException $e)
    {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.delete-fail'), 'messageType' => 'danger'));
    }

    return Response::json(array('dataStatus' => true, 'message' => trans('all.delete-success'), 'messageType' => 'success'));
  }

  public static function getServiceGroup()
  {
    if (strpos(strtolower(Route::currentRouteName()),'imei') !== false) {
      return Config::get('variable.service-group-type.IMEI');
    }
    else if (strpos(strtolower(Route::currentRouteName()),'file') !== false) {
      return Config::get('variable.service-group-type.FILE');
    }
    if (strpos(strtolower(Route::currentRouteName()),'server') !== false) {
      return Config::get('variable.service-group-type.SERVER');
    }
  }
}