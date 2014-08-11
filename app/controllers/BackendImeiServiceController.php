<?php

use Validators\Backend as BackendValidator;
class BackendImeiServiceController extends BackendBaseController
{
    public function getIndex()
    {
        return View::make(Config::get('view.backend.services.imei.index'));
    }

    public function getAjaxTable()
    {
        if(Request::Ajax())
        {
          $order_by = Input::get('order_by_col', 'id');
          $order_dir = Input::get('order_dir', 'asc');
          $limit = Input::get('limit');

          $imeiService = Service::select(array('id as inputbox', 'id','name', 'credit', 'active', 'id as actions'))
                    ->where('service_group_id', '=', Config::get('variable.service-group-type.IMEI'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($imeiService)
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
            ->make();
        }
    }

    public function getQuickEdit()
    {
      if(Request::Ajax())
      {
        $services = ServiceCat::find(Input::get('service_cat'))->services;
        return View::make(Config::get('view.backend.services.imei.list-tr'), array('services' => $services));
      }
      $assignArr['serviceCats'] = ServiceCat::where('service_group_id', '=', Config::get('variable.service-group-type.IMEI'))->get();
      $assignArr['servicesOfFirstCat'] = $assignArr['serviceCats'][0]->services;
      return View::make(Config::get('view.backend.services.imei.quick-edit'), $assignArr);
    }

    public function getEdit($serviceId)
    {
      $service = Service::find($serviceId);
      $assginArr['service'] = $service;
      $assginArr['serviceSettings'] = json_decode($service->settings);

      if(Request::Ajax())
      {
        if(Input::get('action') == 'loadCatList')
        {
          $assginArr['serviceCats'] = ServiceCat::all();
          return View::make('backend.service.imei.cat-list', $assginArr);
        }
      }

      /*
      switch (Route::currentRouteName()) {
        case 'editImeiServiceDiscountedUsers':
          $view_name = 'edits.discounted-users';
          break;
        case 'editImeiServiceCustomerReview':
          $view_name = 'edits.customer-review';
          break;
        
      }
      */

      $assginArr['serviceCats'] = ServiceCat::all();
      $this->layout = View::make(Config::get('view.backend.services.imei.edit'), $assginArr);
    }

    public function getEditServiceApi($serviceId)
    {
      $service = Service::find($serviceId);
      $assginArr['service'] = $service;
      $assginArr['sourceServices'] = SourceService::where('api_id', '=', $service->api_id)->get();
      $this->layout = View::make(Config::get('view.backend.services.imei.edits.api'), $assginArr);
    }

    public function putUpdateQuickEdit()
    {
      try
      {
        $service = Service::find(Input::get('pk'));
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

    public function putUpdate($serviceId)
    {
      $validator = new BackendValidator(Input::all(), 'service-update');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $service = Service::find($serviceId);
      $settings = array(
        'cancel_service' => Input::get('cancel_service') ? 1 : 0,
        'admin_notify' => Input::get('admin_notify') ? 1 : 0,

        'refund_code_not_found' => Input::get('refund_code_not_found') ? 1 : 0,
        'service_247' => Input::get('service_247') ? 1 : 0,
        'unlock_guarant' => Input::get('unlock_guarant') ? 1 : 0,
        'no_refund_bad_request' => Input::get('no_refund_bad_request') ? 1 : 0,
        'work_business_day' => Input::get('work_business_day') ? 1 : 0,
        );
      $service->fill(array(
        'name' => Input::get('service_name'),
        'content' => Input::get('content_info'),
        'credit' => Input::get('credit'),
        'active' => Input::get('service_active') ? 1 : 0,
        'delivery_time' => Input::get('delivery_time'),
        'imei_service_cat_id' => Input::get('service_cat'),
        'type' => Input::get('service_type'),
        'settings' => json_encode($settings),
        ));

      if($service->save())
      {
          return Response::json(array('dataStatus' => true, 'message' => trans('all.update-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
      }

      /*
      try
        {
          $is_validate = true;
          // Find the permission using the permission id
          
          //overview
          if (Input::get('service_name')) $service->name = Input::get('service_name');
          if (Input::get('credit')) $service->credit = Input::get('credit');
          if (Input::get('service_active')) $service->active = Input::get('service_active');
          if (Input::get('delivery_time')) $service->delivery_time = Input::get('delivery_time');
          if (Input::get('service_cat')) $service->imei_service_cat_id = Input::get('service_cat');
          if (Input::get('service_type')) $service->type = Input::get('service_type');
          
          //api
          if (Input::get('api_id') && Input::get('api_service_id'))
          {
            //return Input::get('api_service_id');
            $is_validate = false;
            $service->api_id = Input::get('api_id');
            $service->api_service_id = Input::get('api_service_id');
          } 

          if ($is_validate)
          {
            $validator = new BackendValidator(Input::all(), 'service-update');
            if(!$validator->passes())
            {
                return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
            }
          }

          // Update the permission
          if($service->save())
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
        */
    }

    public function putUpdateApi($serviceId)
    {
      $service = Service::find($serviceId);

      $service->api_id = Input::get('api_id');
      $service->api_service_id = Input::get('api_service_id');

      // Update the permission
      if($service->save())
      {
          return Response::json(array('dataStatus' => true, 'message' => trans('all.update-success'), 'messageType' => 'success'));
      }
      else 
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
      }
    }

    public function getNew()
    {
      $serviceCats = ServiceCat::all();
      $this->layout = View::make(Config::get('view.backend.services.imei.new'), array(
          'serviceCats' => $serviceCats
      ));
    }

    public function postCreate()
    {
      $validator = new BackendValidator(Input::all(), 'service-create');
      if(!$validator->passes())
      {
          return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      // Find the permission using the permission id
      $service = new Service;
      $service->fill(array(
        'name' => Input::get('service_name'),
        'credit' => Input::get('credit'),
        'active' => Input::get('service_active') == 'on' ? 1 : 0,
        'delivery_time' => Input::get('delivery_time'),
        'imei_service_cat_id' => Input::get('service_cat'),
        'service_group_id' => self::getServiceGroup(),
        'type' => Input::get('service_type')
        ));

      // Update the permission
      if($service->save())
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
        $service = Service::find($id);
        $service->delete();
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