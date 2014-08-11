@foreach($services as $service)
<tr>
	<td><a href="#" data-name="name" data-pk="{{$service->id}}" data-type="text" class="editable-click">{{$service->name}}</a></td>
	<td><a href="#" data-name="delivery_time" data-pk="{{$service->id}}" data-type="text" class="editable-click">{{$service->delivery_time}}</a></td>
	<td><a href="#" data-name="credit" data-pk="{{$service->id}}" data-type="text" class="editable-click">{{$service->credit}}</a></td>
</tr>
@endforeach