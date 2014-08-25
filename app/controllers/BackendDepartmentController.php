<?php 
use Validators\Backend as BackendValidator;
class BackendDepartmentController extends BackendBaseController
{
  /**
  * List of permissions
  */
  public function getIndex()
  {
      $departments = Department::all();
      $params['departments'] = $departments;
      $this->layout = View::make(Config::get('view.backend.departments-index'), $params);
      #$this->layout->title = trans('syntara::permissions.titles.list');
      #$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
  }

  /**
  * Create group
  */
  public function postCreate()
  {

    

    $validator = new BackendValidator(Input::all(), 'department-create');

    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }

    $department = new Department;
    $department->fill(array(
      'name' => Input::get('department_name'),
      ));

    if($department->save())
    {
      return Response::json(array('actionStatus' => true, 'itemId' => $department->id, 'message' => trans('all.messages.department-created'), 'messageType' => 'success'));
    }else
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.department-create-failed'), 'messageType' => 'danger'));
    }
  }

   
  /**
     * Edit group action
     * @param int $groupId
     */
  public function putShow($departmentId)
  {
    try
    {
      $department = Department::find(Input::get('department_id'));

      $validator = new BackendValidator(Input::all(), 'department-create');
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $department->name = Input::get('department_name');

      if($department->save())
      {
        return Response::json(array('actionStatus' => true, 'itemId' => $department->id, 'message' => trans('all.messages.department-updated'), 'messageType' => 'success'));
      }else
      {
        return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.department-update-failed'), 'messageType' => 'danger'));
      }

    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.department-not-found'), 'messageType' => 'danger'));
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
    $departmentArrays = explode(',', $groupIds);

    foreach ($departmentArrays as $departmentId) {
      try
      {
          $department = Department::find($departmentId);
          $department->delete();
      }
      catch (\Exception $e)
      {
        return Response::json(array('deletedGroup' => false, 'message' => trans('all.messages.department-not-found'), 'messageType' => 'error'));
      }
    }
    
    return Response::json(array('deletedGroup' => true, 'message' => trans('all.messages.department-delete-success'), 'messageType' => 'success'));
      
  }

}