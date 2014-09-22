<!-- BEGIN PAGE HEADER-->
  <div class="row">
    <div class="col-md-12">
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title">
      Dashboard <small>statistics and more</small>
      </h3>
      <ul class="page-breadcrumb breadcrumb">
        @foreach($dataBreadcrumb as $bread)
        <li>
          @if(!empty($bread[0]))
          <i class="{{$bread[0]}}"></i>
          @endif
          <a @if(!empty($bread[2])) href="{{$bread[2]}}" @endif>{{$bread[1]}}</a>
          @if(!isset($bread[3]))
          <i class="fa fa-angle-right"></i>
          @endif
        </li>
        @endforeach
        <li class="pull-right">
          <div id="dashboard-report-range" class="dashboard-date-range tooltips" data-placement="top" data-original-title="Change dashboard date range">
            <i class="fa fa-calendar"></i>
            <span>
            </span>
            <i class="fa fa-angle-down"></i>
          </div>
        </li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
  </div>
  <!-- END PAGE HEADER-->