<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="row">
  <div class="col-md-6">
    <!-- BEGIN ALERTS PORTLET-->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>{{trans('all.infomation')}}
        </div>
      </div>
      <div class="portlet-body">
        <!-- BEGIN FORM-->
        <form action="{{route('newUserPost')}}" type="POST" class="form-horizontal base-ajax-form">
          <div class="form-body">
            <div class="form-group">
              <label class="col-md-3 control-label">{{trans('all.username')}}</label>
              <div class="col-md-9">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </span>
                  <input type="text" class="form-control" name="username" placeholder="{{trans('all.username')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">{{trans('all.email')}}</label>
              <div class="col-md-9">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                  </span>
                  <input type="text" class="form-control" name="email" placeholder="{{trans('all.email')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">{{trans('all.password')}}</label>
              <div class="col-md-9">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-key"></i>
                  </span>
                  <input type="password" class="form-control" name="password" placeholder="{{trans('all.password')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">{{trans('all.full-name')}}</label>
              <div class="col-md-9">
                <div class="">
                  
                  <input type="text" class="form-control" name="full_name" placeholder="{{trans('all.full-name')}}">
                </div>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3">{{trans('all.group')}}</label>
              <div class="col-md-9">
                  <select id="select_groups" name="select_groups" class="form-control select2" multiple>
                    @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12" style="margin-bottom: 5px;">
                <label class="col-md-offset-1 control-label">{{trans('all.permission')}}</label>
                <label class="col-md-offset-5 control-label">{{trans('all.selected-permission')}}</label>
              </div>

              <div class="">
                <div class="col-md-12">
                  <select multiple="multiple" class="multi-select" id="select_permissions" name="select_permissions[]">
                    @foreach($permissions as $permission)
                    <?php
                      $currentGroup = isset($tagGroup) ? $tagGroup : 'first';
                      $tagGroup = explode("_", $permission->value)[0];
                    ?>
                    @if($tagGroup != $currentGroup)
                      @if($currentGroup != 'first')
                        </optgroup>
                      @endif
                    <optgroup label="{{trans('all.permission-group-name.'.$tagGroup)}}">
                    @endif
                      <option value="{{$permission->value}}">{{$permission->name}}</option>
                    @endforeach
                    </optgroup>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-actions fluid">
            <div class="col-md-offset-3 col-md-9">
              <button type="submit" class="btn btn-info">{{trans('all.update')}}</button>
            </div>
          </div>
        </form>
        <!-- END FORM-->

      </div>
    </div>
    <!-- END ALERTS PORTLET-->
  </div>

  <div class="col-md-6">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box light-grey">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-globe"></i>{{trans('all.user-infomation')}}
      </div>
    </div>
    <div class="portlet-body" id="users-in-group">

     
    </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>


@include(Config::get('view.backend.footer-js'))
<script>
jQuery(document).ready(function() {   
  $('#select_permissions').multiSelect({
      selectableOptgroup: true
  });

  $('#select_groups').select2({
    placeholder: "{{trans('all.select-group')}}",
    allowClear: true
  });

  $('#select_groups').change(function(){
    //alert($(this).val());
  });

  // begin first table
  var ajaxTable = $('#ajax-data-table').dataTable({
    bFilter: false,
    bLengthChange: false,
      "aoColumns": [
        null,
        null,
        null,
        {"bSortable": false},
      ],
      // set the initial value
      "iDisplayLength": 10,
      "sPaginationType": "bootstrap",
      "oLanguage": {
          "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;{{trans('all.please-wait')}}',
          "sLengthMenu": "_MENU_ records",
          "oPaginate": {
              "sPrevious": "Prev",
              "sNext": "Next"
          }
      },
      "aoColumnDefs": [{
              'bSortable': false,
              'aTargets': [0]
          }
      ],
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $(nRow).attr("id",'row-user-in-group-' + aData[0]);
        return nRow;
      }
  });

  $( "form#update-user-in-group" ).on( "submit", function( event ) {
    event.preventDefault();
    ajax_call_custom($(this).attr('type'), $(this).attr('action'), $( this ).serialize(), successAddUserToGroup);
  });

  $("#users-in-group").on( "click", "#ajax-data-table a.remove-user", function( event ) {
    event.preventDefault();
    ajax_call_custom('DELETE', $(this).attr('href'), null, successDeleteUserFromGroup);
  });

});

function successAddUserToGroup(result)
{
  ajaxTable = $('#ajax-data-table').dataTable();
  toastr[result.messageType](result.message, "{{trans('all.notification')}}")
  if (result.actionPerformed === true)
  {
    //add row to table users group
    var action_html = '<a href="'+result.data.linkEdit+'" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> Edit</a> \
    <a href="'+result.data.linkRemoveGroup+'" class="btn btn-default btn-xs black remove-user"><i class="fa fa-trash-o"></i> Delete</a>';
    ajaxTable.fnAddData([result.data.userId, result.data.username, result.data.full_name, action_html ]);

    //clear row in select2
    
    $("#update-user-in-group select option[value='"+result.data.userId+"']").remove();
    $("#update-user-in-group select").select2("val", "");
  }
}

function successDeleteUserFromGroup(result)
{
  ajaxTable = $('#ajax-data-table').dataTable();
  toastr[result.messageType](result.message, "{{trans('all.notification')}}")
  if (result.actionPerformed === true)
  {
    //delete row
    var row = $('#row-user-in-group-'+ result.data.userId).get(0);
    ajaxTable.fnDeleteRow(ajaxTable.fnGetPosition(row));

    //add to select2
    //$("#update-user-in-group select").append($('<option>', {value:result.data.userId, text: result.data.username + ' - <strong>' + result.data.full_name + '</strong>'}));
    var full_name = result.data.full_name == null ? '' : result.data.full_name;
    $("#update-user-in-group select").append('<option value="'+result.data.userId+'">'+result.data.username + ' - <strong>' + full_name + '</strong></option>');
  }
}
</script>
