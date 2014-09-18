<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

@foreach($votes as $vote)
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{$voteGroup->title}}
  </div>
  <div class="actions">
    <a href="{{route('newVote')}}" class="btn btn-info ajaxify-child-page"><i class="fa fa-pencil"></i> {{trans('all.add')}}</a>
    <a href="#delete-modal" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{trans('all.delete')}}</a>
    
    <a class="btn btn-warning" href="table_managed.html#"><i class="fa fa-print"></i> Print</a>
  </div>
</div>
<div class="portlet-body panel-content-area">

  <table class="table table-striped table-bordered table-hover" id="ajax-data-table" action-delete="{{route('deleteVoteGroup')}}">
  <thead>
    <tr>
      <th rowspan="3">STT</th>
      <th rowspan="3">{{trans('all.full-name')}}</th>
      <th rowspan="3">{{trans('all.job-title')}}</th>
      <th colspan="{{count($voterArr[$vote->id])*2}}">{{trans('all.participant')}}</th>
      <th rowspan="3">{{trans('all.general-results')}}</th>
    </tr>
    <tr>
      @foreach($voterArr[$vote->id] as $key => $value)
        <td colspan="2">{{CustomHelper::get_role_name($key)}}</td>  
      @endforeach
    </tr>
    <tr>
      @foreach($voterArr[$vote->id] as $key => $value)
        <td>{{trans('all.mark')}}</td>
        <td>{{trans('all.content-vote')}}</td>
      @endforeach
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="{{4+count($voterArr[$vote->id])*2}}"><strong>{{trans('all.department')}}</strong>: {{$vote->get_department_name()}}</td>
    </tr>

    <!--
    <tr>
    <th rowspan="4">1</th>
    <th rowspan="4">2</th>
    <th rowspan="4">3</th>
    
    <th colspan="2">4</th>
    <th colspan="2">5</th>
    <th rowspan="4">6</th>
  </tr>
  <tr>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>10</td>
  </tr>
  <tr>
    <td colspan="2">11</td>
    <td colspan="2">12</td>
  </tr>
  <tr>
    <td>13</td>
    <td>14</td>
    <td>15</td>
    <td>16</td>
  </tr>
  -->

  <?php $countEntitled = 1; ?>
  @foreach(explode(',', $vote->entitled_vote) as $userId)

  <?php $entitledUser = User::find($userId); ?>
    <tr>
      <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{$countEntitled}}</td>
      <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{ $entitledUser->full_name }}</td>
      <td rowspan="{{ $maxVoterArr[$vote->id] }}">{{$entitledUser->job_titles_name()}}</td>
      @foreach($voterArr[$vote->id] as $voteGroupId => $voterIdArr)
      <td>
        @foreach(explode(',', $vote->criteria) as $criteriaId)
          {{ CustomHelper::get_mark_with_criteria($vote->id, $voterIdArr[0], $entitledUser->id, $criteriaId) }} <br />
        @endforeach
      </td>
      <td>{{ CustomHelper::get_user_name($voterIdArr[0]) }}: {{ CustomHelper::get_mark_with_criteria($vote->id, $voterIdArr[0], $entitledUser->id, 'content') }}</td>
      @endforeach
      <td rowspan="{{$maxVoterArr[$vote->id]}}">{{CustomHelper::get_general_result($vote->id, $userId)}}</td>
    </tr>
    @for($i=1; $i < $maxVoterArr[$vote->id]; $i++)
    <tr>
      @foreach($voterArr[$vote->id] as $voteGroupId => $voterIdArr)
        @if(isset($voterIdArr[$i]))
          <td>
          @foreach(explode(',', $vote->criteria) as $criteriaId)
            {{ CustomHelper::get_mark_with_criteria($vote->id, $voterIdArr[$i], $entitledUser->id, $criteriaId) }} <br />
          @endforeach
          </td>
          <td>{{ CustomHelper::get_user_name($voterIdArr[$i]) }}: {{ CustomHelper::get_mark_with_criteria($vote->id, $voterIdArr[$i], $entitledUser->id, 'content') }}</td>
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
</div>
</div>
@endforeach

@include(Config::get('view.backend.footer-js'))
