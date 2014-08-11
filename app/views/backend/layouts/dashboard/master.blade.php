<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Neon Admin Panel" />
  <meta name="author" content="Laborator.co" />
  
  <title>{{ (!empty($siteName)) ? $siteName : "Syntara"}} - {{isset($title) ? $title : '' }}</title>
  
  @if (!empty($favicon))
  <link rel="icon" {{ !empty($faviconType) ? 'type="$faviconType"' : '' }} href="{{ $favicon }}" />
  @endif
  <link rel="stylesheet" href="{{asset('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/font-icons/entypo/css/entypo.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/font-icons/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/google-fonts.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap-min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/neon-core-min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/neon-theme-min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/neon-forms-min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/custom-min.css')}}">

  <script src="{{asset('assets/js/jquery-1.11.0.min.js')}}"></script>
  <script>$.noConflict();</script>

  <!--[if lt IE 9]><script src="http://demo.neontheme.com/assets/js/ie8-responsive-file-warning.js')}}"></script><![endif]-->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
  <![endif]-->
  
  
  <!-- TS1398827429: Neon - Responsive Admin Template created by Laborator -->
</head>
<body class="page-body {{isset($bodyClass) ? $bodyClass : ''}}" data-url="{{route('indexHome')}}">

<div class="page-container">    
  <div class="sidebar-menu">
    <header class="logo-env">

      <!-- logo -->
      <div class="logo">
        <a href="{{asset('dashboard/main/index.html')}}">
          <img src="{{asset('assets/images/logo@2x.png')}}" width="120" alt="" />
        </a>
      </div>
      
      <!-- logo collapse icon -->
                    
      <div class="sidebar-collapse">
        <a href="index.html#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
          <i class="entypo-menu"></i>
        </a>
      </div>
        
      <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
      <div class="sidebar-mobile-menu visible-xs">
        <a href="index.html#" class="with-animation"><!-- add class "with-animation" to support animation -->
          <i class="entypo-menu"></i>
        </a>
      </div>
        
    </header>

    @include(Config::get('view.backend.left-nav'))
                
  </div>  

  <div class="main-content">
    @include(Config::get('view.backend.header'))
    @yield('content')
    <!-- Footer -->
    <footer class="main">
      &copy; 2014 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>
    </footer>
  </div>
    
  @include(Config::get('view.backend.chat'))
</div>
  
  <!-- Current page css -->
  
  <script src="{{asset('assets/js/gsap/main-gsap.js')}}"></script>
  <script src="{{asset('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.js')}}"></script>
  <script src="{{asset('assets/js/joinable.js')}}"></script>
  <script src="{{asset('assets/js/resizeable.js')}}"></script>
  <script src="{{asset('assets/js/neon-api.js')}}"></script>
  <script src="{{asset('assets/js/cookies.min.js')}}"></script>

  <!-- Current page js -->
  @if(in_array(Route::currentRouteName(), array('indexDashboard')))
    <link rel="stylesheet" href="{{asset('assets/js/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/rickshaw/rickshaw.min.css')}}">
    <script src="{{asset('assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js')}}"></script>
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/js/rickshaw/vendor/d3.v3.js')}}"></script>
    <script src="{{asset('assets/js/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('assets/js/raphael-min.js')}}"></script>
    <script src="{{asset('assets/js/morris.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr.js')}}"></script>
    <script src="{{asset('assets/js/fullcalendar/fullcalendar.min.js')}}"></script>
  @endif
  <!-- Datatable -->
  @if(in_array(Route::currentRouteName(), array('indexImeiServices', 'indexImeiServiceGroups', 'indexSupplier', 'indexClient', 'indexClientGroup', 'quickEditImeiServices', 'editClientInvoiceUser', 'editClientStatement', 'historyImeiOrders', 'quickReplyImeiOrders', 'unpaidInvoiceDashboard', 'editClientOrder', 'editClientInvoice', 'manualReplyImeiOrders', 'quickAcceptImeiOrders', 'memberClientGroup')))
    <link rel="stylesheet" href="{{asset('assets/js/datatables/responsive/css/datatables.responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/select2/select2-bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/select2/select2.css')}}">
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/TableTools.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/datatables/jquery.dataTables.columnFilter.js')}}"></script>
    <script src="{{asset('assets/js/datatables/lodash.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/responsive/js/datatables.responsive.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.min.js')}}"></script>
  @endif
  @if(in_array(Route::currentRouteName(), array('editImeiServices', 'newImeiServices', 'editImeiServiceGroups', 'newImeiServiceGroup', 'newSupplier', 'newClient', 'editClientProfile')))
    <script src="{{asset('assets/js/bootstrap-switch.min.js')}}"></script>
  @endif

  @if(in_array(Route::currentRouteName(), array('editImeiServiceApi', 'editClientGroupPricing', 'systemSummaryDashboard', 'editClient', 'editClientProfile')))
    <link rel="stylesheet" href="{{asset('assets/js/select2/select2-bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/select2/select2.css')}}">
    <script src="{{asset('assets/js/select2/select2.min.js')}}"></script>
  @endif

  @if(in_array(Route::currentRouteName(), array('quickEditImeiServices', 'editClientGroupPricing', 'quickReplyImeiOrders', 'editHistoryImeiOrders')))
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-editable.css')}}">
    <script src="{{asset('assets/js/bootstrap-editable.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-mockjax/1.5.3/jquery.mockjax.js"></script>
    
  @endif
  
  @if(in_array(Route::currentRouteName(), array('editClient')))
    <script src="{{asset('assets/js/raphael-min.js')}}"></script>
    <script src="{{asset('assets/js/morris.min.js')}}"></script>
  @endif
  
  @if(in_array(Route::currentRouteName(), array('editImeiServices')))
    <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/ckeditor/adapters/jquery.js')}}"></script>
  @endif

  <script src="{{asset('assets/js/custom.js')}}"></script>
  <script src="{{asset('assets/js/neon-chat.js')}}"></script>
  <script src="{{asset('assets/js/neon-custom.js')}}"></script>
  <script src="{{asset('assets/js/neon-demo.js')}}"></script>
  <script src="{{asset('assets/js/neon-skins.js')}}"></script>
</body>
</html>