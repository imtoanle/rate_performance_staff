<select class="form-control" name="service_cat">
	@foreach($serviceCats as $cat)
	<option value="{{$cat->id}}" {{ $cat->id == $service->getCatId() ?  'selected="selected"' : ''}}>{{$cat->name}}</option>
	@endforeach
</select>