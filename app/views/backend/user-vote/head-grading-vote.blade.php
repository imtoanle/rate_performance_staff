<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{$vote->voteGroup->title}}
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
      <th colspan="{{count($voterArr)*2}}">{{trans('all.participant')}}</th>
      <th rowspan="3">{{trans('all.general-results')}}</th>
    </tr>
    <tr>
      @foreach($voterArr as $key => $value)
        <td colspan="2">{{CustomHelper::get_role_name($key)}}</td>  
      @endforeach
    </tr>
    <tr>
      @foreach($voterArr as $key => $value)
        <td>{{trans('all.mark')}}</td>
        <td>{{trans('all.content-vote')}}</td>
      @endforeach
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="{{4+count($voterArr)*2}}"><strong>{{trans('all.department')}}</strong>: {{$vote->get_department_name()}}</td>
    </tr>
  <?php $countEntitled = 1; ?>
  @foreach(explode(',', $vote->entitled_vote) as $userId)
  <?php $entitledUser = User::find($userId); ?>
    <tr>
      <td rowspan="{{$maxVoter}}">{{$countEntitled}}</td>
      <td rowspan="{{$maxVoter}}">{{$entitledUser->full_name}}</td>
      <td rowspan="{{$maxVoter}}">{{$entitledUser->job_titles_name()}}</td>
      @foreach($voterArr as $voteGroupId => $voterIdArr)
      <td>
        @foreach(explode(',', $vote->criteria) as $criteriaId)
          {{ CustomHelper::get_mark_with_criteria($vote->id, $voterIdArr[0], $entitledUser->id, $criteriaId) }} <br />
        @endforeach
      </td>
      <td>{{ CustomHelper::get_user_name($voterIdArr[0]) }}: {{ CustomHelper::get_mark_with_criteria($vote->id, $voterIdArr[0], $entitledUser->id, 'content') }}</td>
      @endforeach
      <td rowspan="{{$maxVoter}}">
        <a href="#" class="general-result" data-type="text" data-pk="{{$vote->id}}" data-entitled-vote="{{$userId}}" data-name="mark" data-placement="left" data-placeholder="{{trans('all.input-mark')}}" data-title="{{trans('all.general-results')}}">
          {{CustomHelper::get_general_result($vote->id, $userId, $vote->rating_type)}}
        </a>
      </td>
    </tr>
    @for($i=1; $i < $maxVoter; $i++)
    <tr>
      @foreach($voterArr as $voteGroupId => $voterIdArr)
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

@include(Config::get('view.backend.footer-js'))

<script>
jQuery(document).ready(function() {   
$('a.general-result').editable({
    params: function (params) {  //params already contain `name`, `value` and `pk`
      params.entitled_vote = $(this).data('entitled-vote');
      return params;
    },
    url: '{{route('postQuickHeadGradingUserVote')}}',
    success: function(result, newValue) {
      if(typeof(result.errorMessages) != 'undefined')
      {
        return result.errorMessages.value[0];
      }
    },
    inputclass: 'form-control input-small',
    emptytext: '{{trans('all.not-input-yet')}}',
  });

});
</script>