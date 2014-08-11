<form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('updateClientGroup', $clientGroup->id)}}" method="put" role="form">
			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.group-name')}}</label>
				
				<div class="col-sm-5">
					<input type="text" name="name" value="{{$clientGroup->name}}" class="form-control">
				</div>
			</div>
		</form>

