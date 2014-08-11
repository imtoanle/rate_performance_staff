@extends(Config::get('view.backend.master'))
@section('content')

<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.order'), 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<div class="ajax-alert"></div>
			<form id="datatable-form" action-url="{{route('updateQuickAcceptImeiOrders')}}" method="put"> 
				<table class="table table-bordered table-striped datatable">
					<thead>
						<tr>
							<th></th>
							<th>Id</th>
							<th>{{trans('all.services')}}</th>
							<th>{{trans('all.date')}}</th>
							<th>IMEI</th>
						</tr>
					</thead>
					
					<tbody>
					</tbody>
				</table>
				</form>
				<a id="actionMulti" class="btn btn-success btn-icon icon-left">
					<i class="entypo-check"></i>
					{{trans('all.backend.accept-select')}}
				</a>

				<a id="actionAll" class="btn btn-success">
					{{trans('all.backend.accept-all')}}
				</a>

		</div>
	</div>
</div>
</div>

<div class="modal fade" id="confirm-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{trans('all.confirm')}}</h4>
			</div>
			
			<div class="modal-body">
				{{trans('all.backend.confirm-modal-notice')}}
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
				<button type="button" class="btn btn-info btn-confirm">{{trans('all.ok')}}</button>
			</div>
		</div>
	</div>
</div>
<div>
<script type="text/javascript">
jQuery(window).load(function()
{
	var $ = jQuery;
	
	tableData  = $("table.datatable").dataTable({
		"sPaginationType": "bootstrap-backend",
		//"sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
		"sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
		"bStateSave": false,
		"iDisplayLength": 10,
		"bServerSide": true,
    "sAjaxSource": document.URL,
		"aoColumns": [
			{"sWidth": "5%", "bSortable": false},
			{"sWidth": "10%", "bSortable": false},
			{"sWidth": "40%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
		]
	});
	
	// Highlighted rows
});

</script>
@stop