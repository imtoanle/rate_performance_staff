@extends(Config::get('view.backend.master'))
@section('content')

<form class="form-horizontal base-ajax-form">
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-3">{{trans('all.vote-group')}}</label>
      <div class="col-md-6">
        <select name="department_list" id="department_list" class="form-control select2">
          <option></option>
          @foreach($voteGroups as $voteGroup)
            <optgroup label="{{$voteGroup->vote_code}} - {{$voteGroup->title}}">
              <option value="all-{{$voteGroup->id}}">Tất cả</option>
              @foreach($voteGroup->votes as $vote)
                <option value="{{$vote->id}}">{{$vote->department->name}}</option>
              @endforeach
            </optgroup>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</form>

@include(Config::get('view.backend.report-details-child'))

<script type="text/javascript">
  $(document).ready(function () {
    $('#department_list').change(function(){
      dataArr = $(this).val().split('-');
      if(dataArr[0] == 'all') 
      {
        
        //hide all
        $('div[id^="vote-id-"]').addClass('hide');
        //show only
        $('.vote-group-id-' + dataArr[1]).removeClass('hide');
      }else
      {
        //hide all
        $('div[id^="vote-id-"]').addClass('hide');
        //show only
        $('#vote-id-' + dataArr).removeClass('hide');
      }
    });
  });
</script>
@stop