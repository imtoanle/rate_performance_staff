<?php
use Validators\Backend as BackendValidator;
class BackendVoteController extends BackendBaseController 
{

  /**
  * Display a list of all votes
  *
  * @return Response
  */
  public function getIndex()
  {

    /*
    $groups = Group::all();
    $groupArrs = array();
    foreach ($groups as $group) {
      $groupArrs[$group->id] = $group->name;
    }
    //user
    $users = User::all();
    $userArrs = array();
    foreach ($users as $user) {
      $userArrs[$user->id]['username'] = $user->username;
      $userArrs[$user->id]['full_name'] = $user->full_name;
    }
    */
    $votes = Vote::all();
    $params['votes'] = $votes;

    $this->layout = View::make(Config::get('view.backend.votes-index'), $params);
    
  }

  public function getCreate()
  {
    $params['jobTitles'] = JobTitle::all();
    $this->layout = View::make(Config::get('view.backend.vote-create'), $params);
    
  }

  public function postCreate()
  {
    $validator = new BackendValidator(Input::all(), 'vote-create');
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }
    $voter_list = array_combine(Input::get('voter_id'), Input::get('voter_role'));

    $vote = Vote::create(array(
      'vote_code' => Input::get('vote_code'),
      'title' => Input::get('title'),
      'object_entitled_vote' => Input::get('object_vote_list'),
      'entitled_vote' => Input::get('entitled_vote'),
      'voter' => json_encode($voter_list),
      ));

    if($vote->save())
    {
      return Response::json(array('voteCreated' => true, 'message' => trans('all.messages.vote-create-success'), 'messageType' => 'success', 'redirectUrl' => URL::route('listVotes')));
    }
    else
    {
      return Response::json(array('voteCreated' => false, 'message' => trans('all.messages.vote-create-fail'), 'messageType' => 'error'));
    }
  }

  public function getShow($voteId)
  {
    $vote = Vote::find($voteId);
    if ($vote->status == Config::get('variable.vote-status.closed'))
    {
      App::abort(500, trans('all.messages.cant-edit-closed-vote'));
    }
    
    $params['vote'] = $vote;
    $params['groups'] = Sentry::findAllGroups();
    return View::make(Config::get('view.backend.vote-show'), $params);
  }

  public function putShow($voteId)
  {
    $validator = new BackendValidator(Input::all(), 'vote-create');
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }
    
    $vote = Vote::find($voteId);
    if ($vote->status == Config::get('variable.vote-status.closed'))
    {
      App::abort(500, trans('all.messages.cant-edit-closed-vote'));
    }

    $vote->title = Input::get('title');
    $vote->object_entitled_vote = Input::get('select2_groups');
    $vote->entitled_vote = Input::get('select2_entitled_vote');
    $vote->voter = Input::get('select2_voter');

    if($vote->save())
    {
      return Response::json(array('voteUpdated' => true, 'message' => trans('all.messages.vote-create-success'), 'messageType' => 'success'));
    }
    else
    {
      return Response::json(array('voteUpdated' => false, 'message' => trans('all.messages.vote-create-fail'), 'messageType' => 'error'));
    }
  }

  public function delete()
  {
    $voteIds = Input::get('itemIds');
    $voteArrays = explode(',', $voteIds);

    foreach ($voteArrays as $voteId) {
      try
        {
          $vote = Vote::find($voteId);
          if (in_array($vote->status, array(Config::get('variable.vote-status.closed'), Config::get('variable.vote-status.opened'))))
          {
            App::abort(500, trans('all.messages.only-can-delete-newly-vote'));
          }
          $vote->delete();
        }
        catch (\Cartalyst\Sentry\Votes\VoteNotFoundException $e)
        {
            return Response::json(array('deletedVote' => false, 'message' => trans('all.messages.vote-not-found'), 'messageType' => 'error'));
        }
    }

    return Response::json(array('deletedVote' => true, 'message' => trans('all.messages.vote-remove-success'), 'messageType' => 'success'));
  }

  protected function _convert_voter_list($voter_id, $voter_role)
  {
    $countArr = count($voter_id);
    $dataArr = array();
    for($i=0;$i<$countArr;$i++)
    {
      $dataArr[] = array(
        'user_id' => $voter_id[$i],
        'role' => $voter_role[$i],
      );
    }
    return json_encode($dataArr);
  }
}