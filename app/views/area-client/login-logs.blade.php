<table class="table table-striped">
	<thead>
		<tr>
			<th>IP</th>
			<th>{{trans('all.country')}}</th>
			<th>{{trans('all.time')}}</th>
		</tr>
	</thead>
	<tbody>
	@foreach($loginLogs as $log)
	<?php try { $location = GeoIP::getLocation($log->ip); } catch(\Exception $e) { $location = 'unknown'; } ?>
		<tr>
			<td>{{$log->ip}}</td>
			<td>
				@if($location != 'unknown')
					{{$location['country']}} <img src="{{ asset('img/flags/'.$location['isoCode'].'.gif') }}" />
				@else
					{{trans('all.unknown')}}
				@endif
			</td>
			<td>{{$log->created_at->format('d-m-Y H:i:s')}}</td>
		</tr>
	@endforeach
	</tbody>
</table>