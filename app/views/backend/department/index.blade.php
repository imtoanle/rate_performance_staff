@extends(Config::get('view.backend.master'))
@section('content')

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{trans('all.department-list')}}
  </div>
  <div class="actions">
    <a id="ajax-data-table_new" class="btn btn-info"><i class="fa fa-pencil"></i> {{trans('all.add')}}</a>
    <a href="#delete-modal" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{trans('all.delete')}}</a>
    
    <a class="btn btn-warning" href="table_managed.html#"><i class="fa fa-print"></i> Print</a>
  </div>
</div>
<div class="portlet-body panel-content-area">
  <table class="table table-striped table-bordered table-hover" id="ajax-data-table" action-delete="{{route('deleteDepartment')}}">
  <thead>
  <tr>
    <th class="table-checkbox">
      <input type="checkbox" class="group-checkable" data-set="#ajax-data-table .checkboxes"/>
    </th>
    <th>{{trans('all.name')}}</th>
    <th>{{trans('all.actions')}}</th>
  </tr>
  </thead>
  <tbody>
  @foreach($departments as $department)
  <tr class="odd gradeX" id="ajax-table-item-{{$department->id}}">
    <td>
      <div class="checker">
        <span>
          <input type="checkbox" class="checkboxes" value="{{ $department->id }}"/>
        </span>
      </div>
    </td>
    <td>{{$department->name}}</td>
    <td>
      <a class="edit btn btn-default btn-xs purple"><i class="fa fa-edit"></i> {{trans('all.edit')}}</a>
      <a item-id="{{$department->id}}" class="btn btn-default btn-xs black remove-item"><i class="fa fa-trash-o"></i> {{trans('all.delete')}}</a>
    </td>
  </tr>
  @endforeach
  </tbody>
  </table>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
<!-- Modal Start -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="delete-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{trans('all.confirm')}}</h4>
      </div>
      <div class="modal-body">
         {{trans('all.delete-confirm-notice')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
        <button type="button" name="btn_submit" class="btn btn-danger">{{trans('all.accept')}}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal END -->

<script>
jQuery(document).ready(function() {   
  var oTable = $('#ajax-data-table').dataTable({
    //'bAutoWidth': false,
    "aoColumns": [
      {"bSortable": false},
      null,
      {"bSortable": false, "sWidth": "20%"},
    ],
    "aLengthMenu": [
        [10, 20, 30, -1],
        [10, 20, 30, "All"] // change per page values here
    ],
    // set the initial value
    "iDisplayLength": 10,
    "sPaginationType": "bootstrap",
  });

  jQuery('#ajax-data-table_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
  jQuery('#ajax-data-table_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown

  jQuery('#ajax-data-table_wrapper .dataTables_length select').select2({
    showSearchInput : false //hide search box with special css class
  }); // initialize select2 dropdown

  var nEditing = null;

  $('#ajax-data-table_new').click(function (e) {
    e.preventDefault();
    if (!$('a[data-mode="new"]').length)
    {
      if (nEditing != null)
      {
        restoreRow(oTable, nEditing);
      }
      var aiNew = oTable.fnAddData(['', '', '<a class="edit btn btn-default btn-xs purple" edit-mode="save"><i class="fa fa-edit"></i> {{trans('all.save')}}</a><a class="cancel btn btn-default btn-xs black" data-mode="new"><i class="fa fa-trash-o"></i> {{trans('all.cancel')}}</a>']);
      var nRow = oTable.fnGetNodes(aiNew[0]);
      editRow(oTable, nRow, true);
      nEditing = nRow;
    }
  });

  $('#ajax-data-table a.cancel').live('click', function (e) {
    e.preventDefault();
    cancelAllRow();
  });

  $('#ajax-data-table a.edit').live('click', function (e) {
    e.preventDefault();

    /* Get the row as a parent of the link that was clicked on */
    var nRow = $(this).parents('tr')[0];
    if (nEditing !== null && nEditing != nRow) {
        /* Currently editing - but not this row - restore the old before continuing to edit mode */
        cancelAllRow();
        editRow(oTable, nRow);
        nEditing = nRow;
    } else if (nEditing == nRow && $(this).attr('edit-mode') == 'save') {
        /* Editing this row and want to save it */
        if ($(this).attr('data-mode') == 'new')
        {
          saveRow(oTable, nEditing, true);
        }else
        {
          saveRow(oTable, nEditing);
        }
        
        nEditing = null;
    } else {
        /* No edit in progress - let's start one */
        editRow(oTable, nRow);
        nEditing = nRow;
    }
  });

  function cancelAllRow()
  {
    var new_row = $('a[data-mode="new"]');
    if (new_row.length)
    {
      oTable.fnDeleteRow(new_row.parents('tr')[0]);
    }else
    {
      restoreRow(oTable, nEditing);
    }
    nEditing = null;
  }
});

function restoreRow(oTable, nRow) {
    var aData = oTable.fnGetData(nRow);
    var jqTds = $('>td', nRow);

    for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
        oTable.fnUpdate(aData[i], nRow, i, false);
    }

    oTable.fnDraw();
}

function editRow(oTable, nRow, new_mode) {
    if (typeof new_mode === 'undefined') { new_mode = false; }
    var aData = oTable.fnGetData(nRow),
      itemId = $('input', aData[0]);
    var jqTds = $('>td', nRow),
    new_mode_string = new_mode ? 'data-mode="new"' : '';
    jqTds[1].innerHTML = '<input type="text" class="form-control input-xlarge" item-id="'+itemId.val()+'" value="' + aData[1] + '">';
    jqTds[2].innerHTML = '<a class="edit btn btn-default btn-xs purple" edit-mode="save" '+new_mode_string+'><i class="fa fa-edit"></i> {{trans('all.save')}}</a><a class="cancel btn btn-default btn-xs black" '+new_mode_string+'><i class="fa fa-trash-o"></i> {{trans('all.cancel')}}</a>';
}

function saveRow(oTable, nRow, new_mode) {
    if (typeof new_mode === 'undefined') { new_mode = false; }
    var jqInputs = $('input', nRow);
    if (new_mode)
    {
      type_method = 'POST';
      route = '{{route('newDepartmentPost')}}';
      value_row = jqInputs[0].value
      data_xhr = 'department_name='+value_row;

    }else
    {
      type_method = 'PUT';
      route = '{{route('putDepartment')}}';
      value_row = jqInputs[1].value;
      data_xhr = 'department_id='+jqInputs[1].getAttribute('item-id')+'&department_name='+value_row;
    }
    ajax_call_custom(type_method, route, data_xhr, function(result){
      if(typeof(result.errorMessages) != 'undefined')
      {
        showRegisterFormAjaxErrorsNotify(result.errorMessages);
      }else if (typeof(result.message) != 'undefined')
      {
        toastr[result.messageType](result.message);
        var checkbox = '<div class="checker"><span><input type="checkbox" class="checkboxes" value="'+result.itemId+'"/></span></div>',
          actions = '<a class="edit btn btn-default btn-xs purple"><i class="fa fa-edit"></i> {{trans('all.edit')}}</a>\
      <a item-id="'+result.itemId+'" class="btn btn-default btn-xs black remove-item"><i class="fa fa-trash-o"></i> {{trans('all.delete')}}</a>';
        oTable.fnUpdate(checkbox, nRow, 0, false);
        oTable.fnUpdate(value_row, nRow, 1, false);
        oTable.fnUpdate(actions, nRow, 2, false);
      }
    });
    oTable.fnDraw();
}

</script>
@stop