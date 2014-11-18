<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Sửa phiếu đánh giá
    </div>

  </div>
  <div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form action="{{route('putVote', $vote->id)}}" class="form-horizontal base-ajax-form" type="PUT">
      <div class="form-body">
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