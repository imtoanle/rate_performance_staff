<?php
use Validators\Backend as BackendValidator;
use Carbon\Carbon;
class BackendVoteController extends BackendBaseController 
{

  /**
  * Display a list of all votes
  *
  * @return Response
  */
  public function getIndex()
  {
    if(Request::Ajax())
    {
      if (Input::get('mode') == 'datatable')
      {
        $limit = Input::get('limit');
      $votes = VoteGroup::select(array('id as inputbox','id as button', 'vote_code', 'title', 'id as vote_group_id','id as actions'))
                ->limit($limit);
      return Datatables::of($votes)
        ->edit_column('button', '<span class="row-details row-details-close"></span>')
        ->edit_column('inputbox', 
          '<div class="checker">
            <span>
              <input type="checkbox" class="checkboxes" value="{{ $inputbox }}"/>
            </span>
          </div>')
        ->edit_column('vote_group_id', function($row){
          $count = Vote::where('vote_group_id', $row->vote_group_id)
            ->where('status', Config::get("variable.vote-status.newly"))
            ->whereOr('status', Config::get("variable.vote-status.opened"))
            ->count();
          if ($count > 0)
          {
            return '<span class="label label-success">'.trans("all.opened").'</span>';
          }else
          {
            return '<span class="label label-default">'.trans("all.closed").'</span>';
          }
        })
        ->edit_column('actions', '
            <a href="{{route(\'newVote\')}}/?vote_group_id={{$actions}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-plus"></i> {{trans(\'all.add\')}}</a>
            <a href="{{route(\'copyVoteGroup\', $actions)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-copy"></i> {{trans(\'all.copy\')}}</a>
            <a href="{{route(\'showVoteGroup\', $actions)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> {{trans(\'all.edit\')}}</a>
            <a item-id="{{$actions}}" class="btn btn-default btn-xs black remove-item"><i class="fa fa-trash-o"></i> {{trans(\'all.delete\')}}</a>
          ')
        #->filter_column('vote_code', 'where', 'Vote.vote_code', '=', '$1')
        ->make();

      /*
      $limit = Input::get('limit');
      $votes = Vote::select(array('id as inputbox', 'vote_code', 'title', 'object_entitled_vote', 'created_at', 'status','id as actions'))
                ->limit($limit);
      return Datatables::of($votes)
        ->edit_column('inputbox', 
          '<div class="checker">
            <span>
              <input type="checkbox" class="checkboxes" value="{{ $inputbox }}"/>
            </span>
          </div>')
        ->edit_column('object_entitled_vote', function($row){
          return $row->object_entitled_vote_name();
        })
        ->edit_column('created_at', function($row){
          return $row->created_at->format('d-m-Y');
        })
        ->edit_column('status', '
          @if($status == Config::get("variable.vote-status.newly"))
            <span class="label label-primary">{{trans("all.newly")}}</span>
          @elseif($status == Config::get("variable.vote-status.opened"))
            <span class="label label-success">{{trans("all.opened")}}</span>
          @else
            <span class="label label-default">{{trans("all.closed")}}</span>
          @endif')
        ->edit_column('actions', '
            <a href="{{route(\'listPersionsVote\', $actions)}}" class="btn btn-default btn-xs purple ajax-modal"><i class="fa fa-search"></i> {{trans(\'all.view\')}}</a>
            <a href="{{route(\'showVote\', $actions)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> {{trans(\'all.edit\')}}</a>
            <a item-id="{{$actions}}" class="btn btn-default btn-xs black remove-item"><i class="fa fa-trash-o"></i> {{trans(\'all.delete\')}}</a>
          ')
        ->filter_column('vote_code', 'where', 'Vote.vote_code', '=', '$1')
        ->make();
        */
      }else if (Input::get('mode') == 'votes_of_group')
      {
        $votesArr = array();
        $votes = Vote::where('vote_group_id', Input::get('vote_group_id'))->get();
        foreach ($votes as $vote) {
          switch ($vote->status) {
            case Config::get("variable.vote-status.newly"):
              $statusHtml = '<span class="label label-primary">'.trans("all.newly").'</span>';
              break;
            case Config::get("variable.vote-status.opened"):
              $statusHtml = '<span class="label label-success">'.trans("all.opened").'</span>';
              break;
            
            default:
              $statusHtml = '<span class="label label-default">'.trans("all.closed").'</span>';
              break;
          }
          $actionsHtml = '<a href="'.route('listPersionsVote', $vote->id).'" class="btn btn-default btn-xs purple ajax-modal"><i class="fa fa-search"></i> '.trans('all.view').'</a>
            <a href="'.route('showVote', $vote->id).'" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> '.trans('all.edit').'</a>
            <a class="btn btn-default btn-xs black" data-href="'.route('deleteVote').'" data-item-id="'.$vote->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash-o"></i> '.trans('all.delete').'</a>';
            $department = $vote->department;

          $votesArr[] = array(
            'department' => is_object($department) ? $department->name : '',
            'created_at' => $vote->created_at->format('d-m-Y'),
            'status' => $statusHtml,
            'actions' => $actionsHtml,
            );
        }
        return Response::json(array('actionStatus' => true, 'data' => $votesArr));
      }
      
    }
    $voteGroups = VoteGroup::all();
    $votes = Vote::all();
    $params['votes'] = $votes;
    $params['voteGroups'] = $voteGroups;
    $this->layout = View::make(Config::get('view.backend.votes-index'), $params);
  }

  public function getCopyGroup($voteGroupId)
  {
    $params['vote_group_id'] = $voteGroupId;
    return View::make(Config::get('view.backend.vote-group-copy'), $params);
  }

  public function postCopyGroup($voteGroupId)
  {
    $validator = new BackendValidator(Input::all(), 'vote-group-update');
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }

    $voteGroup = VoteGroup::find($voteGroupId);
    $newVoteGroup = $voteGroup->replicate();
    $newVoteGroup->fill(array(
      'vote_code' => Input::get('vote_code'),
      'title' => Input::get('title'),
      ));

    if(!$newVoteGroup->save())
    {
      return Response::json(array('voteGroupCopied' => false, 'message' => trans('all.messages.vote-group-copy-fail'), 'messageType' => 'error'));
    }
    try
    {
      foreach ($voteGroup->votes as $vote) {
        $newVote = $vote->replicate();
        $newVote->vote_group_id = $newVoteGroup->id;
        unset($newVote->created_at);
        unset($newVote->updated_at);
        $newVote->save();
      }
    }catch(\Exception $e)
    {
      Vote::where('vote_group_id', $newVoteGroup->id)->delete();
      return Response::json(array('voteGroupCopied' => false, 'message' => trans('all.messages.vote-group-copy-fail'), 'messageType' => 'error'));
    }
    
    return Response::json(array('voteGroupCopied' => true, 'message' => trans('all.messages.vote-group-copy-success'), 'messageType' => 'success'));
  }

  public function getShowGroup($voteGroupId)
  {
    $voteGroup = VoteGroup::find($voteGroupId);
    if ($voteGroup->check_status() == 0)
    {
      App::abort(500, trans('all.messages.cant-edit-closed-vote'));
    }
    
    $params['voteGroup'] = $voteGroup;
    return View::make(Config::get('view.backend.vote-group-show'), $params);
  }

  public function getListPersion($voteId)
  {
    $vote = Vote::find($voteId);
    

    $arrayVoterId = array();
    foreach (json_decode($vote->voter, true) as $value) {
      $role = Role::find($value['role_id']);
      $arrayVoterId[$value['user_id']] = is_object($role) ? $role->name : '';
    }

    $voter_users = User::select('id', 'username', 'full_name', 'job_title')->whereIn('id', array_keys($arrayVoterId))->get();
    $entitled_vote_users = User::whereIn('id', explode(',', $vote->entitled_vote))->get();
    $params['entitledVoteUsers'] = $entitled_vote_users;
    $params['voterUsers'] = $voter_users;
    $params['arrayVoterId'] = $arrayVoterId;

    return View::make(Config::get('view.backend.vote-modal-persions-list'), $params);
  }

  public function getCreate()
  {
    $params['jobTitles'] = JobTitle::all();
    $params['departments'] = Department::all();
    $params['criterias'] = Criteria::all();
    $params['roles'] = Role::all();
    if (Input::has('vote_group_id'))
    {
      $params['vote_group_id'] = Input::get('vote_group_id');  
      $views = Config::get('view.backend.only-vote-create');
    }else
    {
      $views = Config::get('view.backend.vote-create');
    }
    $this->layout = View::make($views, $params);
  }

  public function postCreate()
  {
    $validator_name = Input::has('vote_group_id') ? 'vote-update' : 'vote-create';

    $validator = new BackendValidator(Input::all(), $validator_name);
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }

    if (Input::has('vote_group_id'))
    {
      $vote_group_id = Input::get('vote_group_id');
    }else
    {
      $voteGroup = VoteGroup::create(array(
      'vote_code' => Input::get('vote_code'),
      'title' => Input::get('title'),
      ));
      $vote_group_id = $voteGroup->id;
    }

    $voter_list = $this->_convert_voter_list(Input::get('voter_id'), Input::get('voter_role'));
    $vote = new Vote;
    $vote->fill(array(
      'object_entitled_vote' => Input::get('object_vote_list'),
      'department_id' => Input::get('department_list'),
      'criteria' => Input::get('criteria_list'),
      'entitled_vote' => Input::get('entitled_vote'),
      'voter' => json_encode($voter_list),
      'expired_at' => Carbon::createFromFormat('d-m-Y', Input::get('expiration_date'))->toDateString(),
      'vote_group_id' => $vote_group_id,
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
    $params['voteDepartment'] = $vote->department;
    $params['jobTitles'] = JobTitle::all();
    $params['departments'] = Department::all();
    $params['criterias'] = Criteria::all();
    $params['roles'] = Role::all();
    return View::make(Config::get('view.backend.vote-show'), $params);
  }

  public function putShow($voteId)
  {
    $validator = new BackendValidator(Input::all(), 'vote-update');
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }
    
    $vote = Vote::find($voteId);
    if ($vote->status == Config::get('variable.vote-status.closed'))
    {
      App::abort(500, trans('all.messages.cant-edit-closed-vote'));
    }

    $voter_list = $this->_convert_voter_list(Input::get('voter_id'), Input::get('voter_role'));
    $vote->fill(array(
      'object_entitled_vote' => Input::get('object_vote_list'),
      'department_id' => Input::get('department_list'),
      'criteria' => Input::get('criteria_list'),
      'entitled_vote' => Input::get('entitled_vote'),
      'voter' => json_encode($voter_list),
      'expired_at' => Carbon::createFromFormat('d-m-Y', Input::get('expiration_date'))->toDateString(),
      ));

    if($vote->save())
    {
      return Response::json(array('voteUpdated' => true, 'message' => trans('all.messages.vote-update-success'), 'messageType' => 'success'));
    }
    else
    {
      return Response::json(array('voteUpdated' => false, 'message' => trans('all.messages.vote-update-fail'), 'messageType' => 'error'));
    }
  }

  public function putShowGroup($voteGroupId)
  {
    $validator = new BackendValidator(Input::all(), 'vote-group-update');
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }
    
    $voteGroup = VoteGroup::find($voteGroupId);
    if ($voteGroup->check_status() == 0)
    {
      App::abort(500, trans('all.messages.cant-edit-closed-vote'));
    }

    $voteGroup->fill(array(
      'vote_code' => Input::get('vote_code'),
      'title' => Input::get('title'),
      ));

    if($voteGroup->save())
    {
      return Response::json(array('voteGroupUpdated' => true, 'message' => trans('all.messages.vote-update-success'), 'messageType' => 'success'));
    }
    else
    {
      return Response::json(array('voteGroupUpdated' => false, 'message' => trans('all.messages.vote-update-fail'), 'messageType' => 'error'));
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

  public function deleteGroup()
  {
    $voteIds = Input::get('itemIds');
    $voteArrays = explode(',', $voteIds);

    foreach ($voteArrays as $voteId) {
      try
        {
          $vote = VoteGroup::find($voteId);
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
        'role_id' => $voter_role[$i],
      );
    }
    return $dataArr;
  }
}