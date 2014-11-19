@foreach($voteByRole as $voteArray)
<?php $voteGroup = $voteArray[0]->voteGroup; ?>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey vote-group-id-{{$voteGroup->id}}" id="vote-id-{{$voteArray[0]->id}}">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{$voteGroup->title}}
  </div>
  <div class="actions">
    <a data-file-name="{{camel_case($voteGroup->vote_code)}}-{{$voteArray[0]->id}}.xls" data-vote-id="{{$voteArray[0]->id}}" class="btn btn-info export-excel"><i class="fa fa-pencil"></i> {{trans('all.export-excel')}}</a>
  </div>
</div>
<div class="portlet-body panel-content-area">

  <table class="table table-striped table-bordered table-hover" id="vote-data-table-{{$voteArray[0]->id}}" action-delete="{{route('deleteVoteGroup')}}">
    <thead>
      <tr>
        <th rowspan="3">STT</th>
        <th rowspan="3">{{trans('all.full-name')}}</th>
        <th rowspan="3">{{trans('all.job-title')}}</th>
        <th colspan="{{count($voterArr[$voteArray[0]->id])*3}}">{{trans('all.participant')}}</th>
        <th rowspan="3">{{trans('all.general-results')}}</th>
      </tr>
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $key => $value)
          <td colspan="3">{{CustomHelper::get_role_name($key)}}</td>  
        @endforeach
      </tr>
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $key => $value)
          <td>{{trans('all.voter')}}</td>
          <td>{{trans('all.mark')}}</td>
          <td>{{trans('all.content')}}</td>
        @endforeach
      </tr>
    </thead>
  <tbody>
  @foreach($voteArray as $vote)
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
  ?>

  @foreach($entitledArray as $userId)
  <?php $entitledUser = $entitledUsersArray[$userId]; ?>
    <?php $voteResult = CustomHelper::get_array_vote_result_of_entitled_user($vote->id, $entitledUser->id); ?>
    <tr>
      <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{$countEntitled}}</td>
      <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{ $entitledUser->full_name }}</td>
      <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{$entitledUser->job_titles_name()}}</td>
      @foreach($voterArr[$voteArray[0]->id] as $key => $value)
        <?php $firstVoterInRow = isset($voteResult[$voterArr[$vote->id][$key][0]]) ? $voteResult[$voterArr[$vote->id][$key][0]] : null; ?>
      
      <td>{{ CustomHelper::get_user_name($voterArr[$vote->id][$key][0]) }}</td>
      <td>
        @foreach(explode(',', $vote->criteria) as $criteriaId)
          {{ CustomHelper::get_mark_with_criteria($firstVoterInRow, $criteriaId) }} <br />
        @endforeach
      </td>
      <td>{{ CustomHelper::get_mark_with_criteria($firstVoterInRow, 'content') }}</td>
      @endforeach
      <td rowspan="{{$maxVoterArr[$vote->id]}}">
        @if(Route::currentRouteName() == 'detailHeadGradingUserVote')
          <a href="#" class="general-result" data-type="text" data-pk="{{$vote->id}}" data-entitled-vote="{{$userId}}" data-name="mark" data-placement="left" data-placeholder="{{trans('all.input-mark')}}" data-title="{{trans('all.general-results')}}">
        @endif
        {{CustomHelper::get_general_result($vote->id, $userId)}}
        @if(Route::currentRouteName() == 'detailHeadGradingUserVote')
          </a>
        @endif
      </td>
    </tr>
    @for($i=1; $i < $maxVoterArr[$vote->id]; $i++)
    <tr>
      @foreach($voterArr[$voteArray[0]->id] as $key => $value)
        @if(isset($voterArr[$vote->id][$key][$i]))
          <?php $currentVoterInRow = isset($voteResult[$voterArr[$vote->id][$key][$i]]) ? $voteResult[$voterArr[$vote->id][$key][$i]] : null; ?>
          <td>{{ CustomHelper::get_user_name($voterArr[$vote->id][$key][$i]) }}</td>
          <td>
          @foreach(explode(',', $vote->criteria) as $criteriaId)
            {{ CustomHelper::get_mark_with_criteria($currentVoterInRow, $criteriaId) }} <br />
          @endforeach
          </td>
          <td>{{ CustomHelper::get_mark_with_criteria($currentVoterInRow, 'content') }}</td>
        @else
          <td colspan="3"></td>
        @endif
      @endforeach
    </tr>
    @endfor
    <?php $countEntitled++; ?>
    @endforeach

  @endforeach
  </tbody>
  </table>
  </div>
  </div>
@endforeach