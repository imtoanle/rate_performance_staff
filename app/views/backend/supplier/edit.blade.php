<form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('updateSupplier', $supplier->id)}}" method="put" role="form">

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.username')}}</label>
				
				<div class="col-sm-5">
					<input type="text" name="username" value="{{$supplier->username}}" class="form-control">
				</div>
			</div>

		

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.password')}}</label>
				
				<div class="col-sm-5">
					<input type="password" name="password" value="{{$supplier->password}}" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.email')}}</label>
				
				<div class="col-sm-5">
					<input type="text" name="email" value="{{$supplier->email}}" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">{{trans('all.status')}}</label>
				
				<div class="col-sm-5">
					<div class="make-switch" data-on-label="<i class='entypo-check'></i>" data-off-label="<i class='entypo-cancel'></i>">
						<input type="checkbox" name="active" {{ $supplier->status ? 'checked="checked"' : ''}} />
					</div>
				</div>
			</div>

			
		</form>


		<script src="{{asset('assets/js/bootstrap-switch.min.js')}}"></script>