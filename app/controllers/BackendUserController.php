<?php 

use Validators\Backend as BackendValidator;
class BackendUserController extends BackendBaseController 
{

    /**
    * Display a list of all users
    *
    * @return Response
    */
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
            $validator = new BackendValidator(Input::all(), 'user-create');

            $permissionsValues = Input::get('select_permissions');
            $permissions = $this->_formatPermissions($permissionsValues);

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
            $validator = new BackendValidator(Input::all(), 'user-update');

            if(!$validator->passes())
            {
                return Response::json(array('userUpdated' => false, 'errorMessages' => $validator->getErrors()));
            }

            $permissionsValues = Input::get('select_permissions');
            $permissions = $this->_formatPermissions($permissionsValues);

            // Find the user using the user id
            $user = Sentry::findUserById($userId);
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->full_name = Input::get('full_name');

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

            // Update the user
            if($user->save())
            {
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
}