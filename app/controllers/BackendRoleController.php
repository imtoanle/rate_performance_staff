<?php 
use Validators\Backend as BackendValidator;
class BackendRoleController extends BackendBaseController
{
  /**
  * List of permissions
  */
  public function getIndex()
  {
    $roles = Role::whereNotIn('id', array(Config::get('variable.head-department-role-id')))->get();
    $params['roles'] = $roles;
    $this->layout = View::make(Config::get('view.backend.roles-index'), $params);
    #$this->layout->title = trans('syntara::permissions.titles.list');
    #$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
  }

  /**
  * Create group
  */
  public function postCreate()
  {
    $validator = new BackendValidator(Input::all(), 'role-create');

    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }

    $role = new Role;
    $role->fill(array(
      'name' => Input::get('role_name'),
      ));

    if($role->save())
    {
      return Response::json(array('actionStatus' => true, 'itemId' => $role->id, 'message' => trans('all.messages.role-created'), 'messageType' => 'success'));
    }else
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.role-create-failed'), 'messageType' => 'error'));
    }
  }

   
  /**
     * Edit group action
     * @param int $groupId
     */
  public function putShow($roleId)
  {
    $this->_protect_head_department_role(Input::get('role_id'));
    try
    {
      $role = Role::find(Input::get('role_id'));

      $validator = new BackendValidator(Input::all(), 'role-create');
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $role->name = Input::get('role_name');

      if($role->save())
      {
        return Response::json(array('actionStatus' => true, 'itemId' => $role->id, 'message' => trans('all.messages.role-updated'), 'messageType' => 'success'));
      }else
      {
        return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.role-update-failed'), 'messageType' => 'error'));
      }

    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.role-not-found'), 'messageType' => 'error'));
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
    $roleArrays = explode(',', $groupIds);

    foreach ($roleArrays as $roleId) {
      try
      {
        $this->_protect_head_department_role($roleId);
        $role = Role::find($roleId);
        $role->delete();
      }
      catch (\Exception $e)
      {
        return Response::json(array('deletedGroup' => false, 'message' => trans('all.messages.role-not-found'), 'messageType' => 'error'));
      }
    }
    
    return Response::json(array('deletedGroup' => true, 'message' => trans('all.messages.role-delete-success'), 'messageType' => 'success'));
      
  }

  protected function _protect_head_department_role($roleId)
  {
    if ($roleId == Config::get('variable.head-department-role-id'))
    {
      App::abort(500, trans('all.messages.role-action-head-department'));
    }
  }
}
