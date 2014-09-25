<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Conquer | Admin Dashboard Template</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="{{asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/pages/tasks.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->
<link rel="shortcut icon" href="http://www.keenthemes.com/preview/conquer/favicon.ico"/>
<script src="{{asset('assets/plugins/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="header-inner">
    <!-- BEGIN LOGO -->
    <a class="navbar-brand" href="index.html">
    <img src="{{asset('assets/img/logo.png')}}" alt="logo" class="img-responsive"/>
    </a>
    <form class="search-form search-form-header" role="form" action="index.html">
      <div class="input-icon right">
        <i class="fa fa-search"></i>
        <input type="text" class="form-control input-medium input-sm" name="query" placeholder="{{trans('all.search')}}...">
      </div>
    </form>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <img src="{{asset('assets/img/menu-toggler.png')}}" alt=""/>
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <ul class="nav navbar-nav pull-right">
      <!-- BEGIN NOTIFICATION DROPDOWN -->
      <li class="dropdown" id="header_notification_bar">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <i class="fa fa-warning"></i>
        <?php $notifys = $currentUser->unreadNotifys; ?>
        <span class="badge badge-success">
           {{count($notifys)}}
        </span>
        </a>
        <ul class="dropdown-menu extended notification">
          <li>
            <p>
              {{trans('all.you-have-notify', ['count' => count($notifys)]) }}
            </p>
          </li>
          <li>
            <ul class="dropdown-menu-list scroller" style="height: 250px;">
              @foreach($notifys as $notify)
              <li>
                <a class="view-notify-btn" href="{{ route('getNotify', $notify->id )}}">
                  {{$notify->content}}
                  <span class="time">({{$notify->created_at->diffForHumans()}})</span>
                </a>
              </li>
              @endforeach
            </ul>
          </li>
        </ul>
      </li>
      <!-- END NOTIFICATION DROPDOWN -->
      
      <li class="devider">
         &nbsp;
      </li>
      <!-- BEGIN USER LOGIN DROPDOWN -->
      <li class="dropdown user">
        <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <img alt="" src="{{asset('assets/img/avatar3_small.jpg')}}"/>
        <span class="username">
           {{$currentUser->full_name}}
        </span>
        <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('showUser', $currentUser->id)}}" class="ajaxify-child-page"><i class="fa fa-user"></i> {{trans('all.profile')}}</a>
          </li>
          <li class="divider">
          </li>
        </li>
        <li>
          <a href="{{route('logout')}}"><i class="fa fa-key"></i> {{trans('all.sign-out')}}</a>
        </li>
      </ul>
    </li>
    <!-- END USER LOGIN DROPDOWN -->
  </ul>
  <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->