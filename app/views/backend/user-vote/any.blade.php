@extends(Config::get('view.backend.master'))
@section('content')

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>Chấm điểm phiếu bất kì
  </div>
</div>
<div class="portlet-body panel-content-area">
  <form action="{{route('postAnyUserVote')}}" class="form-horizontal base-ajax-form" type="POST">
    <div class="form-body">
      <div class="form-group">
        <label class="col-md-3 control-label">Phiếu đánh giá</label>
        <div class="col-md-8">
          <select name="vote_group" class="form-control">
            <option disabled selected>Chọn phiếu</option>
            @foreach($openedVote as $voteGroupId => $votes)
            <?php $voteGroup = VoteGroup::findOrNew($voteGroupId); ?>
              <option value="{{$voteGroupId}}">{{$voteGroup->title}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label">Phòng ban</label>
        <div class="col-md-8">
          <select name="vote" class="form-control">
            <option disabled selected>Chọn phòng ban</option>
            
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label">Nhân viên</label>
        <div class="col-md-8">
          <select name="entitled_user" class="form-control">
            <option disabled selected>Chọn nhân viên</option>
            
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label">Số điểm</label>
        <div class="col-md-3">
          <input name="mark" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label">Nội dung</label>
        <div class="col-md-3">
          <textarea name="content" class="form-control"></textarea>
        </div>
      </div>

    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-info col-md-offset-3"><i class="fa fa-check"></i> Chấm điểm</button>
      </div>
  </form>
</div>
</div>

<script>
jQuery(document).ready(function() {  
  select_vote_group =  $('select[name="vote_group"]');
  select_vote = $('select[name="vote"]');
  select_vote_group.change(function(){
    vote_group_id = $(this).val();
    ajax_call_custom('GET', '{{route('anyUserVote')}}', 'request_mode=department&vote_group_id='+vote_group_id, function(data){
      vote_select = $('select[name="vote"]');
      //remove vote select
      vote_select.find('option').remove();
      vote_select.append('<option>Chọn phòng ban</option>');
      data.results.forEach(function(result) {
        vote_select.append('<option value="'+result.vote_id+'">'+result.department_name+'</option>');
      });
    });
  });

  select_vote.change(function(){
    vote_group_id = select_vote_group.val();
    vote_id = $(this).val();

    ajax_call_custom('GET', '{{route('anyUserVote')}}', 'request_mode=entitled_user&vote_group_id='+vote_group_id+'&vote_id='+vote_id, function(data){
      entitled_user_select = $('select[name="entitled_user"]');
      //remove vote select
      entitled_user_select.find('option').remove();
      entitled_user_select.append('<option>Chọn nhân viên</option>');
      data.results.forEach(function(result) {
        entitled_user_select.append('<option value="'+result.id+'">'+result.username+' ('+result.full_name+')</option>');
      });
    });
  });
});
</script>
@stop