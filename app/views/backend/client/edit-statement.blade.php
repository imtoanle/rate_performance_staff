@extends(Config::get('view.backend.master'))
@section('content')

<div class="tabs-vertical-env">
	@include(Config::get('view.backend.submenu'), array('datas' => Config::get('variable.backend.sub-menus.client'), 'id' => $client->id, 'dir' => 'right'))
	<div class="tab-content">
		<div class="tab-pane active">
			<form id="datatable-form" action-delete="{{route('deleteClientStatements')}}"> 
				<div class="ajax-alert"></div>
				<table class="table table-bordered table-striped datatable">
					<thead>
						<tr>
							<th></th>
							<th>#Id</th>
							<th>{{ trans('all.date')}}</th>
	            <th>{{trans('all.description')}}</th>
	            <th>{{trans('all.service-imei-page.type')}}</th>
	            <th>{{trans('all.invoice-page.price')}}</th>
	            <th>{{ trans('all.add-fund-page.current-balance')}}</th>
	            <th>SID</th>
						</tr>
					</thead>
					
					<tbody>
					</tbody>
				</table>
				</form>
				<a id="deleteMulti" class="btn btn-danger btn-icon icon-left">
					<i class="entypo-cancel"></i>
					{{trans('all.delete')}}
				</a>



				

				
		</div>
	</div>
</div>



</div>
				<!-- Modal 1 (Basic)-->
				<div class="modal fade" id="confirm-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">{{trans('all.confirm')}}</h4>
							</div>
							
							<div class="modal-body">
								{{trans('all.confirm-modal-delete')}}
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
								<button type="button" class="btn btn-info btn-confirm">{{trans('all.ok')}}</button>
							</div>
						</div>
					</div>
				</div>
				<div>

				<div class="modal fade" id="ajax-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							
							<div class="modal-body">
							
								{{trans('all.loading')}}
								
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
								<button type="button" class="btn btn-info btn-ok">{{trans('all.update')}}</button>
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
						"sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
						"bStateSave": false,
						"iDisplayLength": 10,
						"bServerSide": true,
				    "sAjaxSource": "<?php echo URL::route('indexClientStatements', $client->id) ?>",
						"aoColumns": [
							{"sWidth": "5%", "bSortable": false},
							{"sWidth": "5%", "bSortable": false},
							{"sWidth": "20%", "bSortable": false},
	            { "bSortable": false, "sWidth": "30%" },
	            { "sWidth": "15%", "bSortable": false},
	            { "sWidth": "10%", "bSortable": false },
	            { "bSortable": false, "sWidth": "10%" },
	            { "bSortable": false, "sWidth": "5%" },
						]
					});
					
					$(".dataTables_wrapper select").select2({
						minimumResultsForSearch: -1
					});
					
					// Highlighted rows
				});


				</script>
@stop