<?php 
use Validators\Backend as BackendValidator;
class BackendJobTitleController extends BackendBaseController
{
  /**
  * List of permissions
  */
  public function getIndex()
  {
      $jobTitles = JobTitle::all();
      $params['jobTitles'] = $jobTitles;
      $this->layout = View::make(Config::get('view.backend.job-titles-index'), $params);
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

    $name = Input::get('job_name');

    $validator = new BackendValidator(Input::all(), 'job-title-create');

    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }

    $jobTitle = new JobTitle;
    $jobTitle->fill(array(
      'name' => $name,
      ));

    if($jobTitle->save())
    {
      return Response::json(array('actionStatus' => true, 'itemId' => $jobTitle->id, 'message' => trans('all.messages.job-title-created'), 'messageType' => 'success'));
    }else
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.job-title-create-failed'), 'messageType' => 'danger'));
    }
  }

   
  /**
     * Edit group action
     * @param int $groupId
     */
  public function putShow($jobTitleId)
  {
    try
    {
      $jobTitle = JobTitle::find(Input::get('job_title_id'));
      

      $validator = new BackendValidator(Input::all(), 'job-title-create');
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $jobTitle->name = Input::get('job_name');

      if($jobTitle->save())
      {
        return Response::json(array('actionStatus' => true, 'itemId' => $jobTitle->id, 'message' => trans('all.messages.job-title-updated'), 'messageType' => 'success'));
      }else
      {
        return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.job-title-update-failed'), 'messageType' => 'danger'));
      }

    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.job-title-not-found'), 'messageType' => 'danger'));
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
    $jobTitleArrays = explode(',', $groupIds);

    foreach ($jobTitleArrays as $jobId) {
      try
      {
          $jobId = JobTitle::find($jobId);
          $jobId->delete();
      }
      catch (\Exception $e)
      {
        return Response::json(array('deletedGroup' => false, 'message' => trans('all.messages.job-title-not-found'), 'messageType' => 'error'));
      }
    }
    
    return Response::json(array('deletedGroup' => true, 'message' => trans('all.messages.job-title-delete-success'), 'messageType' => 'success'));
      
  }

}