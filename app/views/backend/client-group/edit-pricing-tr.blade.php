@foreach($services as $service)
<?php $pricing = $service->getPricing($groupId)?>
<tr>
	<td>{{$service->name}}</td>
	<td>{{$service->credit}}</td>
	<td><a href="#" data-name="pricing" data-pk="{{$pricing->id}}" data-type="text" class="editable-click">{{$pricing->pricing}}</a></td>
</tr>
@endforeach