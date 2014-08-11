@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		@include(Config::get('view.services-nav'))
		<div class="col-md-9">

			<h3>{{$detailService->name}}</h3>


			<div class="row">
		<div class="col-md-12">
				<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info">
						<p><i class="icon icon-shopping-cart"></i> <strong>{{trans('all.service-imei-page.price')}}:</strong> <span class="cal_price"><span class="credit">{{$detailService->credit}}</span> {{trans('all.coin')}}</span></p>
						<p><i class="icon icon-clock-o"></i> <strong>{{trans('all.service-imei-page.delivery-time')}}: </strong> {{$detailService->delivery_time}}</p>
						{{$detailService->content}}
					</div>
				</div>
			</div>
		</div>
			</div>
	</div>
</div>
<script>
function add_imei()
{
	var imei = document.getElementById('imei1').value + document.getElementById('imei2').value;
	if(imei.length == 15)
	{
		if(document.getElementById('imei_bulk').value == ''){
			document.getElementById('imei_bulk').value = imei; 
		}else{
			document.getElementById('imei_bulk').value = document.getElementById('imei_bulk').value + "\r\n" + imei; 
		}
		document.getElementById('imei1').value = '';
		document.getElementById('imei2').value = '';
	}else{
		alert ('IMEI Must be filled up!');	
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
		var imei = document.getElementById('imei1').value;
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
			document.getElementById('imei2').value = step3;
			
		else
		{	
			document.getElementById('imei1').value = removeNotDigits(document.getElementById('imei1').value);
			luhnCheck();	
		}
}
function remove_imei2(){
	if(document.getElementById('imei1').value == '' ){
		document.getElementById('imei2').value = ''; 	
	}
}
</script>
@stop