@extends(Config::get('view.backend.master'))
@section('content')

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{trans('all.votes-list')}}
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
    <th></th>
    <th>{{trans('all.vote-code')}}</th>
    <th>{{trans('all.title')}}</th>
    <th style="width:15%">{{trans('all.status')}}</th>
    <th style="width:20%">{{trans('all.actions')}}</th>
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

  $('table tbody').on('click', 'a.export-excel', function(e){

    var xhr = $.ajax({
      type: 'GET',
      cache: false,
      async: false,
      url: '{{route('exportExcelReport')}}',
      data: 'item_id='+$(this).data('item-id')+'&item_type='+$(this).data('item-type'),
    });

    var uri = $("table").btechco_excelexport({
      datatype: $datatype.Html
      , html: xhr.responseText
      , returnUri: true
    });
    $(this).attr('download', $(this).data('file-name')).attr('href', uri).attr('target', '_blank');
  });

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

   // begin first table
   /*
  $('#ajax-data-table').dataTable({
    //'bAutoWidth': false,
    "aoColumns": [
      {"bSortable": false},
      null,
      null,
      null,
      null,
      {"bSortable": false},
    ],
    "aLengthMenu": [
        [10, 20, 30, -1],
        [10, 20, 30, "All"] // change per page values here
    ],
    // set the initial value
    "iDisplayLength": 10,

    "bServerSide": true,
    "sAjaxSource": "<?php echo URL::route('listVotes') ?>",
    "fnServerParams": function ( aoData ) {
      aoData.push( { "name": "mode", "value": "datatable" } );
    },
    */

  /* Formatting function for row details */
  

  /*
   * Initialize DataTables, with no sorting on the 'details' column
   */
  var oTable = $('#ajax-data-table').dataTable( {
      "aoColumnDefs": [
          {"bSortable": false, "aTargets": [ 0 ] },
          //{"sWidth": "5%", "aTargets": [ 2 ] },
          
      ],
      "aaSorting": [[1, 'asc']],
       "aLengthMenu": [
          [5, 15, 20, -1],
          [5, 15, 20, "All"] // change per page values here
      ],
      // set the initial value
      "iDisplayLength": 10,

      "bServerSide": true,
      "sAjaxSource": "{{route('listReportPeriod')}}",
      "fnServerParams": function ( aoData ) {
        aoData.push( { "name": "mode", "value": "datatable" } );
      },
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $(nRow).attr("id",'ajax-table-item-' + $('input[type=hidden]', aData[0]).val());
        return nRow;
      }
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
  var vote_group_id = $('input[type=hidden]', aData[0]).val();
  ajax_call_custom('GET', '{{route('listReportPeriod')}}', 'mode=votes_of_group&vote_group_id=' + vote_group_id, function(result){
    var sOut = '\
      <div class="table-responsive"> \
        <table class="table table-bordered table-hover">\
        <thead>\
        <tr>\
          <th style="width: 50%">{{trans('all.department')}}</th>\
          <th style="width: 15%">{{trans('all.date-create')}}</th>\
          <th style="width: 15%">{{trans('all.status')}}</th>\
          <th style="width: 20%">{{trans('all.actions')}}</th>\
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
@stop