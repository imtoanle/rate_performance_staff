<form class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('createImeiServiceGroup')}}" method="post" role="form">

	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('all.group-name')}}</label>
		
		<div class="col-sm-5">
			<input type="text" name="group_name" value="" class="form-control">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">{{trans('all.status')}}</label>
		
		<div class="col-sm-5">
			<div class="make-switch" data-on-label="<i class='entypo-check'></i>" data-off-label="<i class='entypo-cancel'></i>">
			<input type="checkbox" name="group_active" checked />
			</div>
		</div>
	</div>
	
</form>

<script src="{{asset('assets/js/bootstrap-switch.min.js')}}"></script>