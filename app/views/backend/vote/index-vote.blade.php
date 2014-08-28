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
  <table class="table table-striped table-bordered table-hover" id="ajax-data-table" action-delete="{{route('deleteVote')}}">
  <thead>
  <tr>
    <th class="table-checkbox">
      <input type="checkbox" class="group-checkable" data-set="#ajax-data-table .checkboxes"/>
    </th>
    <th>{{trans('all.vote-code')}}</th>
    <th>{{trans('all.title')}}</th>
    <th>{{trans('all.object-vote')}}</th>
    <th>{{trans('all.date-create')}}</th>
    <th>{{trans('all.status')}}</th>
    <th>{{trans('all.actions')}}</th>
  </tr>
  </thead>
  <tbody>
  @foreach($votes as $vote)
  <tr class="odd gradeX" id="ajax-table-item-{{$vote->id}}">
    <td>
      <div class="checker">
        <span>
          <input type="checkbox" class="checkboxes" value="{{ $vote->id }}"/>
        </span>
      </div>
    </td>
    <td>{{$vote->vote_code}}</td>
    <td>{{$vote->title}}</td>
    <td>
      {{$vote->object_entitled_vote_name()}}
    </td>
    <td>{{$vote->created_at->format('d/m/Y')}}</td>
    <td>
      @if($vote->status == Config::get('variable.vote-status.newly'))
        <span class="label label-primary">{{trans('all.newly')}}</span>
      @elseif($vote->status == Config::get('variable.vote-status.opened'))
        <span class="label label-success">{{trans('all.opened')}}</span>
      @else
        <span class="label label-default">{{trans('all.closed')}}</span>
      @endif
    </td>
    <td>
      <a href="{{route('showVote', $vote->id)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-search"></i> {{trans('all.view')}}</a>
      <a href="{{route('showVote', $vote->id)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> {{trans('all.edit')}}</a>
      <a item-id="{{$vote->id}}" class="btn btn-default btn-xs black remove-item"><i class="fa fa-trash-o"></i> {{trans('all.delete')}}</a>
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
  
   // begin first table
  $('#ajax-data-table').dataTable({
      //'bAutoWidth': false,
      "aoColumns": [
        {"bSortable": false},
        null,
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
  });

  //jQuery('#ajax-data-table_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
  jQuery('#ajax-data-table_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
  jQuery('#ajax-data-table_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
});
</script>
@stop