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
  <form action="{{route('postReportYear')}}" class="form-horizontal" method="POST">
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
            <option value="" disabled selected>{{trans('all.select-report-type')}}</option>
            <option value="1">Báo cáo theo phòng ban</option>
            <option value="2">Báo cáo tổng hợp cả ban</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label">{{trans('all.select-department')}}</label>
        <div class="col-md-8">
          <select name="select2_department" class="form-control select2">
            <option></option>
            @foreach($departments as $department)
            <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
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

<script>
jQuery(document).ready(function() {
  $("select[name=select2_department]").select2({
    placeholder: '{{trans('all.select-department')}}',
    allowClear: true,
  });
 
});


</script>
@stop