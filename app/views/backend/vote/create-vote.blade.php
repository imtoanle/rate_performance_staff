<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>{{trans('all.create-vote')}}
    </div>
    <div class="tools">
      <a href="javascript:;" class="collapse"></a>
      <a href="form_layouts.html#portlet-config" data-toggle="modal" class="config"></a>
      <a href="javascript:;" class="reload"></a>
      <a href="javascript:;" class="remove"></a>
    </div>
  </div>
  <div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form action="{{route('postNewVote')}}" class="form-horizontal base-ajax-form" type="POST">
      <div class="form-body">
        <h3 class="form-section">{{trans('all.info-vote-group')}}</h3>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.vote-code')}}</label>
          <div class="col-md-8">
            <input type="text" name="vote_code" class="form-control" placeholder="VD: VOTE102014">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.title')}}</label>
          <div class="col-md-8">
            <input type="text" name="title" class="form-control" placeholder="VD: Đánh giá nhân viên tháng xx">
          </div>
        </div>

        <h3 class="form-section">{{trans('all.vote-info')}}</h3>
        @include(Config::get('view.backend.little-new-vote-form'))

      </div>
      <div class="form-actions right">
        <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> {{trans('all.save')}}</button>
      </div>
    </form>
    <!-- END FORM-->
  </div>
</div>