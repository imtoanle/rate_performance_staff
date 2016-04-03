@foreach($voteByRole as $voteArray)
<?php $voteGroup = $voteArray[0]->voteGroup; ?>

@if(Route::currentRouteName() != 'exportExcelReport')
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey vote-group-id-{{$voteGroup->id}}" id="vote-id-{{$voteArray[0]->id}}">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{$voteGroup->title}}
  </div>
  <!--
  <div class="actions">
    <a data-file-name="{{camel_case($voteGroup->vote_code)}}-{{$voteArray[0]->id}}.xls" data-vote-id="{{$voteArray[0]->id}}" class="btn btn-info export-excel"><i class="fa fa-pencil"></i> {{trans('all.export-excel')}}</a>
  </div>
  -->
</div>
<div class="portlet-body panel-content-area">
@endif
  
  @foreach($voteArray as $vote)
  <table class="table table-striped table-bordered table-hover export-excel-data-table" id="vote-data-table-{{$voteArray[0]->id}}" action-delete="{{route('deleteVoteGroup')}}">
    <thead>
      <tr>
        <th rowspan="3">STT</th>
        <th rowspan="3">{{trans('all.full-name')}}</th>
        <th rowspan="3">{{trans('all.job-title')}}</th>
        <th colspan="{{count($voterArr[$voteArray[0]->id])*2}}">{{trans('all.participant')}}</th>
        <th rowspan="3">{{trans('all.general-results')}}</th>
      </tr>
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          <td colspan="2">{{CustomHelper::get_role_name($roleId)}}</td>  
        @endforeach
      </tr>
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          <td>{{trans('all.mark')}}</td>
          <td>{{trans('all.content')}}</td>
        @endforeach
      </tr>
    </thead>
  <tbody>
    <tr>
      <td colspan="{{4+count($voterArr[$vote->id])*3}}"><strong>{{trans('all.department')}}</strong>: {{$vote->get_department_name()}}</td>
    </tr>

  <?php
  $countEntitled = 1;
  $entitledArray = explode(',', $vote->entitled_vote);
  $entitledUsers = User::whereIn('id', $entitledArray)->get();
  $entitledUsersArray = [];
  foreach ($entitledUsers as $user) {
    $entitledUsersArray[$user->id] = $user;
  }

  $extendRolePattern = '"role_id":"'.Config::get('variable.extend-member-role').'"';
  $extendRolevoteResults = VoteResult::where('vote_id', $vote->id)->whereRaw("mark regexp '".$extendRolePattern."'")->get();
  $extendRoleVoterArr = [];
  foreach ($extendRolevoteResults as $voteResult) {
    $extendRoleVoterArr[$voteResult->voter_id][] = $voteResult->entitled_vote_id;
  }
  ?>

  @foreach($entitledArray as $userId)
    <?php if (!array_key_exists($userId, $entitledUsersArray)) break; ?>
    <?php $entitledUser = $entitledUsersArray[$userId]; ?>
      <?php
        $voteResult = CustomHelper::get_array_vote_result_of_entitled_user($vote->id, $entitledUser->id);
      ?>
      <tr>
        <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{$countEntitled}}</td>
        <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{ $entitledUser->full_name }}</td>
        <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{$entitledUser->job_titles_name()}}</td>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          <?php $firstVoterInRow = (isset($voterArr[$vote->id][$roleId][0]) && isset($voteResult[$voterArr[$vote->id][$roleId][0]])) ? $voteResult[$voterArr[$vote->id][$roleId][0]] : null; ?>
          <?php if ($roleId == Config::get('variable.extend-member-role') && ($voterArr[$vote->id][$roleId][0] == -1 || !in_array($userId, $extendRoleVoterArr[$voterArr[$vote->id][$roleId][0]])) ) { ?>
            <td colspan="2"></td>
          <?php } else { ?>
            <td>
              {{CustomHelper::get_mark_with_role(['voteResult' => $firstVoterInRow, 'roleId' => $roleId, 'ratingType' => $vote->rating_type])}}<br />
            </td>
            <td>
              {{CustomHelper::get_mark_with_role(['voteResult' => $firstVoterInRow, 'roleId' => $roleId, 'content' => true])}}
            </td>
          <?php } ?>
        @endforeach
        <td rowspan="{{$maxVoterArr[$vote->id]}}">
          {{CustomHelper::get_general_result($vote->id, $userId, $vote->rating_type)}}
        </td>
      </tr>
      @for($i=1; $i < $maxVoterArr[$vote->id]; $i++)
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          @if(isset($voterArr[$vote->id][$roleId][$i]))
            <?php $currentVoterInRow = isset($voteResult[$voterArr[$vote->id][$roleId][$i]]) ? $voteResult[$voterArr[$vote->id][$roleId][$i]] : null; ?>
            
            @if($roleId == Config::get('variable.extend-member-role') && (!in_array($userId, $extendRoleVoterArr[$voterArr[$vote->id][$roleId][$i]])))
              <td></td>
              <td></td>
            @else
              <td>
                {{CustomHelper::get_mark_with_role(['voteResult' => $currentVoterInRow, 'roleId' => $roleId, 'ratingType' => $vote->rating_type])}}<br />
              </td>
              <td>
                {{CustomHelper::get_mark_with_role(['voteResult' => $currentVoterInRow, 'roleId' => $roleId, 'content' => true])}}
              </td>
            @endif
          @else
            <td></td>
            <td></td>
          @endif
        @endforeach
      </tr>
      @endfor
      <?php $countEntitled++; ?>
    @endforeach

@endforeach
  </tbody>
  </table>

@if(Route::currentRouteName() != 'exportExcelReport')  
  </div>
  </div>
@endif
<br /><br /><br />
@endforeach

