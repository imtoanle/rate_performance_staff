<?php

class ServiceController extends BaseController {

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

	public function getIndex()
	{
		return View::make(Config::get('view.index-services'), array('datas' => self::assignDataService() ));
	}

	public function getPlaceOrder()
	{
		if(Request::ajax())
    {
    	$service = Service::find(Input::get('serviceId'));
      //$html = View::make(Config::get('view.place-order-imei-form'), array('detailService' => $service))->render();

      return Response::json(array('service' => array('name' => $service->name, 'price' => $service->credit, 'delivery_time' => $service->delivery_time, 'content' => $service->content)));
    }

		return View::make(Config::get('view.place-order-imei'), array('datas' => self::assignDataService() ));
	}

	public function getDetailService($serviceId)
	{
		$detailService = Service::find($serviceId);
		$arrBreadCrumb = array(
        array(trans('all.home'), route('indexHome')),
        array(trans('all.services'), route('imei-service')),
        array(trans('all.service-imei'), route('imei-service')),
        array($detailService->name)
    );
		return View::make(Config::get('view.detail-imei-service'), array(
			'detailService' => $detailService, 
			'dynamicTitle' => $detailService->name,
			'dataBreadcrumb' => $arrBreadCrumb));
	}

	protected static function assignDataService()
	{
		switch (URL::current()) {
			case route('file-service'):
				$serviceGroupId = Config::get('variable.service-group-type.FILE');
				break;

			case route('server-service'):
				$serviceGroupId = Config::get('variable.service-group-type.SERVER');
				break;
			
			default:
				$serviceGroupId = Config::get('variable.service-group-type.IMEI');
				break;
		}

		$datas = array();
		foreach (ServiceCat::where('service_group_id', '=', $serviceGroupId)->get() as $ServiceCat) {
			$datas[] = array($ServiceCat, $ServiceCat->services());
		}
		return $datas;
	}

}
