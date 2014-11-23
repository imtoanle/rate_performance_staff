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
  @foreach($voteByRole as $voteArray)
<?php $voteGroup = $voteArray[0]->voteGroup; ?>
@foreach($voteArray as $vote)
  <table>
  <tr>
    <td>CÔNG TY TNHH THƯƠNG MẠI KHATOCO</td>
    @for($i=0;$i<(count($voterArr[$voteArray[0]->id])*3 + 1); $i++)
    <td></td>
    @endfor
    <td><center>Mẫu số: </center></td>
  </tr>
  
  <tr>
    <td class="text-center bold uppercase"><b>{{mb_strtoupper($vote->get_department_name(), "UTF-8")}}</b></td>
  </tr>
  
  <tr>
    <td colspan="{{count($voterArr[$voteArray[0]->id])*3 + 4}}" text-align="center"><center><b>{{mb_strtoupper($voteGroup->title, "UTF-8")}}</b></center></td>
  </tr>
  <tr>
    <td colspan="{{count($voterArr[$voteArray[0]->id])*3 + 4}}"><center><b><i>Đối tượng đánh giá: {{$vote->object_entitled_vote}}</i></b></center></td>
  </tr>
  <tr></tr>
  </table>
  <table class="table-bordered">
    <thead>
      <tr>
        <th rowspan="3" style="width:5%;">STT</th>
        <th rowspan="3" style="width:15%;">{{trans('all.full-name')}}</th>
        <th rowspan="3" style="width:15%;">{{trans('all.job-title')}}</th>
        <th colspan="{{count($voterArr[$voteArray[0]->id])*3}}" style="width:50%;">{{trans('all.participant')}}</th>
        <th rowspan="3" style="width:15%;">{{trans('all.general-results')}}</th>
      </tr>
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          <th colspan="3">{{CustomHelper::get_role_name($roleId)}}</th>  
        @endforeach
      </tr>
      <tr>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          <th>{{trans('all.voter')}}</th>
          <th>{{trans('all.mark')}}</th>
          <th>{{trans('all.content')}}</th>
        @endforeach
      </tr>
    </thead>
  <tbody>
  
    <tr>
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
        {{CustomHelper::get_general_result($vote->id, $userId)}}
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

  
  </tbody>
  </table>
  
  <table>
    <tr>
      @for($i=0;$i<(count($voterArr[$voteArray[0]->id])*3 + 2); $i++)
      <td></td>
      @endfor
      <td><center><i>Nha Trang, ngày {{date("d")}} tháng {{date("m")}} năm {{date("Y")}}</i> </center></td>
    </tr>
    <tr>
      @for($i=0;$i<(count($voterArr[$voteArray[0]->id])*3 + 2); $i++)
      <td></td>
      @endfor
      <td><center><b>GIÁM ĐỐC</b></center></td>
    </tr>
  </table>
  <br /><br /><br />
  @endforeach
@endforeach
