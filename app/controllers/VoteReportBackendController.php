<?php
use Validators\Backend as BackendValidator;
use Carbon\Carbon;
class VoteReportBackendController extends BackendBaseController 
{

  /**
  * Display a list of all votes
  *
  * @return Response
  */
  public function getIndexPeriod()
  {
    if(Request::Ajax())
    {
      if (Input::get('mode') == 'datatable')
      {
        $limit = Input::get('limit');
        $votes = VoteGroup::select(array('id as button', 'vote_code', 'title', 'id as vote_group_id','id as actions'))
                ->limit($limit);
      return Datatables::of($votes)
        ->edit_column('button', '<span class="row-details row-details-close"><input type="hidden" value="{{$button}}" /></span>')
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
        ->edit_column('actions', '
            <a href="{{route(\'reportPeriodVoteGroup\', $actions)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-search"></i> {{trans(\'all.report\')}}</a>
          ')
        #->filter_column('vote_code', 'where', 'Vote.vote_code', '=', '$1')
        ->make();
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
          $actionsHtml = '<a href="'.route('reportPeriodVote', $vote->id).'" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-search"></i> '.trans('all.report').'</a>';
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
    $this->layout = View::make(Config::get('view.backend.report-by-period-index'), $params);
  }


  public function getPeriodVote($VoteId)
  {
    $votes = Vote::where('id', $VoteId)->get();
    $params = $this->_get_params_reports($votes);

    return View::make(Config::get('view.backend.report-details-child'), $params);
  }

  public function getPeriodVoteGroup($voteGroupId)
  {
    $votes = Vote::whereVoteGroupId($voteGroupId)->get();
    $params = $this->_get_params_reports($votes);

    return View::make(Config::get('view.backend.report-details-child'), $params);
  }


  public function getIndexYear()
  {
    $departments = Department::all();
    $params['departments'] = $departments;
    return View::make(Config::get('view.backend.report-by-year-index'), $params);
  }

  public function postYearVote()
  {
    $thisYear = array(Carbon::createFromDate(Input::get('year'), Input::get('month') , 1)->startOfMonth(), Carbon::createFromDate(Input::get('year'), Input::get('month') , 1)->endOfMonth());

    if(Input::get('vote_type') == 1)
    {
      $votes = Vote::where('department_id', Input::get('select2_department'))->whereBetween('created_at', $thisYear)->get();
      $params = $this->_get_params_reports($votes);

      $viewName = Config::get('view.backend.report-by-year-department');
    }else
    {
      $voteGroups = VoteGroup::whereBetween('created_at', $thisYear)->get();
      $voteGroupIds = [];
      foreach ($voteGroups as $voteGroup) {
        $voteGroupIds[] = $voteGroup->id;
      }

      $voteGroupIds = empty($voteGroupIds) ? [''] : $voteGroupIds;
      $votes = Vote::whereIn('vote_group_id', $voteGroupIds)->orderBy('vote_group_id')->get();
      
      $params = $this->_get_params_reports($votes);
      $params['voteGroups'] = $voteGroups;

      $viewName = Config::get('view.backend.report-by-year-total-departments');
    }

    return View::make($viewName, $params);
  }

  protected function _get_params_reports($votes)
  {
    $voterArr = [];
    $maxVoterArr = [];

    foreach ($votes as $vote) {
      foreach (json_decode($vote->voter) as $value) {
        $voterArr[$vote->id][$value->role_id][] = $value->user_id;
      }

      //find max voter
      $maxVoterArr[$vote->id] = 0;
      foreach ($voterArr[$vote->id] as $value) {
        if(count($value) > $maxVoterArr[$vote->id])
        {
          $maxVoterArr[$vote->id] = count($value);
        }
      }
    }

    return ['voterArr' => $voterArr, 'maxVoterArr' => $maxVoterArr, 'votes' => $votes];
  }

}