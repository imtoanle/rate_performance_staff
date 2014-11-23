@extends(Config::get('view.backend.master'))
@section('content')
<div class="container">
	<section class="page-not-found">
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
				<div class="page-not-found-main">
					<h2>404 <i class="icon icon-file"></i></h2>
					<p>{{trans('all.error-404-desc')}}</p>
				</div>
			</div>
			<div class="col-md-4">
				<h4>{{trans('all.useful-links')}}</h4>
				
			</div>
		</div>
	</section>

</div>
@stop