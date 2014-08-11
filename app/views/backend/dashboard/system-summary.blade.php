@extends(Config::get('view.backend.master'))
@section('content')
<div class="row">
	<div class="col-md-6">
		<div id="summary-month" class="panel panel-primary" data-collapsed="0">
			
			<!-- panel head -->
			<div class="panel-heading">
				<select name="ajax-load-summary" class="select2" data-allow-clear="false" data-placeholder="{{trans('all.choose-service')}}">
					@foreach($timeArray as $year => $months)
						@foreach(explode(',', $months) as $month)
							<option value="{{$month}}-{{$year}}" {{($currentMonth == $month.'-'.$year) ? 'selected' : ''}}>{{trans('all.month')}} {{$month}} - {{trans('all.year')}} {{$year}}</option>
						@endforeach
					@endforeach
				</select>
			</div>
			
			<!-- panel body -->
			<div class="panel-body">
				
				
				
				
			</div>
			
		</div>
	</div>

	<div class="col-md-6">
		<div id="summary-total" class="panel panel-primary" data-collapsed="0">
			
			<!-- panel head -->
			<div class="panel-heading">
				<div class="panel-title">{{trans('all.total')}}</div>
			</div>
			
			<!-- panel body -->
			<div class="panel-body">
			
				@include(Config::get('view.backend.dashboard.system-summary-child'))
				
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
;(function($, window, undefined){

  "use strict";
  
  $(document).ready(function()
  { 

  	loadSummary();
  $('select[name=ajax-load-summary]').change(function()
  {
    loadSummary();
  });


});

  function loadSummary()
  {
  	$.ajax({
      url: document.URL,
      data: 'select_time='+$('select[name=ajax-load-summary]').val(),
      success: function(response)
      {
        $('#summary-month .panel-body').html(response);
      }
    });
  }
})(jQuery, window);
</script>
@stop