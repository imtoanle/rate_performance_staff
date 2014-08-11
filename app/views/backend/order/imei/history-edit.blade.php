@extends(Config::get('view.backend.master'))
@section('content')
<div class="row">
<div class="col-md-6">
	<div class="panel panel-info" data-collapsed="0">
		
		<!-- panel head -->
		<div class="panel-heading">
			<div class="panel-title">{{trans('all.member')}} [{{$client->id}}]</div>
			
			<div class="panel-options">
				<a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
			</div>
		</div>
		
		<!-- panel body -->
		<div class="panel-body">
			
			<table class="table responsive bottom-border" style="margin-bottom: 0;">
			<tbody>
				<tr>
					<td>{{trans('all.username')}}</td>
					<td>{{$client->username}}</td>
				</tr>
				
				<tr>
					<td>{{trans('all.balance')}}</td>
					<td>{{$client->amount}}</td>
				</tr>

				<tr>
					<td>{{trans('all.status')}}</td>
					<td>{{$client->active}}</td>
				</tr>
			</tbody>
		</table>
			
		</div>
		
	</div>

	<div class="panel panel-info" data-collapsed="0">
		
		<!-- panel head -->
		<div class="panel-heading">
			<div class="panel-title">{{trans('all.services')}} [{{$service->id}}]</div>
			
			<div class="panel-options">
				<a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
			</div>
		</div>
		
		<!-- panel body -->
		<div class="panel-body">
			
			<table class="table responsive bottom-border" style="margin-bottom: 0;">
			<tbody>
				<tr>
					<td>{{trans('all.services')}}</td>
					<td>{{$service->name}}</td>
				</tr>
				
				<tr>
					<td>{{trans('all.credit')}}</td>
					<td>{{$service->getPricing($client->clientgroup_id)->pricing}}</td>
				</tr>

				<tr>
					<td>{{trans('all.api-connection')}}</td>
					<td>{{ isset($service->api->name) ? $service->api->name : trans('all.backend.no-api')}}</td>
				</tr>
				
			</tbody>
		</table>
			
		</div>
		
	</div>
</div>
<div class="col-md-6">
	<div class="panel panel-info" data-collapsed="0">
		
		<!-- panel head -->
		<div class="panel-heading">
			<div class="panel-title">{{trans('all.order')}} [{{$order->id}}]</div>
			
			<div class="panel-options">
				<a href="index.html#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
				<a href="index.html#" data-rel="collapse"><i class="entypo-down-open"></i></a>
			</div>
		</div>
		
		<!-- panel body -->
		<div class="panel-body">
			
			<table class="table responsive bottom-border" style="margin-bottom: 0;">
			<tbody>
				<tr>
					<td>IMEI</td>
					<td>{{$order->bulk_imei}}</td>
				</tr>
				<tr>
					<td>{{trans('all.status')}}</td>
					<td>{{$order->status}}</td>
				</tr>

				<tr>
					<td>{{trans('all.result')}}</td>
					<td><a href="#" id="edit-result" data-name="code" data-pk="{{$order->id}}" data-type="textarea" data-value="{{$order->code}}" class="editable-click">{{empty($order->code) ? trans("all.empty") : str_limit($order->code, 100)}}</a></td>
				</tr>

				<tr>
					<td>{{trans('all.services-page.comment')}}</td>
					<td>{{$order->comment}}</td>
				</tr>

				<tr>
					<td>{{trans('all.service-imei-page.response-email')}}</td>
					<td>{{$order->response_email}}</td>
				</tr>

				<tr>
					<td>{{trans('all.ajax-detail-order.created_at')}}</td>
					<td>{{$order->created_at->format('d/m/Y')}}</td>
				</tr>

				<tr>
					<td>{{trans('all.ajax-detail-order.updated_at')}}</td>
					<td>{{$order->updated_at->format('d/m/Y')}}</td>
				</tr>
				
			</tbody>
		</table>
			
		</div>
		
	</div>
</div>
</div>

<script type="text/javascript">
jQuery(window).load(function()
{
	var $ = jQuery;
	$('#edit-result').editable({
    emptytext: '{{trans('all.empty')}}',
    url: '{{route("quickReplyImeiOrders")}}',
    source: [
              {value: {{Config::get('variable.order-status.pending')}}, text: '{{trans("variable.order-status.pending")}}'},
              {value: {{Config::get('variable.order-status.denied')}}, text: '{{trans("variable.order-status.denied")}}'},
              {value: {{Config::get('variable.order-status.processing')}}, text: '{{trans("variable.order-status.processing")}}'},
           ],
    ajaxOptions: {type: "PUT"},
    success: function(response, newValue) {
        if(response.dataStatus === false) return response.message; //msg will be shown in editable form
    }
  });

 
});
</script>
@stop