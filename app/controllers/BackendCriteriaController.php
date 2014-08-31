<?php 
use Validators\Backend as BackendValidator;
class BackendCriteriaController extends BackendBaseController
{
  /**
  * List of permissions
  */
  public function getIndex()
  {
      $criterias = Criteria::all();
      $params['criterias'] = $criterias;
      $this->layout = View::make(Config::get('view.backend.criterias-index'), $params);
      #$this->layout->title = trans('syntara::permissions.titles.list');
      #$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
  }

  /**
  * Create group
  */
  public function postCreate()
  {

    

    $validator = new BackendValidator(Input::all(), 'criteria-create');

    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }

    $criteria = new Criteria;
    $criteria->fill(array(
      'name' => Input::get('criteria_name'),
      ));

    if($criteria->save())
    {
      return Response::json(array('actionStatus' => true, 'itemId' => $criteria->id, 'message' => trans('all.messages.criteria-created'), 'messageType' => 'success'));
    }else
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.criteria-create-failed'), 'messageType' => 'danger'));
    }
  }

   
  /**
     * Edit group action
     * @param int $groupId
     */
  public function putShow($criteriaId)
  {
    try
    {
      $criteria = Criteria::find(Input::get('criteria_id'));

      $validator = new BackendValidator(Input::all(), 'criteria-create');
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $criteria->name = Input::get('criteria_name');

      if($criteria->save())
      {
        return Response::json(array('actionStatus' => true, 'itemId' => $criteria->id, 'message' => trans('all.messages.criteria-updated'), 'messageType' => 'success'));
      }else
      {
        return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.criteria-update-failed'), 'messageType' => 'danger'));
      }

    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.criteria-not-found'), 'messageType' => 'danger'));
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
    $criteriaArrays = explode(',', $groupIds);

    foreach ($criteriaArrays as $criteriaId) {
      try
      {
          $criteria = Criteria::find($criteriaId);
          $criteria->delete();
      }
      catch (\Exception $e)
      {
        return Response::json(array('deletedGroup' => false, 'message' => trans('all.messages.criteria-not-found'), 'messageType' => 'error'));
      }
    }
    
    return Response::json(array('deletedGroup' => true, 'message' => trans('all.messages.criteria-delete-success'), 'messageType' => 'success'));
      
  }

}