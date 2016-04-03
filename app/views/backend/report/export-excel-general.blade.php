<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $size_of_col = 10#count($voterArr[$voteArray[0]->id])*2 + 4 ?>
<table>
  <tr>
    <td></td>
  </tr>

  <tr>
    <td>{{$voteGroup->title}}</td>
  </tr>
  
  <tr>
    <td></td>
  </tr>
</table>

  <table>
    <thead>
      <tr>
        <th>STT</th>
        <th>{{trans('all.full-name')}}</th>
        <th>{{trans('all.job-title')}}</th>
        <th>{{trans('all.general-results')}}</th>
      </tr>
    </thead>
  <tbody>
    @foreach($voteByRole as $voteArray)
      @foreach($voteArray as $vote)
        <tr>
          <td colspan="4"><b>{{$vote->get_department_name()}}<b></td>
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
          <?php if (!array_key_exists($userId, $entitledUsersArray)) break; ?>
          <?php $entitledUser = $entitledUsersArray[$userId]; ?>
          <?php
            $voteResult = CustomHelper::get_array_vote_result_of_entitled_user($vote->id, $entitledUser->id);
          ?>
          <tr>
            <td>{{$countEntitled}}</td>
            <td>{{ $entitledUser->full_name }}</td>
            <td>{{$entitledUser->job_titles_name()}}</td>
            <td>
              {{CustomHelper::get_general_result($vote->id, $userId, $vote->rating_type)}}
            </td>
          </tr>
          <?php $countEntitled++; ?>
        @endforeach
      @endforeach
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
    <td colspan="2"><b>Trưởng Chi Nhánh</b></td>
    <td colspan="2"><b>Lập bảng</b></td>
  </tr>
</table>
<br /><br /><br />
