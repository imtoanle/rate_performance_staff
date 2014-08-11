@extends(Config::get('view.backend.master'))
@section('content')
<form id="datatable-form" action-delete="{{route('deleteClient')}}"> 
<div class="ajax-alert"></div>
<table class="table table-bordered table-striped datatable">
	<thead>
		<tr>
			<th></th>
			<th>Id</th>
			<th>{{trans('all.username')}}</th>
			<th>{{trans('all.email')}}</th>
			<th>{{trans('all.amount')}}</th>
			<th>{{trans('all.status')}}</th>
			<th>{{trans('all.actions')}}</th>
		</tr>
	</thead>
	
	<tbody>
	</tbody>
</table>
</form>
<a href="{{route('newClient')}}" class="btn btn-primary btn-icon icon-left">
	<i class="entypo-plus"></i>
	{{trans('all.add-new-service')}}
</a>

<a id="deleteMulti" class="btn btn-danger btn-icon icon-left">
	<i class="entypo-cancel"></i>
	{{trans('all.delete')}}
</a>



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
    "sAjaxSource": "<?php echo URL::route('indexClient') ?>",
    "sServerMethod": "POST",
		"aoColumns": [
			{"sWidth": "5%", "bSortable": false},
			{"sWidth": "5%", "bSortable": false},
			{"sWidth": "30%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
			{"sWidth": "10%", "bSortable": false},
			{"sWidth": "10%", "bSortable": false},
			{"sWidth": "180px", "bSortable": false}
		]
	});
	
	$(".dataTables_wrapper select").select2({
		minimumResultsForSearch: -1
	});
	
	// Highlighted rows
});


// Sample Function to add new row
var giCount = 1;

function fnClickAddRow() 
{
	$('#table-2').dataTable().fnAddData(['<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount+".2", giCount+".3", giCount+".4", giCount+".5" ]);
	
	replaceCheckboxes(); // because there is checkbox, replace it
	
	giCount++;
}
</script>

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

<div class="modal fade" id="edit-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{trans('all.edit-service')}}</h4>
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
@stop