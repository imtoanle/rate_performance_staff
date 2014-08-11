<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="row">
  <div class="col-md-6">
    <!-- BEGIN ALERTS PORTLET-->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>{{trans('all.new-group')}}
        </div>
      </div>
      <div class="portlet-body">
        <!-- BEGIN FORM-->
        <form action="{{route('newGroupPost')}}" type="POST" class="form-horizontal base-ajax-form">
          <div class="form-body">
            <div class="form-group">
              <label class="col-md-3 control-label">{{trans('all.group-name')}}</label>
              <div class="col-md-9">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-group"></i>
                  </span>
                  <input type="text" class="form-control" name="group_name" placeholder="{{trans('all.group-name')}}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12" style="margin-bottom: 5px;">
                <label class="control-label">{{trans('all.permission')}}</label>
                <label class="col-md-offset-5 control-label">{{trans('all.selected-permission')}}</label>
              </div>

              <div class="">
                <div class="col-md-12">
                  <select multiple="multiple" class="multi-select" id="select_permissions" name="select_permissions[]">
                    @foreach($permissions as $permission)
                    <?php
                      $currentGroup = isset($tagGroup) ? $tagGroup : 'first';
                      $tagGroup = explode("_", $permission->value)[0];
                    ?>
                    @if($tagGroup != $currentGroup)
                      @if($currentGroup != 'first')
                        </optgroup>
                      @endif
                    <optgroup label="{{trans('all.permission-group-name.'.$tagGroup)}}">
                    @endif
                      <option value="{{$permission->value}}">{{$permission->name}}</option>
                    @endforeach
                    </optgroup>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-actions fluid">
            <div class="col-md-offset-3 col-md-9">
              <button type="submit" class="btn btn-info">{{trans('all.update')}}</button>
            </div>
          </div>
        </form>
        <!-- END FORM-->

      </div>
    </div>
    <!-- END ALERTS PORTLET-->
  </div>

  <div class="col-md-6">
   
  </div>
</div>


@include(Config::get('view.backend.footer-js'))
<script>
jQuery(document).ready(function() {   
  $('#select_permissions').multiSelect({
      selectableOptgroup: true
  });
})
</script>