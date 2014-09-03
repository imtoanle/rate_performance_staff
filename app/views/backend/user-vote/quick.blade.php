@extends(Config::get('view.backend.master'))
@section('content')

@foreach($canVoteGroup as $voteGroup)
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
  @foreach($canVotes as $vote)
    @if($vote->vote_group_id == $voteGroup->id)
    <tr>
      <td colspan="3"><strong>{{trans('all.department')}}:</strong> {{$vote->department_name()}}</td>
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
          {{$criteria->name}}: <a href="#" class="criteria-mark" data-type="text" data-vote="{{$vote->id}}" data-voter="{{$currentUser->id}}" data-entitled-vote="{{$user->id}}" data-pk="{{$criteria->id}}" data-name="mark" data-placement="top" data-placeholder="{{trans('all.input-mark')}}" data-title="{{$criteria->name}}">
          {{CustomHelper::get_mark_with_criteria($vote->id, $currentUser->id, $user->id, $criteria->id)}}
          </a><br />
          @endforeach
        </td>
        <td>
          <a href="#" class="vote-content" data-type="textarea" data-vote="{{$vote->id}}" data-voter="{{$currentUser->id}}" data-entitled-vote="{{$user->id}}" data-name="content" data-placement="top" data-pk="1" data-title="{{trans('all.input-vote-content')}}">
            {{CustomHelper::get_mark_with_criteria($vote->id, $currentUser->id, $user->id, 'content')}}
          </a>
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
@endforeach



<script>
jQuery(document).ready(function() {   
  $('a.criteria-mark').editable({
    params: function (params) {  //params already contain `name`, `value` and `pk`
      params.vote = $(this).data('vote');
      params.voter = $(this).data('voter');
      params.entitled_vote = $(this).data('entitled-vote');
      return params;
    },
    url: '{{route('postQuickUserVote')}}',
    success: function(result, newValue) {
      if(typeof(result.errorMessages) != 'undefined')
      {
        return result.errorMessages.value[0];
      }
    },
    inputclass: 'form-control input-small',
    emptytext: '{{trans('all.not-input-yet')}}',
  });

  $('a.vote-content').editable({
    showbuttons: 'bottom',
    inputclass: 'form-control input-medium',
    params: function (params) {  //params already contain `name`, `value` and `pk`
      params.vote = $(this).data('vote');
      params.voter = $(this).data('voter');
      params.entitled_vote = $(this).data('entitled-vote');
      return params;
    },
    url: '{{route('postQuickUserVote')}}',
    emptytext: '{{trans('all.not-input-yet')}}',
  });
});
</script>
@stop