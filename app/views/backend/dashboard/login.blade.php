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
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Conquer | Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/select2_conquer.css')}}"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="{{asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{asset('assets/css/pages/login.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="http://www.keenthemes.com/preview/conquer/favicon.ico"/>
</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
  <img src="{{asset('assets/img/logo.png')}}" alt=""/>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
  <!-- BEGIN LOGIN FORM -->
  <form class="login-form" action="index.html" method="post">
    <h3 class="form-title">{{trans('all.login-notice')}}</h3>
    <div class="alert alert-error display-hide">
      <button class="close" data-close="alert"></button>
      <span>
         {{trans('all.enter-user-and-password')}}
      </span>
    </div>
    <div class="form-group">
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">{{trans('all.username')}}</label>
      <div class="input-icon">
        <i class="fa fa-user"></i>
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="{{trans('all.username')}}" name="username"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">{{trans('all.password')}}</label>
      <div class="input-icon">
        <i class="fa fa-lock"></i>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="{{trans('all.password')}}" name="password"/>
      </div>
    </div>
    <div class="form-actions">
      <label class="checkbox">
      <input type="checkbox" name="remember" value="1"/> {{trans('all.remember-me')}} </label>
      <button type="submit" class="btn btn-info pull-right">
      {{trans('all.sign-in')}} </button>
    </div>
    <div class="forget-password">
      <h4>{{trans('all.forgot-passord')}} ?</h4>
      <p>
         Bấm vaò <a href="javascript:;" id="forget-password">đây</a>
        để khôi phục mật khẩu.
      </p>
    </div>
  </form>
  <!-- END LOGIN FORM -->
  <!-- BEGIN FORGOT PASSWORD FORM -->
  <form class="forget-form" action="index.html" method="post">
    <h3>{{trans('all.forgot-passord')}} ?</h3>
    <p>
       {{trans('all.enter-email-to-recovery-pass')}}
    </p>
    <div class="form-group">
      <div class="input-icon">
        <i class="fa fa-envelope"></i>
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
      </div>
    </div>
    <div class="form-actions">
      <button type="button" id="back-btn" class="btn btn-default">
      <i class="m-icon-swapleft"></i> {{trans('all.back')}} </button>
      <button type="submit" class="btn btn-info pull-right">
      {{trans('all.submit')}} </button>
    </div>
  </form>
  <!-- END FORGOT PASSWORD FORM -->
  <!-- BEGIN REGISTRATION FORM -->
  <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
   2014 &copy; Khatoco. Admin Vote User.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('assets/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/plugins/excanvas.min.js')}}"></script> 
<![endif]-->
<script src="{{asset('assets/plugins/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/scripts/app.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/login.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
var require_username = "{{trans('all.require-username')}}",
      require_password = "{{trans('all.require-password')}}";

jQuery(document).ready(function() {     
  App.init();
  Login.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>