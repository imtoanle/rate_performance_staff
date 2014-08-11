<div class="row">
	<div class="col-sm-3">
		{{trans('all.services')}}:
	</div>
	<div class="col-sm-9">
		{{$order->service_name}}
	</div>
</div>
<hr style="margin:5px;"/>

<div class="row">
	<div class="col-sm-3">
		IMEI:
	</div>
	<div class="col-sm-9">
		{{$order->bulk_imei}}
	</div>
</div>
<hr style="margin:5px;"/>

<div class="row">
	<div class="col-sm-3">
		{{trans('all.result')}}:
	</div>
	<div class="col-sm-9">
		{{$order->code}}
	</div>
</div>
<hr style="margin:5px;"/>

<div class="row">
	<div class="col-sm-3">
		{{trans('all.ajax-detail-order.created_at')}}:
	</div>
	<div class="col-sm-9">
		{{$order->created_at->format('d/m/Y H:i:s')}}
	</div>
</div>
<hr style="margin:5px;"/>

<div class="row">
	<div class="col-sm-3">
		{{trans('all.ajax-detail-order.updated_at')}}:
	</div>
	<div class="col-sm-9">
		@if($order->updated_at != $order->created_at)
		{{$order->updated_at->format('d/m/Y H:i:s')}}
		@else
		{{trans('all.not-yet-result')}}
		@endif
	</div>
</div>
<hr style="margin:5px;"/>

<div class="row">
	<div class="col-sm-3">
		{{trans('all.coin')}}:
	</div>
	<div class="col-sm-9">
		{{$order->credit}}
	</div>
</div>
