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

    public function fullTextSearch()
    {
      $userArr = array();
      if(Input::has('user_id'))
      {
        $userIds = explode(',',Input::get('user_id'));
        $users = User::whereIn('id', $userIds)->get();
        foreach ($users as $user) {
          $userArr[] = $this->structSelect2($user);
        }

      }else
      {
        $query = Input::get('q');
        $group_ids = Input::has('groups_id') ? Input::get('groups_id') : array();
        $select_id = Input::get('select_id');

        $users = User::select('id','username', 'full_name', 'phone_num', 'address')
                    ->where('username', 'LIKE', '%'.$query.'%')
                    ->orWhere('full_name', 'LIKE', '%'.$query.'%')
                    ->orWhere('phone_num', 'LIKE', '%'.$query.'%')
                    ->orWhere('address', 'LIKE', '%'.$query.'%')
          ->paginate(Input::get('page_limit'));
        
        foreach ($users as $user) {
          $group_name_tmp = '';
          $user_in_group = 0;

          foreach ($user->getGroups() as $group) {
            $group_name_tmp .= $group->name.', ';
            if (in_array($group->id, $group_ids)) $user_in_group++;
          }
     
          if ($user_in_group || $select_id == 'select2_voter')
          {
            $userArr[] = $this->structSelect2($user, $group_name_tmp);
          }
        }
      }
      return Response::json($userArr);
    }
    public function getIndex()
    {
        // get alls users
        $params['users'] = Sentry::findAllUsers();
        
        $this->layout = View::make(Config::get('view.backend.users-index'), $params);
        //$this->layout->title = trans('syntara::users.titles.list');
        //$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.users');
    }

    /**
    * Show new user form view
    */
    public function getCreate()
    {
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
                'full_name' => (string)Input::get('full_name'),
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

        return Response::json(array('userCreated' => true, 'redirectUrl' => URL::route('listUsers')));
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
            return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.not-found'), 'messageType' => 'danger'));
        }
        catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
        {
            return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.activate-already'), 'messageType' => 'danger'));
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
        try
        {
            $user = Sentry::findUserById($userId);
            $throttle = Sentry::findThrottlerByUserId($userId);
            $groups = Sentry::findAllGroups();

            // get user permissions
            $permissions = Permission::orderBy('value')->get();
            $userPermissions = $user->getPermissions();

            $params['user'] = $user;
            $params['throttle'] = $throttle;
            $params['groups'] = $groups;
            $params['permissions'] = $permissions;
            $params['userPermissions'] = array_keys($userPermissions);

            return View::make(Config::Get('view.backend.user-profile'), $params);
            
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->layout = View::make(Config::get('syntara::views.error'), array('message' => trans('syntara::users.messages.not-found')));
        }
    }

    /**
    * Update user account
    * @param int $userId
    * @return Response
    */
    public function putShow($userId)
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
              $validator = new BackendValidator(Input::all(), 'user-update-privacy');
              if(!$validator->passes())
              {
                  return Response::json(array('userUpdated' => false, 'errorMessages' => $validator->getErrors()));
              }

              $permissionsValues = Input::get('select_permissions');
              $permissions = $this->_formatPermissions($permissionsValues);

              // Find the user using the user id

              $currentUser = Sentry::getUser();
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
            return Response::json(array('userUpdated' => false, 'message' => trans('all.messages.user-update-fail'), 'messageType' => 'danger'));
          }
        }
        catch(\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return Response::json(array('userUpdated' => false, 'message' => trans('all.messages.user-email-exists'), 'messageType' => 'danger'));
        }
        catch(\Exception $e)
        {
            return Response::json(array('userUpdated' => false, 'message' => trans('all.messages.user-name-exists'), 'messageType' => 'danger'));
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

    protected function structSelect2($user, $group_name=null)
    {
      $user_lite = array();
      if ($group_name) $user_lite['group_name'] = rtrim($group_name,', ');
      $user_lite['id'] = $user->id;
      $user_lite['text'] = $user->username;
      $user_lite['full_name'] = $user->full_name;
      $user_lite['phone_num'] = $user->phone_num;
      $user_lite['address'] = $user->address;
      return $user_lite;
    }
}