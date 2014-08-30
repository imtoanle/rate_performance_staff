<?php 
use Validators\Backend as BackendValidator;
class BackendRoleController extends BackendBaseController
{
  /**
  * List of permissions
  */
  public function getIndex()
  {
      $roles = Role::all();
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
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.role-create-failed'), 'messageType' => 'danger'));
    }
  }

   
  /**
     * Edit group action
     * @param int $groupId
     */
  public function putShow($roleId)
  {
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
        return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.role-update-failed'), 'messageType' => 'danger'));
      }

    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.role-not-found'), 'messageType' => 'danger'));
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

}