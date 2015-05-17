<form class="form-horizontal base-ajax-form">
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-3">{{trans('all.department')}}</label>
      <div class="col-md-6">
        <select name="department_list" id="department_list" class="form-control select2">
          <option></option>
          <optgroup label="Lựa chọn cơ bản">
            <option value="all" selected="selected">Tất cả</option>
            <option value="voted">Đã đánh giá</option>
            <option value="unvote">Chưa đánh giá</option>
          </optgroup>
          @foreach($canVoteGroup as $voteGroup)
          <optgroup label="{{$voteGroup->vote_code}} - {{$voteGroup->title}}">
            <option value="allgroup,{{$voteGroup->id}}">Tất cả</option>
            @foreach($canVotes as $vote)
              @if($vote->vote_group_id == $voteGroup->id)
                <option value="{{$voteGroup->id}},{{$vote->id}}">{{$vote->department->name}}</option>
              @endif
            @endforeach
          </optgroup>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</form>

@foreach($canVoteGroup as $voteGroup)
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div id="vote-group-id-{{$voteGroup->id}}" class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{$voteGroup->vote_code}} - {{$voteGroup->title}}
  </div>
</div>
<div class="portlet-body panel-content-area">
  

  
  @foreach($canVotes as $vote)
    @if($vote->vote_group_id == $voteGroup->id)
    <?php $roleCurrentUser = CustomHelper::get_role_current_user($vote->voter, $currentUser->id);
    $headerWidth = 65/count($roleCurrentUser)/2; ?>

    <table class="table table-striped table-bordered table-hover">
    <thead class="text-center">
      <tr>
        <th style="width: 5%">#</th>
        <th style="width: 15%">{{trans('all.full-name')}}</th>
        <th style="width: 15%">{{trans('all.job-title')}}</th>
        @foreach($roleCurrentUser as $roleId => $roleName)
        <th style="width: {{$headerWidth}}%">{{trans('all.mark')}}</th>
        <th style="width: {{$headerWidth}}%">{{trans('all.content-vote')}}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
    
    
    <tr class="vote-id-{{$vote->id}}">
      <td colspan="3"><strong>{{trans('all.department')}}:</strong> {{is_object($vote->department) ? $vote->department->name : ''}}</td>
      @foreach($roleCurrentUser as $roleId => $roleName)
      <td class="text-center">
        <form class="form-horizontal quick-ajax-form" data-form-name="mark">
          <div class="row">
            <div class="col-md-12">
              @if($vote->rating_type)
              <select name="form_mark" placeholder="Chọn xếp loại" class="form-control">
                @foreach($ratingTypes as $rating_type)
                <option value="{{$rating_type->id}}">{{$rating_type->name}}</option>
                @endforeach
              </select>
              @else
              <input type="text" name="form_mark" class="form-control" placeholder="Nhập điểm">
              @endif
            </div>
            <div class="col-md-12">
              <input type="hidden" name="vote_id" value="{{$vote->id}}" />
              <input type="hidden" name="voter_id" value="{{$currentUser->id}}" />
              <input type="hidden" name="role_id" value="{{$roleId}}" />
              <button type="submit" class="btn btn-info col-md-12"><i class="fa fa-check"></i> {{trans('all.save')}}</button>
            </div>
          </div>
        </form>
        {{$roleName}}
      </td>
      <td>
        <form class="form-horizontal quick-ajax-form" data-form-name="content">
          <div class="row">
            <div class="col-md-12">
              <input type="text" name="form_content" class="form-control" placeholder="Nhập nội dung">
            </div>
            <div class="col-md-12">
              <input type="hidden" name="vote_id" value="{{$vote->id}}" />
              <input type="hidden" name="voter_id" value="{{$currentUser->id}}" />
              <input type="hidden" name="role_id" value="{{$roleId}}" />
              <button type="submit" class="btn btn-info col-md-12"><i class="fa fa-check"></i> {{trans('all.save')}}</button>
            </div>
          </div>
        </form>
      </td>
      @endforeach
    </tr>
      <?php $number_in_department = 1; ?>
      @foreach(CustomHelper::get_users_from_user_id_list(explode(',', $vote->entitled_vote)) as $user)
      <?php 
        $voteResult = VoteResult::where('vote_id', $vote->id)
          ->where('voter_id', $currentUser->id)
          ->where('entitled_vote_id', $user->id)
          ->first();
      ?>
      <tr class="vote-id-{{$vote->id}} {{CustomHelper::check_voted_of_vote($voteResult) ? 'voted' : ''}}">
        <td>{{$number_in_department}}</td>
        <td>{{$user->full_name}}</td>
        <td>{{$user->job_titles_name()}}</td>
        @foreach($roleCurrentUser as $roleId => $roleName)
          <td>
            <p>
              <a href="#" class="role-mark {{$vote->rating_type ? 'rating-type' : 'mark-type'}} editable role-id-{{$roleId}}" data-vote="{{$vote->id}}" data-voter="{{$currentUser->id}}" data-entitled-vote="{{$user->id}}" data-pk="{{$roleId}}" data-name="mark" data-placement="top" data-placeholder="{{trans('all.input-mark')}}" data-title="Nhập điểm">
              {{CustomHelper::get_mark_with_role(['voteResult' => $voteResult, 'roleId' => $roleId, 'ratingType' => $vote->rating_type])}}
              </a>
            </p>
          </td>
          <td>
            <a href="#" class="vote-content editable role-id-{{$roleId}}" data-type="textarea" data-vote="{{$vote->id}}" data-voter="{{$currentUser->id}}" data-entitled-vote="{{$user->id}}" data-name="content" data-placement="top" data-pk="{{$roleId}}" data-title="{{trans('all.input-vote-content')}}">
              {{CustomHelper::get_mark_with_role(['voteResult' => $voteResult, 'roleId' => $roleId, 'content' => true])}}
            </a>
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
@endforeach



<script>
jQuery(document).ready(function() {   
  $('a.role-mark, a.vote-content').on('hidden', function(e, reason){
    
        if(reason === 'save' || reason === 'nochange') {

          var $next;
          if($(this).hasClass('role-mark'))
          {
            $next = $(this).closest('td').next().find('a.role-mark');
            if (!$next.length)
            {
              $next = $(this).closest('td').next().find('a.vote-content');
            }
          }else if($(this).hasClass('vote-content'))
          {
            if($(this).closest('tr').is(':last-child'))
            {
              $next = $(this).closest('div.portlet').next().find('div.portlet-body table tbody tr p a.role-mark:first');
            }else
            {
              $next = $(this).closest('td').next().find('a.role-mark');
              if (!$next.length)
              {
                next_tr = $(this).closest('tr').next();
  
                while(!next_tr.find('p a.role-mark').length)
                {
                  if(!next_tr.is(':last-child'))
                  {
                    next_tr = next_tr.next();
                  }else
                  {
                    break;
                  }
                }
  
                if(next_tr.find('p a.role-mark').length)
                {
                  $next = next_tr.find('p a.role-mark:first');
                }else
                {
                  $next = $(this).closest('div.portlet').next().find('div.portlet-body table tbody tr p a.role-mark:first');
                }
              }
            }
          }

          setTimeout(function() {
            App.scrollTo($next, -200);
            $next.editable('show');
          }, 300); 
        }
   });

  $('a.role-mark.mark-type').editable({
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
    type: 'text',
    inputclass: 'form-control input-small',
    emptytext: '{{trans('all.not-input-yet')}}',
  });

  $('a.role-mark.rating-type').editable({
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
    type: 'select',
    source: [
      @foreach($ratingTypes as $rating_type)
      {value: "{{$rating_type->id}}", text: "{{$rating_type->name}}"},
      @endforeach
    ],
    inputclass: 'form-control input-small',
    emptytext: '{{trans('all.not-input-yet')}}',
  });

  $('a.vote-content').editable({
    showbuttons: 'bottom',
    inputclass: 'form-control input-small',
    params: function (params) {  //params already contain `name`, `value` and `pk`
      params.vote = $(this).data('vote');
      params.voter = $(this).data('voter');
      params.entitled_vote = $(this).data('entitled-vote');
      return params;
    },
    url: '{{route('postQuickUserVote')}}',
    emptytext: '{{trans('all.not-input-yet')}}',
  });

  $("#department_list").select2({
    placeholder: '{{trans('all.select-department')}}',
    allowClear: true,
  });

  $('#department_list').change(function(){
    dataArr = $(this).val().split(',');
    //hide all data
    $('div[id^="vote-group-id-"]').addClass('hide');
    $('tr[class^="vote-id-"]').addClass('hide');
    //show current data
    if($(this).val() == 'all')
    {
      $('div[id^="vote-group-id-"]').removeClass('hide');
      $('tr[class^="vote-id-"]').removeClass('hide');
    }else if($(this).val() == 'voted')
    {
      var tr_voted = $('tr.voted');
      tr_voted.removeClass('hide');
      tr_voted.eq(0).closest('tbody').find('tr:first').removeClass('hide');
      tr_voted.eq(0).closest('div[id^="vote-group-id-"]').removeClass('hide');
    }else if($(this).val() == 'unvote')
    {
      var tr_unvote = $(':not(tr.voted)');
      tr_unvote.removeClass('hide');
      tr_unvote.eq(0).closest('div[id^="vote-group-id-"]').removeClass('hide');
    }else if(dataArr[0] == 'allgroup')
    {
      $('#vote-group-id-' + dataArr[1]).removeClass('hide');
      $('#vote-group-id-' + dataArr[1] + ' tr').removeClass('hide');
    }else
    {
      $('#vote-group-id-' + dataArr[0]).removeClass('hide');
      $('.vote-id-' + dataArr[1]).removeClass('hide');  
    }
  });
  @if(Input::has('show_vote_data'))
  $("#department_list").val("{{Input::get('show_vote_data')}}").change();
  @endif
  
  $('form.quick-ajax-form').submit(function(e){
    e.preventDefault();
    tr_avaiable = $(this).closest('tbody').find('tr:not(:first):not(.hide)');
    if($(this).data('form-name') == 'mark')
    {
      role_id = $(this).find('input[name=role_id]').val();
      a_mark_unvote = tr_avaiable.find('a.role-mark.editable-empty.role-id-'+role_id);
      var entitled_user = [];
      a_mark_unvote.each(function(){
        entitled_user.push($(this).data('entitled-vote'));
      });

      if (entitled_user.length > 0)
      {
        var xhr = $.ajax({
          type: 'POST',
          cache: false,
          async: false,
          url: '{{route('postQuickMultiUserVote')}}',
          data: 'mode=mark&entitled_user=' + entitled_user + '&' + $(this).serialize(),
        });
        result = xhr.responseJSON;
        toastr[result.messageType](result.message);
        if(result.actionStatus !== false)
        {
          mark_value = $(this).find('input[name=form_mark],select[name=form_mark]').val();
          a_mark_unvote.editable('setValue', mark_value);
        }
      }else
      {
        toastr['warning']('Không có điểm nào chưa nhập !');
      }
    }else
    {
      role_id = $(this).find('input[name=role_id]').val();
      a_content_unvote = tr_avaiable.find('a.vote-content.editable-empty.role-id-'+role_id);
      var entitled_user = [];
      a_content_unvote.each(function(){
        entitled_user.push($(this).data('entitled-vote'));
      });

      if (entitled_user.length > 0)
      {
        ajax_call_custom('POST', '{{route('postQuickMultiUserVote')}}', 'mode=content&entitled_user=' + entitled_user + '&' + $(this).serialize(), function(result){
          toastr[result.messageType](result.message);
        });
        content_value = $(this).find('input[name=form_content]').val();
        a_content_unvote.editable('setValue', content_value);
      }else
      {
        toastr['warning']('Không có nội dung nào chưa nhập !');
      }
    }
  });
  
});
</script>