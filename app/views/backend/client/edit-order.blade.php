@extends(Config::get('view.backend.master'))
@section('content')

<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.client'), 'id' => $client->id, 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<div class="ajax-alert"></div>
			<form id="datatable-form" action-delete="{{route('deleteServices')}}"> 
				<div class="ajax-alert"></div>
				<table class="table table-bordered table-striped datatable">
					<thead>
						<tr>
							<th colspan="2">
								<select name="change_service_group">
									<option value="1">IMEI</option>
									<option value="2">FILE</option>
									<option value="3">SERVER</option>
								</select>
							</th>
							<th colspan="4"></th>
						</tr>
						<tr>
							<th>Id</th>
							<th>{{trans('all.date')}}</th>
							<th>{{trans('all.services')}}</th>
							<th id="service-group-title">IMEI</th>
							<th>{{trans('all.status')}}</th>
							<th>{{trans('all.actions')}}</th>
						</tr>
					</thead>
					
					<tbody>
					</tbody>

						
				</table>
				</form>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(window).load(function()
{
	var $ = jQuery,
		valueServiceGroup = {{Config::get('variable.service-group-type.IMEI')}};
	
	$('select[name=change_service_group]').change(function(){
		valueServiceGroup = $(this).val();
		tableData.fnDraw();
		$('#service-group-title').html($(this).find('option:selected').text());
	});

	tableData  = $("table.datatable").dataTable({
		"sPaginationType": "bootstrap-backend",
		//"sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
		"sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
		"bStateSave": false,
		"iDisplayLength": 10,
		"bServerSide": true,
    "sAjaxSource": "<?php echo URL::route('editClientOrder', $client->id) ?>",
    "fnServerParams": function ( aoData ) {
      aoData.push( { "name": "service_group_id", "value": valueServiceGroup } );
    },
		"aoColumns": [
			{"sWidth": "5%", "bSortable": false},
			{"sWidth": "15%", "bSortable": false},
			{"sWidth": "30%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
			{"sWidth": "15%", "bSortable": false},
			{"sWidth": "90px", "bSortable": false}
		],
		"oTableTools": {
			}
	});
	
});

</script>
@stop