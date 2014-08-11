<?php

use Validators\Backend as BackendValidator;
class BackendClientGroupController extends BackendBaseController
{
    public function getIndex()
    {
        return View::make(Config::get('view.backend.client-group-index'));
    }

    public function getMember($clientGroupId)
    {
      if(Request::Ajax())
      {
        if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'id');
          $order_dir = Input::get('order_dir', 'asc');
          $limit = Input::get('limit');

          $client = Client::select(array('id', 'username', 'email', 'amount'))
                    ->where('clientgroup_id', $clientGroupId)
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($client)->make();
        }
      }
      return View::make(Config::get('view.backend.client-group-member'));
    }

    public function getAjaxIndex()
    {
        if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'id');
          $order_dir = Input::get('order_dir', 'asc');
          $limit = Input::get('limit');

          $clientGroup = ClientGroup::select(array('id as inputbox', 'id', 'name', 'id as actions'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($clientGroup)
            ->edit_column('inputbox', 
              '<div class="checkbox checkbox-replace neon-cb-replacement">
                <label class="cb-wrapper">
                  <input type="checkbox" name="arr_check[]" value="{{$inputbox}}">
                  <div class="checked"></div>
                </label>
              </div>')
            ->edit_column('actions',
              '<a href="{{route(\'editClientGroupPricing\', $actions)}}" class="btn btn-gold btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                {{trans("all.credit")}}
              </a>

              <a href="{{route(\'memberClientGroup\', $actions)}}" class="btn btn-info btn-sm btn-icon icon-left">
                <i class="entypo-info"></i>
                {{trans("all.member")}}
              </a>

              <a href="javascript:;" onclick="AjaxModal(\'#edit-modal\',\'{{route(\'editClientGroup\', $actions)}}\');" class="btn btn-default btn-sm btn-icon icon-left">
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

    public function getEdit($clientGroupId)
    {
      try
      {
          $clientGroup = ClientGroup::find($clientGroupId);
          
          $this->layout = View::make(Config::get('view.backend.client-group-edit'), array(
              'clientGroup' => $clientGroup,
          ));
      }
      catch (NotFoundInDatabaseException $e)
      {
      }
    }

    public function putUpdate($clientGroupId)
    {
      try
        {
          $validator = new BackendValidator(Input::all(), 'client-group-update');
          if(!$validator->passes())
          {
              return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
          }
          // Find the permission using the permission id
          $clientGroup = ClientGroup::find($clientGroupId);
          $clientGroup->fill(array(
            'name' => Input::get('name'),
            ));

          // Update the permission
          if($clientGroup->save())
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
      $this->layout = View::make(Config::get('view.backend.client-group-new'));
    }

    public function postCreate()
    {
      $validator = new BackendValidator(Input::all(), 'client-group-update');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      // Find the permission using the permission id
      $clientGroup = new ClientGroup;
      $clientGroup->fill(array(
        'name' => Input::get('name'),
        ));

      // Update the permission
      if($clientGroup->save())
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
        $clientGroup = ClientGroup::find($id);
        $clientGroup->delete();
      }
    }
    catch (NotFoundInDatabaseException $e)
    {
        return Response::json(array('dataStatus' => false, 'message' => trans('all.delete-fail'), 'messageType' => 'danger'));
    }

    return Response::json(array('dataStatus' => true, 'message' => trans('all.delete-success'), 'messageType' => 'success'));
  }

  public function getEditPricing($groupId)
  {
    if(Request::Ajax())
    {
      $services = ServiceCat::find(Input::get('service_cat'))->services;
      return View::make(Config::get('view.backend.client-group-edit-pricing-list-tr'), array('services' => $services, 'groupId' => $groupId));
    }
    $assignArr['serviceCats'] = ServiceCat::where('service_group_id', '=', Config::get('variable.service-group-type.IMEI'))->get();
    return View::make(Config::get('view.backend.client-group-edit-pricing'), $assignArr);
  }


  public function putUpdatePricing()
  {
    try
    {
      $service = Pricing::find(Input::get('pk'));
      $service->fill(array(
        Input::get('name') => Input::get('value')
        )
      );
      $service->save();
    }catch(Exception $e)
    {
      return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail')));
    }
  }
}