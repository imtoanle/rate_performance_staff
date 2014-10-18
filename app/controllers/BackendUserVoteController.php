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
    $currentUser = Sentry::getUser();
    $pattern = '"user_id":"'.$currentUser->id.'"';
    $canVotes = Vote::whereRaw("voter regexp '".$pattern."'")->orderBy('vote_group_id', 'asc')->get();

    $canVoteGroupId = Vote::select('vote_group_id')->whereRaw("voter regexp '".$pattern."'")->groupBy('vote_group_id')->get();

    $voteGroupId = [];
    foreach ($canVoteGroupId as $value) {
      $voteGroupId[] = $value->vote_group_id;
    }

    $voteGroupId = empty($voteGroupId) ? [''] : $voteGroupId;
    $canVoteGroup = VoteGroup::whereIn('id', $voteGroupId)->get();

    $params['canVotes'] = $canVotes;
    $params['canVoteGroup'] = $canVoteGroup;
    $params['currentUser'] = $currentUser;
    if(Request::Ajax())
      return View::make(Config::get('view.backend.user-votes-quick-little'), $params);
    else
      return View::make(Config::get('view.backend.user-votes-quick'), $params);
  }

  public function getIndexHeadGradingVote()
  {
    if (Request::Ajax())
    {
      if (Input::get('mode') == 'datatable')
      {
        $currentUser = Sentry::getUser();
        $pattern = '"user_id":"'.$currentUser->id.'","role_id":"'.Config::get('variable.head-department-role-id').'"';
        
        $votes = Vote::select(array('vote_group_id', 'department_id', 'id as vote_code', 'id as title', 'id as department_name', 'id as actions'))->whereRaw("voter regexp '".$pattern."'");
      return Datatables::of($votes)
        ->remove_column('vote_group_id', 'department_id')
        ->edit_column('vote_code', function($row){
          return $row->voteGroup->vote_code;
        })
        ->edit_column('title', function($row){
          return $row->voteGroup->title;
        })
        ->edit_column('department_name', function($row){
          return $row->department->name;
        })
        ->edit_column('actions', '
            <a href="{{route(\'detailHeadGradingUserVote\', $actions)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-search"></i> {{trans(\'all.grading\')}}</a>
          ')
        #->filter_column('vote_code', 'where', 'Vote.vote_code', '=', '$1')
        ->make();
      }
    }
    
    return View::make(Config::get('view.backend.head-grading-index'));
  }

  public function getDetailHeadGradingVote($voteId)
  {
    $vote = Vote::find($voteId);
    $voterArr = [];
    foreach (json_decode($vote->voter) as $value) {
      $voterArr[$value->role_id][] = $value->user_id;
    }

    //find max voter
    $maxVoter = 0;
    foreach ($voterArr as $value) {
      if(count($value) > $maxVoter)
      {
        $maxVoter = count($value);
      }
    }
    $params['voterArr'] = $voterArr;
    $params['maxVoter'] = $maxVoter;
    $params['vote'] = $vote;

    return View::make(Config::get('view.backend.head-grading-vote'), $params);
  }

  public function postQuickDetailHeadGradingVote()
  {
    if(Input::get('name') == 'mark')
    {
      $validator = new BackendValidator(Input::all(), 'vote-result-mark');
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $generalResult = GeneralResult::firstOrNew(array(
        'vote_id' => Input::get('pk'),
        'user_id' => Input::get('entitled_vote'),
      ));

      $generalResult->mark = Input::get('value');
    }

    if($generalResult->save())
    {
      return Response::json(array('actionStatus' => true));
    }else
    {
      return Response::json(array('actionStatus' => false));
    }
  }

  public function postQuickVote()
  {
    if(Input::get('name') == 'mark')
    {
      $validator = new BackendValidator(Input::all(), 'vote-result-mark');
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }

      $voteResult = VoteResult::firstOrNew(array(
        'vote_id' => Input::get('vote'),
        'voter_id' => Input::get('voter'),
        'entitled_vote_id' => Input::get('entitled_vote'),
        ));
      if (empty($voteResult->mark))
      {
        $criteriaMark[] = array('criteria_id' => Input::get('pk'), 'mark' => Input::get('value'));
      }else
      {
        $decodeMark = json_decode($voteResult->mark, true);
        $checkExist = 0;
        $newMark = array();
          foreach ($decodeMark as $value) {
            if ($value['criteria_id'] == Input::get('pk'))
            {
              $value['mark'] = Input::get('value');
              $checkExist++;
            }
            $newMark[] = $value;
          }
        if ($checkExist == 0)
        {
          $newMark[] = array('criteria_id' => Input::get('pk'), 'mark' => Input::get('value'));
        }
        $criteriaMark = $newMark;
      }
      $voteResult->mark = json_encode($criteriaMark);
    }
    else if(Input::get('name') == 'content')
    {
      $voteResult = VoteResult::firstOrNew(array(
        'vote_id' => Input::get('vote'),
        'voter_id' => Input::get('voter'),
        'entitled_vote_id' => Input::get('entitled_vote'),
        ));
      $voteResult->content = Input::get('value');
    }

    if($voteResult->save())
    {
      return Response::json(array('actionStatus' => true));
    }else
    {
      return Response::json(array('actionStatus' => false));
    }
  }

  public function postQuickMultiVote()
  {
    $vote = Vote::find(Input::get('vote_id'));
    $entitledUserIds = array_unique(explode(',', Input::get('entitled_user')));
    try
    {
      foreach ($entitledUserIds as $userId) {
        $voteResult = VoteResult::firstOrNew(array(
        'vote_id' => Input::get('vote_id'),
        'voter_id' => Input::get('voter_id'),
        'entitled_vote_id' => $userId,
        ));

        if(Input::get('mode') == 'mark')
        {
          $criteriaIds = explode(',',$vote->criteria);
          $criteriaMark = [];
          if (empty($voteResult->mark))
          {
            foreach ($criteriaIds as $criteriaId) {
              $criteriaMark[] = array('criteria_id' => $criteriaId, 'mark' => Input::get('form_mark'));
            }
          }else
          {
            $decodeMark = json_decode($voteResult->mark, true);

            foreach ($criteriaIds as $criteriaId) {
              $pattern = '/"criteria_id":"'.$criteriaId.'"/';
              $pattern1 = '/"criteria_id":"'.$criteriaId.'","mark":""/';
              if (!preg_match($pattern, $voteResult->mark))
              {
                $newMark = array('criteria_id' => $criteriaId, 'mark' => Input::get('form_mark'));
                $decodeMark = array_merge($decodeMark, $newMark);
              }else if(preg_match($pattern1, $voteResult->mark))
              {
                foreach ($decodeMark as &$value) {
                  if($value['criteria_id'] == $criteriaId)
                  {
                    $value['mark'] = Input::get('form_mark');
                  }
                }
              }
            }
              
            $criteriaMark = $decodeMark;
          }
          $voteResult->mark = json_encode($criteriaMark);
        }else
        {
          if(empty($voteResult->content))
          {
            $voteResult->content = Input::get('form_content');
          }
        }
        $voteResult->save();
      }
      return Response::json(array('actionStatus' => true, 'message' => trans('all.messages.quick-multi-vote-success'), 'messageType' => 'success'));
    }catch(\Exception $e)
    {
      return Response::json(array('actionStatus' => false, 'message' => trans('all.messages.quick-multi-vote-fail'), 'messageType' => 'error'));
    }
  }

  public function getIndex()
  {
    if(Request::Ajax())
    {
      $currentUser = Sentry::getUser();
      if(Input::get('mode') == 'view_my_point')
      {
        $pattern = '^'.$currentUser->id.',|,'.$currentUser->id.',|,'.$currentUser->id.'$';

        #$entitledVotes = Vote::whereRaw("entitled_vote regexp '".$pattern."'")->orderBy('vote_group_id', 'asc')->get();
        $entitledVoteGroupIds = Vote::select('vote_group_id')->whereRaw("entitled_vote regexp '".$pattern."'")->groupBy('vote_group_id')->get();
        $arrEntitledVoteGroupIds = array();
        foreach ($entitledVoteGroupIds as $value) {
          $arrEntitledVoteGroupIds[] = $value['vote_group_id'];
        }
        $arrEntitledVoteGroupIds = empty($arrEntitledVoteGroupIds) ? [''] : $arrEntitledVoteGroupIds;
        $voteGroups = VoteGroup::select(array('vote_code', 'title', 'id as vote_group_id','id as actions'))
          ->whereIn('id', $arrEntitledVoteGroupIds);
          #->limit($limit);
        $viewVoteRoute = 'viewMyMark';
      }else if (Input::get('mode') == 'view_my_vote') {
        $pattern = '"user_id":"'.$currentUser->id.'"';
        $canVoteGroupId = Vote::select('vote_group_id')->whereRaw("voter regexp '".$pattern."'")->groupBy('vote_group_id')->get();
        $arrCanVoteGroupIds = array();
        foreach ($canVoteGroupId as $value) {
          $arrCanVoteGroupIds[] = $value['vote_group_id'];
        }
        $arrCanVoteGroupIds = empty($arrCanVoteGroupIds) ? [''] : $arrCanVoteGroupIds;
        $voteGroups = VoteGroup::select(array('vote_code', 'title', 'id as vote_group_id','id as actions'))
          ->whereIn('id', $arrCanVoteGroupIds);
          #->limit($limit);
        $viewVoteRoute = 'viewMyVote';
      }

      return Datatables::of($voteGroups)
        ->edit_column('vote_group_id', function($row){
          $count = Vote::where('vote_group_id', $row->vote_group_id)
            ->whereIn('status', [Config::get("variable.vote-status.newly"), Config::get("variable.vote-status.opened")])
            ->count();
          if ($count > 0)
          {
            return '<span class="label label-success">'.trans("all.opened").'</span>';
          }else
          {
            return '<span class="label label-default">'.trans("all.closed").'</span>';
          }
        })
        ->edit_column('actions', '<a href="{{route(\''.$viewVoteRoute.'\', $actions)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-search"></i> '.trans('all.view').'</a>')
        #->filter_column('vote_code', 'where', 'Vote.vote_code', '=', '$1')
        ->make();
    }

    $this->layout = View::make(Config::get('view.backend.user-votes-index'));
  }

  public function getViewMyMark($voteGroupId)
  {
    $currentUser = Sentry::getUser();
    $pattern = '^'.$currentUser->id.',|,'.$currentUser->id.',|,'.$currentUser->id.'$';
    $voteGroup = VoteGroup::find($voteGroupId);
    $votes = Vote::where('vote_group_id', $voteGroup->id)->whereRaw("entitled_vote regexp '".$pattern."'")->get();
    $params['votes'] = $votes;
    $params['voteGroup'] = $voteGroup;
    $params['currentUser'] = $currentUser;
    return View::make(Config::get('view.backend.view-my-mark'), $params);
  }

  public function getViewMyVote($voteGroupId)
  {
    $currentUser = Sentry::getUser();
    $pattern = '"user_id":"'.$currentUser->id.'"';
    $voteGroup = VoteGroup::find($voteGroupId);
    $votes = Vote::where('vote_group_id', $voteGroup->id)->whereRaw("voter regexp '".$pattern."'")->get();
    $params['votes'] = $votes;
    $params['voteGroup'] = $voteGroup;
    $params['currentUser'] = $currentUser;

    return View::make(Config::get('view.backend.view-my-vote'), $params); 
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