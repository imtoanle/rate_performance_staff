
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
      @include(Config::get('view.backend.breadcrumbs'))
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