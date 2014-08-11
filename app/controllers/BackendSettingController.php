<?php

use Validators\Backend as BackendValidator;
class BackendSettingController extends BackendBaseController
{
  public function getGeneral()
  {
    return View::make(Config::get('view.backend.settings.general.general'));
  }

  public function getApi()
  {

  	$activatedApis = Api::where('active', '=', 1)->get();
  	$inactiveApis = Api::where('active', '=', 0)->get();
    return View::make(Config::get('view.backend.settings.api.index'), array(
    	'activatedApis' => $activatedApis,
    	'inactiveApis' => $inactiveApis));
  }

  public function getEditApi($apiId)
  {
  	$api = Api::find($apiId);
  	return View::make(Config::get('view.backend.settings.api.edit'), array('api' => $api));
  }

  public function putUpdateApi($apiId)
  {
    try
      {
        $validator = new BackendValidator(Input::all(), 'api-setting-update');
        if(!$validator->passes())
        {
            return Response::json(array('dataStatus' => false, 'errorMessages' => $validator->getErrors()));
        }
        // Find the permission using the permission id
        $api = Api::find($apiId);
        $api->fill(array(
          'site' => Input::get('site'),
          'username' => Input::get('username'),
          'api_key' => Input::get('api_key'),
          ));

        // Update the permission
        if($api->save())
        {
            return Response::json(array('dataStatus' => true, 'message' => trans('all.update-success'), 'messageType' => 'success'));
        }
        else 
        {
            return Response::json(array('dataStatus' => false, 'message' => trans('all.update-fail'), 'messageType' => 'danger'));
        }
      }
      catch (Exception $e) {}
  }

  public function putUpdateSynApi()
  {
    $api = Api::find(Input::get('api_id'));
    if(Input::get('delete_all_current'))
    {
      try
      {
        Service::truncate();
        ServiceCat::truncate();
        Pricing::truncate();
        $notice[] = trans('all.delete-success');
      }catch(Exception $e)
      {
        $notice[] = trans('all.delete-fail');
      }
    }

    if(Input::get('syn_this_api'))
    {

      try
      {
        
        //Xoa du lieu cuar api nay trong source
        SourceService::where('api_id', '=', $api->id)->delete();
        SourceServiceCat::where('api_id', '=', $api->id)->delete();

        $options = array(
          'username' => $api->username,
          'site' => $api->site,
          'api_key' => $api->api_key,
          'format' => 'JSON'
        );
        $request = DhruFusion::action($options, 'imeiservicelist');
        foreach($request['SUCCESS'][0]['LIST'] as $groupService)
        {
          $sourceCat = SourceServiceCat::create(array(
            'api_id' => $api->id,
            'name' => $groupService['GROUPNAME']
          ));

          foreach ($groupService['SERVICES'] as $service) {
            SourceService::create(array(
              'api_id' => $api->id,
              'service_cat_id' => $sourceCat->id,
              'service_id' => $service['SERVICEID'],
              'service_name' => $service['SERVICENAME'],
              'credit' => $service['CREDIT'],
              'delivery_time' => $service['TIME'],
              'info' => $service['INFO']
              ));
          }
        }
        //return Response::json(array('dataStatus' => true, 'message' => trans('all.syn-success'), 'messageType' => 'success'));
        $notice[] = trans('all.syn-success');
      }
      catch(Exception $e){
        $notice[] = trans('all.syn-fail');
      }
    }

    if(Input::get('setup_same_api'))
    {
      try
      {
        $sourceCats = SourceServiceCat::where('api_id', '=', $api->id)->get();
        foreach($sourceCats as $cat)
        {
          $primaryCat = ServiceCat::create(array(
            'api_id' => $api->id,
            'service_group_id' => Config::get('variable.service-group-type.IMEI'),
            'name' => $cat->name,
            'active' => 1
            ));
          foreach ($cat->services as $service) {
            $primaryService = Service::create(array(
              'api_id' => $api->id,
              'api_service_id' => $service->service_id,
              'name' => $service->service_name,
              'content' => $service->info,
              'credit' => $service->credit,
              'active' => 1,
              'delivery_time' => $service->delivery_time,
              'imei_service_cat_id' => $primaryCat->id,
              'service_group_id' => Config::get('variable.service-group-type.IMEI'), //IMEI
              'type' => Config::get('variable.type-service.Database'), //Database

              ));

            //tao luon bang pricing cho tung user
            foreach(ClientGroup::all() as $clientGroup)
            {
              Pricing::create(array(
                'service_id' => $primaryService->id,
                'client_group_id' => $clientGroup->id,
                'pricing' => $primaryService->credit,
                ));
            }
          }
        }
        $notice[] = trans('all.setup-success');
      }catch (Exception $e)
      {
        $notice[] = trans('all.setup-fail');
      }
    }

    $fullNote = "";
    foreach($notice as $note)
    {
      $fullNote .= '<p>'.$note.'</p>';
    }
    return Response::json(array('dataStatus' => true, 'message' => $fullNote, 'messageType' => 'warning'));
  }
}