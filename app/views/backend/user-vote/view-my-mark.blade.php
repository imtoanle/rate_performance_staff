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
      <th style="width: 10%">{{trans('all.username')}}</th>
      <th style="width: 20%">{{trans('all.full-name')}}</th>
      <th style="width: 15%">{{trans('all.job-title')}}</th>
      <th style="width: 15%">{{trans('all.role')}}</th>
      <th style="width: 20%">{{trans('all.mark')}}</td>
      <th style="width: 15%">{{trans('all.content-vote')}}</td>
    </tr>
  </thead>
  <tbody>
  @foreach($votes as $vote)
    <tr>
      <td colspan="7"><strong>{{trans('all.department')}}:</strong> {{$vote->department_name()}}</td>
    </tr>
      <?php $number_in_department = 1; ?>
      @foreach(CustomHelper::get_users_from_voter_list($vote->voter) as $user)
      <tr>
        <td>{{$number_in_department}}</td>
        <td>{{$user['username']}}</td>
        <td>{{$user['full_name']}}</td>
        <td>{{$user['job_name']}}</td>
        <td>{{CustomHelper::get_role_name($user['role'])}}</td>
        <td>
          @foreach(CustomHelper::get_criterias_from_id(explode(',', $vote->criteria)) as $criteria)
          <?php $mark = CustomHelper::get_mark_with_criteria($vote->id, $user['id'], $currentUser->id, $criteria->id) ?>
          {{$criteria->name}}: 
            @if(empty($mark))
            <strong class="color-danger">...</strong><br />
            @else
            <strong class="color-success">{{$mark}}</strong><br />
            @endif
          @endforeach
        </td>
        <td>
          <?php $content = CustomHelper::get_mark_with_criteria($vote->id, $user['id'], $currentUser->id, 'content'); ?>
          @if(empty($content))
          <strong class="color-danger">...</strong><br />
          @else
          <strong class="color-success">{{$content}}</strong><br />
          @endif
        </td>
      </tr>
      <?php $number_in_department++; ?>
      @endforeach
      <tr>
        <td colspan="5" class="text-center"><strong>{{trans('all.final-mark')}}</strong></td>
        <td colspan="2"></td>
      </tr>
  @endforeach
  </tbody>
  </table>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@include(Config::get('view.backend.footer-js'))

