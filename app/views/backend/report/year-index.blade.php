@extends(Config::get('view.backend.master'))
@section('content')

<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box light-grey">
<div class="portlet-title">
  <div class="caption">
    <i class="fa fa-list"></i>{{trans('all.select-report-type')}}
  </div>
</div>
<div class="portlet-body panel-content-area">
  <form action="{{route('postNewVote')}}" class="form-horizontal base-ajax-form" type="POST">
    <div class="form-body">
      <div class="form-group">
        <label class="col-md-3 control-label">{{trans('all.select-year')}}</label>
        <div class="col-md-8">
          <select name="year" class="form-control">
            <option value="2014">2014</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label">{{trans('all.select-report-type')}}</label>
        <div class="col-md-8">
          <select name="vote_type" class="form-control">
            <option value="1">Báo cáo theo phòng ban</option>
            <option value="2">Báo cáo tổng hợp cả ban</option>
          </select>
        </div>
      </div>


    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-info col-md-offset-3"><i class="fa fa-check"></i> {{trans('all.report')}}</button>
      </div>
  </form>
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

  
 
});


</script>
@stop