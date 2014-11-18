@extends(Config::get('view.backend.master'))
@section('content')

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{trans('all.votes-list')}}
  </div>
</div>
<div class="portlet-body panel-content-area">
  <table id="my_mark_datatable" class="table table-striped table-bordered table-hover ajax-data-table">
    <thead>
    <tr>
      <th>{{trans('all.vote-code')}}</th>
      <th>{{trans('all.title')}}</th>
      <th>{{trans('all.department')}}</th>
      <th>{{trans('all.actions')}}</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->

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
      "sAjaxSource": "{{route('listReportSpecifyUser')}}",
      "fnServerParams": function ( aoData ) {
        aoData.push( { "name": "mode", "value": "datatable" } );
      },
  });

  //jQuery('#ajax-data-table_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
  jQuery('.dataTables_filter input').addClass("form-control input-medium"); // modify table search input
  jQuery('.dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
});
</script>
@stop