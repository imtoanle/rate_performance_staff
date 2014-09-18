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
  <table class="table table-striped table-bordered table-hover" id="ajax-data-table" action-delete="{{route('deleteVote')}}">
  <thead class="text-center">
    <tr>
      <th style="width: 5%">#</th>
      <th style="width: 20%">{{trans('all.full-name')}}</th>
      <th style="width: 25%">{{trans('all.job-title')}}</th>
      <th style="width: 25%">{{trans('all.mark')}}</td>
      <th style="width: 25%">{{trans('all.content-vote')}}</td>
    </tr>
  </thead>
  <tbody>
  @foreach($votes as $vote)
    @if($vote->vote_group_id == $voteGroup->id)
    <tr>
      <td colspan="3"><strong>{{trans('all.department')}}:</strong> {{is_object($vote->department) ? $vote->department->name : ''}}</td>
      <td colspan="3"><strong>{{trans('all.role')}}:</strong> {{CustomHelper::get_role_current_user($vote->voter, $currentUser->id)}}</td>
    </tr>
      <?php $number_in_department = 1; ?>
      @foreach(CustomHelper::get_users_from_user_id_list(explode(',', $vote->entitled_vote)) as $user)
      <tr>
        <td>{{$number_in_department}}</td>
        <td>{{$user->full_name}}</td>
        <td>{{$user->job_titles_name()}}</td>
        <td>
          @foreach(CustomHelper::get_criterias_from_id(explode(',', $vote->criteria)) as $criteria)
          <p>
            {{$criteria->name}}: {{CustomHelper::get_mark_with_criteria($vote->id, $currentUser->id, $user->id, $criteria->id)}}
          </p>
          @endforeach
        </td>
        <td>
          {{CustomHelper::get_mark_with_criteria($vote->id, $currentUser->id, $user->id, 'content')}}
        </td>
      </tr>
      <?php $number_in_department++; ?>
      @endforeach
    @endif
  @endforeach
  </tbody>
  </table>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@include(Config::get('view.backend.footer-js'))

