<?php
use Validators\Backend as BackendValidator;
class BackendUserVoteController extends BackendBaseController 
{

  /**
  * Display a list of all votes
  *
  * @return Response
  */
  public function getQuickVote()
  {
    return View::make(Config::get('view.backend.user-votes-quick'));
  }

  public function getIndex()
  {
    $currentUser = Sentry::getUser();
    $pattern = '^'.$currentUser->id.',|,'.$currentUser->id.',|,'.$currentUser->id.'$';
    $canVotes = Vote::whereRaw("voter regexp '".$pattern."'")->get();
    #$entitledVotes = Vote::whereRaw("entitled_vote regexp '".$pattern."'")->get();
    
    $params['canVotes'] = $canVotes;
    #$params['entitledVotes'] = $entitledVotes;
    $this->layout = View::make(Config::get('view.backend.user-votes-index'), $params);
    
  }

  public function getCreate()
  {
    $params['groups'] = Sentry::findAllGroups();
    $this->layout = View::make(Config::get('view.backend.vote-create'), $params);
    
  }

  public function postCreate()
  {
    $validator = new BackendValidator(Input::all(), 'vote-create');
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }
    //return Input::all();
    $vote = Vote::create(array(
      'title' => Input::get('title'),
      'object_entitled_vote' => Input::get('select2_groups'),
      'entitled_vote' => Input::get('select2_entitled_vote'),
      'voter' => Input::get('select2_voter'),
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
}