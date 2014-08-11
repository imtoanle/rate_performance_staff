	<ul class="nav tabs-vertical {{ $dir == 'right' ? 'right-aligned' : '' }}">
		@foreach ($datas as $data)
		<li class="{{(Route::currentRouteName()==$data[1] ? "active" : '')}}"><a href="{{isset($id) ? route($data[1], $id) : route($data[1])}}">{{$data[0]}}</a></li>
		@endforeach
	</ul>