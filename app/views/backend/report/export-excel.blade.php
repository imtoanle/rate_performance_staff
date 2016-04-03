<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<table>
  <tr>
    <td>CÔNG TY TNHH THƯƠNG MẠI KHATOCO</td>
    @for($i=0;$i<($size_of_col - 3); $i++)
    <td></td>
    @endfor
    <td><center>Mẫu số: 01/BMĐGHQCV</center></td>
  </tr>

  <tr>
    <td></td>
    @for($i=0;$i<($size_of_col - 3); $i++)
    <td></td>
    @endfor
    <td><center>(Áp dụng Chi nhánh)</center></td>
  </tr>
  
  <tr>
    <td><b></b></td>
  </tr>
  
  <tr>
    <td><b>{{$voteArray[0]->voteGroup->title}}</b></td>
  </tr>
  <tr>
    <td><b><i>Đối tượng đánh giá: {{$vote->object_entitled_vote}}</i></b></td>
  </tr>
</table>



  <table>
    <thead>
<!--      
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

      <td>{{ CustomHelper::get_user_name($voterArr[$vote->id][$roleId][0]) }}</td>
-->
      <tr></tr>
      <tr></tr>
      <tr></tr>
    </thead>
  <tbody>
    <tr>
      <td colspan="2">{{$vote->get_department_name()}}</td>
      @for($i=0;$i<($size_of_col - 2); $i++)
      <td></td>
      @endfor
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
        <td></td>
        <td></td>
        <td></td>
        @foreach($voterArr[$voteArray[0]->id] as $roleId => $value)
          @if(isset($voterArr[$vote->id][$roleId][$i]))
            <?php $currentVoterInRow = isset($voteResult[$voterArr[$vote->id][$roleId][$i]]) ? $voteResult[$voterArr[$vote->id][$roleId][$i]] : null; ?>
            
            @if($roleId == Config::get('variable.extend-member-role') && (!in_array($userId, $extendRoleVoterArr[$voterArr[$vote->id][$roleId][$i]])))
              <td colspan="2"></td>
            @else
              <td>
                {{CustomHelper::get_mark_with_role(['voteResult' => $currentVoterInRow, 'roleId' => $roleId, 'ratingType' => $vote->rating_type])}}<br />
              </td>
              <td>
                {{CustomHelper::get_mark_with_role(['voteResult' => $currentVoterInRow, 'roleId' => $roleId, 'content' => true])}}
              </td>
            @endif
          @else
            <td colspan="2"></td>
          @endif
        @endforeach
      </tr>
      @endfor
      <?php $countEntitled++; ?>
      @endforeach
  </tbody>
  </table>





<table>
  <!--
  <tr>
    @for($i=0;$i<($size_of_col - 2); $i++)
    <td></td>
    @endfor
    <td><center><i>Nha Trang, ngày {{date("d")}} tháng {{date("m")}} năm {{date("Y")}}</i> </center></td>
  </tr>
-->
  <tr>
    @for($i=0;$i<($size_of_col - 4); $i++)
    <td></td>
    @endfor
    <td colspan="2"><b>Trưởng Chi Nhánh</b></td>
    <td colspan="2"><b>Lập bảng</b></td>
  </tr>
</table>
<br /><br /><br />
