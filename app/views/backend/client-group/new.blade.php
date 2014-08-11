<form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('createClientGroup')}}" method="post" role="form">
			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.group-name')}}</label>
				
				<div class="col-sm-5">
					<input type="text" name="name" value="" class="form-control">
				</div>
			</div>
		</form>