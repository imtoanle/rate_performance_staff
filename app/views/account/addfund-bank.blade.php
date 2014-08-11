@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="row featured-boxes login">
				<div class=" col-md-12">
					<div class="featured-box featured-box-secundary default info-content">
						<div class="box-content">
							{{$addFundBank->content}}
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>

@stop
