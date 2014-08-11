<?php 
use Validators\Backend as BackendValidator;
class BackendGroupController extends BackendBaseController
{
  /**
  * List of permissions
  */
  public function getIndex()
  {
      $groups =  Sentry::findAllGroups();
      $this->layout = View::make(Config::get('view.backend.groups-index'), array('groups' => $groups));
      #$this->layout->title = trans('syntara::permissions.titles.list');
      #$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
  }

  /**
   * Show new permission view
   */
  public function getCreate()
  {
  
    $params['permissions'] = Permission::orderBy('value')->get();

    $this->layout = View::make(Config::get('view.backend.group-create'), $params);
      //$this->layout->title = trans('syntara::permissions.titles.new');
      //$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_permission');
  }

  /**
  * Create group
  */
  public function postCreate()
  {
    $groupname = Input::get('group_name');

    $validator = new BackendValidator(Input::all(), 'usergroup-update');

    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }

    $permissions = $this->_create_permissions_array(Input::get('select_permissions'));

    try
    {
      // create group
      Sentry::getGroupProvider()->create(array(
          'name' => $groupname,
          'permissions' => $permissions,
      ));
    }
    catch (\Cartalyst\Sentry\Groups\NameRequiredException $e) {}
    catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
    {
      return Response::json(array('groupCreated' => false, 'message' => trans('all.messages.group-update-exists'), 'messageType' => 'danger'));
    }

    return Response::json(array('groupCreated' => true,  'redirectUrl' => URL::route('listGroups')));
  }

   

  public function getShow($groupId)
  {
    $group = Sentry::findGroupById($groupId);
    
    // users not in group
    $candidateUsers = array();
    $allUsers = Sentry::findAllUsers();
    foreach($allUsers as $user)
    {
        if(!$user->inGroup($group))
        {
            $candidateUsers[] = $user;
        }
    }
    $params['group'] = $group;
    $params['candidateUsers'] = $candidateUsers;
    $params['usersInGroup'] = Sentry::findAllUsersInGroup($group);
    $params['permissions'] = Permission::orderBy('value')->get();
    $params['groupPermissions'] = array_keys($group->getPermissions());

    return View::make(Config::get('view.backend.group-edit'), $params);
  }

  public function addUserInGroup()
  {
    try
    {
        $user = Sentry::findUserById(Input::get('userId'));
        $group = Sentry::findGroupById(Input::get('groupId'));
        $user->addGroup($group);

        return Response::json(array('actionPerformed' => true, 'message' => trans('all.messages.group-user-add-success'), 'data' => array('userId' => $user->id, 'linkEdit' => route('showUser', $user->id), 'linkRemoveGroup' => route('deleteUserGroup', array($group->id, $user->id)), 'username' => $user->username, 'full_name' => $user->full_name), 'messageType' => 'success'));
    }
    catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
    {
        return Response::json(array('actionPerformed' => false, 'message' => trans('all.messages.user-not-found'), 'messageType' => 'error'));
    }
    catch(\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
    {
        return Response::json(array('actionPerformed' => false, 'message' => trans('all.messages.group-not-found'), 'messageType' => 'error'));
    }
  }

  public function deleteUserFromGroup($groupId, $userId)
  {
    try
    {
        $user = Sentry::findUserById($userId);
        $group = Sentry::findGroupById($groupId);
        $user->removeGroup($group);
        
        return Response::json(array('actionPerformed' => true, 'data' => array('userId' => $user->id, 'username' => $user->username, 'full_name' => $user->full_name) , 'message' => trans('all.messages.group-user-removed-success'), 'messageType' => 'success'));
    }
    catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
    {
        return Response::json(array('actionPerformed' => false, 'message' => trans('all.messages.user-not-found'), 'messageType' => 'error'));
    }
    catch(\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
    {
        return Response::json(array('actionPerformed' => false, 'message' => trans('all.messages.group-not-found'), 'messageType' => 'error'));
    }
  }

  /**
     * Edit group action
     * @param int $groupId
     */
    public function putShow($groupId)
    {
      $groupname = Input::get('group_name');
      $validator = new BackendValidator(Input::all(), 'usergroup-update');

      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $permissions = $this->_create_permissions_array(Input::get('select_permissions'));

      try
      {
        $group = Sentry::findGroupById($groupId);
        $group->name = $groupname;
        //$group->permissions = $permissions;
        
        // delete permissions in db
        DB::table('groups')
            ->where('id', $groupId)
            ->update(array('permissions' => json_encode($permissions)));
        if($group->save())
        {
          return Response::json(array('actionStatus' => true, 'message' => trans('all.messages.group-update-success'), 'messageType' => 'success'));
        }
        else 
        {
            return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.group-update-fail'), 'messageType' => 'error'));
        }
      }
      catch (\Cartalyst\Sentry\Groups\NameRequiredException $e) {}
      catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
      {
          return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.group-update-exists'), 'messageType' => 'error'));
      }
  }


  /**
 * Delete group
 * @param  int $groupId
 * @return Response
 */
  public function delete()
  {
    $groupIds = Input::get('itemIds');
    $groupArrays = explode(',', $groupIds);

    foreach ($groupArrays as $groupId) {
      try
      {
          $group = Sentry::findGroupById($groupId);
          $group->delete();
      }
      catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
      {
          return Response::json(array('deletedGroup' => false, 'message' => trans('all.messages.group-not-found'), 'messageType' => 'error'));
      }
    }
    
    return Response::json(array('deletedGroup' => true, 'message' => trans('all.messages.group-delete-success'), 'messageType' => 'success'));
      
  }

  protected function _create_permissions_array($permissionsValues)
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
}