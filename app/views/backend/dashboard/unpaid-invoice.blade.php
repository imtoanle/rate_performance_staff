@extends(Config::get('view.backend.master'))
@section('content')
<div class="ajax-alert"></div>
<form id="datatable-form" action-url="{{route('cancelUnpaidInvoice')}}" method="put"> 
	<table class="table table-bordered table-striped datatable">
		<thead>
			<tr>
				<th colspan="3">
					<div class="col-md-6">Người tạo</div>
					<div class="col-md-6">
					<select name="invoice-who-created">
						<option value="{{Config::get('variable.invoice-created-status.user')}}">{{trans('all.member')}}</option>
						<option value="{{Config::get('variable.invoice-created-status.admin')}}">{{trans('all.admin')}}</option>
					</select>
					</div>
				</th>
				<th colspan="4"></th>
			</tr>
			<tr>
				<th></th>
				<th>Id</th>
				<th>{{trans('all.username')}}</th>
				<th>{{trans('all.date')}}</th>
				<th>{{trans('all.due-date')}}</th>
				<th>{{trans('all.total')}}</th>
				<th>{{trans('all.actions')}}</th>
			</tr>
		</thead>
		
		<tbody>
		</tbody>

			
	</table>
	</form>

<a id="actionMulti" class="btn btn-success btn-icon icon-left">
	<i class="entypo-check"></i>
	{{trans('all.backend.cancel-selected')}}
</a>


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
	var $ = jQuery,
		valueServiceGroup = {{Config::get('variable.invoice-created-status.user')}};
	
	$('select[name=invoice-who-created]').change(function(){
		valueServiceGroup = $(this).val();
		tableData.fnDraw();
	});

	tableData  = $("table.datatable").dataTable({
		"sPaginationType": "bootstrap-backend",
		//"sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
		"sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
		"bStateSave": false,
		"iDisplayLength": 10,
		"bServerSide": true,
    "sAjaxSource": document.URL,
    "fnServerParams": function ( aoData ) {
      aoData.push( { "name": "admin_created", "value": valueServiceGroup } );
    },
		"aoColumns": [
			{"sWidth": "5%", "bSortable": false},
			{"sWidth": "10%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
			{"sWidth": "15%", "bSortable": false},
			{"sWidth": "20%", "bSortable": false},
		],
		"oTableTools": {
			}
	});
	
});

</script>

@stop