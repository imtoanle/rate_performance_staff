<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>{{trans('all.show-vote')}}
    </div>
    <div class="tools">
      <a href="javascript:;" class="collapse"></a>
      <a href="form_layouts.html#portlet-config" data-toggle="modal" class="config"></a>
      <a href="javascript:;" class="reload"></a>
      <a href="javascript:;" class="remove"></a>
    </div>
  </div>
  <div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form action="{{route('putVote', $vote->id)}}" class="form-horizontal base-ajax-form" type="PUT">
      <div class="form-body">
        <h3 class="form-section">{{trans('all.vote-info')}}</h3>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.expiration-date')}}</label>
          <div class="col-md-8">
            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
              <input type="text" name="expiration_date" class="form-control" value="{{ date('d-m-Y', strtotime($vote->expired_at))}}" readonly>
              <span class="input-group-btn">
                <button class="btn btn-info" type="button"><i class="fa fa-calendar"></i></button>
              </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.vote-code')}}</label>
          <div class="col-md-8">
            <input type="text" name="vote_code" value="{{$vote->vote_code}}" class="form-control" placeholder="VD: VOTE102014">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.title')}}</label>
          <div class="col-md-8">
            <input type="text" name="title" value="{{$vote->title}}" class="form-control" placeholder="VD: Đánh giá nhân viên tháng xx">
          </div>
        </div>
        <!--
        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.object-vote')}}</label>
          <div class="col-md-8">
            <input type="text" name="object_vote_title" class="form-control" placeholder="VD: Trưởng/Phó phòng, chi nhánh">
          </div>
        </div>
        -->

        <div class="form-group">
          <label class="control-label col-md-3">{{trans('all.object-vote')}}</label>
          <div class="col-md-8">
            <select name="object_vote_list" id="select2_object_vote" class="form-control select2" multiple>
              <?php $objectVoteArr = explode(',', $vote->object_entitled_vote); ?>
              @foreach($jobTitles as $job)
              <option value="{{$job->id}}" {{in_array($job->id, $objectVoteArr) ? 'selected' : ''}}>{{$job->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3">{{trans('all.entitled-vote')}}</label>
          <div class="col-md-8">
            <?php $entitledVoteArr = explode(',', $vote->entitled_vote); ?>
            <select name="entitled_vote" class="multi-select select2" multiple="" id="multi_entitled_vote">
              @foreach(CustomHelper::get_users_from_job_list($objectVoteArr) as $key => $value)
                <optgroup job-id="{{$key}}" label="{{$value['jobName']}}">
                  @foreach($value['data'] as $user)
                    <option value="{{$user['id']}}" {{in_array($user['id'], $entitledVoteArr) ? 'selected' : ''}}>{{$user['username']}}</option>    
                  @endforeach
                </optgroup>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.voter')}}</label>
          <div class="col-md-7">
            <input type="hidden" name="select2_voter" id="select2_voter" class="form-control select2">
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
                        <input type="hidden" value="{{$user['role']}}" name="voter_role[]">
                        <span class="voter-role">{{$user['role']}}</span>
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

      </div>
      <div class="form-actions right">
        <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> {{trans('all.save')}}</button>
      </div>
    </form>
    <!-- END FORM-->
  </div>
</div>

@include(Config::get('view.backend.footer-js'))
<script>
jQuery(document).ready(function() {   
  var sel = $("#select2_object_vote");
  sel.data("prev",sel.val());

  if (jQuery().datepicker) {
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        autoclose: true
    });
  }

  $('#select2_object_vote').change(function(){
    ajax_call_custom('GET', '{{route('listUsersSearchJob')}}', 'old_object_vote='+$(this).data('prev')+'&new_object_vote='+$(this).val(), function(result){
      if (result.action == 'add')
      {
        var html_option = '';
        html_option += '<optgroup job-id="'+ result.jobId +'" label="'+result.jobTitleName+'">';
        for(var i in result.data)
        {
          if(!$('option[value='+ result.data[i].id +']').length)
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
    var user_id = $('#select2_voter').val();
    if (user_id.length)
    {
      ajax_call_custom('GET', '{{route('listUsersSearch')}}', 'user_id='+user_id, function(result){
        htm_tr = '<tr><td><input type="hidden" name="voter_id[]" value="'+user_id+'" /><span class="selected-voter">'+user_id+'</span></td><td>'+result[0].text+'</td><td>'+result[0].full_name+'</td><td>'+result[0].job_title_name+'</td><td>'+html_role_voter('{{trans('all.not-enter-yet')}}')+'</td><td><a class="item-remove btn btn-xs btn-danger"><i class="fa fa-times"></i> {{trans('all.delete')}}</a></td>';
        $('#list-voter tbody').append(htm_tr);
        $("#select2_voter").select2("val", "");
      });
    }else
    {
      toastr['error']('{{trans('all.messages.need-select-voter')}}');
    } 
  });

  $('#list-voter').on('click', 'a.item-remove', function(){
    $(this).closest('tr').remove();
  });

  $('#list-voter').on('click', 'span.voter-role', function(){
    $(this).closest('td').html('<input type="text" class="input-voter-list form-control" name="voter_role[]" value="'+$(this).html()+'">');
  });

  $('#list-voter').on('focusout', 'input.input-voter-list', function(){
    change_input_to_html($(this));
  });

  $('#list-voter').on('keydown', 'input.input-voter-list', function(e){
    if(e.keyCode == 13){
        change_input_to_html($(this));
    }
  });

  function change_input_to_html(element)
  {
    element.closest('td').html(html_role_voter(element.val()));
  }

  function html_role_voter(text)
  {
    return '<input type="hidden" name="voter_role[]" value="'+text+'"/><span class="voter-role">'+text+'</span>';
  }

  $("#select2_object_vote").select2({
    placeholder: '{{trans('all.select-object-vote')}}',
    allowClear: true,
  });

  $('#select2_voter').select2({
    placeholder: "{{trans('all.select-voter')}}",
    minimumInputLength: 1,
    ajax: {
      url: "{{route('listUsersSearch')}}",
      dataType: 'json',
      data: function(term, page) {
        var selected_voter = $('#list-voter tbody .selected-voter').map(function(){ return $(this).html(); }).get();
        if (selected_voter.length)
        {
          selected_user = $('#multi_entitled_vote').val() + ',' + selected_voter;
        }else
        {
          selected_user = $('#multi_entitled_vote').val();
        }
        return {
          q: term,
          page_limit: 10,
          select_id: $(this).attr('id'),
          entitled_user: selected_user,
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    },
    formatResult: markup_result, // omitted for brevity, see the source of this page
    //formatSelection: function(user){ return user.text;}, // omitted for brevity, see the source of this page
    //dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
  });

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


                