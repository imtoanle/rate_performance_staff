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
    if(Request::Ajax() && Input::get('mode') == 'datatable')
    {
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
    }
    $votes = Vote::all();
    $params['votes'] = $votes;
    $this->layout = View::make(Config::get('view.backend.votes-index'), $params);
  }

  public function getListPersion($voteId)
  {
    $vote = Vote::find($voteId);
    

    $arrayVoterId = array();
    foreach (json_decode($vote->voter, true) as $value) {
      $arrayVoterId[$value['user_id']] = Role::find($value['role_id'])->name;
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
    $params['roles'] = Role::all();
    $this->layout = View::make(Config::get('view.backend.vote-create'), $params);
    
  }

  public function postCreate()
  {
    $validator = new BackendValidator(Input::all(), 'vote-create');
    if(!$validator->passes())
    {
        return Response::json(array('voteCreated' => false, 'errorMessages' => $validator->getErrors()));
    }
    $voter_list = $this->_convert_voter_list(Input::get('voter_id'), Input::get('voter_role'));
    $vote = Vote::create(array(
      'vote_code' => Input::get('vote_code'),
      'title' => Input::get('title'),
      'object_entitled_vote' => Input::get('object_vote_list'),
      'department' => Input::get('department_list'),
      'entitled_vote' => Input::get('entitled_vote'),
      'voter' => json_encode($voter_list),
      'expired_at' => Carbon::createFromFormat('d-m-Y', Input::get('expiration_date'))->toDateString(),
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
    $params['jobTitles'] = JobTitle::all();
    $params['departments'] = Department::all();
    $params['roles'] = Role::all();
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

    $voter_list = $this->_convert_voter_list(Input::get('voter_id'), Input::get('voter_role'));
    $vote->fill(array(
      'vote_code' => Input::get('vote_code'),
      'title' => Input::get('title'),
      'object_entitled_vote' => Input::get('object_vote_list'),
      'department' => Input::get('department_list'),
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
        'role_id' => $voter_role[$i],
      );
    }
    return $dataArr;
  }
}