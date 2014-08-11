@extends(Config::get('view.backend.master'))
@section('content')

<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.client'), 'id' => $client->id, 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<div class="ajax-alert"></div>
			<form class="form-horizontal form-groups-bordered ajax-submit-form" action="{{route('updateClientProfile', $client->id)}}" method="put" role="form">
				<div class="row">
				<div class="col-md-6">
				<div data-collapsed="0" class="panel panel-primary">
							
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">{{trans('all.account-info')}}</div>
						
						<div class="panel-options">
							<a data-rel="collapse" href="index.html#"><i class="entypo-down-open"></i></a>
						</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body" style="display: block;">
						
						

							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.username')}} *</label>
								
								<div class="col-sm-8">
									<input disabled type="text" name="username" value="{{$client->username}}" class="form-control">
								</div>
							</div>

						

							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.password')}}</label>
								
								<div class="col-sm-8">
									<input type="password" name="password" value="" class="form-control">
									<div><button id="reset-pass-btn" type="button" class="btn btn-success" data-loading-text="{{trans('all.loading')}}">{{trans('all.backend.client-profile.reset-pass-send-mail')}}</button></div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.email')}} *</label>
								
								<div class="col-sm-8">
									<input type="text" name="email" value="{{$client->email}}" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.client-group-text')}}</label>
								
								<div class="col-sm-8">
									<select name="client_group" class="form-control">
										@foreach($clientGroups as $group)
										<option value="{{$group->id}}" {{$client->group->id == $group->id ? 'selected="selected"' : ''}}>{{$group->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.language')}}</label>
								
								<div class="col-sm-8">
									<select class="form-control" name="language">
										@foreach(Config::get('variable.languages') as $value)
											<option value="{{$value}}"  {{$client->language == $value ? 'selected="selected"' : ''}}>{{ trans('all.languages.'.$value)}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.send-mail')}}</label>
								<div class="col-sm-8">
									<div class="input-group">
										<select name="ajax-load-action-mail" class="select2" data-allow-clear="false" data-placeholder="{{trans('all.choose-service')}}">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
										
										<span class="input-group-btn">
											<button class="btn btn-success" type="button">{{trans('all.submit')}}</button>
										</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">{{trans('all.status')}}</label>
								
								<div class="col-sm-8">
									<div class="make-switch" data-on-label="<i class='entypo-check'></i>" data-off-label="<i class='entypo-cancel'></i>">
										<input type="checkbox" name="active" checked/>
									</div>
								</div>
							</div>

					</div>
					
				</div>
				</div>

				<div class="col-md-6">
				<div data-collapsed="0" class="panel panel-primary">
							
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">{{trans('all.settings.personal-info')}}</div>
						
						<div class="panel-options">
							<a data-rel="collapse" href="index.html#"><i class="entypo-down-open"></i></a>
						</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body" style="display: block;">

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('all.full-name')}}</label>
								
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" class="form-control" name="full_name" value="{{$client->name}}" placeholder="{{trans('all.full-name')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('all.phone')}}</label>
								
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" class="form-control" name="phone" value="{{$client->phone}}" placeholder="+(84) 932550039" data-mask="+(99) 9{1,10}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('all.address')}}</label>
								
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" class="form-control" name="address" value="{{$client->address}}" placeholder="{{trans('all.address')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('all.city')}}</label>
								
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" class="form-control" name="city" value="{{$client->city}}" placeholder="{{trans('all.city')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('all.state')}}</label>
								
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" class="form-control" name="state" value="{{$client->state}}" placeholder="{{trans('all.state')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('all.zip-code')}}</label>
								
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" class="form-control" name="zip_code" value="{{$client->zip_code}}" placeholder="{{trans('all.zip-code')}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">{{trans('all.country')}}</label>
								
								<div class="col-sm-5">
									<div class="input-group">
										<input type="text" class="form-control" name="country" value="{{$client->country}}" placeholder="{{trans('all.country')}}">
									</div>
								</div>
							</div>
						
					</div>
					
				</div>
				</div>
				</div>
				<div class="form-group default-padding">
					<button type="submit" class="btn btn-success" data-loading-text="{{trans('all.loading')}}">{{trans('all.update')}}</button>
				</div>
				</form>
		</div>
	</div>
</div>



<script type="text/javascript">
jQuery(document).ready(function($) 
{
	$('#reset-pass-btn').click(function(){
		showAjaxClickResult('{{route("editClientResetPass", $client->id)}}', 'post', '')
	});
})
</script>
@stop