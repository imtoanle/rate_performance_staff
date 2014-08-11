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
					<th style="width:25%">{{trans('all.time')}}</th>
					<th style="width:25%">{{trans('all.credit')}}</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($servicesOfFirstCat as $service)
				<tr>
					<td><a href="#" data-name="name" data-pk="{{$service->id}}" data-type="text" class="editable-click">{{$service->name}}</a></td>
					<td><a href="#" data-name="delivery_time" data-pk="{{$service->id}}" data-type="text" class="editable-click">{{$service->delivery_time}}</a></td>
					<td><a href="#" data-name="credit" data-pk="{{$service->id}}" data-type="text" class="editable-click">{{$service->credit}}</a></td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
<script type="text/javascript">
;(function($, window, undefined){

  "use strict";
  
  $(document).ready(function()
  { 

  $('select[name=ajax-load-service]').change(function()
  {
    $.ajax({
      url: document.URL,
      data: 'service_cat='+$(this).val(),
      success: function(response)
      {
        $('table tbody').html(response);
      }
    });
  });

  $('table tbody').editable({
    mode: 'inline',
    selector: 'a',
    inputclass: 'large-width-input',
    url: '{{route("updateQuickEditImeiServices")}}',
    ajaxOptions: {type: "PUT"},
    success: function(response, newValue) {
        if(response.dataStatus === false) return response.message; //msg will be shown in editable form
    }
  });


});
})(jQuery, window);
</script>
@stop