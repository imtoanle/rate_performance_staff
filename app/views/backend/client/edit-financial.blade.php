@extends(Config::get('view.backend.master'))
@section('content')
<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.client'), 'id' => $client->id, 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<div class="ajax-alert"></div>
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-primary" data-collapsed="0">
						
						<!-- panel head -->
						<div class="panel-heading">
							<div class="panel-title">{{trans('all.financial-info')}}</div>
						</div>
						
						<!-- panel body -->
						<div class="panel-body">
							<div class="row">							
								<div class="col-md-12">
									<form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('addCreditClientFinancial', $client->id)}}" method="post" role="form">

										<div class="form-group">
											<label class="col-sm-3 control-label">{{trans('all.add-credit')}}</label>
											
											<div class="col-sm-7">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
													<input type="text" name="add_credit" class="form-control">
													<span class="input-group-addon"><i class="entypo-plus-circled"></i></span>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">{{trans('all.service-imei-page.note-order')}}</label>
											
											<div class="col-sm-7">
												<textarea class="form-control" name="comment"></textarea>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-9">
												<div class="checkbox checkbox-replace color-green">
													<input type="checkbox" name="generate_invoice" checked disabled>
													<label>{{trans('all.generate-invoice')}}</label>
												</div>

												<div class="checkbox checkbox-replace color-green">
													<input type="checkbox" name="invoice_paid">
													<label>{{trans('all.paid')}}</label>
												</div>

												<div class="checkbox checkbox-replace color-green">
													<input type="checkbox" name="email_financial_info" checked>
													<label>{{trans('all.backend.send-financial-info-via-mail')}}</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-5">
												<button class="btn btn-green" data-loading-text="{{trans('all.loading')}}" type="submit">{{trans('all.update')}}</button>
											</div>
										</div>

										
									</form>
								</div>
							</div>
							
						</div>
						
					</div>
				</div>

				<div class="col-md-6">
				<div class="panel panel-primary" data-collapsed="0">
						
						<!-- panel head -->
						<div class="panel-heading">
							<div class="panel-title">{{trans('all.financial-info')}}</div>
						</div>
						
						<!-- panel body -->
						<div class="panel-body">
							<div class="row">							
								<div class="col-md-12">
									<form class="form-horizontal form-groups-bordered ajax-submit-form" id="form-ajax" action="{{route('rebateCreditClientFinancial', $client->id)}}" method="post" role="form">

										<div class="form-group">
											<label class="col-sm-3 control-label">{{trans('all.rebate-credit')}}</label>
											
											<div class="col-sm-7">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
													<input type="text" name="rebate_credit" class="form-control">
													<span class="input-group-addon"><i class="entypo-minus-circled"></i></span>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">{{trans('all.settings.invoice')}}</label>
											
											<div class="col-sm-7">
												<select class="form-control" name="invoice_id">
												@foreach($clientInvoices as $invoice)
													<option value="{{$invoice->id}}">#{{$invoice->id}} - $ {{$invoice->total_price}}</option>
												@endforeach
												</select>
												<span>{{trans('all.backend.finnancial-rebate-note')}}</span>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">{{trans('all.service-imei-page.note-order')}}</label>
											
											<div class="col-sm-7">
												<textarea class="form-control" name="comment"></textarea>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-9">
												<div class="checkbox checkbox-replace color-red">
													<input type="checkbox" name="email_financial_info" checked>
													<label>{{trans('all.backend.send-financial-info-via-mail')}}</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-5">
												<button class="btn btn-red" data-loading-text="{{trans('all.loading')}}" type="submit">{{trans('all.update')}}</button>
											</div>
										</div>

										
									</form>
								</div>
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>













@stop