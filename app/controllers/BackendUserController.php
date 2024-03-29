<?php 

use Validators\Backend as BackendValidator;
use Carbon\Carbon;
class BackendUserController extends BackendBaseController 
{

    /**
    * Display a list of all users
    *
    * @return Response
    */

  public function getImportUser()
  {
    return View::make(Config::get('view.backend.users-import'));
  }

  public function postImportUser()
  {
    $faker = Faker\Factory::create();

    $file = Input::file('users_data_file');
    $users = Excel::selectSheetsByIndex(0)->load($file)->get();
    $usersDepartment = [];
    foreach ($users as $user) {
      $usersDepartment[$user->phongban][] = $user;
    }

    try
    {
      $randomGroup = Sentry::findGroupById(1);
      foreach ($usersDepartment as $departmentName => $users) {
        $department = Department::where('name', 'LIKE', '%'.$departmentName.'%')->first();
        if(!is_object($department))
        {
          $department = Department::create(array('name' => $departmentName));
        }
        foreach ($users as $user) {
          $job = JobTitle::where('name', 'LIKE', '%'.$user->chucvu.'%')->first();
          if(!is_object($job))
          {
            $job = JobTitle::create(array('name' => $user->chucvu));
          }
          if(!User::where('username', $user->sohieu)->exists())
          {
            $userCreatd = User::create(array(
            'username' => $user->sohieu,
            'email' => $faker->email,
            'password' => '123123',
            'activated' => true,
            'full_name' => $user->hovaten,
            'birth_date' => Carbon::createFromDate($user->namsinh),
            'job_title' => $job->id,
            'department_id' => $department->id,
            ));


            $userCreatd->addGroup($randomGroup);
          }
          
        }
      }
    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => 'Có lỗi xảy ra khi import thành viên !', 'messageType' => 'error'));
    }
    
    return Response::json(array('actionStatus' => false, 'message' => 'Import thành viên thành công !', 'messageType' => 'success'));
  }

  public function searchViaJobTitle()
  {
    $str_old_value = Input::get('old_object_vote') == 'null' ? '' : Input::get('old_object_vote');
    $str_new_value = Input::get('new_object_vote');
    $arr_old_value = explode(',',$str_old_value);
    $arr_new_value = explode(',',$str_new_value);
    $diff          = array_diff($arr_new_value, $arr_old_value);
    $invert_diff   = array_diff($arr_old_value, $arr_new_value);

    if(count($diff) == 0 || $str_new_value == 'null')
    {
      #delete
      return Response::json(array('action' => 'delete', 'jobId' => array_pop($invert_diff)));
    }else
    {
      $value = array_pop($diff);
      $pattern = "^$value,|,$value,|^$value$|,$value$";
      $users = User::select('id', 'username', 'full_name')->whereRaw("job_title regexp '".$pattern."'")->get();
      $usersInJob = array();
      foreach ($users as $user) {
        $usersInJob[] = array(
          'id' => $user->id,
          'username' => $user->username, 
          'full_name' => $user->full_name,
        );
      }
      return Response::json(array('action' => 'add', 'jobId' => $value, 'jobTitleName' => JobTitle::find($value)->name, 'data' => $usersInJob));
    }
  }

  public function searchViaDepartment()
  {
    if (Input::has('department_id'))
    {
      $departmentId = Input::get('department_id');
      $department = Department::find($departmentId);
      $users = $department->users;
      $usersInDepartment = array();
      foreach ($users as $user) {
        $usersInDepartment[] = array(
          'id' => $user->id,
          'username' => $user->username, 
          'full_name' => $user->full_name,
        );
      }
      return Response::json(array('action' => true, 'departmentId' => $departmentId, 'departmentName' => $department->name, 'data' => $usersInDepartment));
    }
    return Response::json(array('actionStatus' => false));
  }

    public function fullTextSearch()
    {
      $userArr = array();
      if(Input::has('single_user_id'))
      {
        $user = User::find(Input::get('single_user_id'));
        $userArr = $this->structSelect2($user, $user->job_titles_name());
      }
      else if(Input::has('user_id'))
      {
        $userIds = explode(',',Input::get('user_id'));
        $users = User::whereIn('id', $userIds)->get();
        foreach ($users as $user) {
          $userArr[] = $this->structSelect2($user, $user->job_titles_name());
        }

      }else
      {
        $query = Input::get('q');
        $select_id = Input::get('select_id');
        //$notIn = is_array(Input::get('entitled_user')) ? Input::get('entitled_user') : explode(',', Input::get('entitled_user'));
        $notIn = Input::get('selected_voter') == null ? [''] : Input::get('selected_voter');
        $users = User::select('id','username', 'full_name', 'job_title')
          ->whereRaw("(username LIKE '%$query%' OR full_name LIKE '%$query%')")
          ->whereNotIn('id', $notIn)
          ->paginate(Input::get('page_limit'));

        $userArr = array();
        foreach ($users as $user) {
          $userArr[] = $this->structSelect2($user, $user->job_titles_name());
        }
      }
      return Response::json($userArr);
    }
    public function getIndex()
    {
      if (Request::Ajax())
      {
        if (Input::get('mode') == 'datatable')
        {
          $department = Input::has('sSearch_5') ? 'department_id='.Input::get('sSearch_5') : 'deleted_at is null';
          $users = User::select(array('id', 'activated', 'id as checkbox','username', 'full_name', 'email', 'id as groups', 'department_id', 'id as status', 'id as actions'))
            ->whereRaw($department);
          return Datatables::of($users)
          ->remove_column('id')
          ->remove_column('activated')
          ->edit_column('checkbox',
            '<div class="checker">
              <span>
                <input type="checkbox" class="checkboxes" value="{{ $checkbox }}"/>
              </span>
            </div>')
          ->edit_column('groups', function($row){
            $groupsName = '';
            foreach($row->getGroups()->toArray() as $key => $group)
            {
              $groupsName .= $group['name'].',';
            }
            return rtrim($groupsName, ',');
          })
          ->edit_column('department_id', function($row){
            $department = $row->department;
            return is_object($department) ? $department->name : '';
          })
          /*
          ->edit_column('permissions', function($row){
            $permissionsName = '';
            foreach(array_keys($row->getPermissions()) as $permision)
            {
              $permissionsName .= $permision.',';
            }
            return rtrim($permissionsName, ',');
          })
          */
          ->edit_column('status', function($row){
            $throttle = Sentry::findThrottlerByUserId($row->id);
            if ($throttle->isBanned())
            return '<span class="label label-default">'.trans('all.active').'</span>';
            else if ($row->isActivated())
            return '<span class="label label-success">'.trans('all.active').'</span>';
            else
            return '<span class="label label-danger">'.trans('all.inactive').'</span>';
          })
          ->edit_column('actions', 
            '<a href="{{route(\'showUser\', $actions)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> {{trans(\'all.edit\')}}</a>
            <a item-id="{{$actions}}" class="btn btn-default btn-xs black remove-item"><i class="fa fa-trash-o"></i> {{trans(\'all.delete\')}}</a>')
          ->make();
        }
      }

      // get alls users
      $params['users'] = Sentry::findAllUsers();
      
      if(Request::Ajax())
        return View::make(Config::get('view.backend.users-little-index'), $params);
      else
        return View::make(Config::get('view.backend.users-index'), $params);

      //$this->layout = View::make(Config::get('view.backend.users-index'), $params);
      //$this->layout->title = trans('syntara::users.titles.list');
      //$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.users');
    }

    /**
    * Show new user form view
    */
    public function getCreate()
    {
      $params['jobTitles'] = JobTitle::all();
      $params['departments'] = Department::all();
      $params['groups'] = Sentry::findAllGroups();
      $params['permissions'] = Permission::all();

      $this->layout = View::make(Config::get('view.backend.user-create'), $params);
      $this->layout->title = trans('syntara::users.titles.new');
      $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_user');
    }

    /**
    * Create new user
    */
    public function postCreate()
    {
        try
        {
            $permissionsValues = Input::get('select_permissions');
            $permissions = $this->_formatPermissions($permissionsValues);

            $validator = new BackendValidator(Input::all(), 'user-create');
            if(!$validator->passes())
            {
                return Response::json(array('userCreated' => false, 'errorMessages' => $validator->getErrors()));
            }
            

            // create user
            $user = Sentry::createUser(array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
                'username' => Input::get('username'),
                'department_id' => Input::get('select_department'),
                'full_name' => (string)Input::get('full_name'),
                'job_title' => Input::get('select_job_titles'),
                'permissions' => $permissions
            ));

            // activate user
            $activationCode = $user->getActivationCode();
            $user->attemptActivation($activationCode);
            /*
            if(Config::get('syntara::config.user-activation') === 'auto')
            {
                $user->attemptActivation($activationCode);
            }
            elseif(Config::get('syntara::config.user-activation') === 'email')
            {
                $datas = array(
                    'code' => $activationCode,
                    'username' => $user->username
                );

                // send email
                Mail::queue(Config::get('syntara::mails.user-activation-view'), $datas, function($message) use ($user)
                {
                    $message->from(Config::get('syntara::mails.email'), Config::get('syntara::mails.contact'))
                            ->subject(Config::get('syntara::mails.user-activation-object'));
                    $message->to($user->getLogin());
                });
            }
            */
            $groups = explode(',',Input::get('select_groups'));
            if(isset($groups) && is_array($groups))
            {
                foreach($groups as $groupId)
                {
                    $group = Sentry::findGroupById($groupId);
                    $user->addGroup($group);
                }
            }
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e){} // already catch by validators
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e){} // already catch by validators
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e){}
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return Response::json(array('userCreated' => false, 'message' => trans('all.messages.user-name-exists'), 'messageType' => 'error'));
            
        }
        catch(\Exception $e)
        {
            return Response::json(array('userCreated' => false, 'message' => trans('all.messages.user-email-exists'), 'messageType' => 'error'));
        }

        return Response::json(array('userCreated' => true,  'message' => 'Tạo thành viên thành công.', 'messageType' => 'success', 'redirectUrl' => URL::route('listUsers')));
    }

    /**
     * Delete user
     * @param  int $userId
     * @return  Response
     */
    public function delete()
    {

        $userIds = Input::get('itemIds');
        $userArrays = explode(',', $userIds);

        foreach ($userArrays as $userId) {
          try
            {
                if($userId !== Sentry::getUser()->getId())
                {
                    $user = Sentry::findUserById($userId);
                    $user->delete();
                }
                else
                {
                    return Response::json(array('deletedUser' => false, 'message' => trans('all.messages.remove-own-user'), 'messageType' => 'error'));
                }
            }
            catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                return Response::json(array('deletedUser' => false, 'message' => trans('all.messages.user-not-found'), 'messageType' => 'error'));
            }
        }
    
        return Response::json(array('deletedUser' => true, 'message' => trans('all.messages.user-remove-success'), 'messageType' => 'success'));
    }

    /**
     * Activate a user since the dashboard
     * @param  int $userId
     * @return Response
     */
    public function putActivate($userId)
    {
        try
        {
            $user = Sentry::getUserProvider()->findById($userId);
            $activationCode = $user->getActivationCode();
            $user->attemptActivation($activationCode);
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.not-found'), 'messageType' => 'error'));
        }
        catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
        {
            return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.activate-already'), 'messageType' => 'error'));
        }

        return Response::json(array('deletedUser' => true, 'message' => trans('syntara::users.messages.activate-success'), 'messageType' => 'success'));
    }

    /**
     * Activate a user (from an email)
     * @param  string $activationCode
     */
    public function getActivate($activationCode)
    {
        $activated = false;
        try
        {
            // Find the user using the activation code
            $user = Sentry::getUserProvider()->findByActivationCode($activationCode);

            // Attempt to activate the user
            if($user->attemptActivation($activationCode))
            {
                $message = trans("Your account is successfully activated.");
                $activated = true;
            }
            else
            {
                // User activation failed
                $message = trans("Your account could not be activated.");
            }
        }
        catch(\Exception $e)
        {
            // User not found, activation found or other errors
            $message = trans("Your account could not be activated.");
        }

        $this->layout = View::make(Config::get('syntara::views.user-activation'), array('activated' => $activated, 'message' => $message));
    }

    /**
    * View user account
    * @param int $userId
    */
    public function getShow($userId)
    {
      $currentUser = Sentry::getUser();
      if($currentUser->hasAnyAccess(['users-management_edit']) || $currentUser->id == $userId)
      {
        try
        {
          $user = Sentry::findUserById($userId);
          $throttle = Sentry::findThrottlerByUserId($userId);
          $jobTitles = JobTitle::all();
          $groups = Sentry::findAllGroups();

          // get user permissions
          $permissions = Permission::orderBy('value')->get();
          $userPermissions = $user->getPermissions();

          $params['user'] = $user;
          $params['departments'] = Department::all();
          $params['throttle'] = $throttle;
          $params['jobTitles'] = $jobTitles;
          $params['groups'] = $groups;
          $params['permissions'] = $permissions;
          $params['userPermissions'] = array_keys($userPermissions);

          return View::make(Config::Get('view.backend.user-profile'), $params);
            
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->layout = View::make(Config::get('syntara::views.error'), array('message' => trans('syntara::users.messages.not-found')));
        }
      }else
      {
        $this->layout = View::make(Config::get('view.backend.error'), array('message' => 'Bạn không có quyền truy cập khu vực này'));    
        $this->layout->title = 'Từ chối truy cập';
      }
    }

    /**
    * Update user account
    * @param int $userId
    * @return Response
    */
    public function putShow($userId)
    {
      $currentUser = Sentry::getUser();
      if($currentUser->hasAnyAccess(['users-management_edit']) || $currentUser->id == $userId)
      {
        try
        {
          $user = Sentry::findUserById($userId);
          $form_name = Input::get('form_name');
          switch ($form_name) {
            case 'personal_info':
              $validator = new BackendValidator(Input::all(), 'user-update-personal');
              if(!$validator->passes())
              {
                  return Response::json(array('userUpdated' => false, 'errorMessages' => $validator->getErrors()));
              }

              $birth_date = explode('/',Input::get('birth_date'));
              $user->email = Input::get('email');
              $user->avatar = Input::get('avatar');
              $user->full_name = Input::get('full_name');
              $user->birth_date = Carbon::createFromDate($birth_date[2], $birth_date[1], $birth_date[0]);
              $user->phone_num = Input::get('mobile_number');
              $user->address = Input::get('address');
              break;
            case 'change_pass':
              $validator = new BackendValidator(Input::all(), 'user-change-pass');
              if(!$validator->passes())
              {
                  return Response::json(array('userUpdated' => false, 'errorMessages' => $validator->getErrors()));
              }
              if($user->checkPassword(Input::get('current_password')))
              {
                  $user->password = Input::get('new_password');
              }
              else
              {
                  return Response::json(array('userUpdated' => true, 'message' => trans('all.messages.user-pass-not-match'), 'messageType' => 'error'));
              }
              break;
            case 'privacy_manage':
              $currentUser = Sentry::getUser();
              if(!$currentUser->hasAnyAccess(['users-management_edit']))
              {
                App::abort(500, 'Bạn không có quyền truy cập khu vực này');
              }
              $validator = new BackendValidator(Input::all(), 'user-update-privacy');
              if(!$validator->passes())
              {
                  return Response::json(array('userUpdated' => false, 'errorMessages' => $validator->getErrors()));
              }

              $permissionsValues = Input::get('select_permissions');
              $permissions = $this->_formatPermissions($permissionsValues);

              // Find the user using the user id

              
              $permissions = (empty($permissions)) ? '' : json_encode($permissions);
              $hasPermissionManagement = $currentUser->hasAccess('permissions-management') || $currentUser->hasAccess('superuser');
              if($hasPermissionManagement === true)
              {
                  DB::table('users')
                      ->where('id', $userId)
                      ->update(array('permissions' => $permissions));
              }

              $pass = Input::get('password');
              if(!empty($pass))
              {
                  $user->password = $pass;
              }

              // if the user has permission to update
              $banned = Input::get('banned');
              if(isset($banned) && Sentry::getUser()->getId() !== $user->getId())
              {

                  $this->_banUser($userId, $banned);
              }

              if($currentUser->hasAccess('user-group-management'))
              {
                  $groups = (Input::get('select_groups') === null) ? array() : explode(',',Input::get('select_groups'));
                  $userGroups = $user->getGroups()->toArray();
                  
                  foreach($userGroups as $group)
                  {
                      if(!in_array($group['id'], $groups))
                      {
                          $group = Sentry::findGroupById($group['id']);
                          $user->removeGroup($group);
                      }
                  }

                  if(isset($groups) && is_array($groups))
                  {
                      foreach($groups as $groupId)
                      {
                          $group = Sentry::findGroupById($groupId);
                          $user->addGroup($group);
                      }
                  }
              }

              $user->job_title = Input::get('select_job_titles');
              $user->department_id = Input::get('select_department');
              $user->username = Input::get('username');
              break;

            default:
              return Response::json(array('userUpdated' => true, 'message' => trans('all.messages.user-wrong-form'), 'messageType' => 'error'));
              break;
          }

          // Update the user
          if($user->save())
          {
            return Response::json(array('userUpdated' => true, 'message' => trans('all.messages.user-update-success'), 'messageType' => 'success'));
          }
          else 
          {
            return Response::json(array('userUpdated' => false, 'message' => trans('all.messages.user-update-fail'), 'messageType' => 'error'));
          }
        }
        catch(\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return Response::json(array('userUpdated' => false, 'message' => trans('all.messages.user-email-exists'), 'messageType' => 'error'));
        }
        catch(\Exception $e)
        {
            return Response::json(array('userUpdated' => false, 'message' => $e->getMessage(), 'messageType' => 'error'));
        }
      }else
      {
        $this->layout = View::make(Config::get('view.backend.error'), array('message' => 'Bạn không có quyền truy cập khu vực này'));    
        $this->layout->title = 'Từ chối truy cập';
      }
    }

    protected function _formatPermissions($permissionsValues)
    {
        $permissions = array();
        if(!empty($permissionsValues))
        {
            foreach($permissionsValues as $key)
            {
               $permissions[$key] = 1;
            }
        }

        return $permissions;
    }

    protected function _banUser($userId, $value)
    {
        $throttle = Sentry::findThrottlerByUserId($userId);
        if($value === 'no' && $throttle->isBanned() === true)
        {
            $throttle->unBan();
        }
        elseif($value === 'yes' && $throttle->isBanned() === false)
        {
            $throttle->ban();
        }
    }

    protected function structSelect2($user, $job_title_name=null)
    {
      $user_lite = array();
      if ($job_title_name) $user_lite['job_title_name'] = rtrim($job_title_name,', ');
      $user_lite['id'] = $user->id;
      $user_lite['text'] = $user->username;
      $user_lite['full_name'] = $user->full_name;
      $user_lite['phone_num'] = $user->phone_num;
      $user_lite['address'] = $user->address;
      return $user_lite;
    }
}
