@extends(Config::get('view.backend.master'))
@section('content')
<div class="row">
	<div class="col-md-12">
	<div class="alert alert-info">
		To enable APi automation features to run, make sure you set up a cron job to run Every minute.Create the following Cron Job using PHP  | <a target="_blank" href="http://dhru.com/knowledgebase/999147/How-to-setup-a-Cron-job.html" style="text-decoration: none; color: black">How to setup a Cron job in
			cPanel</a><br>
		<div style="padding: 5px; border: #B5D3FF 1px dotted; margin: 10px">/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php</div>
		<strong>OR</strong> Set Up separate cron jobs by api server <strong>(recommended)</strong><br>
<div style="padding: 5px; border: #B5D3FF 1px dotted; margin: 10px">
/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=bbcodes<br>/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=berryunlocks<br>/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=fusionfreedomobile<br>/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=gsmfather<br>/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=imeichecknet<br>/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=lgtool<br>/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=fusion20<br>/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=fusionunlockking<br></div>


For File Service api set up this crons separately and <strong>run every
			10 minute</strong>
		<div style="padding: 5px; border: #B5D3FF 1px dotted; margin: 10px">
/usr/bin/wget -O - -q -t 1 http://fusiondemo.dhru.com/includes/cron.php?action=bruteforcemarket&amp;service=file<br></div>
<div style="float: right;">
			<form method="post" id="frm">
Cron Password : <input type="text" name="cron_password" value=""> <input type="button" class="addFromgallery" id="btns" name="save" value="Save" onclick="SubmitForm ('#btns','settingappear','#frm','#notification','true','#main_loader');">
			</form>
		</div>
		<br> <br>
	</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h4 class="border-orange"><strong>ACTIVATED</strong></h4>
	</div>

	<div class="col-md-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="col-md-10"><strong>API Server Name</strong></th>
					<th class="col-md-2"><strong>Action</strong></th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($activatedApis as $api)
				<tr>
					<td>{{$api->name}}</td>
					<td><a href="{{route('editApiSetting', $api->id)}}">Edit & Synchronize</a></td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>


	<div class="col-md-12">
		<h4 class="border-orange"><strong>INACTIVATED</strong></h4>
	</div>

	<div class="col-md-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="col-md-10"><strong>API Server Name</strong></th>
					<th class="col-md-2"><strong>Action</strong></th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($inactiveApis as $api)
				<tr>
					<td>{{$api->name}}</td>
					<td><button href="" class="btn btn-green">Active</button></td>
				</tr>
				@endforeach
				
				
			</tbody>
		</table>
	</div>
</div>
@stop