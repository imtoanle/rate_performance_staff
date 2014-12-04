<style type="text/css">
  table {
    font-family:"Times New Roman";
    mso-generic-font-family:auto;
    font-size: 13pt;
    white-space:nowrap;
  }
  table.table-bordered tr, table.table-bordered th, table.table-bordered td {
    border: 0.5px solid #000;
  }
  .uppercase { text-transform: uppercase; }
  .bold { font-weight: bold }
  .text-center { text-align: center }
</style>
<?php $firstVoteArray = array_values($voteByRole)[0]; ?>
<table>
  <tr>
    <td>CÔNG TY TNHH THƯƠNG MẠI KHATOCO</td>
    @for($i=0;$i<(count($voterArr[$firstVoteArray[0]->id])*3 + 1); $i++)
    <td></td>
    @endfor
    <td><center>Mẫu số: </center></td>
  </tr>
  
  <tr>
    <td class="text-center bold uppercase"><b></b></td>
  </tr>
  
  <tr>
    <td colspan="{{count($voterArr[$firstVoteArray[0]->id])*3 + 4}}" text-align="center"><center><b></b></center></td>
  </tr>
  <tr>
    <td colspan="{{count($voterArr[$firstVoteArray[0]->id])*3 + 4}}"><center><b><i>Đối tượng đánh giá: </i></b></center></td>
  </tr>
  <tr></tr>
</table>

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
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          <td colspan="3">{{CustomHelper::get_role_name($roleId)}}</td>  
        @endforeach
      </tr>
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
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
      @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
        <?php $firstVoterInRow = isset($voteResult[$voterArr[$vote->id][$roleId][0]]) ? $voteResult[$voterArr[$vote->id][$roleId][0]] : null; ?>
      
      <td>{{ CustomHelper::get_user_name($voterArr[$vote->id][$roleId][0]) }}</td>
      <td>
        {{ CustomHelper::get_mark_with_role($firstVoterInRow, $roleId) }} <br />
      </td>
      <td>{{ CustomHelper::get_mark_with_role($firstVoterInRow, $roleId, true) }}</td>
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
      @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
        @if(isset($voterArr[$vote->id][$roleId][$i]))
          <?php $currentVoterInRow = isset($voteResult[$voterArr[$vote->id][$roleId][$i]]) ? $voteResult[$voterArr[$vote->id][$roleId][$i]] : null; ?>
          <td>{{ CustomHelper::get_user_name($voterArr[$vote->id][$roleId][$i]) }}</td>
          <td>
            {{ CustomHelper::get_mark_with_role($currentVoterInRow, $roleId) }} <br />
          </td>
          <td>{{ CustomHelper::get_mark_with_role($currentVoterInRow, $roleId, true) }}</td>
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



<table>
  <tr>
    @for($i=0;$i<(count($voterArr[$firstVoteArray[0]->id])*3 + 2); $i++)
    <td></td>
    @endfor
    <td><center><i>Nha Trang, ngày {{date("d")}} tháng {{date("m")}} năm {{date("Y")}}</i> </center></td>
  </tr>
  <tr>
    @for($i=0;$i<(count($voterArr[$firstVoteArray[0]->id])*3 + 2); $i++)
    <td></td>
    @endfor
    <td><center><b>GIÁM ĐỐC</b></center></td>
  </tr>
</table>
<br /><br /><br />