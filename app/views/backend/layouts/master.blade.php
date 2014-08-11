
<!DOCTYPE html>
<!-- 
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0.3
Version: 1.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
@include(Config::get('view.backend.header'))
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      @include(Config::get('view.backend.left-nav'))
    </div>
  </div>
</div>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <div class="page-content-wrapper">
    <div class="page-content">
      <!-- BEGIN PAGE HEADER-->
      <div class="row">
        <div class="col-md-12">
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          <h3 class="page-title">
          Dashboard <small>statistics and more</small>
          </h3>
          <ul class="page-breadcrumb breadcrumb">
            <li>
              <i class="fa fa-home"></i>
              <a href="index.html">Home</a>
              <i class="fa fa-angle-right"></i>
            </li>
            <li>
              <a href="index.html#">Dashboard</a>
            </li>
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
      <div class="page-content-body">
        @yield('content')
      </div>
    </div>
  </div>
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
<div class="footer-inner">
   2013 &copy; Conquer by keenthemes.
</div>
<div class="footer-tools">
  <span class="go-top">
    <i class="fa fa-angle-up"></i>
  </span>
</div>
</div>
<!-- END FOOTER -->
@include(Config::get('view.backend.master-js'))
</body>
<!-- END BODY -->
</html>