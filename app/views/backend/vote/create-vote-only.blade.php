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
        <h3 class="form-section">{{trans('all.vote-info')}}</h3>
        @include(Config::get('view.backend.little-new-vote-form'))

      </div>
      <div class="form-actions right">
        <input type="hidden" name="vote_group_id" value="{{$vote_group_id}}" />
        <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> {{trans('all.save')}}</button>
      </div>
    </form>
    <!-- END FORM-->
  </div>
</div>