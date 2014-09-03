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
  <ul class="nav nav-pills">
    <li class="active">
      <a href="#tab_entitled_vote" data-toggle="tab">{{trans('all.self-voting')}}</a>
    </li>
    <li class="">
      <a href="#tab_voter" data-toggle="tab">{{trans('all.self-voter')}}</a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade active in" id="tab_entitled_vote">
      <table id="my_mark_datatable" class="table table-striped table-bordered table-hover ajax-data-table">
        <thead>
        <tr>
          <th>{{trans('all.vote-code')}}</th>
          <th>{{trans('all.title')}}</th>
          <th>{{trans('all.status')}}</th>
          <th>{{trans('all.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="tab_voter">
      <table id="my_vote_datatable" class="table table-striped table-bordered table-hover ajax-data-table">
        <thead>
        <tr>
          <th>{{trans('all.vote-code')}}</th>
          <th>{{trans('all.title')}}</th>
          <th>{{trans('all.status')}}</th>
          <th>{{trans('all.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>   
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


<script>
jQuery(document).ready(function() {   
   // begin first table
  $('#my_mark_datatable').dataTable({
      //'bAutoWidth': false,
     
      "aLengthMenu": [
          [10, 20, 30, -1],
          [10, 20, 30, "All"] // change per page values here
      ],
      // set the initial value
      "iDisplayLength": 10,
      "sPaginationType": "bootstrap",

      "bServerSide": true,
      "sAjaxSource": "{{route('listUserVotes')}}",
      "fnServerParams": function ( aoData ) {
        aoData.push( { "name": "mode", "value": "view_my_point" } );
      },
  });

  $('#my_vote_datatable').dataTable({
      //'bAutoWidth': false,
     
      "aLengthMenu": [
          [10, 20, 30, -1],
          [10, 20, 30, "All"] // change per page values here
      ],
      // set the initial value
      "iDisplayLength": 10,
      "sPaginationType": "bootstrap",

      "bServerSide": true,
      "sAjaxSource": "{{route('listUserVotes')}}",
      "fnServerParams": function ( aoData ) {
        aoData.push( { "name": "mode", "value": "view_my_vote" } );
      },
  });

  //jQuery('#ajax-data-table_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
  jQuery('.dataTables_filter input').addClass("form-control input-medium"); // modify table search input
  jQuery('.dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
});
</script>
@stop