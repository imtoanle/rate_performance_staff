<?php

use Validators\Backend as BackendValidator;
use Carbon\Carbon;
class BackendDashboardController extends BackendBaseController
{
    /**
    * Index loggued page
    */
    public function getIndex()
    {
        $currentUser = Sentry::getUser();

        $patternVoter = '"user_id":"'.$currentUser->id.'"';
        //$patternEntitled = '^'.$currentUser->id.',|,'.$currentUser->id.',|,'.$currentUser->id.'$';

        $canVoter = Vote::whereRaw("voter regexp '".$patternVoter."'")->where('status', Config::get('variable.vote-status.opened'))->get();
        //$canEntitled = Vote::whereRaw("entitled_vote regexp '".$patternVoter."'")->where('status', Config::get('variable.vote-status.opened'))->get();


        $params['canVoter'] = $canVoter;
        //$params['canEntitled'] = $canEntitled;
        $params['notifys'] = $currentUser->notifys;

        if(Request::Ajax())
            return View::make(Config::get('view.backend.dashboard-index-little'), $params);
        else                        
            return View::make(Config::get('view.backend.dashboard-index'), $params);
        //$this->layout->tilte = trans('syntara::all.titles.index');
        //$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.dashboard');
    }

    public function getUnpaidInvoice()
    {
        //get table unpaid invoice
        if(Request::Ajax())
        {
            $order_by = Input::get('order_by_col', 'invoices.id');
            $order_dir = Input::get('order_dir', 'desc');
          $limit = Input::get('limit');

          $invoice = Invoice::leftJoin('clients', 'clients.id', '=', 'invoices.client_id')
            ->select(array('invoices.id as checkbox','invoices.id','clients.username', 'invoices.created_at', 'invoices.created_at as due_date', 'invoices.total_price', 'invoices.id as actions'))
                    ->where('status', Config::get('variable.invoice-status.unpaid'))
                    ->where('admin_created', Input::get('admin_created'))
                    ->orderBy($order_by, $order_dir)
                    ->limit($limit);
          return Datatables::of($invoice)
            ->edit_column('checkbox', 
              '<div class="checkbox checkbox-replace neon-cb-replacement">
                <label class="cb-wrapper">
                  <input type="checkbox" name="arr_check[]" value="{{$checkbox}}">
                  <div class="checked"></div>
                </label>
              </div>')
            ->edit_column('actions',
              '<a href="{{route(\'editInvoice\', $actions)}}" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                {{trans("all.edit")}}
              </a>')
            ->make();
        }

        return View::make(Config::get('view.backend.dashboard.unpaid-invoice'));
    }

    public function putCancelUnpaidInvoice()
    {
        try
      {
        Invoice::whereRaw('id IN ('.Input::get('arr_id', 0).')')->update(array('status' => Config::get('variable.invoice-status.cancel')));
      }
      catch (NotFoundInDatabaseException $e)
      {
          return Response::json(array('dataStatus' => false, 'message' => trans('all.backend.cancel-invoice-fail'), 'messageType' => 'danger'));
      }

      return Response::json(array('dataStatus' => true, 'message' => trans('all.backend.cancel-invoice-success'), 'messageType' => 'success'));
    }

    public function getSystemSummary()
    {
        //orders
        $orderCompletedByMonth  = Order::select(DB::raw('service_group_id, status, count(*) as total'))->groupBy('service_group_id', 'status');
        //users
        $userByMonth  = Client::select(DB::raw('active, count(*) as total'))->groupBy('active');
        //prices completed order
        $priceCompletedOrder  = Order::where('status', Config::get('variable.order-status.completed'));

        if(Request::Ajax())
        {
            //settime
            $time = explode('-',Input::get('select_time'));
            $selectMonth = array(Carbon::createFromDate($time[1], $time[0], 1)->startOfMonth(), Carbon::createFromDate($time[1], $time[0], 1)->endOfMonth());

            $orderCompletedByMonth = $orderCompletedByMonth->whereBetween('updated_at', $selectMonth)->get();
            $userByMonth = $userByMonth->whereBetween('created_at', $selectMonth)->get();
            $priceCompletedOrder = $priceCompletedOrder->whereBetween('updated_at', $selectMonth)->sum('amount');
        }else
        {
            $orderCompletedByMonth = $orderCompletedByMonth->get();
            $userByMonth = $userByMonth->get();
            $priceCompletedOrder = $priceCompletedOrder->sum('amount');
        }

        //orders
        $orderArray = array_fill(1, 3, array_fill(1, 4, 0));
        foreach ($orderCompletedByMonth as $value) {
            $orderArray[$value->service_group_id][$value->status] = $value->total;
        }

        //users
        $userArray = array_fill(0, 2, 0);
        foreach ($userByMonth as $value) {
            $userArray[$value->active] = $value->total;
        }
        

        if (Request::Ajax())
        {
            return View::make(Config::get('view.backend.dashboard.system-summary-child'), array(
                'orderArray' => $orderArray,
                'userArray' => $userArray,
                'priceCompletedOrder' => $priceCompletedOrder,
                ));
        }

        //$orderSummary = Order::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year'))->groupBy(DB::raw('MONTH(created_at), YEAR(created_at)'))->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))->get();
        $siteStartTime = Carbon::createFromDate(2013, 4, 1);
        $timeArray = array();
        for($year = $siteStartTime->year; $year <= Carbon::now()->year; $year++)
        {
            $startMonth = ($year == $siteStartTime->year) ? $siteStartTime->month : 1;
            $endMonth = ($year == Carbon::now()->year) ? Carbon::now()->month : 12;
            $timeArray[$year] = "";
            for($month = $startMonth; $month <= $endMonth; $month++)
            {
                $timeArray[$year] .= $month.',';
            }
            $timeArray[$year] = trim($timeArray[$year], ',');
        }
        
        $currentMonth = Carbon::now()->month.'-'.Carbon::now()->year;

        return View::make(Config::get('view.backend.dashboard.system-summary'), array(
            'timeArray' => $timeArray,
            'currentMonth' => $currentMonth,
            'orderArray' => $orderArray,
            'userArray' => $userArray,
            'priceCompletedOrder' => $priceCompletedOrder,
            ));
    }
    /**
    * Login page
    */
    public function getLogin()
    {
        $this->layout = View::make(Config::get('view.backend.login'));
        $this->layout->title = trans('syntara::all.titles.login');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.login');
    }

    /**
    * Login post authentication
    */
    public function postLogin()
    {
        try
        {
            $validator = new BackendValidator(Input::all(), 'user-login');

            if(!$validator->passes())
            {
                 return Response::json(array('logged' => false, 'errorMessages' => $validator->getErrors()));
            }

            $credentials = array(
                'username'    => Input::get('username'),
                'password' => Input::get('password'),
            );

            // authenticate user
            Sentry::authenticate($credentials, Input::get('remember'));
        }
        catch(\Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            return Response::json(array('logged' => false, 'errorMessage' => trans('all.messages.banned'), 'errorType' => 'danger'));
        }
        catch (\RuntimeException $e)
        {
            return Response::json(array('logged' => false, 'errorMessage' => trans('all.messages.login-failed'), 'errorType' => 'danger'));
        }

        return Response::json(array('logged' => true));
    }

    /**
    * Logout user
    */
    public function getLogout()
    {
        Sentry::logout();

        return Redirect::route('indexDashboard');
    }

    /**
    * Access denied page
    */
    public function getAccessDenied()
    {
        if(Request::Ajax())
        {
            App::abort(500, 'Bạn không có quyền truy cập khu vực này');
        }else
        {
            $this->layout = View::make(Config::get('view.backend.error'), array('message' => 'Bạn không có quyền truy cập khu vực này'));    
            $this->layout->title = 'Từ chối truy cập';
        }
        
        
    }
}