<?php 
if(isset($vote))
{
  $vote = $vote;
}elseif(isset($copyVote))
{
  $vote = new Vote;
  $vote->voter = $copyVote->voter;
}else
  {$vote = new Vote;}
?>
<!--
<div class="form-group">
  <label class="col-md-3 control-label">{{trans('all.head-department')}}</label>
  <div class="col-md-8">
    <input type="hidden" name="can_view_results" id="can_view_results" class="form-control select2">
  </div>
</div>
-->

<div class="form-group">
  <label class="col-md-3 control-label">{{trans('all.expiration-date')}}</label>
  <div class="col-md-8">
    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
      <input type="text" name="expiration_date" class="form-control" value="{{ isset($vote->expired_at) ? date('d-m-Y', strtotime($vote->expired_at)) : '' }}" readonly>
      <span class="input-group-btn">
        <button class="btn btn-info" type="button"><i class="fa fa-calendar"></i></button>
      </span>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3">{{trans('all.department')}}</label>
  <div class="col-md-8">
    <select name="department_list" id="select2_department" class="form-control select2">
      <option></option>
      @foreach($departments as $department)
      <option value="{{$department->id}}" {{ $department->id == $vote->department_id ? 'selected' : '' }}>{{$department->name}}</option>
      @endforeach
    </select>
  </div>
</div>
<!--
<div class="form-group">
  <label class="control-label col-md-3">{{trans('all.criteria')}}</label>
  <div class="col-md-8">
    <select name="criteria_list" id="select2_criteria" class="form-control select2" multiple>
      @foreach($criterias as $criteria)
      <option value="{{$criteria->id}}">{{$criteria->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3">{{trans('all.object-vote')}}</label>
  <div class="col-md-8">
    <select name="object_vote_list" id="select2_object_vote" class="form-control select2" multiple>
      @foreach($jobTitles as $job)
      <option value="{{$job->id}}">{{$job->name}}</option>
      @endforeach
    </select>
  </div>
</div>
-->

<div class="form-group">
  <label class="col-md-3 control-label">{{trans('all.object-vote')}}</label>
  <div class="col-md-8">
    <input type="text" name="object_vote_title"  value="{{$vote->object_entitled_vote}}" class="form-control" placeholder="VD: Trưởng/Phó phòng, chi nhánh">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3">{{trans('all.entitled-vote')}}</label>
  <div class="col-md-8">
    <select name="entitled_vote" class="multi-select select2" multiple="" id="multi_entitled_vote">
      <?php $entitledVoteArr = explode(',', $vote->entitled_vote); ?>
      @foreach($departments as $department)
        <optgroup label="{{$department->name}}">
          @if(isset($usersArray[$department->id]))
          @foreach($usersArray[$department->id] as $user)
            <option value="{{$user->id}}" {{in_array($user->id, $entitledVoteArr) ? 'selected' : ''}}>{{$user->username}} ({{$user->full_name}})</option>
          @endforeach
          @endif
        </optgroup>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">{{trans('all.voter')}}</label>
  <div class="col-md-5">
    <select name="select2_voter" id="select2_voter" class="form-control select2">
      <option></option>
      @foreach($departments as $department)
        <optgroup label="{{$department->name}}">
          @if(isset($usersArray[$department->id]))
          @foreach($usersArray[$department->id] as $user)
            <option value="{{$user->id}}">{{$user->username}} ({{$user->full_name}})</option>
          @endforeach
          @endif
        </optgroup>
      @endforeach
    </select>
  </div>
  <div class="col-md-2">
    <select id="type_of_persion" class="form-control">
      <option value="1">Người chấm điểm</option>
      <option value="2">Người xem báo cáo</option>
      <option value="3">Người chốt điểm</option>
    </select>
  </div>
  <div class="col-md-1">
    <button type="button" id="add_voter" class="btn btn-success">{{trans('all.add')}}</button>
  </div>
</div>

<div class="form-group">
  <div class="col-md-offset-1 col-md-10">
    <!-- BEGIN BORDERED TABLE PORTLET-->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-user"></i>{{trans('all.selected-voter-list')}}
        </div>
      </div>
      <div class="portlet-body">

        <div class="table-responsive">
          <table id="list-voter" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>{{trans('all.username')}}</th>
              <th>{{trans('all.full-name')}}</th>
              <th>{{trans('all.job-title')}}</th>
              <th>{{trans('all.role')}}</th>
              <th>{{trans('all.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach(CustomHelper::get_users_from_voter_list($vote->voter) as $user)
              <tr>
                <td>
                  <input type="hidden" value="{{$user['id']}}" name="voter_id[]">
                  <span class="selected-voter">{{$user['id']}}</span>
                </td>
                <td>{{$user['username']}}</td>
                <td>{{$user['full_name']}}</td>
                <td>{{$user['job_name']}}</td>
                <td>
                  <select name="voter_role[]" class="form-control select2-role">
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" {{$role->id == $user['role'] ? 'selected' : ''}}>{{$role->name}}</option>
                    @endforeach
                  </select>
                </td>
                <td><a class="item-remove btn btn-xs btn-danger"><i class="fa fa-times"></i> {{trans('all.delete')}}</a></td>
              </tr>
            @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-md-offset-1 col-md-10">
    <!-- BEGIN BORDERED TABLE PORTLET-->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-user"></i>Danh sách thành viên đặc biệt
        </div>
      </div>
      <div class="portlet-body">

        <div class="table-responsive">
          <table id="list-specify-user" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>{{trans('all.username')}}</th>
              <th>{{trans('all.full-name')}}</th>
              <th>{{trans('all.job-title')}}</th>
              <th>Quyền hạn</th>
              <th>{{trans('all.actions')}}</th>
            </tr>
          </thead>
          <tbody>
          @foreach(CustomHelper::get_users_from_specify_users_list($vote->specify_user) as $user)
            <tr>
              <td>
                <input type="hidden" value="{{$user['id']}},{{$user['type_of_person']}}" name="specify_user[]">
                {{$user['id']}}
              </td>
              <td>{{$user['username']}}</td>
              <td>{{$user['full_name']}}</td>
              <td>{{$user['job_name']}}</td>
              <td>
                @if($user['type_of_person'] == Config::get('variable.type-of-person.view-report'))
                Người xem báo cáo
                @else($user['type_of_person'] == Config::get('variable.type-of-person.head-grading'))
                Người chốt điểm
                @endif
              </td>
              <td><a class="item-remove btn btn-xs btn-danger"><i class="fa fa-times"></i> {{trans('all.delete')}}</a></td>
            </tr>
            @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@include(Config::get('view.backend.footer-js'))
<script>
jQuery(document).ready(function() {   
  /*
  var sel = $("#select2_object_vote");
  sel.data("prev",sel.val());
  */

  if (jQuery().datepicker) {
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        autoclose: true
    });
  }

  /*
  $('#select2_object_vote').change(function(){
    ajax_call_custom('GET', '{{route('listUsersSearchJob')}}', 'old_object_vote='+$(this).data('prev')+'&new_object_vote='+$(this).val(), function(result){
      if (result.action == 'add')
      {
        var html_option = '';
        html_option += '<optgroup job-id="'+ result.jobId +'" label="'+result.jobTitleName+'">';
        for(var i in result.data)
        {
          if(!$('#multi_entitled_vote option[value='+ result.data[i].id +']').length)
          {
            html_option += '<option value="'+result.data[i].id+'">'+result.data[i].username+' ('+result.data[i].full_name+')</option>';  
          }
        }
        html_option += '</optgroup>';

        $('#multi_entitled_vote').append(html_option);
      }else if(result.action == 'delete')
      {
        $('optgroup[job-id='+ result.jobId +']').remove();
      }
      $('#multi_entitled_vote').multiSelect('refresh');
    });
    $(this).data("prev",$(this).val());
  });

  $('#select2_department').change(function(){
    $('optgroup[department-id]').remove();

    if($(this).val() == 'all')
    {

      $('#multi_entitled_vote').multiSelect('refresh');
    }else
    {
      ajax_call_custom('GET', '{{route('listUsersSearchDepartment')}}', 'department_id='+$(this).val(), function(result){
        var html_option = '';
        html_option += '<optgroup department-id="'+ result.departmentId +'" label="'+result.departmentName+'">';
        for(var i in result.data)
        {
          if(!$('#multi_entitled_vote option[value='+ result.data[i].id +']').length)
          {
            html_option += '<option value="'+result.data[i].id+'">'+result.data[i].username+' ('+result.data[i].full_name+')</option>';  
          }
        }
        html_option += '</optgroup>';
  
        $('#multi_entitled_vote').append(html_option);
        $('#multi_entitled_vote').multiSelect('refresh');
      });
    }
  });
*/


  $('#multi_entitled_vote').multiSelect({
      selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='{{trans('all.search')}}...'>",
      selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='{{trans('all.search')}}...'>",
      afterInit: function (ms) {
          var that = this,
              $selectableSearch = that.$selectableUl.prev(),
              $selectionSearch = that.$selectionUl.prev(),
              selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
              selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

          that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
              .on('keydown', function (e) {
                  if (e.which === 40) {
                      that.$selectableUl.focus();
                      return false;
                  }
              });

          that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
              .on('keydown', function (e) {
                  if (e.which == 40) {
                      that.$selectionUl.focus();
                      return false;
                  }
              });
      },
      afterSelect: function () {
          this.qs1.cache();
          this.qs2.cache();
      },
      afterDeselect: function () {
          this.qs1.cache();
          this.qs2.cache();
      }
  });


    $('#add_voter').on('click', function(){
    var user_id = $('#select2_voter').val(),
        type_of_persion = $('#type_of_persion');
    if (user_id.length)
    {
      ajax_call_custom('GET', '{{route('listUsersSearch')}}', 'user_id='+user_id, function(result){
        switch (type_of_persion.val())
        {
          case '1':
            select_box = '<select name="voter_role[]" class="form-control select2-role"> \
              <option value="" disabled selected>{{trans('all.select-role')}}</option> \
              @foreach($roles as $role)
              <option value="{{$role->id}}">{{$role->name}}</option> \
              @endforeach
            </select>';
            htm_tr = '<tr><td><input type="hidden" name="voter_id[]" value="'+user_id+'" /><span class="selected-voter">'+user_id+'</span></td><td>'+result[0].text+'</td><td>'+result[0].full_name+'</td><td>'+result[0].job_title_name+'</td><td>'+select_box+'</td><td><a class="item-remove btn btn-xs btn-danger"><i class="fa fa-times"></i> {{trans('all.delete')}}</a></td>';
            $('#list-voter tbody').append(htm_tr);
            break;
          default:
            permission_content = type_of_persion.val() == '2' ? 'Người xem báo cáo' : 'Người chốt điểm';
            htm_tr = '<tr><td><input type="hidden" name="specify_user[]" value="'+user_id+','+type_of_persion.val()+'" />'+user_id+'</td><td>'+result[0].text+'</td><td>'+result[0].full_name+'</td><td>'+result[0].job_title_name+'</td><td>'+permission_content+'</td><td><a class="item-remove btn btn-xs btn-danger"><i class="fa fa-times"></i> {{trans('all.delete')}}</a></td>';
            $('#list-specify-user tbody').append(htm_tr);
        }
        $("#select2_voter").select2("val", "");
      });
    }else
    {
      toastr['error']('{{trans('all.messages.need-select-voter')}}');
    } 
  });

  $('#list-voter, #list-specify-user').on('click', 'a.item-remove', function(){
    $(this).closest('tr').remove();
  });

  /*
  $("#select2_object_vote").select2({
    placeholder: '{{trans('all.select-object-vote')}}',
    allowClear: true,
  });
  */

  $('#select2_department').select2({
    placeholder: '{{trans('all.select-department')}}',
    allowClear: true,
  });

  $('#select2_voter').select2({
    placeholder: 'Chọn người chấm điểm',
    allowClear: true,
    minimumInputLength: 4, 
  });

/*
  $("#select2_criteria").select2({
    placeholder: '{{trans('all.select-criteria')}}',
    allowClear: true,
  });
*/
  /*
  $('#select2_voter').select2({
    placeholder: "{{trans('all.select-voter')}}",
    minimumInputLength: 1,
    ajax: {
      url: "{{route('listUsersSearch')}}",
      dataType: 'json',
      data: function(term, page) {
        var selected_voter = $('#list-voter tbody .selected-voter').map(function(){ return $(this).html(); }).get();
        return {
          q: term,
          page_limit: 10,
          select_id: $(this).attr('id'),
          selected_voter: selected_voter,
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    },
    formatResult: markup_result, // omitted for brevity, see the source of this page
    //formatSelection: function(user){ return user.text;}, // omitted for brevity, see the source of this page
    //dropdownCssClass: "bigdrop", apply css that makes the dropdown taller
  });
  */
  

});

function markup_result(user, data1, query){
  var markup = '\
    <div class="row">\
      <div class="col-md-3">\
        <i class="fa fa-user"></i>'+ user.text.replace(new RegExp('(' + query.term + ')', 'gi'), '<b class="color-success">$1</b>') + '\
      </div>\
      <div class="col-md-3">\
        <i class="fa fa-credit-card"></i> '+ user.full_name.replace(new RegExp('(' + query.term + ')', 'gi'), '<b class="color-success">$1</b>') +'\
      </div>\
      <div class="col-md-6">\
        <i class="fa fa-group"></i> '+ user.job_title_name +'\
      </div>\
    </div>';
  
  return markup;
}
</script>                