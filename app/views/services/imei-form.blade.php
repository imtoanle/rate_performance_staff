<div class="row">
	<div class="col-md-6">
	<h4>{{$detailService->name}}</h4>
	<div class="ajax-alert"></div>
	<form id="create-data-form" action="{{URL::route('client-create-order')}}">
		<div class="row">
			<div class="form-group">
					<label class="col-sm-12">IMEI *</label>
					<div class="col-sm-8">
						<input type="text" value="" class="form-control" name="imei1" id="imei1" onblur="remove_imei2()" onkeyup="luhnCheck()" maxlength="14">
					</div>
					<div class="col-sm-4">
						<input type="text" value="" maxlength="100" class="form-control" name="imei2" id="imei2" readonly="true">
					</div>
			</div>
		</div>
		<div class="row col-sm-12">
			<div class="form-group">
				<button type="button" class="btn btn-default" onclick="add_imei()">{{ trans('all.services.add-multi-imei') }}</button>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<div class="col-md-12">
					<label>{{trans('all.services.multi-imei')}}</label>
					<textarea maxlength="5000" rows="10" class="form-control" name="imei_bulk" id="imei_bulk" style="height: 138px;"></textarea>
					<span>{{trans('all.services.notice-multi-imei')}}</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<div class="col-md-12">
					<label>{{trans('all.services.notice')}}:</label>
					<input type="text" value="" class="form-control" name="notice" id="notice">
					<span>{{trans('all.services.span-notice')}}</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<div class="col-md-12">
					<label>{{trans('all.services.comment')}}</label>
					<textarea maxlength="5000" rows="3" class="form-control" name="comment" id="comment" style="height: 50px;"></textarea>
					<span>{{trans('all.services.notice-comment')}}</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<div class="col-md-12">
					<label>{{trans('all.services.response-email')}}:</label>
					<input type="text" value="" class="form-control" name="response_email" id="response_email">
					<span>{{trans('all.services.notice-reponse-email')}}</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<input type="submit" value="Submit" class="btn btn-primary" data-loading-text="Loading...">
			</div>
		</div>
		<input type="hidden" name="service_id" value="{{$detailService->id}}">
	</form>
</div>

<div class="col-md-6">
		<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info">
				<strong>Heads up!</strong> This alert needs your attention, but it's not super important.
				<br />
				This alert needs your attention, but it's not super important.
				This alert needs your attention, but it's not super important.
				This alert needs your attention, but it's not super important.
				This alert needs your attention, but it's not super important.
				This alert needs your attention, but it's not super important.
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