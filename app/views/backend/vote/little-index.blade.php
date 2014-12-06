<div class="note note-info">
  <h4 class="block">Ý nghĩa trạng thái</h4>
  <p>
     <span class="label label-primary">Mới tạo</span> Phiếu đánh giá vừa được tạo, có thể chỉnh sửa, xóa.
  </p>
  <p>
    <span class="label label-success">Đang đánh giá</span> Phiếu đánh giá đã được mở để nhân viên bắt đầu cho điểm, chỉ có thể sửa.
  </p>
  <p>
    <span class="label label-default">Đã chốt</span> Phiếu đánh giá đã được đóng để vào điểm, không thể sửa, xóa.
  </p>
</div>



<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{trans('all.votes-list')}}
  </div>
  <div class="actions">
    <a href="{{route('newVote')}}" class="btn btn-info ajaxify-child-page"><i class="fa fa-pencil"></i> {{trans('all.add')}}</a>
    <a href="#delete-modal" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{trans('all.delete')}}</a>
    <div class="btn-group">
      <button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> {{trans('all.actions')}} <i class="fa fa-angle-down"></i>
      </button>
      <ul class="dropdown-menu pull-right">
        <li>
          <a href="#open-vote-modal" data-toggle="modal">{{trans('all.vote-open')}}</a>
        </li>
        <li>
          <a href="#close-vote-modal" data-toggle="modal">{{trans('all.vote-close')}}</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="portlet-body panel-content-area">
  <table class="table table-striped table-bordered table-hover" id="ajax-data-table" action-delete="{{route('deleteVoteGroup')}}" action-open="{{route('openVoteGroup')}}" action-close="{{route('closeVoteGroup')}}">
  <thead>
  <tr>
    <th class="table-checkbox">
      <input type="checkbox" class="group-checkable" data-set="#ajax-data-table .checkboxes"/>
    </th>
    <th style="width:5%"></th>
    <th>{{trans('all.vote-code')}}</th>
    <th>{{trans('all.title')}}</th>
    <th style="width:10%">{{trans('all.status')}}</th>
    <th style="width:25%">{{trans('all.actions')}}</th>
  </tr>
  </thead>
  <tbody>
  </tbody>
  </table>
</div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{trans('all.confirm')}}
            </div>
            <div class="modal-body">
                {{trans('all.delete-confirm-notice')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
                <a href="#" class="btn btn-danger danger">{{trans('all.accept')}}</a>
            </div>
        </div>
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

<!-- Open/Close vote Modal Start -->
<div class="modal fade" id="open-vote-modal" tabindex="-1" role="open-vote-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{trans('all.confirm')}}</h4>
      </div>
      <div class="modal-body">
         Bạn có muốn mở các phiếu đánh giá đã chọn ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
        <button type="button" name="btn_submit" class="btn btn-success">{{trans('all.accept')}}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal END -->

<!-- Open/Close vote Modal Start -->
<div class="modal fade" id="close-vote-modal" tabindex="-1" role="open-vote-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{trans('all.confirm')}}</h4>
      </div>
      <div class="modal-body">
         Bạn có muốn chốt các phiếu đánh giá đã chọn ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
        <button type="button" name="btn_submit" class="btn btn-success">{{trans('all.accept')}}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal END -->


<!-- Modal 7 (Ajax Modal)-->
<div class="modal fade" id="modal-list-persions">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">{{trans('all.participant')}}</h4>
      </div>
      
      <div class="modal-body">
      
        {{trans('all.loading')}}
        
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
      </div>
    </div>
  </div>
</div>


<script>
jQuery(document).ready(function() {
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $('td.details_votes_of_group tr.canDeleteVote').removeClass('canDeleteVote');
    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
    $(this).find('.danger').attr('item-id', $(e.relatedTarget).data('item-id'));
    $(e.relatedTarget).closest('tr').addClass('canDeleteVote');
  });

  $('#confirm-delete a.danger').click(function(e){
    e.preventDefault();
    ajax_call_custom('DELETE', $(this).attr('href'), 'itemIds='+$(this).attr('item-id'), function(result){
      if(result.deletedVote == true)
      {
        $('#confirm-delete').modal('hide');
        $('td.details_votes_of_group tr.canDeleteVote').remove();
      }
    });
  });



  //clear checked when close modal
  $('table tbody').on('click', 'a.ajax-modal', function(e){
    e.preventDefault();
    var modal = 'modal-list-persions';
    jQuery('#'+modal).modal('show', {backdrop: 'static'});
  
    $.ajax({
      url: $(this).attr('href'),
      success: function(response)
      {
        jQuery('#'+modal+' .modal-body').html(response);
      }
    });
  });

  /*
   * Initialize DataTables, with no sorting on the 'details' column
   */
  var oTable = $('#ajax-data-table').dataTable( {
      "aoColumnDefs": [
          {"bSortable": false, "aTargets": [ 0 ] },
          {"bSortable": false, "aTargets": [ 1 ] },
          //{"sWidth": "5%", "aTargets": [ 2 ] },
          
      ],
      "aaSorting": [[2, 'asc']],
       "aLengthMenu": [
          [5, 15, 20, -1],
          [5, 15, 20, "All"] // change per page values here
      ],
      // set the initial value
      "iDisplayLength": 10,

      "bServerSide": true,
      "sAjaxSource": "{{route('listVotes')}}",
      "fnServerParams": function ( aoData ) {
        aoData.push( { "name": "mode", "value": "datatable" } );
      },
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $(nRow).attr("id",'ajax-table-item-' + $('input[type=checkbox]', aData[0]).val());
        return nRow;
      }
  });

  $('table tbody').on('click', 'a.unlock-vote-btn', function(e){
    ajax_call_custom('POST', '{{route('postUnlockVote')}}', 'vote_id=' + $(this).data('item-id'), function(result){
      oTable.fnDraw();
      toastr[result.messageType](result.message);
    });
  });

  $('table tbody').on('click', 'a.close-vote-btn', function(e){
    ajax_call_custom('POST', '{{route('postCloseVote')}}', 'vote_id=' + $(this).data('item-id'), function(result){
      oTable.fnDraw();
      toastr[result.messageType](result.message);
    });
  });

  /* Add event listener for opening and closing details
   * Note that the indicator for showing which row is open is not controlled by DataTables,
   * rather it is done here
   */
  $('#ajax-data-table').on('click', ' tbody td .row-details', function () {
      var nTr = $(this).parents('tr')[0];
      if ( oTable.fnIsOpen(nTr) )
      {
        /* This row is already open - close it */
        $(this).addClass("row-details-close").removeClass("row-details-open");
        oTable.fnClose( nTr );
      }
      else
      {
        /* Open this row */                
        $(this).addClass("row-details-open").removeClass("row-details-close");
        get_vote_of_groups(oTable, nTr)
      }
  });

  //jQuery('#ajax-data-table_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
  jQuery('#ajax-data-table_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
  jQuery('#ajax-data-table_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
});

function get_vote_of_groups(oTable, nTr)
{
  var aData = oTable.fnGetData( nTr );
  var vote_group_id = $('input[type=checkbox]', aData[0]).val();
  ajax_call_custom('GET', '{{route('listVotes')}}', 'mode=votes_of_group&vote_group_id=' + vote_group_id, function(result){
    var sOut = '\
      <div class="table-responsive"> \
        <table class="table table-bordered table-hover">\
        <thead>\
        <tr>\
          <th style="width: 30%">{{trans('all.department')}}</th>\
          <th style="width: 15%">{{trans('all.date-create')}}</th>\
          <th style="width: 15%">{{trans('all.status')}}</th>\
          <th style="width: 40%">{{trans('all.actions')}}</th>\
        </tr>\
        </thead>\
        <tbody>';
    for(var i in result.data)
    {
      if (result.data[i].status)
      sOut += '<tr>';
      sOut += '<td>'+result.data[i].department+'</td>';
      sOut += '<td>'+result.data[i].created_at+'</td>';
      sOut += '<td>'+result.data[i].status+'</td>';
      sOut += '<td>'+result.data[i].actions+'</td>';
      sOut += '</tr>';
    }
    sOut += '</tbody></table></div>';

    oTable.fnOpen( nTr, sOut, 'details_votes_of_group');
  });
}
</script>