@extends(Config::get('view.backend.master'))
@section('content')
<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.client'), 'id' => $client->id, 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<div class="ajax-alert"></div>
			<div class="row">
				<div class="col-md-3">
						<div class="tile-stats tile-aqua">
							<div class="icon"><i class="fa fa-dollar"></i></div>
							<h3>{{trans('all.balance')}}</h3>
							<div class="num" data-start="0" data-end="{{$client->amount}}" data-prefix="$ " data-duration="500" data-delay="0">$ {{$client->amount}}</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="tile-stats tile-purple">
							<div class="icon"><i class="fa fa-dollar"></i></div>
							<h3>{{trans('all.lock-amount')}}</h3>
							<div class="num" data-start="0" data-end="{{round($lockedAmount)}}" data-prefix="$ " data-duration="500" data-delay="500">$ {{round($lockedAmount)}}</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="tile-stats tile-orange">
							<div class="icon"><i class="fa fa-dollar"></i></div>
							<h3>{{trans('all.total-receipts')}}</h3>
							<div class="num" data-start="0" data-end="{{round($paidInvoice)}}" data-prefix="$ " data-duration="500" data-delay="1000">$ {{round($paidInvoice)}}</div>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="tile-stats tile-green">
							<div class="icon"><i class="fa fa-dollar"></i></div>
							<h3>{{trans('all.sell-credit-limit')}}</h3>
							<div class="num"><i class="fa fa-dollar"></i> 83</div>
						</div>
					</div>
					
				</div>
				<div class="row">
				<div class="profile-env col-md-6">
					
					<header class="row">
						
						<div class="col-sm-offset-1 col-sm-4">
							
							<a href="#" class="profile-picture">
								<img src="{{asset('assets/images/profile-picture.png')}}" class="img-responsive img-circle" />
							</a>
							
						</div>
						
						<div class="col-sm-7">
							
							<ul class="profile-info-sections">
								<li>
									<div class="profile-name">
										<strong>
											<a>{{$client->name}}</a>
											<a class="user-status is-{{$client->active ? 'active' : 'inactive'}} tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="{{$client->active ? trans('all.active') : trans('all.inactive')}}"></a>
																	</strong>
										<span><a>{{$client->group->name}}</a></span>
									</div>
								</li>
								
							</ul>
							
						</div>
						
					</header>
					
					<section class="profile-info-tabs">
						
						<div class="row">
							
							<div class="col-md-offset-3 col-sm-9">
								
								<ul class="user-details">
									<li><a><i class="entypo-mail"></i>{{$client->email}}</a></li>
									<li><a><i class="entypo-location"></i>{{$client->address1}}</a></li>
									<li><a><i class="entypo-phone"></i>{{$client->phone}}</a></li>
									<li><a><i class="entypo-calendar"></i>{{$client->created_at->format('d/m/Y')}}</a></li>
								</ul>
								
							</div>
							
						</div>
						
					</section>
					
					
				</div>
				<div class="col-sm-6">
				<strong>{{trans('all.order-summary')}}</strong>
					<div id="line-chart-order-summary" class="morrischart" style="height: 290px"></div>
				</div>
				</div>


				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-primary" data-collapsed="0">
							
							<!-- panel head -->
							<div class="panel-heading">
								<div class="panel-title">{{trans('all.quick-action')}}</div>
							</div>
							
							<!-- panel body -->
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12 cursor-pointer">
										<a id="reset-pass-via-email"><i class="fa fa-caret-right"></i> {{trans('all.backend.client-profile.reset-pass-send-mail')}}</a> <br />
										<a><i class="fa fa-caret-right"></i> {{trans('all.backend.client-profile.reset-pin-send-mail')}}</a>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-9">
										<select name="ajax-load-action-mail" class="select2" data-allow-clear="false" data-placeholder="{{trans('all.choose-service')}}">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
									<div class="col-md-3" style="padding-top: 5px;">
										<button type="button" class="btn btn-success">{{trans('all.submit')}}</button>
									</div>
								
								</div>
							</div>
							
						</div>

					</div>

					<div class="col-md-6">
					<table class="table table-bordered">
								<thead>
									<tr>
										<th class="panel panel-primary">{{trans('all.backend.client-profile.top-service')}}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($topUsedService as $service)
									<tr>
										<td>
											<div class="row">
												<div class="col-md-9">{{$service['service_name']}}</div>
												<div class="col-md-3"><span class="badge badge-info badge-roundless">{{$service['total']}}</span></div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>

					</div>


					
				</div>



				<div class="row">
					<div class="col-md-4">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="panel panel-primary">{{trans('all.invoice-by-user')}}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="row">
											<div class="col-md-6">{{trans('all.paid')}}</div>
											<div class="col-md-6"><span class="badge badge-info">{{$invoiceBilling[Config::get('variable.invoice-created-status.user')][Config::get('variable.invoice-status.paid')]['total']}}</span><div class="label label-info"><strong>$ {{$invoiceBilling[Config::get('variable.invoice-created-status.user')][Config::get('variable.invoice-status.paid')]['sum_price']}}</strong></div></div>
										</div>
									</td>
								</tr>

								<tr>
									<td>
										<div class="row">
											<div class="col-md-6">{{trans('all.unpaid')}}</div>
											<div class="col-md-6"><span class="badge badge-info">{{$invoiceBilling[Config::get('variable.invoice-created-status.user')][Config::get('variable.invoice-status.unpaid')]['total']}}</span><div class="label label-info"><strong>$ {{$invoiceBilling[Config::get('variable.invoice-created-status.user')][Config::get('variable.invoice-status.unpaid')]['sum_price']}}</strong></div></div>
										</div>
									</td>
								</tr>

								<tr>
									<td>
										<div class="row">
											<div class="col-md-6">{{trans('all.cancelled')}}</div>
											<div class="col-md-6"><span class="badge badge-info">{{$invoiceBilling[Config::get('variable.invoice-created-status.user')][Config::get('variable.invoice-status.cancel')]['total']}}</span><div class="label label-info"><strong>$ {{$invoiceBilling[Config::get('variable.invoice-created-status.user')][Config::get('variable.invoice-status.cancel')]['sum_price']}}</strong></div></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>

					</div>


					<div class="col-md-4">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="panel panel-primary">{{trans('all.invoice-by-admin')}}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="row">
											<div class="col-md-6">{{trans('all.paid')}}</div>
											<div class="col-md-6"><span class="badge badge-info">{{$invoiceBilling[Config::get('variable.invoice-created-status.admin')][Config::get('variable.invoice-status.paid')]['total']}}</span><div class="label label-info"><strong>$ {{$invoiceBilling[Config::get('variable.invoice-created-status.admin')][Config::get('variable.invoice-status.paid')]['sum_price']}}</strong></div></div>
										</div>
									</td>
								</tr>

								<tr>
									<td>
										<div class="row">
											<div class="col-md-6">{{trans('all.unpaid')}}</div>
											<div class="col-md-6"><span class="badge badge-info">{{$invoiceBilling[Config::get('variable.invoice-created-status.admin')][Config::get('variable.invoice-status.unpaid')]['total']}}</span><div class="label label-info"><strong>$ {{$invoiceBilling[Config::get('variable.invoice-created-status.admin')][Config::get('variable.invoice-status.unpaid')]['sum_price']}}</strong></div></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="col-md-4">
					<table class="table table-bordered">
								<thead>
									<tr>
										<th class="panel panel-primary">{{trans('all.services')}}</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="row">
												<div class="col-md-6">{{trans('all.services')}} IMEI</div>
												<div class="col-md-6"><div class="label label-info"><strong>{{$totalOrder[Config::get('variable.service-group-type.IMEI')][Config::get('variable.order-status.completed')]}} / {{$totalOrder[Config::get('variable.service-group-type.IMEI')][5]}}</strong></div></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="row">
												<div class="col-md-6">{{trans('all.services')}} FILE</div>
												<div class="col-md-6"><div class="label label-info"><strong>{{$totalOrder[Config::get('variable.service-group-type.FILE')][Config::get('variable.order-status.completed')]}} / {{$totalOrder[Config::get('variable.service-group-type.FILE')][5]}}</strong></div></div>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="row">
												<div class="col-md-6">{{trans('all.services')}} SERVER</div>
												<div class="col-md-6"><div class="label label-info"><strong>{{$totalOrder[Config::get('variable.service-group-type.SERVER')][Config::get('variable.order-status.completed')]}} / {{$totalOrder[Config::get('variable.service-group-type.SERVER')][5]}}</strong></div></div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>

					</div>
				</div>




				<script type="text/javascript">
				jQuery(document).ready(function($) 
				{

					$('#reset-pass-via-email').click(function(){
						showAjaxClickResult('{{route("editClientResetPass", $client->id)}}', 'post', '')
					});
					// Line Charts
					var line_chart_demo = $("#line-chart-order-summary");
					
					Morris.Line({
						parseTime: false,
						element: 'line-chart-order-summary',
						data: [
						@foreach($chartOrderSummary as $key => $value)
							{ y: 'T{{$key}}', a: {{$value[Config::get('variable.service-group-type.IMEI')]}}, b: {{$value[Config::get('variable.service-group-type.FILE')]}}, c: {{$value[Config::get('variable.service-group-type.SERVER')]}} },
						@endforeach
						],
						xkey: 'y',
						ykeys: ['a', 'b', 'c'],
						labels: ['IMEI', 'FILE', 'SERVER'],
						redraw: true
					});
					
					line_chart_demo.parent().attr('style', '');

				})
				</script>

		</div>
	</div>
</div>




@stop