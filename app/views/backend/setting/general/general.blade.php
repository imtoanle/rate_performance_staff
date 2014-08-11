@extends(Config::get('view.backend.master'))
@section('content')
<div class="tabs-vertical-env">
  <?php 
  $submenu = array(
    array(trans('all.general'), 'generalSetting'),
    );
  ?>
  @include(Config::get('view.backend.submenu'), array('datas' => $submenu, 'dir' => 'right'))
  <div class="tab-content">
    <div class="tab-pane active">
      <div class="ajax-alert"></div>
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-gradient" data-collapsed="0">
            
            <!-- panel head -->
            <div class="panel-heading">
              <div class="panel-title">{{trans('all.site-infomation')}}</div>
              
              <div class="panel-options">
                <a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
              </div>
            </div>
            
            <!-- panel body -->
            <div class="panel-body">
              
              <form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('updateImeiServices', 1)}}" method="put" role="form">

                <div class="form-group">
                  <label class="col-sm-3 control-label">{{trans('all.services')}}</label>
                  
                  <div class="col-sm-5">
                    <input type="text" name="service_name" value="" class="form-control">
                  </div>
                </div>
              </form>
              
            </div>
            
          </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-gradient" data-collapsed="0">
            
            <!-- panel head -->
            <div class="panel-heading">
              <div class="panel-title">Gradient Panel</div>
              
              <div class="panel-options">
                <a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
              </div>
            </div>
            
            <!-- panel body -->
            <div class="panel-body">
              
              <p>Article evident arrived express highest men did boy. Mistress sensible entirely am so. Quick can manor smart money hopes worth too. Comfort produce husband boy her had hearing. Law others theirs passed but wishes. You day real less till dear read. Considered use dispatched melancholy sympathize discretion led. Oh feel if up to till like.</p>
              
            </div>
            
          </div>
        </div>
      </div>

    </div>
  </div>
</div>




@stop