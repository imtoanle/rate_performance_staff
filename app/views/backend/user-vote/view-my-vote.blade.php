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
    <?php $voteRoles = CustomHelper::get_role_current_user($vote->voter, $currentUser->id); ?>
    <table class="table table-striped table-bordered table-hover" id="ajax-data-table" action-delete="{{route('deleteVote')}}">
    <thead class="text-center">
      <tr>
        <th style="width: 5%">#</th>
        <th style="width: 15%">{{trans('all.full-name')}}</th>
        <th style="width: 15%">{{trans('all.job-title')}}</th>
        <th style="width: 50%" colspan="{{count($voteRoles)}}">{{trans('all.mark')}}</td>
        <th style="width: 15%">{{trans('all.content-vote')}}</td>
      </tr>
    </thead>
    <tbody>
    <tr>
      <td colspan="3"><strong>{{trans('all.department')}}:</strong> {{is_object($vote->department) ? $vote->department->name : ''}}</td>
      @foreach($voteRoles as $roleId => $roleName)
        <td><strong>{{trans('all.role')}}:</strong> {{$roleName}}</td>
      @endforeach
      <td></td>
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
            {{CustomHelper::get_mark_with_role($voteResult, $roleId)}}
          </p>
        </td>
        @endforeach
        <td>
          {{CustomHelper::get_mark_with_role($voteResult, 'content')}}
        </td>
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

