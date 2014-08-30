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
      <a href="#tab_voter" data-toggle="tab">{{trans('all.can-votes')}}</a>
    </li>
    <li class="">
      <a href="#tab_entitled_vote" data-toggle="tab">{{trans('all.self-voting')}}</a>
    </li>
    <li class="">
      <a href="#tab_old_vote" data-toggle="tab">{{trans('all.old-votes')}}</a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade active in" id="tab_voter">
      <table class="table table-striped table-bordered table-hover ajax-data-table" action-delete="{{route('deleteVote')}}">
        <thead>
        <tr>
          <th class="table-checkbox">
            <input type="checkbox" class="group-checkable" data-set="#ajax-data-table .checkboxes"/>
          </th>
          <th>{{trans('all.title')}}</th>
          <th>{{trans('all.object-vote')}}</th>
          <th>{{trans('all.entitled-vote')}}</th>
          <th>{{trans('all.date-create')}}</th>
          <th>{{trans('all.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($canVotes as $vote)
        <tr class="odd gradeX" id="ajax-table-item-{{$vote->id}}">
          <td>
            <div class="checker">
              <span>
                <input type="checkbox" class="checkboxes" value="{{ $vote->id }}"/>
              </span>
            </div>
          </td>
          <td>{{$vote->title}}</td>
          <td>
            <?php $object_groups = explode(',', $vote->object_entitled_vote) ?>
            @foreach($object_groups as $id)
            {{$groups[$id]}}, 
            @endforeach 
          </td>
          <td>
            <span data-toggle="popover" data-html="true" data-trigger="hover" data-placement="bottom" data-content-selector=".popover-entitled-user-{{$vote->id}}" data-original-title="{{trans('all.entitled-vote')}}">{{trans('all.list')}}</span>
            <div class="invi popover-entitled-user-{{$vote->id}}">
              <div class="table-responsive">
                <table class="table table-condensed table-hover">
                  <thead>
                    <tr>
                      <th>{{trans('all.username')}}</th>
                      <th>{{trans('all.full-name')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $entitled_users = explode(',', $vote->entitled_vote) ?>
                  @foreach($entitled_users as $id)
                  <tr>
                    <td>{{$users[$id]['username']}}</td>
                    <td>{{$users[$id]['full_name']}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </td>
          <td>{{$vote->created_at->format('d/m/Y')}}</td>
          <td>
              <a href="{{route('showVote', $vote->id)}}" class="ajaxify-child-page btn btn-default btn-xs purple"><i class="fa fa-edit"></i> {{trans('all.edit')}}</a>
              <a item-id="{{$vote->id}}" class="btn btn-default btn-xs black remove-item"><i class="fa fa-trash-o"></i> {{trans('all.delete')}}</a>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="tab_entitled_vote">
      
    </div>
    <div class="tab-pane fade" id="tab_old_vote">
      <p>
        dsadas Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.
      </p>
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
  $('.ajax-data-table').dataTable({
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
      ]
  });

  //jQuery('#ajax-data-table_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
  jQuery('.dataTables_filter input').addClass("form-control input-medium"); // modify table search input
  jQuery('.dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
});
</script>
@stop