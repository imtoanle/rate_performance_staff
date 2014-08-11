<!-- BEGIN PAGE LEVEL PLUGINS -->
@if(in_array(Route::currentRouteName(), array('indexDashboard')))
<script src="{{asset('assets/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery.peity.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-knob/js/jquery.knob.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/flot/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js')}} for drag & drop support -->
<script src="{{asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
@endif

@if(in_array(Route::currentRouteName(), array('listPermissions', 'listGroups')))
<script type="text/javascript" src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/data-tables/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/data-tables/DT_bootstrap.js')}}"></script>
@endif
<!-- END PAGE LEVEL PLUGINS -->

<script>
jQuery(document).ready(function() {    
   @if(in_array(Route::currentRouteName(), array('indexDashboard')))
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initPeityElements();
   Index.initKnowElements();
   Index.initDashboardDaterange();
   Tasks.initDashboardWidget();
   @endif
});
</script>

dasdasdas