<table class="table table-hover bold-head">
	<thead>
		<tr>
			<th>{{trans('all.order')}}</th>
			<th>IMEI</th>
			<th>FILE</th>
			<th>SERVER</th>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td>{{trans('variable.order-status.completed')}}</td>
			<td><span class="badge badge-success">{{$orderArray[Config::get('variable.service-group-type.IMEI')][Config::get('variable.order-status.completed')]}}</span></td>
			<td><span class="badge badge-success">{{$orderArray[Config::get('variable.service-group-type.FILE')][Config::get('variable.order-status.completed')]}}</span></td>
			<td><span class="badge badge-success">{{$orderArray[Config::get('variable.service-group-type.SERVER')][Config::get('variable.order-status.completed')]}}</span></td>
		</tr>

		<tr>
			<td>{{trans('variable.order-status.processing')}}</td>
			<td><span class="badge badge-info">{{$orderArray[Config::get('variable.service-group-type.IMEI')][Config::get('variable.order-status.processing')]}}</span></td>
			<td><span class="badge badge-info">{{$orderArray[Config::get('variable.service-group-type.FILE')][Config::get('variable.order-status.processing')]}}</span></td>
			<td><span class="badge badge-info">{{$orderArray[Config::get('variable.service-group-type.SERVER')][Config::get('variable.order-status.processing')]}}</span></td>
		</tr>

		<tr>
			<td>{{trans('variable.order-status.denied')}}</td>
			<td><span class="badge badge-danger">{{$orderArray[Config::get('variable.service-group-type.IMEI')][Config::get('variable.order-status.denied')]}}</span></td>
			<td><span class="badge badge-danger">{{$orderArray[Config::get('variable.service-group-type.FILE')][Config::get('variable.order-status.denied')]}}</span></td>
			<td><span class="badge badge-danger">{{$orderArray[Config::get('variable.service-group-type.SERVER')][Config::get('variable.order-status.denied')]}}</span></td>
		</tr>
		
	</tbody>
</table>

<!-- Users -->
<table class="table table-hover bold-head">
	<thead>
		<tr>
			<th colspan="2">{{trans('all.member')}}</th>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td>{{trans('all.active')}}</td>
			<td><span class="badge badge-success">{{$userArray[Config::get('variable.client-status.active')]}}</span></td>
		</tr>

		<tr>
			<td>{{trans('all.inactive')}}</td>
			<td><span class="badge badge-danger">{{$userArray[Config::get('variable.client-status.inactive')]}}</span></td>
		</tr>

		<tr>
			<td>{{trans('all.new-member')}}</td>
			<td><span class="badge badge-info">{{$userArray[Config::get('variable.client-status.active')] + $userArray[Config::get('variable.client-status.inactive')]}}</span></td>
		</tr>

		
	</tbody>
</table>


<!-- Lua thu ve -->
<table class="table table-hover bold-head">
	<thead>
		<tr>
			<th style="width:70%">{{trans('all.backend.dashboard.completed-order-credit')}}</th>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td>USD</td>
			<td><span class="label label-info">$ {{$priceCompletedOrder}}</span></td>
		</tr>
	</tbody>
</table>