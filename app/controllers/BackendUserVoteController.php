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
    $canVotes = Vote::where('status', Config::get("variable.vote-status.opened"))->whereRaw("voter regexp '".$pattern."'")->orderBy('vote_group_id', 'asc')->get();

    $canVoteGroupId = Vote::select('vote_group_id')->where('status', Config::get("variable.vote-status.opened"))->whereRaw("voter regexp '".$pattern."'")->groupBy('vote_group_id')->get();

    $voteGroupId = [];
    foreach ($canVoteGroupId as $value) {
      $voteGroupId[] = $value->vote_group_id;
    }

    $voteGroupId = empty($voteGroupId) ? [''] : $voteGroupId;
    $canVoteGroup = VoteGroup::whereIn('id', $voteGroupId)->get();

    $params['canVotes'] = $canVotes;
    $params['canVoteGroup'] = $canVoteGroup;
    $params['currentUser'] = $currentUser;
    $params['ratingTypes'] = RatingType::all()->groupBy('value');
    if(Request::Ajax())
      return View::make(Config::get('view.backend.user-votes-quick-little'), $params);
    else
      return View::make(Config::get('view.backend.user-votes-quick'), $params);
  }

  public function getAnyVote()
  {
    $openedVote = Vote::where('status', Config::get("variable.vote-status.opened"))->get()->groupBy('vote_group_id');
    If(Request::Ajax())
    {
      $voteGroupId = Input::get('vote_group_id');
      $results = [];

      switch (Input::get('request_mode')) {
        case 'department':
          foreach($openedVote[$voteGroupId] as $vote)
          {
            $department = $vote->department;
            $departmentName = is_object($department) ? $department->name : '';
            $results[] = [
              'vote_id' => $vote->id,
              'department_name' => $departmentName,
            ];
          }
          break;
        case 'entitled_user':
          $voteId = Input::get('vote_id');
          $vote = Vote::findOrNew($voteId);
          $users = User::whereRaw('id IN ('.$vote->entitled_vote.')')->get();
          foreach ($users as $user) {
            $results[] = [
            'id' => $user->id,
            'username' => $user->username,
            'full_name' => $user->full_name,
            ];
          }
          break;
        
        default:
          # code...
          break;
      }
      return Response::json(array('results' => $results));
    }
    $params['openedVote'] = $openedVote;
    return View::make(Config::get('view.backend.user-vote-any'), $params);
  }

  public function postAnyVote()
  {
    $validator = new BackendValidator(Input::all(), 'any-user-vote');
    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }

    $vote = Vote::find(Input::get('vote'));
    $validation = $vote->rating_type ? 'vote-result-mark' : 'vote-result-mark';
    $validator = new BackendValidator(Input::all(), $validation);
    if(!$validator->passes())
    {
        return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
    }
      
    $currentUser = Sentry::getUser();
    $voteResult = VoteResult::firstOrNew(array(
        'vote_id' => Input::get('vote'),
        'voter_id' => $currentUser->id,
        'entitled_vote_id' => Input::get('entitled_user'),
        ));

    $roleId = (string)Config::get('variable.extend-member-role');
    $markParams = [
      'roleId' => $roleId,
      'value' => Input::get('mark'),
      'rating_type' => $vote->rating_type,
    ];
    $contentParams = [
      'roleId' => $roleId,
      'value' => Input::get('content'),
    ];


    $voteResult->mark = $this->_UpdateDataVoteResult($voteResult->mark, $markParams);
    $voteResult->content = $this->_UpdateDataVoteResult($voteResult->content, $contentParams, true);

    if($voteResult->save())
    {
      return Response::json(array('actionStatus' => true, 'message' => 'Chấm điểm nhân viên thành công.', 'messageType' => 'success'));
    }else
    {
      return Response::json(array('actionStatus' => true, 'message' => 'Chấm điểm nhân viên thất bại.', 'messageType' => 'error'));
    }
  }

  public function getIndexHeadGradingVote()
  {
    if (Request::Ajax())
    {
      if (Input::get('mode') == 'datatable')
      {
        $currentUser = Sentry::getUser();
        $pattern = '"user_id":"'.$currentUser->id.'","type_of_persion":"'.Config::get('variable.type-of-person.head-grading').'"';
        
        $votes = Vote::select(array('vote_group_id', 'department_id', 'id as vote_code', 'id as title', 'id as department_name', 'id as actions'))->whereRaw("specify_user regexp '".$pattern."'")->where('status', Config::get('variable.vote-status.opened'));
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

  public function postQuickDetailHeadGradingVote()
  {
    if(Input::get('name') == 'mark')
    {
      $vote = Vote::find(Input::get('vote'));
      $validation = $vote->rating_type ? 'vote-result-mark' : 'vote-result-mark';
      $validator = new BackendValidator(Input::all(), $validation);
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
    $voteResult = VoteResult::firstOrNew(array(
        'vote_id' => Input::get('vote'),
        'voter_id' => Input::get('voter'),
        'entitled_vote_id' => Input::get('entitled_vote'),
        ));

    $params = [
      'roleId' => Input::get('pk'),
      'value' => Input::get('value'),
    ];

    if(Input::get('name') == 'mark')
    {
      $vote = Vote::find(Input::get('vote'));
      $validation = $vote->rating_type ? 'vote-result-mark' : 'vote-result-mark';
      $validator = new BackendValidator(Input::all(), $validation);
      if(!$validator->passes())
      {
          return Response::json(array('actionStatus' => false, 'errorMessages' => $validator->getErrors()));
      }
      $params['rating_type'] = $vote->rating_type;
      //return Input::get('value');
      $voteResult->mark = $this->_UpdateDataVoteResult($voteResult->mark, $params);
    }
    else if(Input::get('name') == 'content')
    {
      $voteResult->content = $this->_UpdateDataVoteResult($voteResult->content, $params, true);
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

    if(Input::get('mode') == 'mark')
    {
      $validation = $vote->rating_type ? 'vote-result-mark' : 'vote-result-mark';
      $validator = new BackendValidator(Input::all(), $validation);
      if(!$validator->passes())
      {
        return Response::json(array('actionStatus' => false, 'message' => array_values($validator->getErrors())[0], 'messageType' => 'error'));
      }  
    }

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
          $params = ['roleId' => Input::get('role_id'), 'value' => Input::get('form_mark'), 'rating_type' => $vote->rating_type];
          $voteResult->mark = $this->_UpdateDataVoteResult($voteResult->mark, $params);
        }else
        {
          $params = ['roleId' => Input::get('role_id'), 'value' => Input::get('form_content')];
          $voteResult->content = $this->_UpdateDataVoteResult($voteResult->content, $params, true);
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
        $entitledVoteGroupIds = Vote::select('vote_group_id')->whereStatus(Config::get('variable.vote-status.closed'))->whereRaw("entitled_vote regexp '".$pattern."'")->groupBy('vote_group_id')->get();
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
        $canVoteGroupId = Vote::select('vote_group_id')->whereStatus(Config::get('variable.vote-status.closed'))->whereRaw("voter regexp '".$pattern."'")->groupBy('vote_group_id')->get();
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

    $params['departments'] = Department::all();
    $params['usersByDepartment'] = User::all()->groupBy('department_id');
    $this->layout = View::make(Config::get('view.backend.user-votes-index'), $params);
  }

  public function getSpecifyUser()
  {
    if (Request::Ajax())
    {
      
      $currentUser = Sentry::getUser();
      $specifyVoter = Input::has('voter_id') ? Input::get('voter_id') : -1;
      $voteResults = VoteResult::select('vote_id', 'content', 'mark', 'vote_groups.title', 'departments.name as department_name', 'mark as result')->whereVoterId($specifyVoter)->whereEntitledVoteId($currentUser->id)
        ->leftJoin('votes', 'vote_results.vote_id', '=', 'votes.id')
        ->leftJoin('departments', 'departments.id', '=', 'votes.department_id')
        ->leftJoin('vote_groups', 'vote_groups.id', '=', 'votes.vote_group_id');
    return Datatables::of($voteResults)
      ->remove_column('vote_id', 'content', 'mark')
      ->edit_column('result', function($row){
        $html = '';
        foreach (json_decode($row->mark) as $value) {
          if(empty($value->role_id))
          {
            $roleName = '';
          }else
          {
            $role = Role::find($value->role_id);
            $roleName = is_object($role) ? $role->name : '';
          }
          $html .= '<strong>Vai trò: </strong> '.$roleName.'<br />';
          $html .= '<strong>Điểm: </strong> '.$value->mark.'<br />';
          $html .= '<strong>Nội dung: </strong> '.$row->content.'<br />';
          $html .= '------------------------------<br />';
        }
        return $html;
      })
      /*
      ->edit_column('vote_group_title', function($row){
        $vote = $row->vote;
        if(is_object($vote)) $voteGroup = $vote->voteGroup;
        else return '';
        $voteGroupTitle = is_object($voteGroup) ? $voteGroup->title : '';
        return $voteGroupTitle;
      })
      ->edit_column('department', function($row){
        $vote = $row->vote
      })
      */
    /*
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
        */
      #->filter_column('vote_code', 'where', 'Vote.vote_code', '=', '$1')
      ->make();
    
    }

    $currentUser = Sentry::getUser();
    $voteResults = VoteResult::whereVoterId($specifyVoter->id)->whereEntitledVoteId($currentUser->id)->get();
    $params['specifyVoter'] = $specifyVoter;
    return View::make(Config::get('view.backend.user-vote-specify'), $params);
  }

  public function getViewMyMark($voteGroupId)
  {
    $currentUser = Sentry::getUser();
    $pattern = '^'.$currentUser->id.',|,'.$currentUser->id.',|,'.$currentUser->id.'$';
    $voteGroup = VoteGroup::find($voteGroupId);
    if(!is_object($voteGroup))
    {
      App::abort(500, 'Dánh giá không tồn tại'); 
    }
    $votes = Vote::whereStatus(Config::get('variable.vote-status.closed'))->where('vote_group_id', $voteGroup->id)->whereRaw("entitled_vote regexp '".$pattern."'")->get();

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
    $votes = Vote::whereStatus(Config::get('variable.vote-status.closed'))->where('vote_group_id', $voteGroup->id)->whereRaw("voter regexp '".$pattern."'")->get();
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


  protected function _UpdateDataVoteResult($jsonString, $params, $content=false)
  {
    $dataType = $content ? 'content' : 'mark';
    if (empty($jsonString))
    {
      $roleData[] = ['role_id' => $params['roleId'], $dataType => $params['value']];
    }else
    {
      $decodeData = json_decode($jsonString, true);
      $checkExist = false;
      foreach ($decodeData as &$value) {
        if($value['role_id'] == $params['roleId'])
        {
          /*
          if($params['rating_type'])
          {
            $value[$dataType] = Config::get('variable.rating-type.'.$params['value']) ;
          }else
          {
            $value[$dataType] = $params['value'];
          }
          */
          $value[$dataType] = $params['value'];
          
          $checkExist = true;
        }
      }
      if ($checkExist == false)
      {
        $decodeData[] = ['role_id' => $params['roleId'], $dataType => $params['value']];
      }

      $roleData = $decodeData;
    }
    return json_encode($roleData);
  }
}