<?php 
use Validators\Backend as BackendValidator;
class RatingTypeBackendController extends BackendBaseController
{
  /**
  * List of permissions
  */
  public function getIndex()
  {
      $rating_types = RatingType::all();
      $params['rating_types'] = $rating_types;
      $this->layout = View::make(Config::get('view.backend.rating-types-index'), $params);
      #$this->layout->title = trans('syntara::permissions.titles.list');
      #$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
  }

  /**
  * Create group
  */
  public function postCreate()
  {
    $validator = new BackendValidator(Input::all(), 'rating-type-create');

    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }

    $rating_type = new RatingType;
    $rating_type->fill(array(
      'name' => Input::get('rating_type_name'),
      'value' => Input::get('rating_type_value'),
      ));

    if($rating_type->save())
    {
      return Response::json(array('actionStatus' => true, 'itemId' => $rating_type->id, 'message' => trans('all.messages.rating-type-created'), 'messageType' => 'success'));
    }else
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.rating-type-create-failed'), 'messageType' => 'danger'));
    }
  }

   
  /**
     * Edit group action
     * @param int $groupId
     */
  public function putShow($rating_typeId)
  {
    try
    {
      $rating_type = RatingType::find(Input::get('rating_type_id'));

      $validator = new BackendValidator(Input::all(), 'rating-type-create');
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $rating_type->name = Input::get('rating_type_name');
      $rating_type->value = Input::get('rating_type_value');

      if($rating_type->save())
      {
        return Response::json(array('actionStatus' => true, 'itemId' => $rating_type->id, 'message' => trans('all.messages.rating-type-updated'), 'messageType' => 'success'));
      }else
      {
        return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.rating-type-update-failed'), 'messageType' => 'danger'));
      }

    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.rating-type-not-found'), 'messageType' => 'danger'));
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
    $rating_typeArrays = explode(',', $groupIds);

    foreach ($rating_typeArrays as $rating_typeId) {
      try
      {
          $rating_type = RatingType::find($rating_typeId);
          $rating_type->delete();
      }
      catch (\Exception $e)
      {
        return Response::json(array('deletedGroup' => false, 'message' => trans('all.messages.rating-type-not-found'), 'messageType' => 'error'));
      }
    }
    
    return Response::json(array('deletedGroup' => true, 'message' => trans('all.messages.rating-type-delete-success'), 'messageType' => 'success'));
      
  }

}