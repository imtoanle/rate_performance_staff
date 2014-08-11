@extends(Config::get('view.master'))
@section('content')
<link href="{{asset('css/chosen.min.css')}}" rel="stylesheet"/>
<div class="container">

	<div class="row">
		@include(Config::get('view.services-nav'))
		<div class="col-md-9">

			<h3>{{ trans('all.service-imei') }}</h3>
			<form class="ajax-submit-form" action="{{URL::route('client-create-order')}}" method="post">
				<div class="form-group">
					<div class="col-md-12">
					<select name="service_id" data-placeholder="{{trans('all.choice-service')}}" class="chosen-select" tabindex="5">
            <option value=""></option>
            @foreach($datas as $data)
            <optgroup label="{{ $data[0]->name }}">
            	@foreach($data[1] as $service)
              <option value="{{$service->id}}">{{$service->name}}</option>
              @endforeach
            </optgroup>
            @endforeach
          </select>
          </div>
        </div>

        <div class="row" style="margin-top:30px;">
				<div class="col-md-6">
				<div class="ajax-alert"></div>
				
					<div class="form-group">
							<label class="col-sm-12">IMEI *</label>
							<div class="col-sm-8">
								<input type="text" value="" class="form-control" name="imei1" id="imei1" onblur="remove_imei2()" onkeyup="luhnCheck()" maxlength="14">
							</div>
							<div class="col-sm-4">
								<input type="text" value="" maxlength="100" class="form-control" name="imei2" id="imei2" readonly="true">
							</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<div class="radio col-sm-6">
								<label>
									<input type="radio" checked="" value="single" name="typeImeiRadio">{{trans('all.service-imei-page.single-imei')}}
								</label>
							</div>
							<div class="radio col-sm-6" style="margin-top:10px;">
								<label>
									<input type="radio" value="multi" name="typeImeiRadio">{{trans('all.service-imei-page.multi-imei')}}
								</label>
							</div>
						</div>
					</div>

					<div id="input-multi-imei" class="hide">
						<div class="form-group">
							<div class="col-md-12">
								<button type="button" class="btn btn-default" onclick="add_imei()">{{ trans('all.service-imei-page.btn-add-multi-imei') }}</button>
							</div>
						</div>

						<div  class="form-group">
							<div class="col-md-12">
								<label>{{trans('all.service-imei-page.list-multi-imei')}}</label>
								<textarea maxlength="5000" rows="10" class="form-control" name="imei_bulk" id="imei_bulk" style="height: 138px;"></textarea>
								<span>{{trans('all.service-imei-page.notice-multi-imei')}}</span>
							</div>
						</div>
					</div>
			
					<div class="form-group">
						<div class="col-md-12">
							<label>{{trans('all.service-imei-page.note-order')}}</label>
							<textarea maxlength="5000" rows="3" class="form-control" name="comment" id="comment" style="height: 50px;"></textarea>
							<span>{{trans('all.service-imei-page.notice-note')}}</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<label>{{trans('all.service-imei-page.response-email')}}:</label>
							<input type="text" value="" class="form-control" name="response_email" id="response_email">
							<span>{{trans('all.service-imei-page.notice-response-email')}}</span>
						</div>
					</div>

					<div class="col-md-12">
						<input type="submit" value="{{trans('all.submit')}}" class="btn btn-primary" data-loading-text="Loading...">
					</div>
				
			</div>

			<div class="col-md-6">
					<div class="row">
					<div class="col-md-12">
						<div class="alert service-info">
						</div>
					</div>
				</div>
			</div>
				</div>
				{{Form::token()}}
				</form>
		</div>
	</div>
</div>
<script src="{{asset('js/chosen.jquery.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$('.chosen-select').chosen({no_results_text: "{{trans('all.not-found-service')}}"}).change(
	function () {
    $.ajax({
			url: "{{route('place-order-imei')}}",
			data: 'serviceId='+ $(this).val() + '&_token='+$('input[name=_token]').val(),
			method: "post",
			success: function(response)
			{
				var html_info = '<h4><strong>'+response.service['name']+'</strong></h4><br /> \
				<p><i class="icon icon-shopping-cart"></i> <strong>{{trans('all.service-imei-page.price')}}:</strong> <span class="cal_price"><span class="credit">'+response.service['price']+'</span> x <span class="amount_price">1</span> = '+response.service['price']+' {{trans('all.coin')}}</span></p>\
				<p><i class="icon icon-clock-o"></i> <strong>{{trans('all.service-imei-page.delivery-time')}}: </strong>'+response.service['delivery_time']+' </p>\
				'+ response.service['content'];
				jQuery('.alert.service-info').addClass('alert-info').html(html_info);
			}
		});
  }
  );

$('input[name=typeImeiRadio]').change(function()
	{
		if($(this).val() == 'multi')
		{
			$('#input-multi-imei').removeClass('hide');
		}else {
			$('#input-multi-imei').addClass('hide');
		}
	});

function add_imei()
{
	var imei = $('#imei1').val() + $('#imei2').val();
	if(imei.length == 15)
	{
		var qlt_imei, credit = parseFloat($('span.credit').html()).toFixed(2);

		if($('#imei_bulk').val() == ''){
			$('#imei_bulk').val(imei);
			qlt_imei = 1; 
		}else{
			$('#imei_bulk').val($('#imei_bulk').val() + "\r\n" + imei); 
			qlt_imei = parseFloat($('span.amount_price').html())+1;
		}
		$('#imei1').val('');
		$('#imei2').val('');

		$('span.cal_price').html('<span class="credit">'+credit+'</span> x <span class="amount_price">'+qlt_imei+'</span> = '+(qlt_imei*credit).toFixed(2)+' {{trans('all.coin')}}');

		
	}else{
		alert ('{{trans('all.service-imei-page.fill-up-all-imei')}}');	
	}
}
function checknumber(x) 
{
	var out
	var valid=/(^\d+$)|(^\d+\.\d+$)/;
	if (valid.test(x))
		out=true;
	else
		out=false;
	return out;
}
function luhnCheck()
{
		var imei = $('#imei1').val();
		var step2 = 0;
		var step2a = 0;
		var step2b = 0;
		var step3 = 0;
		for(var i=imei.length;i<14;i++)
			imei = imei + "0";
		for(var i=1;i<14;i=i+2)
		{
			var step1 = (imei.charAt(i))*2 + "0";
			step2a = step2a + parseInt(step1.charAt(0)) + parseInt(step1.charAt(1));
		}
		for(var i=0;i<14;i=i+2)		step2b = step2b + parseInt(imei.charAt(i));
		step2 = step2a + step2b;
		if(step2%10 == 0)
			step3 = 0;
		else
			step3 = 10 - step2%10;
			if(checknumber(step3))
			$('#imei2').val(step3);
			
		else
		{	
			$('#imei1').val(remove_not_digits($('#imei1').val()));
			luhnCheck();	
		}
}
function remove_imei2(){
	if($('#imei1').val() == '' ){
		$('#imei2').val(''); 	
	}
}
function remove_not_digits(imei) {
  return imei.replace(/[^0-9]/, '0');
}
</script>
@stop