@extends(Config::get('view.backend.master'))
@section('content')

<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th style="width:50%">
						<select name="ajax-load-service" class="select2" data-allow-clear="false" data-placeholder="{{trans('all.choose-service')}}">
							@foreach($serviceCats as $cat)
							<option value="{{$cat->id}}">{{$cat->name}}</option>
							@endforeach
						</select>
					</th>
					<th style="width:20%">{{trans('all.original-price')}}</th>
					<th style="width:30%">{{trans('all.pricing-for-group')}}</th>
				</tr>
			</thead>
			
			<tbody>
			</tbody>
		</table>
<script type="text/javascript">
;(function($, window, undefined){

  "use strict";
  
  $(document).ready(function()
  { 

  load_data($('select[name=ajax-load-service]').val());
  $('select[name=ajax-load-service]').change(function()
  {
    load_data($(this).val());
  });

  $('table tbody').editable({
    mode: 'inline',
    selector: 'a',
    inputclass: 'large-width-input',
    url: '{{route("updateClientGroupPricing")}}',
    ajaxOptions: {type: "PUT"},
    success: function(response, newValue) {
        if(response.dataStatus === false) return response.message; //msg will be shown in editable form
    }
  });

  function load_data(select_val)
  {
  	$.ajax({
      url: document.URL,
      data: 'service_cat='+select_val,
      success: function(response)
      {
        $('table tbody').html(response);
      }
    });
  }


});
})(jQuery, window);
</script>
@stop