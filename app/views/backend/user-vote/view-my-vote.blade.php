<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{$voteGroup->vote_code}} - {{$voteGroup->title}}
  </div>
</div>
<div class="portlet-body panel-content-area">
  @foreach($votes as $vote)
    @if($vote->vote_group_id == $voteGroup->id)
    <?php $voteRoles = CustomHelper::get_role_current_user($vote->voter, $currentUser->id);
    $headerWidth = 65/count($voteRoles)/2; ?>
    <table class="table table-striped table-bordered table-hover" id="ajax-data-table" action-delete="{{route('deleteVote')}}">
    <thead class="text-center">
      <tr>
        <th style="width: 5%">#</th>
        <th style="width: 15%">{{trans('all.full-name')}}</th>
        <th style="width: 15%">{{trans('all.job-title')}}</th>
        @foreach($voteRoles as $roleId => $roleName)
        <th style="width: {{$headerWidth}}%">{{trans('all.mark')}}</th>
        <th style="width: {{$headerWidth}}%">{{trans('all.content-vote')}}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
    <tr>
      <td colspan="3"><strong>{{trans('all.department')}}:</strong> {{is_object($vote->department) ? $vote->department->name : ''}}</td>
      @foreach($voteRoles as $roleId => $roleName)
        <td colspan="2"><strong>{{trans('all.role')}}:</strong> {{$roleName}}</td>
      @endforeach
    </tr>
      <?php $number_in_department = 1; ?>
      @foreach(CustomHelper::get_users_from_user_id_list(explode(',', $vote->entitled_vote)) as $user)
      <?php $voteResult = VoteResult::where('vote_id', $vote->id)
          ->where('voter_id', $currentUser->id)
          ->where('entitled_vote_id', $user->id)
          ->first(); ?>
      <tr>
        <td>{{$number_in_department}}</td>
        <td>{{$user->full_name}}</td>
        <td>{{$user->job_titles_name()}}</td>
        @foreach($voteRoles as $roleId => $roleName)
        <td>
          <p>
            {{CustomHelper::get_mark_with_role(['voteResult' => $voteResult, 'roleId' => $roleId, 'ratingType' => $vote->rating_type])}}
          </p>
        </td>
        <td>
          {{CustomHelper::get_mark_with_role(['voteResult' => $voteResult, 'roleId' => $roleId, 'content' => true])}}
        </td>
        @endforeach
      </tr>
      <?php $number_in_department++; ?>
      @endforeach
      </tbody>
    </table>
    @endif
  @endforeach
  
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@include(Config::get('view.backend.footer-js'))

